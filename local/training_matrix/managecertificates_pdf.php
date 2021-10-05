<?php
ini_set('memory_limit', '2048M');
ini_set('max_execution_time', 0);
ini_set('upload_max_filesize', "512M");
ini_set('post_max_size', "1024M");
// Globals.
global $USER, $CFG,$DB,$SESSION,$PAGE;
define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/training_matrix/locallib.php');  // Include our function library.
require_once($CFG->libdir.'/pdflib.php');


$where      = unserialize($_SESSION["managecertificates_csv"]["where"]);
$params     = unserialize($_SESSION["managecertificates_csv"]["params"]);
$filterData = unserialize($_SESSION["managecertificates_csv"]["filter_data"]);


if ($filterData['certificate_type']){
    $ctype = is_number($filterData['certificate_type']) ? $filterData['certificate_type'] : 0;
}
if ($filterData['status']){
    $status =  is_number($filterData['status'])? $filterData['status'] : 0;
}

$sql = " SELECT u.id,training_group_ids,idnumber,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u WHERE $where AND u.deleted = 0 ORDER BY name ASC";
$users = $DB->get_records_sql($sql,$params);

$html   = "";
$html   .= html_writer:: start_tag('div',array('class'=>'table-responsive'));
$table = new html_table();
$table->attributes['class'] = 'generaltable';
$table->head  = array('ID Number','User Name');

$certificate_groups    = get_datas(array(),"training_groups");
$certificateGroups = array();
if(!empty($certificate_groups)){
    foreach ($certificate_groups AS $CG){
        $ctypes                     = explode(",",$CG->required_certificates);
        $certificateGroups[$CG->id] = $ctypes;
    }
}

$certificate_types     = get_certificate_types_listing('sortorder','ASC',"status=1");
$certificate_types_arr = array();

