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
global $CFG, $OUTPUT, $USER, $SITE, $PAGE,$DB;
$pluginname = 'trend_analysis_report';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
require_once($CFG->dirroot.'/local/'.$pluginname.'/functions.php');  // Include our function library.

echo '<script src="'.$CFG->wwwroot.'/local/'.$pluginname.'/highcharts/code/highcharts.js"></script>
<script src="'.$CFG->wwwroot.'/local/'.$pluginname.'/highcharts/code/highcharts-3d.js"></script>
<script src="'.$CFG->wwwroot.'/local/'.$pluginname.'/highcharts/code/modules/exporting.js"></script>
<script src="'.$CFG->wwwroot.'/local/'.$pluginname.'/highcharts/code/modules/export-data.js"></script>';

require_login();

$homeurl    = new moodle_url('/local/mp_report/index.php');
if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}

if (empty(get_request('cur_year'))){
    $cur_year = date("Y");
}else{
    $cur_year = get_request('cur_year');
    if(!is_number($cur_year)) $cur_year = date("Y");
}
// Heading ==========================================================.

$title   = get_string('ipsum_group_scorecard_dashboard', 'local_'.$pluginname);
$heading = get_string('ipsum_group_scorecard_dashboard', 'local_'.$pluginname);
$url     = new moodle_url('/local/'.$pluginname.'/index.php');

$context = context_system::instance();


$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);

echo $OUTPUT->header();

echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: start_tag('div',array('class'=>'dropdown show md-4 float-right'));
echo $html ='<a class="btn btn-dark" onclick="history.back()" style="background-color: #fcc42c; border-color: #fcc42c !important; font-weight: bold"><i class="fa fa-step-backward"> </i> Back </a>';

echo html_writer::tag('button', $cur_year, array('href'=>'#','class'=>'btn btn-secondary btn-lg dropdown-toggle',
    'type'=>'button','id'=>'dropdownMenuButton','data-toggle'=>'dropdown','aria-haspopup'=>'true','aria-expanded'=>'false'));

echo html_writer:: start_tag('div',array('class'=>'dropdown-menu','aria-labelledby'=>'dropdownMenuButton'));
$min = 2018;
$max = $year = date('Y');
for($i=$min;$i<=$max;$i++)
{
    $active = '';
    if($i==$cur_year) {$active = ' active ';}
    echo html_writer::tag('a', $i, array('class'=>'dropdown-item'.$active,'href'=>'mp_scorecard.php?cur_year='.$i));
}
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');

$Q1_start = $cur_year.'-01-01';
$Q2_start = $cur_year.'-04-01';
$Q3_start = $cur_year.'-07-01';
$Q4_start = $cur_year.'-10-01';

list ($year, $month, $day) = explode('-', $Q1_start);
$month = $month % 3 ? $month + 3 - ($month % 3) : $month;
$date = new DateTime();
$date->setDate($year, $month + 1, 0); //PHP will fix this date for you
$Q1_end=$date->format('Y-m-d');

//$DB->set_debug(true);
$sql = " SELECT COUNT(id) AS Q1_total_Fatalities FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=16 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start' AND '$Q1_end') ";
$Q1_Fatalities = $DB->count_records_sql($sql);
$Q1_Specific_Injuries = $DB->count_records_sql(" SELECT COUNT(id) AS Q1_total_Specific_Injuries FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=17 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start' AND '$Q1_end') ");
$Q1_Over_7_Day_Incapacity = $DB->count_records_sql(" SELECT COUNT(id) AS Q1_total_Over_7_Day_Incapacity FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=18 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start' AND '$Q1_end') ");
$Q1_Non_Fatal_Accidents_to_non_workers = $DB->count_records_sql(" SELECT COUNT(id) AS Q1_total_Non_Fatal_Accidents_to_non_workers FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=19 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start' AND '$Q1_end') ");
$Q1_Occupational_Disease = $DB->count_records_sql(" SELECT COUNT(id) AS Q1_total_Occupational_Disease FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=20 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start' AND '$Q1_end') ");
$Q1_Dangerous_Occurrence = $DB->count_records_sql(" SELECT COUNT(id) AS Q1_total_Dangerous_Occurrence FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=21 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start' AND '$Q1_end') ");
$Q1_Gas_Incidents = $DB->count_records_sql(" SELECT COUNT(id) AS Q1_total_Gas_Incidents FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=22 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start' AND '$Q1_end') ");
$Q1_medical_treatment_over_first_aid = $DB->count_records_sql(" SELECT COUNT(id) AS Q1_total_medical_treatment_over_first_aid FROM mdl_accident_report WHERE accident_treatment='Yes' AND (s_mgt_rpt_2508_completed IS NULL OR s_mgt_rpt_2508_completed IN(2,3))  AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start' AND '$Q1_end') ");
$Q1_Minor_Injuries = $DB->count_records_sql(" SELECT COUNT(id) AS Q1_total_Minor_Injuries FROM mdl_accident_report WHERE minor_injuries ='Yes' AND accident_treatment='No' AND (s_mgt_rpt_2508_completed IN(2,3) OR s_mgt_rpt_2508_completed IS NULL)  AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start' AND '$Q1_end') ");

