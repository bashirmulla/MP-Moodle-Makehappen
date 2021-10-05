<?php

/*
 * Author: Bashir Mulla
 * Date: 11/10/2019
 * Comment: For this functionality to work, you need to add the global variable like $CFG->hs_webserviceid = <webserviceid in the database>;
 * in the config.php file.
 */

namespace local_training_matrix\task;

use webservice\token_table;

class certificate_status extends \core\task\scheduled_task {
    public function get_name() {
        // Shown on admin screens
        return get_string('certificate_status', 'local_training_matrix'); //get the string from lang/en/
    }

    public function execute() {
        global $CFG,$DB,$USER;
        require_once($CFG->dirroot . '/local/training_matrix/locallib.php');


        $sql   = " SELECT u.id,u.training_group_ids,u.idnumber,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u WHERE 1 AND u.deleted = 0 ORDER BY name ASC";
        $users = $DB->get_records_sql($sql);

        $certificate_groups    = get_datas(array(),"training_groups");
        $certificateGroups = array();
        if(!empty($certificate_groups)){
            foreach ($certificate_groups AS $CG){
                $ctypes                     = explode(",",$CG->required_certificates);
                $certificateGroups[$CG->id] = $ctypes;
            }
        }

        $certificate_types     = get_certificate_types_listing();
        $certificate_types_arr = array();
        foreach ($certificate_types as $certificate_type) {
            if(!empty($ctype) && $certificate_type->id!=$ctype) continue;

            $certificate_types_obj = new stdClass();
            $certificate_types_obj->certificate_type_id = $certificate_type->id;
            $certificate_types_obj->certificate_expire = $certificate_type->certificate_expire;
            // $certificate_types_obj->certificate_status = $certificate_type->certificate_status;
            $certificate_types_arr[] = $certificate_types_obj;
        }

        $all_certificates = get_all_certificates();

        if (!empty($users)) {
            foreach ($users as $user) {
                $sql = "";
                if(in_array($user->id,$CFG->not_genuine_user)) continue;
                //if(!empty($status) && !check_certificates_by_status($user->id,$status)) continue;
                if(!empty($status) && !check_certificates_by_status2($all_certificates[$user->id],$status)) continue;


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


                foreach ($certificate_types_arr as $objcertificate_types) {
                    if(!empty($ctype) && $objcertificate_types->certificate_type_id!=$ctype) continue;
                    $user_certificates = get_certificates_by_user2($all_certificates[$user->id],$objcertificate_types->certificate_type_id);

                    if ($user_certificates){

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
                                $updateobj = new stdClass();
                                $updateobj->certificate_user_id = $user->id;
                                $updateobj->certificate_types_id = $objcertificate_types->certificate_type_id;
                                $updateobj->certificate_status = intval(2);//Not Held
                                //$updateobj->update_status         = intval(2);//Not Held
                                $updateobj->id                 = $user_certificates[0]->id;
                                update_data($updateobj, 'managecertificates');

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

                    }
                    elseif (in_array($objcertificate_types->certificate_type_id,@$userAllCrType)){
                        $updateobj                        = new stdClass();
                        $updateobj->certificate_user_id   = $user->id;
                        $updateobj->certificate_types_id  = $objcertificate_types->certificate_type_id;
                        $updateobj->certificate_status    = intval(2);//Not Held
                        //$updateobj->update_status         = intval(2);//Not Held
                        save_data($updateobj, 'managecertificates');

                    }
                    else{

                        $updateobj                        = new stdClass();
                        $updateobj->certificate_user_id   = $user->id;
                        $updateobj->certificate_types_id  = $objcertificate_types->certificate_type_id;
                        $updateobj->certificate_status    = intval(6);//  N/A
                        //$updateobj->update_status         = intval(6);//  N/A
                        save_data($updateobj, 'managecertificates');

                    }

                }

            }
        }

    }
}