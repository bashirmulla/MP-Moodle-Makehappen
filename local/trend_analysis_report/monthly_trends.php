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
$homeurl    = new moodle_url('/local/accident_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}

if (empty(get_request('cur_year'))){
    $cur_year = date("Y");
}else{
    $cur_year = get_request('cur_year');

    if(!is_number($cur_year))  $cur_year = date("Y");
}
// Heading ==========================================================.

$title   = get_string('monthly_trends', 'local_'.$pluginname);
$heading = get_string('monthly_trends', 'local_'.$pluginname);
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
    echo html_writer::tag('a', $i, array('class'=>'dropdown-item'.$active,'href'=>'monthly_trends.php?cur_year='.$i));
}
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');

/* BM added */
$sql       = "SELECT    FROM_UNIXTIME(b_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(b_date,'%c')-1 as month  
              FROM      mdl_new_accident_report 
              WHERE     FROM_UNIXTIME(b_date,'%Y')=".$cur_year." 
              GROUP by  FROM_UNIXTIME(b_date,'%m')";
/* EOF BM */
$result    = $DB->get_records_sql($sql);
$accidents = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
    $accidents[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=31 
                          ELSE  correct_report_category=31 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$incidents = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $incidents[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=29 
                          ELSE  correct_report_category=29 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$near_misses = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $near_misses[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=30 
                          ELSE  correct_report_category=30 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$hazards = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $hazards[$data->month] = $data->total;
}

echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: tag('h5',get_string('overview_by_category', 'local_trend_analysis_report').' ('.$cur_year.')',array('class'=>'card-header'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 600px;','id'=>'container1'));
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');


$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=32  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=30 
                          ELSE  correct_report_category=30 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$access_restriction = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $access_restriction[$data->month] = $data->total;
}


$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=33  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=30 
                          ELSE  correct_report_category=30 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$animals = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $animals[$data->month] = $data->total;
}


$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=34  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=30 
                          ELSE  correct_report_category=30 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$asset_issues = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $asset_issues[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=35  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=30 
                          ELSE  correct_report_category=30 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$equipment_issues = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $equipment_issues[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=36  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=30 
                          ELSE  correct_report_category=30 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$gas_detection = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $gas_detection[$data->month] = $data->total;
}


$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=37  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=30 
                          ELSE  correct_report_category=30 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$manhole_covers_frame_issue = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $manhole_covers_frame_issue[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=38  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=30 
                          ELSE  correct_report_category=30 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$needles_glass = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $needles_glass[$data->month] = $data->total;
}


$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=39  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=30 
                          ELSE  correct_report_category=30 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$other = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $other[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=40  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=30 
                          ELSE  correct_report_category=30 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$slips_trips_falls = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $slips_trips_falls[$data->month] = $data->total;
}


$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=41  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=30 
                          ELSE  correct_report_category=30 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$traffic_vehicle = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $traffic_vehicle[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=42  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=30 
                          ELSE  correct_report_category=30 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$vegetation = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $vegetation[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND report_category=30 AND is_correct_report_category IS NULL  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$tbc = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $tbc[$data->month] = $data->total;
}

echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: tag('h5',get_string('hazard_by_classification', 'local_trend_analysis_report').' ('.$cur_year.')',array('class'=>'card-header'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 400px;','id'=>'container2'));
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');



$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=32  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=29 
                          ELSE  correct_report_category=29 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$access_restriction2 = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $access_restriction2[$data->month] = $data->total;
}


$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=33  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=29 
                          ELSE  correct_report_category=29 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$animals2 = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $animals2[$data->month] = $data->total;
}


$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=34  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=29 
                          ELSE  correct_report_category=29 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$asset_issues2 = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $asset_issues2[$data->month] = $data->total;
}


$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=35  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=29 
                          ELSE  correct_report_category=29 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$equipment_issues2 = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $equipment_issues2[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=36  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=29 
                          ELSE  correct_report_category=29 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$gas_detection2 = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $gas_detection2[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=37  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=29 
                          ELSE  correct_report_category=29 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$manhole_covers_frame_issue2 = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $manhole_covers_frame_issue2[$data->month] = $data->total;
}


$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=38  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=29 
                          ELSE  correct_report_category=29 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$needles_glass2 = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $needles_glass2[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=39  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=29 
                          ELSE  correct_report_category=29 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$other2 = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $other2[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=40  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=29 
                          ELSE  correct_report_category=29 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$slips_trips_falls2 = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $slips_trips_falls2[$data->month] = $data->total;
}


$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=41  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=29 
                          ELSE  correct_report_category=29 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$traffic_vehicle2 = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $traffic_vehicle2[$data->month] = $data->total;
}


$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND classification=42  AND 
              ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=29 
                          ELSE  correct_report_category=29 
              END )  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$vegetation2 = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $vegetation2[$data->month] = $data->total;
}

$sql       = "SELECT FROM_UNIXTIME(i_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(i_date,'%c')-1 as month  
              FROM   mdl_incident_report 
              WHERE  FROM_UNIXTIME(i_date,'%Y')=".$cur_year." 
              AND report_category=29 AND is_correct_report_category IS NULL  
              GROUP by  FROM_UNIXTIME(i_date,'%m')";
$result    = $DB->get_records_sql($sql);
$tbc2 = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        $tbc2[$data->month] = $data->total;
}

//$DB->set_debug(false);
echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: tag('h5',get_string('near_misses_by_classification', 'local_trend_analysis_report').' ('.$cur_year.')',array('class'=>'card-header'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 400px;','id'=>'container3'));
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');

/*BM commented-out */
/*
$sql       = "SELECT FROM_UNIXTIME(accident_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(accident_date,'%c')-1 as month
              FROM      mdl_accident_report
              WHERE     FROM_UNIXTIME(accident_date,'%Y')=".$cur_year."  AND accident_category=74
              GROUP by  FROM_UNIXTIME(accident_date,'%m')";
*/
/* EOF BM */

/* BM added */
$sql       = "SELECT FROM_UNIXTIME(b_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(b_date,'%c')-1 as month  
              FROM      mdl_new_accident_report 
              WHERE     FROM_UNIXTIME(b_date,'%Y')=".$cur_year."  AND find_in_set('1', d_agents) > 0
              GROUP by  FROM_UNIXTIME(b_date,'%m')";
/* EOF BM */

$result    = $DB->get_records_sql($sql);
$any_vehicle_associated_equipment_machinery = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        //$act_of_physical_violence[$data->month] = $data->total;
        $any_vehicle_associated_equipment_machinery[$data->month] = $data->total;
}


$sql       = "SELECT FROM_UNIXTIME(b_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(b_date,'%c')-1 as month  
              FROM      mdl_new_accident_report 
              WHERE     FROM_UNIXTIME(b_date,'%Y')=".$cur_year."  AND find_in_set('2', d_agents) > 0 
              GROUP by  FROM_UNIXTIME(b_date,'%m')";
$result    = $DB->get_records_sql($sql);
$building_services_not_electrical = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        //$cuts_and_lacerations[$data->month] = $data->total;
        $building_services_not_electrical[$data->month] = $data->total;
}

//$DB->set_debug(false);
//$DB->set_debug(true);

$sql       = "SELECT FROM_UNIXTIME(b_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(b_date,'%c')-1 as month  
              FROM      mdl_new_accident_report 
              WHERE     FROM_UNIXTIME(b_date,'%Y')=".$cur_year."  AND find_in_set('3', d_agents) > 0
              GROUP by  FROM_UNIXTIME(b_date,'%m')";
$result    = $DB->get_records_sql($sql);
$building_structure_excavation_underground_working = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        //$falls_from_height[$data->month] = $data->total;
        $building_structure_excavation_underground_working[$data->month] = $data->total;
}


