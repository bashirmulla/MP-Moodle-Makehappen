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
 * @package    local_trend_analysis_report
 * @copyright  2019 www.makehappengroup.co.uk
 * @author     MP
 */

// Globals.
global $CFG, $OUTPUT, $USER, $SITE, $PAGE;
$pluginname = 'trend_analysis_report';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
require_once($CFG->dirroot.'/local/'.$pluginname.'/functions.php');  // Include our function library.

require_once(dirname(__FILE__).'/classes/email_notification_on_high_h_s_report.php');  // Include form.

require_login();
$homeurl    = new moodle_url('/local/accident_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}
// Heading ==========================================================.

$title   = get_string('email_notification_on_high_H_S_report_volumes', 'local_'.$pluginname);
$heading = get_string('email_notification_on_high_H_S_report_volumes', 'local_'.$pluginname);
$url     = new moodle_url('/local/'.$pluginname.'/index.php');

$context = context_system::instance();

$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);

echo $OUTPUT->header();

$form = new email_notification_on_high_h_s_report(null, array());
if ($form->is_cancelled()) {
    redirect($homeurl);
}


if($form->is_submitted()){
    $url = "email_notification_on_high_h_s_report.php?m=5_1";
    $data = get_requests();
    unset($data['sesskey']); // we do not need to return sesskey
    unset($data['_qf__email_notification_on_high_h_s_report']);   // we do not need the submission marker too
    $dataobject = (object) $data;
//    _p($dataobject,true);
    if (empty($dataobject->id)){
        $id = save_data($dataobject,'email_notification_on_high_h_s_report_volumes');
    }else{
        $data_reset = new stdClass();
        $data_reset->id = $dataobject->id;
        $data_reset->act_of_physical_violence_status=0;
        $data_reset->act_of_physical_violence=0;
        $data_reset->cuts_and_lacerations_status=0;
        $data_reset->cuts_and_lacerations=0;
        $data_reset->falls_from_height_status=0;
        $data_reset->falls_from_height=0;
        $data_reset->manual_handling_status=0;
        $data_reset->manual_handling=0;
        $data_reset->needlestick_injuries_status=0;
        $data_reset->needlestick_injuries=0;
        $data_reset->slips_trips_and_falls_on_same_level_status=0;
        $data_reset->slips_trips_and_falls_on_same_level=0;
        $data_reset->struck_by_an_object_status=0;
        $data_reset->struck_by_an_object=0;
        $data_reset->animals_status=0;
        $data_reset->animals=0;
        $data_reset->equipment_issues_status=0;
        $data_reset->equipment_issues=0;
        $data_reset->gas_detection_status=0;
        $data_reset->gas_detection=0;
        $data_reset->needle_glass_status=0;
        $data_reset->needle_glass=0;
        $data_reset->slips_trips_and_falls_status=0;
        $data_reset->slips_trips_and_falls=0;
        $data_reset->traffic_vehicle_status=0;
        $data_reset->traffic_vehicle=0;
        $data_reset->vegetation_status=0;
        $data_reset->vegetation=0;
        $data_reset->vehicle_collision_status=0;
        $data_reset->vehicle_collision=0;
        $data_reset->vehicle_near_miss_status=0;
        $data_reset->vehicle_near_miss=0;
        $data_reset->vehicle_theft_status=0;
        $data_reset->vehicle_theft=0;
        $data_reset->vehicle_vandalism_status=0;
        $data_reset->vehicle_vandalism=0;
        $data_reset->vehicle_general_damage_status=0;
        $data_reset->vehicle_general_damage=0;
        $data_reset->equipment_loss_status=0;
        $data_reset->equipment_loss=0;
        $data_reset->equipment_theft_status=0;
        $data_reset->equipment_theft=0;
        $data_reset->equipment_wear_and_tear_status=0;
        $data_reset->equipment_wear_and_tear=0;
        $data_reset->environmental_flooding_internal_status=0;
        $data_reset->environmental_flooding_internal=0;
        $data_reset->environmental_flooding_external_status=0;
        $data_reset->environmental_flooding_external=0;
        $data_reset->environmental_contamination_status=0;
        $data_reset->environmental_contamination=0;
        $data_reset->environmental_fly_tipping_status=0;
        $data_reset->environmental_fly_tipping=0;
        $data_reset->attack_abusive_verbal_status=0;
        $data_reset->attack_abusive_verbal=0;
        $data_reset->attack_animal_attack_status=0;
        $data_reset->attack_animal_attack=0;
        update_data($data_reset, 'email_notification_on_high_h_s_report_volumes',$url);

        $dataobject->updated_at  = time();
        update_data($dataobject, 'email_notification_on_high_h_s_report_volumes',$url);
        $id = $dataobject->id;
    }


    if(!empty($id) ){
        redirect('/local/trend_analysis_report/email_notification_on_high_h_s_report.php?m=5_1',"Data has been saved successfully!!...","5",'success');
    }


}else {
    //$data = $form->get_data();
    //$form->set_data($data);
    $form->display();
}


echo $OUTPUT->footer();