$Q1_lost_days_accident = $DB->count_records_sql(" SELECT COALESCE(SUM(lost_time_days),0) AS Q1_total_lost_days FROM mdl_accident_report WHERE (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start' AND '$Q1_end') ");
$Q1_lost_days_incident = $DB->count_records_sql(" SELECT COALESCE(SUM(lost_time_days),0) AS Q1_total_lost_days FROM mdl_incident_report WHERE (DATE(FROM_UNIXTIME(i_date)) BETWEEN '$Q1_start' AND '$Q1_end') ");

$Q1_lost_days = $Q1_lost_days_accident + $Q1_lost_days_incident;

$Q1 = [$Q1_Fatalities, $Q1_Specific_Injuries, $Q1_Over_7_Day_Incapacity, $Q1_Non_Fatal_Accidents_to_non_workers, $Q1_Occupational_Disease, $Q1_Dangerous_Occurrence, $Q1_Gas_Incidents, $Q1_medical_treatment_over_first_aid, $Q1_Minor_Injuries, $Q1_lost_days];

list ($year, $month, $day) = explode('-', $Q2_start);
$month = $month % 3 ? $month + 3 - ($month % 3) : $month;
$date = new DateTime();
$date->setDate($year, $month + 1, 0); //PHP will fix this date for you
$Q2_end=$date->format('Y-m-d');

//$DB->set_debug(true);
$Q2_Fatalities = $DB->count_records_sql(" SELECT COUNT(id) AS Q2_total_Fatalities FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=16 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q2_start' AND '$Q2_end') ");
$Q2_Specific_Injuries = $DB->count_records_sql(" SELECT COUNT(id) AS Q2_total_Specific_Injuries FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=17 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q2_start' AND '$Q2_end') ");
$Q2_Over_7_Day_Incapacity = $DB->count_records_sql(" SELECT COUNT(id) AS Q2_total_Over_7_Day_Incapacity FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=18 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q2_start' AND '$Q2_end') ");
$Q2_Non_Fatal_Accidents_to_non_workers = $DB->count_records_sql(" SELECT COUNT(id) AS Q2_total_Non_Fatal_Accidents_to_non_workers FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=19 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q2_start'  AND '$Q2_end') ");
$Q2_Occupational_Disease = $DB->count_records_sql(" SELECT COUNT(id) AS Q2_total_Occupational_Disease FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=20 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q2_start'  AND '$Q2_end') ");
$Q2_Dangerous_Occurrence = $DB->count_records_sql(" SELECT COUNT(id) AS Q2_total_Dangerous_Occurrence FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=21 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q2_start'  AND '$Q2_end') ");
$Q2_Gas_Incidents = $DB->count_records_sql(" SELECT COUNT(id) AS Q2_total_Gas_Incidents FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=22 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q2_start'  AND '$Q2_end') ");

$Q2_medical_treatment_over_first_aid = $DB->count_records_sql(" SELECT COUNT(id) AS Q2_total_medical_treatment_over_first_aid FROM mdl_accident_report WHERE accident_treatment='Yes' AND (s_mgt_rpt_2508_completed IS NULL OR s_mgt_rpt_2508_completed IN(2,3))  AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q2_start' AND '$Q2_end') ");
$Q2_Minor_Injuries = $DB->count_records_sql(" SELECT COUNT(id) AS Q2_total_Minor_Injuries FROM mdl_accident_report WHERE minor_injuries ='Yes' AND accident_treatment='No' AND (s_mgt_rpt_2508_completed IN(2,3) OR s_mgt_rpt_2508_completed IS NULL) AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q2_start' AND '$Q2_end') ");
//$DB->set_debug(false);
$Q2_lost_days_accident = $DB->count_records_sql(" SELECT COALESCE(SUM(lost_time_days),0) AS Q2_total_lost_days FROM mdl_accident_report WHERE (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q2_start' AND '$Q2_end') ");
$Q2_lost_days_incident = $DB->count_records_sql(" SELECT COALESCE(SUM(lost_time_days),0) AS Q2_total_lost_days FROM mdl_incident_report WHERE (DATE(FROM_UNIXTIME(i_date)) BETWEEN '$Q2_start' AND '$Q2_end') ");

