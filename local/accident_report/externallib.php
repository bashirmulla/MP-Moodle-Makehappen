<?php
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//

/**
 * Sample plugin
 *
 * @package    local_accident_report
 * @copyright  2018 www.makehappengroup.co.uk
 * @author     MP
 */
require_once($CFG->libdir . "/externallib.php");

class local_accident_report_external extends external_api {

// Standing Table API Start

    public static function get_standing_table_parameters() {
        return new external_function_parameters(
            array(
                //if I had any parameters, they would be described here. But I don't have any, so this array is empty.
            )
        );
    }

    public static function get_standing_table() {
        global $USER,$DB;
        //Parameter validation
        //REQUIRED


        $result = $DB->get_records("standing_table",array("field_status" => 1));

        return $result;
    }

    public static function get_standing_table_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, 'standing_table id'),
                    'report_id' => new external_value(PARAM_INT, 'report_id of standing_table'),
                    'dropdown_name' => new external_value(PARAM_TEXT, 'dropdown_name of standing_table'),
                    'field_value' => new external_value(PARAM_TEXT, 'field_value of standing_table'),
                )
            )
        );
    }
// Standing Table API END

// Email Table API START
    public static function get_email_table_parameters() {
        return new external_function_parameters(
            array(
                //if I had any parameters, they would be described here. But I don't have any, so this array is empty.
            )
        );
    }

    public static function get_email_table($welcomemessage = 'Hello world, ') {
        global $USER,$DB;
        //Parameter validation
        //REQUIRED


        $result = $DB->get_records("report_table_emaildata");

        return $result;
    }

    public static function get_email_table_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, 'report_table_emaildata id'),
                    'firstname' => new external_value(PARAM_TEXT, 'firstname of report_table_emaildata'),
                    'lastname' => new external_value(PARAM_TEXT, 'lastname of report_table_emaildata'),
                    'email' => new external_value(PARAM_TEXT, 'email of report_table_emaildata'),
                    'contact' => new external_value(PARAM_INT, 'contact of report_table_emaildata'),
                )
            )
        );
    }
// Email Table API END


// Manager List START
    public static function get_manager_list_parameters() {
        return new external_function_parameters(
            array(
                //if I had any parameters, they would be described here. But I don't have any, so this array is empty.
            )
        );
    }

    public static function get_manager_list() {
        global $USER,$CFG,$DB;

        $sql = "SELECT u.id ,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u 
                   LEFT JOIN {role_assignments} ra ON (u.id = ra.userid)
                   LEFT JOIN {role} r ON (ra.roleid=r.id)
                WHERE r.shortname='seniormanager' AND u.deleted = 0 
                AND u.id NOT IN (SELECT user_id FROM {h_s_manager_standing_table}) 
                ORDER BY  name ASC ";

        return  $DB->get_records_sql($sql);


    }

    public static function get_manager_list_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, 'name of manager_list'),
                    'name' => new external_value(PARAM_TEXT, 'name of manager_list'),
                )
            )
        );
    }
// Manager List END

