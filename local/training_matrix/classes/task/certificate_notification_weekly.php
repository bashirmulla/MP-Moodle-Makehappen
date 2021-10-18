<?php

/*
 * Author: Bashir Mulla
 * Date: 11/10/2019
 * Comment: For this functionality to work, you need to add the global variable like $CFG->hs_webserviceid = <webserviceid in the database>;
 * in the config.php file.
 */

namespace local_training_matrix\task;

use webservice\token_table;

class certificate_notification_weekly extends \core\task\scheduled_task {
    public function get_name() {
        // Shown on admin screens
        return get_string('certificate_notification_weekly', 'local_training_matrix'); //get the string from lang/en/
    }

    public function execute() {
        global $CFG,$DB,$USER;
        require_once($CFG->dirroot . '/local/training_matrix/locallib.php');

        // get users certificate data
        $certificates = get_certificate_data();
        $today        = time();


        $manager_usercer_arr = array();
        foreach ($certificates as $ct){
            $tbl_expiry_date   = $ct->expiry_date;
            $delta = 3600 * 24 * 30 * $ct->number_of_months;  //3600 seconds per hours *24 hours * 30 day * number_of_months

            if(is_training_admin($ct->certificate_user_id) && !empty($tbl_expiry_date)){

                $user    = get_userInfo(['id' => $ct->certificate_user_id]);
                //$manager_usercer_arr[$user->manager_id][] = $ct->certificate_user_id.'_'.$ct->certificate_types_id;

                if($ct->certificate_status==2 AND in_array($ct->update_status,[0,7])){
                    //send_certificate_notification($ct);
                    $manager_usercer_arr[$user->manager_id][] = $ct->certificate_user_id.'_'.$ct->certificate_types_id;
                }


                if(($tbl_expiry_date<($today+$delta)) && ($tbl_expiry_date>$today)) {
                    //send_certificate_notification($ct,"Expiring");
                    $manager_usercer_arr[$user->manager_id][] = $ct->certificate_user_id.'_'.$ct->certificate_types_id;
                }
            }

        }
        if (!empty($manager_usercer_arr)){
            send_training_notification_manager($manager_usercer_arr);
        }

    }
}