$Q2_lost_days = $Q2_lost_days_accident + $Q2_lost_days_incident;


$Q2 = [$Q2_Fatalities, $Q2_Specific_Injuries, $Q2_Over_7_Day_Incapacity, $Q2_Non_Fatal_Accidents_to_non_workers, $Q2_Occupational_Disease, $Q2_Dangerous_Occurrence, $Q2_Gas_Incidents, $Q2_medical_treatment_over_first_aid, $Q2_Minor_Injuries, $Q2_lost_days];

list ($year, $month, $day) = explode('-', $Q3_start);
$month = $month % 3 ? $month + 3 - ($month % 3) : $month;
$date = new DateTime();
$date->setDate($year, $month + 1, 0); //PHP will fix this date for you
$Q3_end=$date->format('Y-m-d');

//$DB->set_debug(true);
$Q3_Fatalities = $DB->count_records_sql(" SELECT COUNT(id) AS Q3_total_Fatalities FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=16 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q3_start'  AND '$Q3_end') ");
$Q3_Specific_Injuries = $DB->count_records_sql(" SELECT COUNT(id) AS Q3_total_Specific_Injuries FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=17 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q3_start'  AND '$Q3_end') ");
$Q3_Over_7_Day_Incapacity = $DB->count_records_sql(" SELECT COUNT(id) AS Q3_total_Over_7_Day_Incapacity FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=18 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q3_start'  AND '$Q3_end') ");
$Q3_Non_Fatal_Accidents_to_non_workers = $DB->count_records_sql(" SELECT COUNT(id) AS Q3_total_Non_Fatal_Accidents_to_non_workers FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=19 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q3_start'  AND '$Q3_end') ");
$Q3_Occupational_Disease = $DB->count_records_sql(" SELECT COUNT(id) AS Q3_total_Occupational_Disease FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=20 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q3_start'  AND '$Q3_end') ");
$Q3_Dangerous_Occurrence = $DB->count_records_sql(" SELECT COUNT(id) AS Q3_total_Dangerous_Occurrence FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=21 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q3_start'  AND '$Q3_end') ");
$Q3_Gas_Incidents = $DB->count_records_sql(" SELECT COUNT(id) AS Q3_total_Gas_Incidents FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=22 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q3_start'  AND '$Q3_end') ");

$Q3_medical_treatment_over_first_aid = $DB->count_records_sql(" SELECT COUNT(id) AS Q3_total_medical_treatment_over_first_aid FROM mdl_accident_report WHERE accident_treatment='Yes' AND (s_mgt_rpt_2508_completed IS NULL OR s_mgt_rpt_2508_completed IN(2,3)) AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q3_start' AND '$Q3_end') ");
$Q3_Minor_Injuries = $DB->count_records_sql(" SELECT COUNT(id) AS Q3_total_Minor_Injuries FROM mdl_accident_report WHERE minor_injuries ='Yes' AND accident_treatment='No' AND (s_mgt_rpt_2508_completed IN(2,3) OR s_mgt_rpt_2508_completed IS NULL) AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q3_start' AND '$Q3_end') ");

$Q3_lost_days_accident = $DB->count_records_sql(" SELECT COALESCE(SUM(lost_time_days),0) AS Q3_total_lost_days FROM mdl_accident_report WHERE (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q3_start' AND '$Q3_end') ");
$Q3_lost_days_incident = $DB->count_records_sql(" SELECT COALESCE(SUM(lost_time_days),0) AS Q3_total_lost_days FROM mdl_incident_report WHERE (DATE(FROM_UNIXTIME(i_date)) BETWEEN '$Q3_start' AND '$Q3_end') ");

$Q3_lost_days = $Q3_lost_days_accident + $Q3_lost_days_incident;

$Q3 = [$Q3_Fatalities, $Q3_Specific_Injuries, $Q3_Over_7_Day_Incapacity, $Q3_Non_Fatal_Accidents_to_non_workers, $Q3_Occupational_Disease, $Q3_Dangerous_Occurrence, $Q3_Gas_Incidents, $Q3_medical_treatment_over_first_aid, $Q3_Minor_Injuries, $Q3_lost_days];

list ($year, $month, $day) = explode('-', $Q4_start);
$month = $month % 3 ? $month + 3 - ($month % 3) : $month;
$date = new DateTime();
$date->setDate($year, $month + 1, 0); //PHP will fix this date for you
$Q4_end=$date->format('Y-m-d');

