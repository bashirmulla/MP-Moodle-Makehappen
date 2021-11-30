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
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
require_once(dirname(__FILE__).'/classes/manager_assign_form.php');  // Include form.

require_login();
$homeurl    = new moodle_url('/local/accident_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}
// Heading ==========================================================.

$title   = get_string('assign_manager', 'local_'.$pluginname);
$heading = get_string('assign_manager', 'local_'.$pluginname);
$url     = new moodle_url('/local/'.$pluginname.'/assign.php?m=3_5');


$context = context_system::instance();


$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);


echo $OUTPUT->header();

$form = new manager_assign_form(null, array());

if ($form->is_cancelled()) {
    redirect($url);
}


if(!empty($_REQUEST)){

    global $DB;

    $data = $_REQUEST;

    if(!empty($data['add'])){

        if(!empty($data['users'])){

            $insert = array();
            foreach ($data['users'] as $userid){
                $DB->insert_record("h_s_manager_standing_table",array("user_id" =>$userid));
            }
        }
       redirect($url,"Data has been added successfully");
    }

    if(!empty($data['remove'])){

        if(!empty($data['managers'])){

            $delete = array();
            foreach ($data['managers'] as $userid){
                $delete[] = $userid;
            }

            $ids = implode(",",$delete);
            $params['user_id'] = $ids;
            $DB->execute('DELETE FROM {h_s_manager_standing_table} WHERE user_id IN(?)',$params);
        }
        redirect($url,"Data has been removed successfully");
    }

}




$form->get_data();
$form->display();

if(is_manager() || is_admin() || is_senior_manager() || is_complieance()) {
    echo html_writer::tag('div','',array('id'=>'ajax_content'));
}
echo $OUTPUT->footer();
