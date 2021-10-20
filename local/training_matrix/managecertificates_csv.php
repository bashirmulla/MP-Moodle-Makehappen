<?php
// Globals.
global $USER, $CFG,$DB;
$pluginname = 'training_matrix';

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/training_matrix/locallib.php');  // Include our function library.
require_login();

$homeurl    = new moodle_url('/local/training_matrix/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance() && !is_training_admin() && !is_siteadmin()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}

$where      = unserialize($_SESSION["managecertificates_csv"]["where"]);
$params     = unserialize($_SESSION["managecertificates_csv"]["params"]);
$filterData = unserialize($_SESSION["managecertificates_csv"]["filter_data"]);

if ($filterData['certificate_type']){
    $ctype = is_number($filterData['certificate_type']) ? $filterData['certificate_type'] : 0;
}
if ($filterData['status']){
    $status =  is_number($filterData['status'])? $filterData['status'] : 0;
}


$sql = "SELECT u.id,training_group_ids,idnumber,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u WHERE $where AND u.deleted = 0 ORDER BY name ASC";
$users = $DB->get_records_sql($sql,$params);

//populate csv final data array
$csvDataArray = array();

//inactive group certificate types
$SQL    = "SELECT required_certificates FROM {training_groups} WHERE status!=1";
$result =  $DB->get_records_sql($SQL);
$inactiveGPCert = array();
$inactiveGPCert2 = array();
foreach ($result as $data){
    $cetTypeIds = explode(",",$data->required_certificates);
    foreach ($cetTypeIds as $dd){
        $inactiveGPCert[$dd] = 1;
        $inactiveGPCert2[] = $dd;
    }
}

$certificate_groups    = get_datas(array('status' => 1),"training_groups");
$certificateGroups = array();
if(!empty($certificate_groups)){
    foreach ($certificate_groups AS $CG){
        $ctypes                     = explode(",",$CG->required_certificates);
        $certificateGroups[$CG->id] = $ctypes;
    }
}


$certificate_types     = get_certificate_types_listing('sortorder','ASC',"status=1");
$certificate_types_arr = array();
$csv_head[]  = 'ID Number';
$csv_head[]  = 'User Name';
foreach ($certificate_types as $certificate_type) {
    if(!empty($ctype) && $certificate_type->id!=$ctype) continue;
    $csv_head[] = $certificate_type->certificate_name;

    $certificate_types_obj = new stdClass();
    $certificate_types_obj->certificate_type_id = $certificate_type->id;
    $certificate_types_obj->certificate_expire = $certificate_type->certificate_expire;
    $certificate_types_arr[] = $certificate_types_obj;
}

if (!empty($users)) {
    foreach($users as $rec){
        if(in_array($rec->id,$CFG->not_genuine_user)) continue;
        if(!empty($filterData['status']) && !check_certificates_by_status($rec->id,$filterData['status'])) continue;

        $row_cells = array();
        $row_cells[] = $rec->idnumber;
        $row_cells[] = $rec->name;

        $userGroups = explode(",",$rec->training_group_ids);
        $userAllCrType = array();

        if(!empty($userGroups))
            foreach ($userGroups as $UG) {
                foreach ($certificateGroups[$UG] as $dd){
                    $userAllCrType[] = $dd;
                }
            }

        foreach ($certificate_types_arr as $objcertificate_types) {
            if(!empty($ctype) && $objcertificate_types->certificate_type_id!=$ctype) continue;
            $cell = new html_table_cell();
            $user_certificates = get_certificates_by_user($rec->id,$objcertificate_types->certificate_type_id);

            if ($user_certificates){
//                _p($user_certificates);
                if ($user_certificates[0]->certificate_expire=="No"){
                    $tbl_update_status      = $user_certificates[0]->update_status;
                    $tbl_certificate_status = $user_certificates[0]->certificate_status;

                    if($inactiveGPCert[$objcertificate_types->certificate_type_id]==1){
                        $cell_text   = "N/A";
                    }
                    elseif ($tbl_update_status==3){
                        $cell_text   = "Booked";
                    }elseif ($tbl_update_status==4){
                        $cell_text   = "Awaiting Certificate";
                    }elseif ($tbl_certificate_status==2){
                        $cell_text   = "Not Held";
                    }
                    elseif ($tbl_certificate_status==6 && in_array($objcertificate_types->certificate_type_id, @$userAllCrType)) {
                       $cell_text = "Not Held";

                    }
                    elseif ($tbl_certificate_status==6){
                        $cell_text   = "N/A";
                    }
                    else{
                        $cell_text   = "No Expiration";
                    }
                }else{

                    if($inactiveGPCert[$objcertificate_types->certificate_type_id]==1){
                        $cell_text   = "N/A";
                    }

                    else if(!empty($user_certificates[0]->expiry_date)){
                        $status1 = "";
                        if($user_certificates[0]->update_status==3)       $status1 = " (Booked)";
                        elseif($user_certificates[0]->update_status==4)   $status1 = " (Awaiting Certificate)";
                        elseif($user_certificates[0]->update_status==7 and $user_certificates[0]->certificate_status!=2)   $status = " (No Action required)";
                        elseif($user_certificates[0]->update_status==7 and $user_certificates[0]->certificate_status==2)   $status = " (Expired)";

                        $cell_text   = showDateTime($user_certificates[0]->expiry_date,'managecertificatedateonly'). "$status1";
                    }
                    else {

                        if ($user_certificates[0]->certificate_status == 2) {
                            $cell_text = "Not Held";
                        }
                        elseif ($user_certificates[0]->certificate_status == 6) {
                            $cell_text = "N/A";
                        }

                        if (in_array($objcertificate_types->certificate_type_id, @$userAllCrType)) {
                            $cell_text = "Not Held";
                        }

                        if ($user_certificates[0]->update_status == 3) {
                            $cell_text = "Booked";
                        }
                        elseif ($user_certificates[0]->update_status == 4) {
                            $cell_text = "Awaiting Certificate";
                        }
                        elseif ($user_certificates[0]->update_status == 7 &&
                            (empty($user_certificates[0]->copy_of_certificate) OR empty($user_certificates[0]->expiry_date))) {
                            $cell_text = "Not Held";
                        }

                    }
                }

                if($user_certificates[0]->update_status==8){
                    $cell_text    = 'Refresher Training not Required';
                }
            }
            elseif (in_array($objcertificate_types->certificate_type_id,@$userAllCrType)){

                $cell_text   = "Not Held";

            }
            else{
                $cell_text = 'N/A';

            }



            $row_cells[] = $cell_text;
        }

        $csvDataArray[] = $row_cells;
    }
}

//CSV snippet
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=managecertificates_csv.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, $csv_head);

// loop over the rows, outputting them
foreach($csvDataArray as $row){
    fputcsv($output, $row);
}