//$DB->set_debug(true);
$Q4_Fatalities = $DB->count_records_sql(" SELECT COUNT(id) AS Q4_total_Fatalities FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=16 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q4_start'  AND '$Q4_end') ");
$Q4_Specific_Injuries = $DB->count_records_sql(" SELECT COUNT(id) AS Q4_total_Specific_Injuries FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=17 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q4_start'  AND '$Q4_end') ");
$Q4_Over_7_Day_Incapacity = $DB->count_records_sql(" SELECT COUNT(id) AS Q4_total_Over_7_Day_Incapacity FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=18 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q4_start'  AND '$Q4_end') ");
$Q4_Non_Fatal_Accidents_to_non_workers = $DB->count_records_sql(" SELECT COUNT(id) AS Q4_total_Non_Fatal_Accidents_to_non_workers FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=19 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q4_start'  AND '$Q4_end') ");
$Q4_Occupational_Disease = $DB->count_records_sql(" SELECT COUNT(id) AS Q4_total_Occupational_Disease FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=20 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q4_start'  AND '$Q4_end') ");
$Q4_Dangerous_Occurrence = $DB->count_records_sql(" SELECT COUNT(id) AS Q4_total_Dangerous_Occurrence FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=21 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q4_start'  AND '$Q4_end') ");
$Q4_Gas_Incidents = $DB->count_records_sql(" SELECT COUNT(id) AS Q4_total_Gas_Incidents FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=22 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q4_start'  AND '$Q4_end') ");

$Q4_medical_treatment_over_first_aid = $DB->count_records_sql(" SELECT COUNT(id) AS Q4_total_medical_treatment_over_first_aid FROM mdl_accident_report WHERE accident_treatment='Yes' AND (s_mgt_rpt_2508_completed IS NULL OR s_mgt_rpt_2508_completed IN(2,3)) AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q4_start' AND '$Q4_end') ");
$Q4_Minor_Injuries = $DB->count_records_sql(" SELECT COUNT(id) AS Q4_total_Minor_Injuries FROM mdl_accident_report WHERE minor_injuries ='Yes' AND accident_treatment='No' AND (s_mgt_rpt_2508_completed IN(2,3) OR s_mgt_rpt_2508_completed IS NULL) AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q4_start' AND '$Q4_end') ");
$Q4_lost_days = $DB->count_records_sql(" SELECT COALESCE(SUM(lost_time_days),0) AS Q4_total_lost_days FROM mdl_accident_report WHERE (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q4_start'  AND '$Q4_end') ");

$Q4_lost_days_accident = $DB->count_records_sql(" SELECT COALESCE(SUM(lost_time_days),0) AS Q4_total_lost_days FROM mdl_accident_report WHERE (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q4_start' AND '$Q4_end') ");
$Q4_lost_days_incident = $DB->count_records_sql(" SELECT COALESCE(SUM(lost_time_days),0) AS Q4_total_lost_days FROM mdl_incident_report WHERE (DATE(FROM_UNIXTIME(i_date)) BETWEEN '$Q4_start' AND '$Q4_end') ");

$Q4_lost_days = $Q4_lost_days_accident + $Q4_lost_days_incident;

$Q4 = [$Q4_Fatalities, $Q4_Specific_Injuries, $Q4_Over_7_Day_Incapacity, $Q4_Non_Fatal_Accidents_to_non_workers, $Q4_Occupational_Disease, $Q4_Dangerous_Occurrence, $Q4_Gas_Incidents, $Q4_medical_treatment_over_first_aid, $Q4_Minor_Injuries, $Q4_lost_days];

//$DB->set_debug(true);
$YTD_Fatalities = $DB->count_records_sql(" SELECT COUNT(id) AS YTD_total_Fatalities FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=16 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start'  AND '$Q4_end') ");
$YTD_Specific_Injuries = $DB->count_records_sql(" SELECT COUNT(id) AS YTD_total_Specific_Injuries FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=17 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start'  AND '$Q4_end') ");
$YTD_Over_7_Day_Incapacity = $DB->count_records_sql(" SELECT COUNT(id) AS YTD_total_Over_7_Day_Incapacity FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=18 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start'  AND '$Q4_end') ");
$YTD_Non_Fatal_Accidents_to_non_workers = $DB->count_records_sql(" SELECT COUNT(id) AS YTD_total_Non_Fatal_Accidents_to_non_workers FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=19 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start'  AND '$Q4_end') ");
$YTD_Occupational_Disease = $DB->count_records_sql(" SELECT COUNT(id) AS YTD_total_Occupational_Disease FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=20 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start'  AND '$Q4_end') ");
$YTD_Dangerous_Occurrence = $DB->count_records_sql(" SELECT COUNT(id) AS YTD_total_Dangerous_Occurrence FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=21 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start'  AND '$Q4_end') ");
$YTD_Gas_Incidents = $DB->count_records_sql(" SELECT COUNT(id) AS YTD_total_Gas_Incidents FROM mdl_accident_report WHERE s_mgt_rpt_riddor_event_clf=22 AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start'  AND '$Q4_end') ");