//$DB->set_debug(false);
//$DB->set_debug(true);

$sql       = "SELECT FROM_UNIXTIME(b_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(b_date,'%c')-1 as month  
              FROM      mdl_new_accident_report 
              WHERE     FROM_UNIXTIME(b_date,'%Y')=".$cur_year."  AND find_in_set('4', d_agents) > 0 
              GROUP by  FROM_UNIXTIME(b_date,'%m')";
$result    = $DB->get_records_sql($sql);
$carcinogen = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        //$manual_handling[$data->month] = $data->total;
        $carcinogen[$data->month] = $data->total;
}

//$DB->set_debug(false);
//$DB->set_debug(true);

$sql       = "SELECT FROM_UNIXTIME(b_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(b_date,'%c')-1 as month  
              FROM      mdl_new_accident_report 
              WHERE     FROM_UNIXTIME(b_date,'%Y')=".$cur_year."  AND find_in_set('5', d_agents) > 0 
              GROUP by  FROM_UNIXTIME(b_date,'%m')";
$result    = $DB->get_records_sql($sql);
$Construction_shuttering_false_work = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        //$needlestick_injuries[$data->month] = $data->total;
        $Construction_shuttering_false_work[$data->month] = $data->total;
}

//$DB->set_debug(false);
//$DB->set_debug(true);
$sql       = "SELECT FROM_UNIXTIME(b_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(b_date,'%c')-1 as month  
              FROM      mdl_new_accident_report 
              WHERE     FROM_UNIXTIME(b_date,'%Y')=".$cur_year."  AND find_in_set('6', d_agents) > 0 
              GROUP by  FROM_UNIXTIME(b_date,'%m')";