foreach ($certificate_types as $certificate_type) {
    if(!empty($ctype) && $certificate_type->id!=$ctype) continue;
    $table->head[] = $certificate_type->certificate_name;

    $certificate_types_obj = new stdClass();
    $certificate_types_obj->certificate_type_id = $certificate_type->id;
    $certificate_types_obj->certificate_expire = $certificate_type->certificate_expire;
    // $certificate_types_obj->certificate_status = $certificate_type->certificate_status;
    $certificate_types_arr[] = $certificate_types_obj;
}
if (!empty($users)) {
    foreach ($users as $user) {
        if(in_array($user->id,$CFG->not_genuine_user)) continue;
        if(!empty($status) && !check_certificates_by_status($user->id,$status)) continue;

        $row = new html_table_row();

        $userGroups = explode(",",$user->training_group_ids);
        $userAllCrType = array();

        if(!empty($userGroups))
            foreach ($userGroups as $UG) {
                foreach ($certificateGroups[$UG] as $dd){
                    $userAllCrType[] = $dd;
                }
            }
        $params = [];
        if (!empty($issuerid)) {
            $sql .= ' AND issuerid = ?';

        }

        if(!empty($userAllCrType)) {
            $params['certificate_types_id'] = $userAllCrType;
            $params['certificate_user_id'] = $user->id;

            $sql = "DELETE FROM {managecertificates} WHERE certificate_types_id NOT IN(?) AND certificate_user_id=? AND update_status=0 AND certificate_status=2";
        }
        else {
            $params['certificate_user_id'] = $user->id;
            $sql = "DELETE FROM {managecertificates} WHERE  certificate_user_id=? AND update_status=0 AND certificate_status=2";
        }
        $data = $DB->execute($sql,$params);

        //_p($userAllCrType);
        //die;

        $cell1 = new html_table_cell();
        $cell1->text = $user->idnumber;
        $row->cells[] = $cell1;

        $cell2 = new html_table_cell();
        $cell2->text = $user->name;
        $row->cells[] = $cell2;

        foreach ($certificate_types_arr as $objcertificate_types) {
            if(!empty($ctype) && $objcertificate_types->certificate_type_id!=$ctype) continue;
            $cell = new html_table_cell();
            $user_certificates = get_certificates_by_user($user->id,$objcertificate_types->certificate_type_id);



            if ($user_certificates){
//                _p($user_certificates);
                if ($user_certificates[0]->certificate_expire=="No"){

                    $tbl_update_status      = $user_certificates[0]->update_status;
                    $tbl_certificate_status = $user_certificates[0]->certificate_status;

                    if ($tbl_update_status==3){
                        $color_class = 'view-certificate booked';
                        $cell_text   = "Booked";
                    }elseif ($tbl_update_status==4){
                        $color_class = 'view-certificate awaiting-certificate';
                        $cell_text   = "Awaiting Certificate";

                    }elseif ($tbl_certificate_status==2) {
                        $color_class = 'upload-certificate expired-notheld';
                        $cell_text = "Not Held";
                    }
                    elseif ($tbl_certificate_status==6 && in_array($objcertificate_types->certificate_type_id, @$userAllCrType)) {

                        $cell_text = "Not Held";
                        $cell->text = $cell_text;
                        $color_class = 'view-certificate expired-notheld';

                    }elseif ($tbl_certificate_status==6){
                        $color_class = 'upload-certificate na';
                        $cell_text   = "N/A";
                    }
                    else{
                        $cell_text   = "No Expiration";
                        $color_class = 'view-certificate no-action-requrired';

                    }
                    $cell->attributes['class']        = 'bold '.$color_class;
                    $cell->attributes['data-cerusr']  = $user->id;
                    $cell->attributes['data-certype'] = $objcertificate_types->certificate_type_id;
                    $cell->attributes['data-cerexp']  = $objcertificate_types->certificate_expire;

                }else{


                    if(!empty($user_certificates[0]->expiry_date)){
                        $color_class = "view-certificate ".get_certificates_status_colour_coding($user_certificates);
                        $cell_text   = showDateTime($user_certificates[0]->expiry_date,'managecertificatedateonly');
                    }
                    else {

                        if ($user_certificates[0]->certificate_status == 2) {
                            $color_class = "upload-certificate expired-notheld";
                            $cell_text = "Not Held";

                        }
                        elseif ($user_certificates[0]->certificate_status == 6) {
                            $color_class = "upload-certificate na";
                            $cell_text = "N/A";

                        }

                        if (in_array($objcertificate_types->certificate_type_id, @$userAllCrType)) {
                            $updateobj = new stdClass();
                            $updateobj->certificate_user_id = $user->id;
                            $updateobj->certificate_types_id = $objcertificate_types->certificate_type_id;
                            $updateobj->certificate_status = intval(2);//Not Held
                            //$updateobj->update_status         = intval(2);//Not Held
                            $updateobj->id                 = $user_certificates[0]->id;
                            update_data($updateobj, 'managecertificates');
                            $cell_text = "Not Held";
                            $cell->text = $cell_text;
                            $color_class = 'view-certificate expired-notheld';

                        }

                        if ($user_certificates[0]->update_status == 3) {
                            $cell_text = "Booked";
                            $color_class = "view-certificate booked";
                        }
                        elseif ($user_certificates[0]->update_status == 4) {
                            $cell_text = "Awaiting Certificate";
                            $color_class = "view-certificate awaiting-certificate";
                        }
                        elseif ($user_certificates[0]->update_status == 7 &&
                            (empty($user_certificates[0]->copy_of_certificate) OR empty($user_certificates[0]->expiry_date))) {
                            $cell_text = "Not Held";
                            $color_class = "view-certificate expired-notheld";
                        }

                    }

                }
                $cell->text = $cell_text;
                $cell->attributes['class']        = 'bold '.$color_class;
                $cell->attributes['data-cerusr']  = $user->id;
                $cell->attributes['data-certype'] = $objcertificate_types->certificate_type_id;
                $cell->attributes['data-cerexp']  = $objcertificate_types->certificate_expire;
            }
            elseif (in_array($objcertificate_types->certificate_type_id,@$userAllCrType)){
                $updateobj                        = new stdClass();
                $updateobj->certificate_user_id   = $user->id;
                $updateobj->certificate_types_id  = $objcertificate_types->certificate_type_id;
                $updateobj->certificate_status    = intval(2);//Not Held
                //$updateobj->update_status         = intval(2);//Not Held
                save_data($updateobj, 'managecertificates');
                $cell_text     = "Not Held";
                $cell->text    = $cell_text;
                $color_class   = 'expired-notheld';
                $cell->attributes['class']        = 'bold upload-certificate '.$color_class;
                $cell->attributes['data-cerusr']  = $user->id;
                $cell->attributes['data-certype'] = $objcertificate_types->certificate_type_id;
                $cell->attributes['data-cerexp']  = $objcertificate_types->certificate_expire;
            }
            else{
                $cell->text                       = 'N/A';
                $cell->attributes['class']        = 'upload-certificate na';
                $cell->attributes['data-cerusr']  = $user->id;
                $cell->attributes['data-certype'] = $objcertificate_types->certificate_type_id;
                $cell->attributes['data-cerexp']  = $objcertificate_types->certificate_expire;

                $updateobj                        = new stdClass();
                $updateobj->certificate_user_id   = $user->id;
                $updateobj->certificate_types_id  = $objcertificate_types->certificate_type_id;
                $updateobj->certificate_status    = intval(6);//  N/A
                //$updateobj->update_status         = intval(6);//  N/A
                save_data($updateobj, 'managecertificates');

            }

            if($user_certificates[0]->update_status==8){
                $cell->text                       = 'Refresher Training not Required';
                $cell->attributes['class']        = 'training-not-required';
                $cell->attributes['data-cerusr']  = $user->id;
                $cell->attributes['data-certype'] = $objcertificate_types->certificate_type_id;
                $cell->attributes['data-cerexp']  = $objcertificate_types->certificate_expire;

            }

            $row->cells[] = $cell;
        }
        $table->data[] = $row;
    }
}