//echo "SELECT COUNT(id) AS YTD_total_Minor_Injuries FROM mdl_accident_report WHERE s_mgt_rpt_2508_completed IS NULL AND (accident_treatment='No' OR accident_treatment IS NULL) AND minor_injuries='Yes' AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q4_start' AND '$Q4_end') ";

$YTD_medical_treatment_over_first_aid = $DB->count_records_sql(" SELECT COUNT(id) AS YTD_total_medical_treatment_over_first_aid FROM mdl_accident_report WHERE accident_treatment='Yes' AND (s_mgt_rpt_2508_completed IS NULL OR s_mgt_rpt_2508_completed IN(2,3)) AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start' AND '$Q4_end') ");
$YTD_Minor_Injuries = $DB->count_records_sql(" SELECT COUNT(id) AS YTD_total_Minor_Injuries FROM mdl_accident_report WHERE minor_injuries ='Yes' AND accident_treatment='No' AND (s_mgt_rpt_2508_completed IN(2,3) OR s_mgt_rpt_2508_completed IS NULL) AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start' AND '$Q4_end') ");


//$YTD_medical_treatment_over_first_aid = $DB->count_records_sql(" SELECT COUNT(id) AS YTD_total_medical_treatment_over_first_aid FROM mdl_accident_report WHERE accident_treatment='Yes' AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start'  AND '$Q4_end') ");
//$YTD_Minor_Injuries = $DB->count_records_sql(" SELECT COUNT(id) AS YTD_total_Minor_Injuries FROM mdl_accident_report WHERE minor_injuries='Yes' AND (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start'  AND '$Q4_end') ");
$YTD_lost_days_accident = $DB->count_records_sql(" SELECT COALESCE(SUM(lost_time_days),0) AS YTD_total_lost_days FROM mdl_accident_report WHERE (DATE(FROM_UNIXTIME(accident_date)) BETWEEN '$Q1_start'  AND '$Q4_end') ");
$YTD_lost_days_incident = $DB->count_records_sql(" SELECT COALESCE(SUM(lost_time_days),0) AS YTD_total_lost_days FROM mdl_incident_report WHERE (DATE(FROM_UNIXTIME(i_date)) BETWEEN '$Q1_start'  AND '$Q4_end') ");

$YTD_lost_days = $YTD_lost_days_accident + $YTD_lost_days_incident;

//$DB->set_debug(false);
$YTD = [$YTD_Fatalities, $YTD_Specific_Injuries, $YTD_Over_7_Day_Incapacity, $YTD_Non_Fatal_Accidents_to_non_workers, $YTD_Occupational_Disease, $YTD_Dangerous_Occurrence, $YTD_Gas_Incidents, $YTD_medical_treatment_over_first_aid, $YTD_Minor_Injuries, $YTD_lost_days];


echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: tag('h5',get_string('accidents_incidents_chart', 'local_trend_analysis_report').' ('.$cur_year.')',array('class'=>'card-header'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 600px;','id'=>'container1'));
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');

$target_year_data = $DB->get_record_sql(" SELECT * FROM mdl_report_target WHERE year=$cur_year ");


    $decode_data = json_decode($target_year_data->data);
    $Q1_target = 0;
    $Q2_target = 0;
    $Q3_target = 0;
    $Q4_target = 0;

    if(!empty($decode_data))
    foreach($decode_data as $key2=>$rec2) {

        if (strcasecmp($key2,"No of Site Audits")==0) {
            $k = 0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
//            echo $k;
                if ($k >= 1 && $k <= 3) {
                    $Q1_target = ($Q1_target + $rec3);
//                $Q1_target .= $k;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_target = ($Q2_target + $rec3);
//                $Q2_target .= $k;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_target = ($Q3_target + $rec3);
//                $Q3_target .= $k;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_target = ($Q4_target + $rec3);
//                $Q4_target .= $k;
                }
            }
        }

    }

//print_r($Q4_target);
$YTD_target = ($Q1_target+$Q2_target+$Q3_target+$Q4_target);
$target = [$Q1_target,$Q2_target,$Q3_target,$Q4_target,$YTD_target];

$Q1_actual = 0;$Q2_actual = 0;$Q3_actual = 0;$Q4_actual = 0;
$actual_year_data = $DB->get_records_sql(" SELECT * FROM mdl_report_actual WHERE year=$cur_year ");
foreach($actual_year_data as $rec) {
    $month = 0;
    $month = $rec->month;
    $decode_data = json_decode($rec->data);

    foreach($decode_data as $key2=>$rec2) {

        if (strcasecmp($rec2[0],"Number of Audits")==0) {

            if ($month >= 1 && $month <= 3) {
                $Q1_actual = ($Q1_actual + $rec2[1]);
//                print_r($Q1_actual.'Q1');
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_actual = ($Q2_actual + $rec2[1]);
//                print_r($Q2_actual.'Q2');
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_actual = ($Q3_actual + $rec2[1]);
//                print_r($Q3_actual.'Q3');
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_actual = ($Q4_actual + $rec2[1]);
//                print_r($Q4_actual.'Q4');
            }
//            print_r($Q1_actual.'Q1');print_r($Q2_actual.'Q2');print_r($Q3_actual.'Q3');print_r($Q4_actual.'Q4');
        }
    }
}
//print_r($Q1_actual.'Q1');print_r($Q2_actual.'Q2');print_r($Q3_actual.'Q3');print_r($Q4_actual.'Q4');
$YTD_actual = ($Q1_actual+$Q2_actual+$Q3_actual+$Q4_actual);
$actual = [$Q1_actual,$Q2_actual,$Q3_actual,$Q4_actual,$YTD_actual];
echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: tag('h5',get_string('number_of_site_audit', 'local_trend_analysis_report').' ('.$cur_year.')',array('class'=>'card-header'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 400px;','id'=>'container2'));
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');

$Q1_number_of_audits = 0;$Q2_number_of_audits = 0;$Q3_number_of_audits = 0;$Q4_number_of_audits = 0;

$Q1_audit_recommendations = 0;$Q2_audit_recommendations = 0;$Q3_audit_recommendations = 0;$Q4_audit_recommendations = 0;

$Q1_outstanding_recommendations = 0;$Q2_outstanding_recommendations = 0;$Q3_outstanding_recommendations = 0;$Q4_outstanding_recommendations = 0;
$recommendation_against_audit_year_data = $DB->get_records_sql(" SELECT * FROM mdl_report_actual WHERE year=$cur_year ");
//echo '<pre>';
//print_r($recommendation_against_audit_year_data);
foreach($recommendation_against_audit_year_data as $rec) {
    $month = 0;
    $month = $rec->month;
    $decode_data = json_decode($rec->data);

    foreach($decode_data as $key2=>$rec2) {
//        print_r($rec2);
        if (strcasecmp($rec2[0],"Number of Audits")==0) {

//            print_r($rec2[0]);
            if ($month >= 1 && $month <= 3) {
                $Q1_number_of_audits = ($Q1_number_of_audits + $rec2[1]);
//                $Q1_number_of_audits +=$rec2[1];
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_number_of_audits = ($Q2_number_of_audits + $rec2[1]);
//                $Q2_number_of_audits +=$rec2[1];
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_number_of_audits = ($Q3_number_of_audits + $rec2[1]);
//                $Q3_number_of_audits +=$rec2[1];
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_number_of_audits = ($Q4_number_of_audits + $rec2[1]);
//                $Q4_number_of_audits +=$rec2[1];
            }
//            print_r($Q1_number_of_audits.'Q1');print_r($Q2_number_of_audits.'Q2');print_r($Q3_number_of_audits.'Q3');print_r($Q4_number_of_audits.'Q4');
        }
        if (strcasecmp($rec2[0],"Audit Recommendations")==0) {
//            print_r($rec2[0]);
            if ($month >= 1 && $month <= 3) {
                $Q1_audit_recommendations = ($Q1_audit_recommendations + $rec2[1]);
//                $Q1_audit_recommendations .= $k;
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_audit_recommendations = ($Q2_audit_recommendations + $rec2[1]);
//                $Q2_audit_recommendations .= $k;
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_audit_recommendations = ($Q3_audit_recommendations + $rec2[1]);
//                $Q3_audit_recommendations .= $k;
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_audit_recommendations = ($Q4_audit_recommendations + $rec2[1]);
//                $Q4_audit_recommendations .= $k;
            }
//            print_r($Q1_audit_recommendations.'Q1');print_r($Q2_audit_recommendations.'Q2');print_r($Q3_audit_recommendations.'Q3');print_r($Q4_audit_recommendations.'Q4');
        }
        if (strcasecmp($rec2[0],"Outstanding Recommendations")==0) {
//            print_r($rec2);
            if ($month >= 1 && $month <= 3) {
                $Q1_outstanding_recommendations = ($Q1_outstanding_recommendations + $rec2[1]);
//                $Q1_outstanding_recommendations .= $k;
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_outstanding_recommendations = ($Q2_outstanding_recommendations + $rec2[1]);
//                $Q2_outstanding_recommendations .= $k;
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_outstanding_recommendations = ($Q3_outstanding_recommendations + $rec2[1]);
//                $Q3_outstanding_recommendations .= $k;
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_outstanding_recommendations = ($Q4_outstanding_recommendations + $rec2[1]);
//                $Q4_outstanding_recommendations .= $k;
            }
//            print_r($Q1_outstanding_recommendations.'Q1');print_r($Q2_outstanding_recommendations.'Q2');print_r($Q3_outstanding_recommendations.'Q3');print_r($Q4_outstanding_recommendations.'Q4');
        }
    }
    $Q1_recommendation_percentage_against_audit = (($Q1_audit_recommendations/$Q1_number_of_audits)*100);
    $Q2_recommendation_percentage_against_audit = (($Q2_audit_recommendations/$Q2_number_of_audits)*100);
    $Q3_recommendation_percentage_against_audit = (($Q3_audit_recommendations/$Q3_number_of_audits)*100);
    $Q4_recommendation_percentage_against_audit = (($Q4_audit_recommendations/$Q4_number_of_audits)*100);

    $Q1_outstanding_recommendation_percentage_against_audit = (($Q1_outstanding_recommendations/$Q1_number_of_audits)*100);
    $Q2_outstanding_recommendation_percentage_against_audit = (($Q2_outstanding_recommendations/$Q2_number_of_audits)*100);
    $Q3_outstanding_recommendation_percentage_against_audit = (($Q3_outstanding_recommendations/$Q3_number_of_audits)*100);
    $Q4_outstanding_recommendation_percentage_against_audit = (($Q4_outstanding_recommendations/$Q4_number_of_audits)*100);
}
//print_r($Q2_recommendation_percentage_against_audit);
if (is_nan($Q1_recommendation_percentage_against_audit) || ("$Q1_recommendation_percentage_against_audit"=='INF')) $Q1_recommendation_percentage_against_audit=0;
if (is_nan($Q2_recommendation_percentage_against_audit) || ("$Q2_recommendation_percentage_against_audit"=='INF')) $Q2_recommendation_percentage_against_audit=0;
if (is_nan($Q3_recommendation_percentage_against_audit) || ("$Q3_recommendation_percentage_against_audit"=='INF')) $Q3_recommendation_percentage_against_audit=0;
if (is_nan($Q4_recommendation_percentage_against_audit) || ("$Q4_recommendation_percentage_against_audit"=='INF')) $Q4_recommendation_percentage_against_audit=0;
//print_r($Q2_recommendation_percentage_against_audit);
$YTD_recommendation_percentage_against_audit = (($Q1_audit_recommendations+$Q2_audit_recommendations+$Q3_audit_recommendations+$Q4_audit_recommendations)/($Q1_number_of_audits+$Q2_number_of_audits+$Q3_number_of_audits+$Q4_number_of_audits)*100);
$recommendation_percentage_against_audit = [round($Q1_recommendation_percentage_against_audit,2),round($Q2_recommendation_percentage_against_audit,2),round($Q3_recommendation_percentage_against_audit,2),round($Q4_recommendation_percentage_against_audit,2),round($YTD_recommendation_percentage_against_audit,2)];

if (is_nan($Q1_outstanding_recommendation_percentage_against_audit) || ("$Q1_outstanding_recommendation_percentage_against_audit"=='INF')) $Q1_outstanding_recommendation_percentage_against_audit=0;
if (is_nan($Q2_outstanding_recommendation_percentage_against_audit) || ("$Q2_outstanding_recommendation_percentage_against_audit"=='INF')) $Q2_outstanding_recommendation_percentage_against_audit=0;
if (is_nan($Q3_outstanding_recommendation_percentage_against_audit) || ("$Q3_outstanding_recommendation_percentage_against_audit"=='INF')) $Q3_outstanding_recommendation_percentage_against_audit=0;
if (is_nan($Q4_outstanding_recommendation_percentage_against_audit) || ("$Q4_outstanding_recommendation_percentage_against_audit"=='INF')) $Q4_outstanding_recommendation_percentage_against_audit=0;
$YTD_outstanding_recommendation_percentage_against_audit = (($Q1_outstanding_recommendations+$Q2_outstanding_recommendations+$Q3_outstanding_recommendations+$Q4_outstanding_recommendations)/($Q1_number_of_audits+$Q2_number_of_audits+$Q3_number_of_audits+$Q4_number_of_audits)*100);
$outstanding_recommendation_percentage_against_audit = [round($Q1_outstanding_recommendation_percentage_against_audit,2),round($Q2_outstanding_recommendation_percentage_against_audit,2),round($Q3_outstanding_recommendation_percentage_against_audit,2),round($Q4_outstanding_recommendation_percentage_against_audit,2),round($YTD_outstanding_recommendation_percentage_against_audit,2)];

echo html_writer:: start_tag('div',array('class'=>'card'));
echo html_writer:: tag('h5',get_string('audit_recommendation', 'local_trend_analysis_report').' ('.$cur_year.')',array('class'=>'card-header'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 400px;','id'=>'container3'));
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');

echo $OUTPUT->footer();
?>
<script type="text/javascript">
    Highcharts.chart('container1', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Accidents and Incidents chart'
        },
        subtitle: {
            text: ''
        },
        credits: {
            enabled: false
        },
        xAxis: {

    categories: [
                'Fatalities',
                'Specific Injuries',
                'Over 7 day injury',
                'Non Fatal Accidents to non workers',
                'Occupational Disease',
                'Dangerous Occurrence',
                'Gas Incidents',
                'No of medical treatment over first aid',
                'No of minor injuries',
                'Total lost days'
            ],
            crosshair: true,
            labels: {
                rotation: -45
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Number of reports'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0;font-size:8px;">{series.name}: </td>' +
            '<td style="padding:0;font-size:8px;"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold'
                    },
                    formatter: function() {
                        if (this.y != 0) {
                            return this.y;
                        } else {
                            return null;
                        }
                    }
                }
            }
        },
        series: [{
            name: 'Quarter 1',
            data: [<?=implode(",", $Q1)?>]
        }, {
            name: 'Quarter 2',
            data: [<?=implode(",", $Q2)?>]
        }, {
            name: 'Quarter 3',
            data: [<?=implode(",", $Q3)?>]
        }, {
            name: 'Quarter 4',
            data: [<?=implode(",", $Q4)?>]
        }, {
            name: 'Year to date',
            data: [<?=implode(",", $YTD)?>]
        }]
    });


    Highcharts.chart('container2', {
        chart: {
            zoomType: 'xy'
        },
        title: {
            text: 'Number of Site Audits'
        },
        subtitle: {
            text: ''
        },
        credits: {
            enabled: false
        },
        xAxis: [{
            categories: ['Q1', 'Q2', 'Q3', 'Q4', 'YTD'],
            crosshair: true
        }],
        yAxis: [{ // Primary yAxis
            labels: {
                format: '{value}',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            },
            title: {
                text: 'Audits',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
        }, { // Secondary yAxis
            title: {
                text: '',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value}',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
        }],
        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            x: 120,
            verticalAlign: 'top',
            y: 100,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || 'rgba(255,255,255,0.25)'
        },
        series: [{
            name: 'Target',
            type: 'column',
            yAxis: 0,
            data: [<?=implode(",", $target)?>],
            dataLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold'
                },
                formatter: function() {
                    if (this.y != 0) {
                        return this.y;
                    } else {
                        return null;
                    }
                }
            }
        }, {
            name: 'Actual',
            type: 'spline',
            data: [<?=implode(",", $actual)?>],
            dataLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold'
                },
                formatter: function() {
                    if (this.y != 0) {
                        return this.y;
                    } else {
                        return null;
                    }
                }
            }
        }]
    });

    Highcharts.chart('container3', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Audit Recommendations'
        },
        subtitle: {
            text: ''
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: ['Q1', 'Q2', 'Q3', 'Q4', 'YTD'],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Percentage'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0;font-size:8px;">{series.name}: </td>' +
            '<td style="padding:0;font-size:8px;"><b>{point.y}%</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold'
                    },
                    formatter: function() {
                        if (this.y != 0) {
                            return this.y+"%";
                        } else {
                            return null;
                        }
                    }
                }
            },

        },
        series: [{
            name: 'Recommendation % against Audit',
            data: [<?=implode(",", $recommendation_percentage_against_audit)?>]
        }, {
            name: 'Outstanding Recommendation % against Audit',
            data: [<?=implode(",", $outstanding_recommendation_percentage_against_audit)?>]
        }]
    });
</script>