$result    = $DB->get_records_sql($sql);
$entertainment_sporting_facilities_equipment = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        //$slips_trips_and_falls_on_same_level[$data->month] = $data->total;
        $entertainment_sporting_facilities_equipment[$data->month] = $data->total;
}

//$DB->set_debug(false);
//$DB->set_debug(true);
$sql       = "SELECT FROM_UNIXTIME(b_date,'%c')-1 as rowid,COUNT(id) as total ,FROM_UNIXTIME(b_date,'%c')-1 as month  
              FROM      mdl_new_accident_report 
              WHERE     FROM_UNIXTIME(b_date,'%Y')=".$cur_year."  AND find_in_set('7', d_agents) > 0
              GROUP by  FROM_UNIXTIME(b_date,'%m')";
$result    = $DB->get_records_sql($sql);
$floor_ground_stairs_any_work_surface = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
if(!empty($result)){
    foreach ($result as $data)
        //$struck_by_an_object[$data->month] = $data->total;
        $floor_ground_stairs_any_work_surface[$data->month] = $data->total;
}

//$DB->set_debug(false);

echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: tag('h5',get_string('accidents_by_category', 'local_trend_analysis_report').' ('.$cur_year.')',array('class'=>'card-header'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 400px;','id'=>'container4'));
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');

$sql       = "SELECT concat(s_mgt_rpt_riddor_event_clf,'_',FROM_UNIXTIME(accident_date,'%c')-1) as rowid,COUNT(id) as total ,FROM_UNIXTIME(accident_date,'%c')-1 as month , s_mgt_rpt_riddor_event_clf as ridder_event
              FROM      mdl_accident_report 
              WHERE     FROM_UNIXTIME(accident_date,'%Y')=".$cur_year." 
              GROUP by  FROM_UNIXTIME(accident_date,'%m'),s_mgt_rpt_riddor_event_clf";
$result    = $DB->get_records_sql($sql);


$fatalities             = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
$over_7_day_incapacity  = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
$non_fatal_accidents_to_non_workers = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
$occupational_disease   = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
$dangerous_occurrence   = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
$gas_incidents          = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);

if(!empty($result)){
    foreach ($result as $data) {
        if ($data->ridder_event == 16) $fatalities[$data->month]            = $data->total;
        if ($data->ridder_event == 18) $over_7_day_incapacity[$data->month] = $data->total;
        if ($data->ridder_event == 19) $non_fatal_accidents_to_non_workers[$data->month] = $data->total;
        if ($data->ridder_event == 20) $occupational_disease[$data->month] = $data->total;
        if ($data->ridder_event == 21) $dangerous_occurrence[$data->month] = $data->total;
        if ($data->ridder_event == 22) $gas_incidents[$data->month]        = $data->total;

    }

}


$sql       = "SELECT concat(RIDDOR_subcategory,'_',FROM_UNIXTIME(accident_date,'%c')-1) as rowid,COUNT(id) as total ,FROM_UNIXTIME(accident_date,'%c')-1 as month , riddor_subcategory
              FROM      mdl_accident_report 
              WHERE     FROM_UNIXTIME(accident_date,'%Y')=".$cur_year." 
              GROUP by  FROM_UNIXTIME(accident_date,'%m'),RIDDOR_subcategory";
$result    = $DB->get_records_sql($sql);


$fractures                = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
$amputation               = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
$permanent_loss_reduction_of_sight         = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
$crush_to_head_or_torso   = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
$scalping                 = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
$injury_from_working_in_an_enclosed_space  = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
$burn_injury              = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);
$loss_consciousness       = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,7=>0,8=>0,9=>0,10=>0,11=>0);

