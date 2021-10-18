<?php
// This file is part of MailTest for Moodle - http://moodle.org/
//
// MailTest is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// MailTest is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with MailTest.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Sample plugin
 *
 * @package    training_matrix
 * @copyright  2020 EEG
 * @author     Bash & SAM Harun & mahedi
 */


// Globals.
global $USER, $CFG,$DB;
define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/training_matrix/locallib.php');  // Include our function library.
require_login();

$homeurl    = new moodle_url('/local/training_matrix/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance() && !is_training_admin() && !is_siteadmin()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}

$params = array();

$query_con_str =" 1=1 ";
$filterData = get_requests();



if ($filterData['user']){
    $user_id = $filterData['user'];
    $params['id'] = $filterData['user'];
    $query_con_str .= " AND id IN (?) ";
}
if ($filterData['id_number']){
    $id_number = $filterData['id_number'];
    $params['idnumber'] = $filterData['id_number'];
    $query_con_str .= " AND idnumber IN (?) ";
}
if ($filterData['manager']){
    $manager_id = $filterData['manager'];
    $params['manager_id'] = $filterData['manager'];
    $query_con_str .= " AND manager_id IN (?) ";
}
if ($filterData['user_status']){
    $user_status = ($filterData['user_status']=='Active')?'0':'1';
    $params['suspended'] = $user_status;
    $query_con_str .= " AND suspended IN (?) ";
}

if ($filterData['certificate_type']){
    $ctype = is_number($filterData['certificate_type']) ? $filterData['certificate_type'] : 0;
}
if ($filterData['status']){
    $status =  is_number($filterData['status'])? $filterData['status'] : 0;
}

$_SESSION["managecertificates_csv"]["where"]         = serialize($query_con_str);
$_SESSION["managecertificates_csv"]["params"]        = serialize($params);
$_SESSION["managecertificates_csv"]["filter_data"]   = serialize($filterData);

$sql = " SELECT u.id,u.training_group_ids,u.idnumber,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u WHERE $query_con_str AND u.deleted = 0 ORDER BY name ASC";
$users = $DB->get_records_sql($sql,$params);

$html   = "";

if(count($users)>0){
    $html   .= html_writer:: start_tag('div',array('class'=>'form-row'));
    $html   .= html_writer:: div('','col-md-6 form-group-ele');
    $html   .= html_writer:: start_tag('div',array('class'=>'form-group col-md-6 form-group-ele','style'=>'text-align:right;'));
    $html   .= html_writer:: tag('button','<i class="fa fa-download"></i> &nbsp;&nbsp;Download CSV',array('type'=>'button','id'=>'dwn_managecertificates_csv','class'=>'btn btn-primary','style' =>"background-color:GREEN; margin-right:10px"));
   // $html   .= html_writer:: tag('button','<i class="fa fa-download"></i> &nbsp;&nbsp;Download PDF',array('type'=>'button','id'=>'dwn_managecertificates_pdf','class'=>'btn btn-primary','style' =>"background-color:ORANGE; margin-right:10px"));
    $html   .= html_writer:: end_tag('div');
    $html   .= html_writer:: end_tag('div');
}
$html   .= html_writer:: start_tag('div',array('class'=>'table-responsive'));
$table = new html_table();
$table->attributes['class'] = 'fl-table managecertificates trainingmatrixtbl';
$table->head  = array('ID Number','User Name','All Certificates');

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
foreach ($certificate_types as $certificate_type) {
    if(!empty($ctype) && $certificate_type->id!=$ctype) continue;
    $table->head[] = $certificate_type->certificate_name;

    $certificate_types_obj = new stdClass();
    $certificate_types_obj->certificate_type_id = $certificate_type->id;
    $certificate_types_obj->certificate_expire = $certificate_type->certificate_expire;
    // $certificate_types_obj->certificate_status = $certificate_type->certificate_status;
    $certificate_types_arr[] = $certificate_types_obj;
}

$certificatesArr = get_all_certificates();
$all_certificates = $certificatesArr['certificates'];
$has_certificates = $certificatesArr['has_certificate'];

if (!empty($users)) {
    foreach ($users as $user) {
        if(in_array($user->id,$CFG->not_genuine_user)) continue;
        //if(!empty($status) && !check_certificates_by_status($user->id,$status)) continue;
        if(!empty($status) && !check_certificates_by_status2($all_certificates[$user->id],$status)) continue;

        $row = new html_table_row();

        $userGroups = explode(",",$user->training_group_ids);
        $userAllCrType = array();
        $userAllCrType2 = array();



        if(!empty($userGroups))
            foreach ($userGroups as $UG) {
                foreach ($certificateGroups[$UG] as $dd){
                    $userAllCrType[]     = $dd;
                    $userAllCrType2[$dd] = 1;
                }
            }



        $inactiveCTOfUsers = array_intersect($inactiveGPCert2,$userAllCrType);


        $params            = [];

        if (!empty($issuerid)) {
            $sql .= ' AND issuerid = ?';

        }

        if(!empty($userAllCrType)) {
            //$params['certificate_types_id'] = implode(",",$userAllCrType);
            $params['certificate_types_id'] = $userAllCrType;
            $params['certificate_user_id'] = $user->id;

            $sql = "DELETE FROM {managecertificates} WHERE certificate_types_id NOT IN(?) AND certificate_user_id=? AND update_status=0 AND certificate_status=2";
            $data = $DB->execute($sql,$params);
            /*
            foreach ($inactiveCTOfUsers as $data1) {
                $pr['certificate_types_id'] = $data1;
                $pr['certificate_user_id'] = $user->id;
                $sql2 = " UPDATE {managecertificates} SET active='0'  WHERE certificate_types_id=? AND certificate_user_id=? ";
                $data = $DB->execute($sql2, $pr);
            }
            */
        }
        else {
            $params['certificate_user_id'] = $user->id;
            $sql = "DELETE FROM {managecertificates} WHERE  certificate_user_id=? AND update_status=0 AND certificate_status=2";
            $data = $DB->execute($sql,$params);

            /*
            $sql2 = "UPDATE {managecertificates} SET active='0'  WHERE certificate_user_id=? ";
            $data = $DB->execute($sql2,$params);
            */
        }


        //_p($userAllCrType);
        //die;

        $cell1 = new html_table_cell();
        $cell1->text = $user->idnumber;
        $row->cells[] = $cell1;

        $cell2 = new html_table_cell();
        $cell2->text = $user->name;
        $row->cells[] = $cell2;

        if($has_certificates[$user->id]) {

            $download_link = "<a href='/local/training_matrix/managecertificates_download.php?u=" . $user->id . "'> <i class='fa fa-download'></i> Download</a>";

        }
        else{
            $download_link = "No Certificate";
        }
        $row->cells[]  = $download_link;

        //echo  $user->id. "------- ";
        foreach ($certificate_types_arr as $objcertificate_types) {
            if(!empty($ctype) && $objcertificate_types->certificate_type_id!=$ctype) continue;
            $cell = new html_table_cell();
            //$user_certificates = get_certificates_by_user($user->id,$objcertificate_types->certificate_type_id);
            $user_certificates = get_certificates_by_user2($all_certificates[$user->id],$objcertificate_types->certificate_type_id);
            $color_class = "";
            $cell_text   = "";
            if(!in_array( $objcertificate_types->certificate_type_id,@$userAllCrType)){

                $color_class = 'inactive_cell na';
                $cell_text   = "N/A";
            }
            if ($user_certificates){

//                _p($user_certificates);
                $tbl_update_status      = $user_certificates[0]->update_status;
                $tbl_certificate_status = $user_certificates[0]->certificate_status;
                $tbl_attendent_date ="";
                if(!empty($user_certificates[0]->attended_date)) {
                    $tbl_attendent_date = "Course Attended Date: " . showDateTime($user_certificates[0]->attended_date, 'managecertificatedateonly');
                }



                if ($user_certificates[0]->certificate_expire=="No"){


                     if($inactiveGPCert[$objcertificate_types->certificate_type_id]==1){
                         $color_class = 'inactive_cell na';
                         $cell_text   = "N/A";
                     }
                    else if ($tbl_update_status==8 OR $tbl_certificate_status==8){
                        $color_class = 'bold view-certificate training-not-required';
                        $cell_text   = "No Refresher";
                    }
                    elseif ($tbl_update_status==3){
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

                    }elseif ($tbl_certificate_status==6){
                        $color_class = 'upload-certificate na';
                        $cell_text   = "N/A";
                    }
                    else{
                        $cell_text   = "No Expiration";
                        $color_class = 'view-certificate no-action-requrired';
                        $updateobj   = new stdClass();
                        $updateobj->certificate_status = intval(5);//No Action required
                        //$updateobj->update_status      = intval(5);//No Action required
                        $updateobj->id                 = $user_certificates[0]->id;
                        update_data($updateobj, 'managecertificates');
                    }
                    $cell->attributes['class']        = 'bold '.$color_class;
                    $cell->attributes['data-cerusr']  = $user->id;
                    $cell->attributes['data-certype'] = $objcertificate_types->certificate_type_id;
                    $cell->attributes['data-cerexp']  = $objcertificate_types->certificate_expire;
                    $cell->attributes['title']        = $tbl_attendent_date;

                }else{


                    if ($tbl_update_status==8 OR $tbl_certificate_status==8){
                        $color_class = 'bold view-certificate training-not-required';
                        $cell_text   = "No Refresher";
                    }
                    else {

                        if ($user_certificates[0]->certificate_status == 2 && $tbl_update_status == 0) {
                            $color_class = "upload-certificate expired-notheld";
                            $cell_text = "Not Held";

                        }
                        elseif ($user_certificates[0]->certificate_status == 6 && $tbl_update_status == 0) {
                            $color_class = "upload-certificate na";
                            $cell_text = "N/A";

                        }

                        elseif ($user_certificates[0]->update_status == 3) {
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

                        elseif($user_certificates[0]->update_status == 7 && !empty($user_certificates[0]->expiry_date)){
                            $color_class = "view-certificate ".get_certificates_status_colour_coding($user_certificates);
                            $cell_text   = showDateTime($user_certificates[0]->expiry_date,'managecertificatedateonly');
                        }
                        else{
                            $cell_text = "Not Held";
                            $cell->text = $cell_text;
                            $color_class = 'upload-certificate expired-notheld';
                        }

                        /*
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
                             $color_class = 'upload-certificate expired-notheld';

                         }
                        */



                    }

                }
                $cell->text = $cell_text;
                $cell->attributes['class']        = 'bold '.$color_class;
                $cell->attributes['data-cerusr']  = $user->id;
                $cell->attributes['data-certype'] = $objcertificate_types->certificate_type_id;
                $cell->attributes['data-cerexp']  = $objcertificate_types->certificate_expire;
                $cell->attributes['title']        = $tbl_attendent_date;
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
                $cell->attributes['class']        = 'bold upload-certificate na';
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
            //cheeking if the certificate type are in inActive group
            /*
            if(isset($inactiveGPCert[$objcertificate_types->certificate_type_id]) && $inactiveGPCert[$objcertificate_types->certificate_type_id]==1){

                $cell->attributes['class'] = str_replace("upload-certificate","inactive_cell",$cell->attributes['class']);
                $cell->attributes['class'] = str_replace("view-certificate","inactive_cell",$cell->attributes['class']);

            }
            */

            $row->cells[] = $cell;
        }
       // echo  "\n\n";
        $table->data[] = $row;
    }
}

$html .= html_writer::table($table);
$html .= html_writer:: end_tag('div');
$html .= "<hr>";



echo json_encode($html);
die;