// Accident Report API Start
    public static function create_accident_parameters() {
        return new external_function_parameters(
            array(
                'accident' =>
                    new external_single_structure(
                        array(
                                'user_id'             => new external_value(PARAM_INT, 'moodle user_id',1),
                                'user_address'        => new external_value(PARAM_TEXT, 'Plain text puser_address',1),
                                'user_postcode'       => new external_value(PARAM_TEXT, 'Plain text user_postcode',1),
                                'user_occupation'     => new external_value(PARAM_TEXT, 'Plain text user_occupation',1),
                                'user_contract'       => new external_value(PARAM_TEXT, 'Plain text user_contract',1),
                                'user_manager'        => new external_value(PARAM_INT, 'id of user_manager',1),
                                'user_date'           => new external_value(PARAM_INT, 'timestamp int value user_date',1),
                                'victim_name'         => new external_value(PARAM_TEXT, 'Plain text victim_name',1),
                                'victim_address'      => new external_value(PARAM_TEXT, 'Plain text victim_address',1),
                                'victim_postcode'     => new external_value(PARAM_TEXT, 'Plain text victim_postcode',1),
                                'victim_occupation'   => new external_value(PARAM_TEXT, 'Plain text victim_occupation',1),
                                'accident_date'           => new external_value(PARAM_INT, 'Plain text accident_report_number',1),
                                'accident_place'          => new external_value(PARAM_TEXT, 'Plain text accident_place',0),
                                'accident_reason'         => new external_value(PARAM_TEXT, 'Plain text accident_reason',0),
                                'accident_detail'         => new external_value(PARAM_TEXT, 'Plain text accident_detail',0),
                                'accident_witnesses'      => new external_value(PARAM_TEXT, 'Yes/No enum field accident_witnesses',0),
                                'witnesses_name'          => new external_value(PARAM_TEXT, 'Plain text witnesses_name',0),
                                'witnesses_address'       => new external_value(PARAM_TEXT, 'Plain text witnesses_address',0),
                                'witnesses_phone_number'  => new external_value(PARAM_TEXT, 'Plain text witnesses_phone_number',0),
                                'witnesses_report_date'   => new external_value(PARAM_INT, 'Plain text witnesses_report_date',0),
                                'witnesses_report_details'=> new external_value(PARAM_TEXT, 'Plain text witnesses_report_details',0),
                                'photo_1'                 => new external_value(PARAM_TEXT, 'based64 encoded text photo_1',0),
                                'photo_2'                 => new external_value(PARAM_TEXT, 'based64 encoded text photo_2',0),
                                'photo_3'                 => new external_value(PARAM_TEXT, 'based64 encoded text photo_3',0),
                                'photo_4'                 => new external_value(PARAM_TEXT, 'based64 encoded text photo_4',0),
                                'photo_5'                 => new external_value(PARAM_TEXT, 'based64 encoded text photo_5',0),
                                'photo_6'                 => new external_value(PARAM_TEXT, 'based64 encoded text photo_6',0),
                                'accident_category'       => new external_value(PARAM_INT, 'category id',0),
                                'accident_treatment'      => new external_value(PARAM_TEXT, 'Enum field Yes/No',0),
                                'minor_injuries'          => new external_value(PARAM_TEXT, 'Enum field Yes/No',0),
                                'submitted_from'          => new external_value(PARAM_TEXT, 'Enum field mobile/web',0,'mobile'),


                            )
                        )
                )

        );
    }

    public static function create_accident($accident) {

        global $USER,$CFG,$DB;
        require_once($CFG->dirroot.'/local/accident_report/functions.php');

        $params = self::validate_parameters( self::create_accident_parameters(),
                                             array("accident" => $accident)
                                            );


        $transaction = $DB->start_delegated_transaction();
        $return      = create_accident($accident);

        $transaction->allow_commit();
        return $return;
    }

    public static function create_accident_returns() {
        return
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, 'id of the accident')
                )

        );
    }


    public static function create_incident_parameters() {
        return new external_function_parameters(
            array(
                'incident' =>
                    new external_single_structure(
                        array(
                                'user_id'             => new external_value(PARAM_INT, 'User id',1),
                                'contact'             => new external_value(PARAM_INT, 'A valid contact',1),
                                'manager'             => new external_value(PARAM_INT, 'A valid manager',1),
                                'i_date'              => new external_value(PARAM_INT, 'A valid i_time',1),
                                'day_night'           => new external_value(PARAM_TEXT, 'Enum field Day/Night',1),
                                'location'            => new external_value(PARAM_TEXT, 'A valid location',1),
                                'lone_worker'         => new external_value(PARAM_TEXT, 'Enum field Yes/No',1),
                                'what_observe'        => new external_value(PARAM_TEXT, 'A valid what_observe',1),
                                'photo_1'             => new external_value(PARAM_TEXT, 'A valid photo_1',0),
                                'photo_2'             => new external_value(PARAM_TEXT, 'A valid photo_2',0),
                                'photo_3'             => new external_value(PARAM_TEXT, 'A valid photo_3',0),
                                'photo_4'             => new external_value(PARAM_TEXT, 'A valid photo_4',0),
                                'photo_5'             => new external_value(PARAM_TEXT, 'A valid photo_5',0),
                                'photo_6'             => new external_value(PARAM_TEXT, 'A valid photo_6',0),
                                'action_taken'        => new external_value(PARAM_TEXT, 'Enum field Yes/No',0),
                                'what_could_happened' => new external_value(PARAM_TEXT, 'A valid what_could_happened',0),
                                'report_category'     => new external_value(PARAM_INT, 'A valid report_category id',0),
                                'submitted_from'          => new external_value(PARAM_TEXT, 'Enum field mobile/web',0,'mobile'),
                    )
                )
        )

        );
    }

    public static function create_incident($incident) {
        global $USER,$CFG,$DB;
        require_once($CFG->dirroot.'/local/accident_report/functions.php');

        $params = self::validate_parameters( self::create_incident_parameters(),
            array('incident' => $incident)
        );

        $transaction = $DB->start_delegated_transaction();
        $return      = create_incident($incident);

        $transaction->allow_commit();
        return $return;
    }

    public static function create_incident_returns() {
        return
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, 'id of the incident')
                )

            );
    }



}