if(!empty($result)){
    foreach ($result as $data) {
        if ($data->riddor_subcategory == 94) $fractures[$data->month]              = $data->total;
        if ($data->riddor_subcategory == 95) $amputation[$data->month]             = $data->total;
        if ($data->riddor_subcategory == 96) $permanent_loss_reduction_of_sight[$data->month] = $data->total;
        if ($data->riddor_subcategory == 97) $crush_to_head_or_torso[$data->month] = $data->total;
        if ($data->riddor_subcategory == 97) $crush_to_head_or_torso[$data->month] = $data->total;
        if ($data->riddor_subcategory == 98) $burn_injury[$data->month] = $data->total;
        if ($data->riddor_subcategory == 99) $scalping[$data->month]               = $data->total;
        if ($data->riddor_subcategory == 100) $loss_consciousness[$data->month]               = $data->total;
        if ($data->riddor_subcategory == 101) $injury_from_working_in_an_enclosed_space[$data->month] = $data->total;

    }

}

echo html_writer:: start_tag('div',array('class'=>'card'));
echo html_writer:: tag('h5',get_string('riddor_by_event_classification', 'local_trend_analysis_report').' ('.$cur_year.')',array('class'=>'card-header'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 400px;','id'=>'container5'));
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
            text: '<?=get_string('overview_by_category', 'local_trend_analysis_report')?>'
        },
        subtitle: {
            text: '<?=$cur_year?>'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ],
            crosshair: true,
//            labels: {
//                rotation: -45
//            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Integer'
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
            name: 'Accidents',
            data: [<?=implode(",", $accidents)?>]
        }, {
            name: 'Incidents',
            data: [<?=implode(",", $incidents)?>]
        }, {
            name: 'Near Misses',
            data: [<?=implode(",", $near_misses)?>]
        }, {
            name: 'Hazards',
            data: [<?=implode(",", $hazards)?>]
        }]
    });

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: '<?=get_string('hazard_by_classification', 'local_trend_analysis_report')?>'
        },
        subtitle: {
            text: '<?=$cur_year?>'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ],
            crosshair: true,
