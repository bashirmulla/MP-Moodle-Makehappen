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

// training groups Table API Start
//
    public static function get_training_groups_table_parameters() {
        return new external_function_parameters(
            array(
                //if I had any parameters, they would be described here. But I don't have any, so this array is empty.
            )
        );
    }

    public static function get_training_groups_table() {
        global $USER,$DB;
        //Parameter validation
        //REQUIRED


        $result = $DB->get_records("training_groups");

        return $result;
    }

    public static function get_training_groups_table_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, 'training_group_table id'),
                    'training_role_name' => new external_value(PARAM_TEXT, 'training group name'),
                    'required_certificates' => new external_value(PARAM_TEXT, 'Required certificates'),
                )
            )
        );
    }
// training groups Table API END


}