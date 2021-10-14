<?php
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//

/**
 * Sample plugin
 *
 * @package    local_training_matrix
 * @copyright  2019 Fluid Compliance Platform
 *
 */
require_once($CFG->libdir . "/externallib.php");

class local_training_matrix_external extends external_api {

// training records API Start
//
    public static function get_training_records_parameters() {
        return new external_function_parameters ([
            'user_id' => new external_value(PARAM_INT, 'The ID of the discussion from which to fetch posts.', VALUE_REQUIRED),
        ]);
    }

    public static function get_training_records($user_id) {
        global $USER,$DB;
        //Parameter validation
        //REQUIRED

        $params = self::validate_parameters( self::get_training_records_parameters(), [
            'user_id' => $user_id,
        ]);

        $arr =  array();

        $sql = "SELECT mc.id AS certificate_id, mc.certificate_user_id, ct.certificate_name, cs.status_name, 
                    mc.copy_of_certificate, FROM_UNIXTIME(mc.expiry_date, '%D %M %Y') AS expirydate, ct.certificate_expire, ct.number_of_months
                FROM {managecertificates} mc
                LEFT JOIN {certificate_types} ct ON (ct.id = mc.certificate_types_id)
                LEFT JOIN {managecertificates_status} cs ON (cs.id = mc.certificate_status)
                WHERE mc.certificate_user_id = $user_id";


        $data = $DB->get_records_sql($sql);

        if(!empty($data)){
            foreach ($data as $value){
                $arr[] = $value;
            }
        }
        return $arr;

    }

    public static function get_training_records_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'certificate_id' => new external_value(PARAM_INT, 'certificate id'),
                    'certificate_user_id' => new external_value(PARAM_INT, 'certificate user id'),
                    'certificate_name' => new external_value(PARAM_TEXT, 'certificate name'),
                    'status_name' => new external_value(PARAM_TEXT, 'certificate status name'),
                    'copy_of_certificate' => new external_value(PARAM_TEXT, 'file path of certificate'),
                    'expirydate' => new external_value(PARAM_TEXT, 'expiry date of certificate'),
                    'certificate_expire' => new external_value(PARAM_TEXT, 'certificate to expire'),
                    'number_of_months' => new external_value(PARAM_INT, 'number of months'),
                )
            )
        );
    }
// training records API END


}