//            labels: {
//                rotation: -45
//            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Integer'
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
                borderWidth: 0
            }
        },
        series: [{
            color: '#FF00FF',
            name: 'Access Restriction',
            data: [<?=implode(",", $access_restriction)?>]
        }, {
            color: '#808080',
            name: 'Animals',
            data: [<?=implode(",", $animals)?>]
        }, {
            color: '#000000',
            name: 'Asset Issues',
            data: [<?=implode(",", $asset_issues)?>]
        }, {
            color: '#FF0000',
            name: 'Equipment Issues',
            data: [<?=implode(",", $equipment_issues)?>]
        }, {
            color: '#800000',
            name: 'Gas Detection',
            data: [<?=implode(",", $gas_detection)?>]
        }, {
            color: '#FFFF00',
            name: 'Manhole Covers/Frame Issue',
            data: [<?=implode(",", $manhole_covers_frame_issue)?>]
        }, {
            color: '#808000',
            name: 'Needles/Glass',
            data: [<?=implode(",", $needles_glass)?>]
        }, {
            color: '#00FF00',
            name: 'Other',
            data: [<?=implode(",", $other)?>]
        }, {
            color: '#008000',
            name: 'Slips, Trips and Falls',
            data: [<?=implode(",", $slips_trips_falls)?>]
        }, {
            color: '#00FFFF',
            name: 'Traffic/Vehicle',
            data: [<?=implode(",", $traffic_vehicle)?>]
        }, {
            color: '#008080',
            name: 'Vegetation',
            data: [<?=implode(",", $vegetation)?>]
        }, {
            color: '#CBBEB5',
            name: 'TBC',
            data: [<?=implode(",", $tbc)?>]
        }]
    });

    Highcharts.chart('container3', {
        chart: {
            type: 'column'
        },
        title: {
            text: '<?=get_string('near_misses_by_classification', 'local_trend_analysis_report')?>'
        },
        subtitle: {
            text: '<?=$cur_year?>'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ],
            crosshair: true,
//            labels: {
//                rotation: -45
//            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Integer'
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
                borderWidth: 0
            }
        },
        series: [{
            color: '#FF00FF',
            name: 'Access Restriction',
            data: [<?=implode(",", $access_restriction2)?>]
        }, {
            color: '#808080',
            name: 'Animals',
            data: [<?=implode(",", $animals2)?>]
        }, {
            color: '#000000',
            name: 'Asset Issues',
            data: [<?=implode(",", $asset_issues2)?>]
        }, {
            color: '#FF0000',
            name: 'Equipment Issues',
            data: [<?=implode(",", $equipment_issues2)?>]
        }, {
            color: '#800000',
            name: 'Gas Detection',
            data: [<?=implode(",", $gas_detection2)?>]
        }, {
            color: '#FFFF00',
            name: 'Manhole Covers/Frame Issue',
            data: [<?=implode(",", $manhole_covers_frame_issue2)?>]
        }, {
            color: '#808000',
            name: 'Needles/Glass',
            data: [<?=implode(",", $needles_glass2)?>]
        }, {
            color: '#00FF00',
            name: 'Other',
            data: [<?=implode(",", $other2)?>]
        }, {
            color: '#008000',
            name: 'Slips, Trips and Falls',
            data: [<?=implode(",", $slips_trips_falls2)?>]
        }, {
            color: '#00FFFF',
            name: 'Traffic/Vehicle',
            data: [<?=implode(",", $traffic_vehicle2)?>]
        }, {
            color: '#008080',
            name: 'Vegetation',
            data: [<?=implode(",", $vegetation2)?>]
        }, {
            color: '#CBBEB5',
            name: 'TBC',
            data: [<?=implode(",", $tbc2)?>]
        }]
    });

    Highcharts.chart('container4', {
        chart: {
            type: 'column'
        },
        title: {
            text: '<?= get_string('accidents_by_category', 'local_trend_analysis_report')?>'
        },
        subtitle: {
            text: '<?=$cur_year?>'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Integer'
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
                borderWidth: 0
            }
        },
        series: [{
            name: 'Any vehicle or associated equipment / machinery', //BM changed
            data: [<?=implode(",", $any_vehicle_associated_equipment_machinery)?>] // BM changed
        },{
            name: 'Building services – not electrical', //BM changed
            data: [<?=implode(",", $building_services_not_electrical)?>] //BM changed
        },{
            name: 'Building, structure or excavation / underground working',
            data: [<?=implode(",", $building_structure_excavation_underground_working)?>]
        },{
            name: 'Carcinogen',
            data: [<?=implode(",", $carcinogen)?>]
        },{
            name: 'Construction, shuttering or false work',
            data: [<?=implode(",", $Construction_shuttering_false_work)?>]
        },{
            name: 'Entertainment, sporting facilities or equipment',
            data: [<?=implode(",", $entertainment_sporting_facilities_equipment)?>]
        },{
            name: 'Floor, ground, stairs or any work surface',
            data: [<?=implode(",", $floor_ground_stairs_any_work_surface)?>]
        }]
    });

    Highcharts.chart('container5', {
        chart: {
            type: 'column'
        },
        title: {
            text: '<?= get_string('riddor_by_event_classification', 'local_trend_analysis_report')?>'
        },
        subtitle: {
            text: '<?=$cur_year?>'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Integer'
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
                borderWidth: 0
            }
        },
        series: [{
            color: '#FF00FF',
            name: 'Fatalities',
            data: [<?=implode(",", $fatalities)?>]
        },{
            color: '#808080',
            name: 'Over 7 Day Incapacity',
            data: [<?=implode(",", $over_7_day_incapacity)?>]
        },{
            color: '#000000',
            name: 'Non Fatal Accidents to non workers',
            data: [<?=implode(",", $non_fatal_accidents_to_non_workers)?>]
        },{
            color: '#FF0000',
            name: 'Occupational Disease',
            data: [<?=implode(",", $occupational_disease)?>]
        },{
            color: '#800000',
            name: 'Dangerous Occurrence',
            data: [<?=implode(",", $dangerous_occurrence)?>]
        },{
            color: '#FFFF00',
            name: 'Gas Incidents',
            data: [<?=implode(",", $gas_incidents)?>]
        },{
            color: '#808000',
            name: 'Fractures',
            data: [<?=implode(",", $fractures)?>]
        },{
            color: '#00FF00',
            name: 'Amputation',
            data: [<?=implode(",", $amputation)?>]
        },{
            color: '#008000',
            name: 'Permanent loss/reduction of sight',
            data: [<?=implode(",", $permanent_loss_reduction_of_sight)?>]
        },{
            color: '#00FFFF',
            name: 'Crush to head or torso',
            data: [<?=implode(",", $crush_to_head_or_torso)?>]
        },{
            color: '#008080',
            name: 'Burn injury',
            data: [<?=implode(",", $burn_injury)?>]
        },{
            color: '#C0C0C0',
            name: 'Scalping',
            data: [<?=implode(",", $scalping)?>]
        },{
            color: '#0000FF',
            name: 'Loss of consciousness',
            data: [<?=implode(",", $loss_consciousness)?>]
        },{
            color: '#000080',
            name: 'Injury from working in an enclosed space',
            data: [<?=implode(",", $injury_from_working_in_an_enclosed_space)?>]
        }]
    });
</script>
