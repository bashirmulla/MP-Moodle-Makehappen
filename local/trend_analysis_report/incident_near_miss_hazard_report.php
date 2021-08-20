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

require_once(dirname(__FILE__).'/classes/incident_near_miss_hazard_list.php');  // Include form.

require_login();
$homeurl    = new moodle_url('/local/mp_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}
// Heading ==========================================================.

$title   = get_string('incident', 'local_'.$pluginname);
$heading = get_string('incident', 'local_'.$pluginname);
$url     = new moodle_url('/local/'.$pluginname.'/index.php');

$context = context_system::instance();

$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);

echo $OUTPUT->header();

$form = new incident_near_miss_hazard_list(null, array());
if ($form->is_cancelled()) {
    redirect($homeurl);
}
$form->get_data();
$form->display();

if(is_manager() || is_admin() || is_senior_manager() || is_complieance()) {
    echo html_writer:: tag('div','no data',array('id'=>'ajax_content'));
}

echo $OUTPUT->footer();