$html .= html_writer::table($table);
$html .= html_writer:: end_tag('div');
ob_start();
?>
<style type="text/css">
    table {border-collapse: collapse;color: #4e4e4e;}

    th {font-family: Arial,Helvetica,sans-serif;font-size: 15px;font-weight: 400;}
    th {color:#fff;background-color:#009fe5;text-align:center; vertical-align: bottom;border-bottom: 1px solid #dee2e6;}

    td {font-family: Arial,Helvetica,sans-serif;font-size: 12px;font-weight: 400;}
    td {border: 1px solid #dee2e6;text-align:center;padding: 3px;}

    .expiring{background-color: #ffdd43;} .expired-notheld{background-color: #ff0000;} .booked{background-color: #ff1493;} .awaiting-certificate{ background-color: #00bfff;}
    .no-action-requrired{background-color: #90ee90;} .na{background-color: #d3d3d3;}

</style>
<?php
echo $html;
$pdf_html = ob_get_contents();
ob_clean();
if (isset($pdf_html)) {
    $pdf_file = 'managecertificates_pdf.pdf';
    $pdf_file = str_replace(" ","-", $pdf_file);

    $pdf = new pdf('L');
    $pdf -> setPrintHeader(false);
    $pdf -> setPrintFooter(false);

    $pdf -> AddPage();
    $pdf -> WriteHTML($pdf_html);
    $pdf -> Output( pdfs_path() . $pdf_file, 'F' );

    $fileurl = pdfs_path() . $pdf_file;
    header("Content-type:application/pdf");
    header('Content-Disposition: attachment; filename='.$pdf_file);
    readfile( $fileurl );
    @unlink( $fileurl );
    exit;
}
?>