<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Bulk course registration script from a comma separated file.
 *
 * @package    tool_uploadcourse
 * @copyright  2011 Piers Harding
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
global $DB,$USER,$CFG;
$pluginname = 'trend_analysis_report';

require(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/coursecatlib.php');
require_once($CFG->libdir . '/csvlib.class.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/target_form.php');
require_once($CFG->dirroot.'/local/trend_analysis_report/locallib.php');  // Include our function library.

$returnurl = new moodle_url('/local/trend_analysis_report/target.php');


$title   = get_string('pluginname', 'local_'.$pluginname);
$heading = get_string('heading', 'local_'.$pluginname);
$url     = new moodle_url('/local/'.$pluginname.'/index.php');

require_login();

$homeurl    = new moodle_url('/local/mp_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}

$context = context_system::instance();

$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);



if (empty($importid)) {
    $mform1 = new target_form();
    if ($form1data = $mform1->get_data()) {
        $importid = csv_import_reader::get_new_iid('uploadtarget');
        $cir = new csv_import_reader($importid, 'uploadtarget');
        $content = $mform1->get_file_content('targetfile');


        $data = explode("\r\n",$content);
        if (count($data) == 0) {
            print_error('csvemptyfile', 'error', $returnurl, $cir->get_error());
        }

        foreach ($data as $key=>$thisData){
            if($key){

                $temp = explode(",",$thisData);
                $name = $temp[0];
                unset($temp[0]);
                if(!empty($temp))
                $dataArr[$name] = $temp;

            }
        }


        $saveData = array();

        $saveData['data']       = json_encode($dataArr);
        $saveData['year']       = $form1data->year;
        $saveData['user_id']    = $USER->id;

        $saveData['updated_at'] = time();

        $target = $DB->get_record("report_target",array("year" => $form1data->year));

        if(empty($target)){

            $saveData['created_at'] = time();

            $DB->insert_record("report_target",$saveData);
        }
        else{
            $saveData['id'] = $target->id;
            $DB->update_record("report_target",$saveData);
        }


        if(!empty($DB->get_last_error())){
            print_error('csvemptyfile', 'error', $returnurl, $DB->get_last_error());
        }
        else{
            redirect($returnurl,"Data has been saved successfully!!...","6",'success');
        }


    } else {

        echo $OUTPUT->header();
        echo $OUTPUT->heading_with_help(get_string('uploadtarget', 'local_trend_analysis_report'), 'uploadtarget', 'local_trend_analysis_report');
        $mform1->display();
        echo $OUTPUT->footer();
        die();
    }
} else {
    $cir = new csv_import_reader($importid, 'uploadtarget');
}


echo $OUTPUT->footer();
