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
global $USER, $CFG,$DB;
define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/trend_analysis_report/locallib.php');  // Include our function library.
require_login();

$homeurl    = new moodle_url('/local/mp_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    echo ("You are not authorized to view this page");
}

define('PREFERRED_RENDERER_TARGET', RENDERER_TARGET_GENERAL);

global $USER, $CFG,$DB;

$cur_time = '';
$query_con_str =" 1=1 ";
$query_con_str2 =" 1=1 ";
$filterData = get_requests();
if(empty($filterData['date_btn'])){

    $toDateArr   = $filterData['date_to'];
    $fromDateArr = $filterData['date_from'];

    $date_from = strtotime(implode("-", $filterData['date_from']).' 00:00:00');
    $date_to = strtotime(implode("-", $filterData['date_to']).' 23:59:59');
    $cur_time = date('d M Y', $date_from).' to '.date('d M Y', $date_to);
}else{
    if($filterData['date_btn']=='last_month'){
        $year = date("Y");
        $last_month = date("m")-1;
        $date_from = strtotime($year.'-'.$last_month.'-01 00:00:00');
        $date_to   = strtotime(date('Y-m-d',strtotime("last day of previous month")).' 23:59:59');
        $cur_time  = date('d M Y', $date_from).' to '.date('d M Y', $date_to);

    }elseif ($filterData['date_btn']=='this_month'){
        $date_from = strtotime(date('Y-m-01 00:00:00'));
        $date_to   = strtotime(date('Y-m-d 23:59:59'));
        $cur_time  = date('d M Y', $date_from).' to '.date('d M Y', $date_to);

    }elseif ($filterData['date_btn']=='this_year'){
        $date_from = strtotime(date('Y-01-01 00:00:00'));
        $date_to   = strtotime(date('Y-m-d 23:59:59'));
        $cur_time  = date('d M Y', $date_from).' to '.date('d M Y', $date_to);

    }else{
        $date_from = '';
        $date_to   = '';
    }
}

$query_con_str .= " AND (i_date BETWEEN $date_from AND $date_to) ";
$query_con_str2 .= " AND (accident_date BETWEEN $date_from AND $date_to) ";

$sql = " SELECT COUNT(id) AS total_hazard FROM mdl_incident_report WHERE $query_con_str AND  (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=30 ELSE  correct_report_category=30 END) ";
$total_hazard = $DB->count_records_sql($sql);

$sql = " SELECT COUNT(id) AS total_near_miss FROM mdl_incident_report WHERE $query_con_str  AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=29 ELSE  correct_report_category=29 END) ";
$total_near_miss = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_riddor_report FROM mdl_accident_report WHERE $query_con_str2 AND s_mgt_rpt_2508_completed='1' ";
$total_riddor_report = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_medical_treatment_over_first_aid FROM mdl_accident_report WHERE $query_con_str2 AND accident_treatment='Yes' AND (s_mgt_rpt_2508_completed IS NULL OR s_mgt_rpt_2508_completed IN(2,3))";
$total_medical_treatment_over_first_aid = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_minor_injuries FROM mdl_accident_report WHERE $query_con_str2 AND minor_injuries='Yes' AND accident_treatment='No' AND (s_mgt_rpt_2508_completed IS NULL OR s_mgt_rpt_2508_completed IN(2,3))";
$total_minor_injuries = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_incidents FROM mdl_incident_report WHERE $query_con_str AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_incidents = $DB->count_records_sql($sql);
$sql1 = " SELECT COALESCE(SUM(lost_time_days), 0) AS accident_total_lost_time_days FROM mdl_accident_report WHERE $query_con_str2 AND lost_time='Yes' ";
$sql2 = " SELECT COALESCE(SUM(lost_time_days), 0) AS incident_total_lost_time_days FROM mdl_incident_report WHERE $query_con_str AND lost_time='Yes' ";

$rec1 = $DB->get_record_sql($sql1);
$rec2 = $DB->get_record_sql($sql2);
$total_lost_time_days = $rec1->accident_total_lost_time_days + $rec2->incident_total_lost_time_days;

$category = [$total_hazard,$total_near_miss,$total_riddor_report,$total_medical_treatment_over_first_aid,$total_minor_injuries,$total_incidents,$total_lost_time_days];

echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: tag('h5',get_string('accident_incident_performance', 'local_trend_analysis_report').' ('.$cur_time.')',array('class'=>'card-header'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 400px;','id'=>'container1'));
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');

$sql = " SELECT COUNT(id) AS total_access_restriction FROM mdl_incident_report WHERE $query_con_str AND classification=32 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=30 ELSE  correct_report_category=30 END) ";
$total_access_restriction  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_animals FROM mdl_incident_report WHERE $query_con_str AND classification=33 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=30 ELSE  correct_report_category=30 END) ";
$total_animals  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_asset_issues FROM mdl_incident_report WHERE $query_con_str AND classification=34 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=30 ELSE  correct_report_category=30 END) ";
$total_asset_issues  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_equipment_issues FROM mdl_incident_report WHERE $query_con_str AND classification=35 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=30 ELSE  correct_report_category=30 END) ";
$total_equipment_issues  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_gas_detection FROM mdl_incident_report WHERE $query_con_str AND classification=36 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=30 ELSE  correct_report_category=30 END) ";
$total_gas_detection  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_manhole_covers_frame_issue FROM mdl_incident_report WHERE $query_con_str AND classification=37 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=30 ELSE  correct_report_category=30 END) ";
$total_manhole_covers_frame_issue  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_needles_glass FROM mdl_incident_report WHERE $query_con_str AND classification=38 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=30 ELSE  correct_report_category=30 END) ";
$total_needles_glass  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_other FROM mdl_incident_report WHERE $query_con_str AND classification=39 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=30 ELSE  correct_report_category=30 END) ";
$total_other  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_slips_trips_falls FROM mdl_incident_report WHERE $query_con_str AND classification=40 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=30 ELSE  correct_report_category=30 END) ";
$total_slips_trips_falls  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_traffic_vehicle FROM mdl_incident_report WHERE $query_con_str AND classification=41 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=30 ELSE  correct_report_category=30 END) ";
$total_traffic_vehicle  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_vegetation FROM mdl_incident_report WHERE $query_con_str AND classification=42 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=30 ELSE  correct_report_category=30 END) ";
$total_vegetation  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_tbc FROM mdl_incident_report WHERE $query_con_str AND report_category=30 AND is_correct_report_category IS NULL";
$total_tbc  = $DB->count_records_sql($sql);
$hazard_dentification = [$total_access_restriction,$total_animals,$total_asset_issues,$total_equipment_issues,$total_gas_detection,$total_manhole_covers_frame_issue,$total_needles_glass,$total_other,$total_slips_trips_falls,$total_traffic_vehicle,$total_vegetation,$total_tbc];

$sql = " SELECT COUNT(id) AS total_access_restriction FROM mdl_incident_report WHERE $query_con_str AND classification=32 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=29 ELSE  correct_report_category=29 END) ";
$total_access_restriction  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_animals FROM mdl_incident_report WHERE $query_con_str AND classification=33 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=29 ELSE  correct_report_category=29 END) ";
$total_animals  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_asset_issues FROM mdl_incident_report WHERE $query_con_str AND classification=34 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=29 ELSE  correct_report_category=29 END) ";
$total_asset_issues  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_equipment_issues FROM mdl_incident_report WHERE $query_con_str AND classification=35 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=29 ELSE  correct_report_category=29 END) ";
$total_equipment_issues  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_gas_detection FROM mdl_incident_report WHERE $query_con_str AND classification=36 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=29 ELSE  correct_report_category=29 END) ";
$total_gas_detection  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_manhole_covers_frame_issue FROM mdl_incident_report WHERE $query_con_str AND classification=37 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=29 ELSE  correct_report_category=29 END) ";
$total_manhole_covers_frame_issue  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_needles_glass FROM mdl_incident_report WHERE $query_con_str AND classification=38 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=29 ELSE  correct_report_category=29 END) ";
$total_needles_glass  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_other FROM mdl_incident_report WHERE $query_con_str AND classification=39 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=29 ELSE  correct_report_category=29 END) ";
$total_other  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_slips_trips_falls FROM mdl_incident_report WHERE $query_con_str AND classification=40 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=29 ELSE  correct_report_category=29 END) ";
$total_slips_trips_falls  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_traffic_vehicle FROM mdl_incident_report WHERE $query_con_str AND classification=41 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=29 ELSE  correct_report_category=29 END) ";
$total_traffic_vehicle  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_vegetation FROM mdl_incident_report WHERE $query_con_str AND classification=42 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=29 ELSE  correct_report_category=29 END) ";
$total_vegetation  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_tbc FROM mdl_incident_report WHERE $query_con_str AND report_category=29 AND is_correct_report_category IS NULL";
$total_tbc  = $DB->count_records_sql($sql);

$near_misses = [$total_access_restriction,$total_animals,$total_asset_issues,$total_equipment_issues,$total_gas_detection,$total_manhole_covers_frame_issue,$total_needles_glass,$total_other,$total_slips_trips_falls,$total_traffic_vehicle,$total_vegetation,$total_tbc];
echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: tag('h5',get_string('hazard_identification_near_misses_by_classification', 'local_trend_analysis_report').' ('.$cur_time.')',array('class'=>'card-header'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 400px;','id'=>'container2'));
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');

$sql = " SELECT COUNT(id) AS total_act_of_physical_violence FROM mdl_accident_report WHERE $query_con_str2 AND accident_category=74 ";
$total_act_of_physical_violence = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_cuts_and_lacerations FROM mdl_accident_report WHERE $query_con_str2 AND accident_category=75 ";
$total_cuts_and_lacerations = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_falls_from_height FROM mdl_accident_report WHERE $query_con_str2 AND accident_category=76 ";
$total_falls_from_height = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_manual_handling FROM mdl_accident_report WHERE $query_con_str2 AND accident_category=77 ";
$total_manual_handling = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_needlestick_injuries FROM mdl_accident_report WHERE $query_con_str2 AND accident_category=78 ";
$total_needlestick_injuries = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_slips_trips_and_falls_on_same_level FROM mdl_accident_report WHERE $query_con_str2 AND accident_category=79 ";
$total_slips_trips_and_falls_on_same_level = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_struck_by_an_object FROM mdl_accident_report WHERE $query_con_str2 AND accident_category=80 ";
$total_total_struck_by_an_object = $DB->count_records_sql($sql);
$accidents = [$total_act_of_physical_violence,$total_cuts_and_lacerations,$total_falls_from_height,$total_manual_handling,$total_needlestick_injuries,$total_slips_trips_and_falls_on_same_level,$total_total_struck_by_an_object];
echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: tag('h5',get_string('accidents_by_category', 'local_trend_analysis_report').' ('.$cur_time.')',array('class'=>'card-header'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 400px;','id'=>'container3'));
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');

$sql = " SELECT COUNT(id) AS total_vehicle FROM mdl_incident_report WHERE $query_con_str AND categorisation=43 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_vehicle  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_equipment FROM mdl_incident_report WHERE $query_con_str AND categorisation=44 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_equipment  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_environmental FROM mdl_incident_report WHERE $query_con_str AND categorisation=45 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_environmental  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_attack FROM mdl_incident_report WHERE $query_con_str AND categorisation=46 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_attack  = $DB->count_records_sql($sql);

$sql = " SELECT COUNT(id) AS total_customer_complaint FROM mdl_incident_report WHERE $query_con_str AND categorisation=133 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_customer_complaint  = $DB->count_records_sql($sql);


$sql = " SELECT COUNT(id) AS total_other FROM mdl_incident_report WHERE $query_con_str AND categorisation=47 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_other  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_tbc FROM mdl_incident_report WHERE $query_con_str AND report_category=31 AND is_correct_report_category IS NULL";
$total_tbc  = $DB->count_records_sql($sql);
$incidents = [$total_vehicle,$total_equipment,$total_environmental,$total_attack,$total_other,$total_customer_complaint,$total_tbc];
echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: tag('h5',get_string('incidents_by_category', 'local_trend_analysis_report').' ('.$cur_time.')',array('class'=>'card-header'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 400px;','id'=>'container4'));
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');

$sql = " SELECT COUNT(id) AS total_collision FROM mdl_incident_report WHERE $query_con_str AND vehicles=59 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_collision  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_near_miss FROM mdl_incident_report WHERE $query_con_str AND vehicles=60 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_near_miss  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_theft FROM mdl_incident_report WHERE $query_con_str AND vehicles=61 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_theft  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_vandalism FROM mdl_incident_report WHERE $query_con_str AND vehicles=62 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_vandalism  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_general_damage FROM mdl_incident_report WHERE $query_con_str AND vehicles=63 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_general_damage  = $DB->count_records_sql($sql);

$sql = " SELECT COUNT(id) AS total_loss FROM mdl_incident_report WHERE $query_con_str AND equipment=64 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_loss  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_theft FROM mdl_incident_report WHERE $query_con_str AND equipment=65 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_theft2  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_wear_and_tear FROM mdl_incident_report WHERE $query_con_str AND equipment=66 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_wear_and_tear  = $DB->count_records_sql($sql);

$sql = " SELECT COUNT(id) AS total_adverse_weather FROM mdl_incident_report WHERE $query_con_str AND environmental=67 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_adverse_weather  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_flooding_internal FROM mdl_incident_report WHERE $query_con_str AND environmental=68 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_flooding_internal  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_flooding_external FROM mdl_incident_report WHERE $query_con_str AND environmental=69 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_flooding_external  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_contamination FROM mdl_incident_report WHERE $query_con_str AND environmental=70 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_contamination  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_fly_tipping FROM mdl_incident_report WHERE $query_con_str AND environmental=71 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_fly_tipping  = $DB->count_records_sql($sql);

$sql = " SELECT COUNT(id) AS total_abusive_verbal FROM mdl_incident_report WHERE $query_con_str AND attack=72 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_abusive_verbal  = $DB->count_records_sql($sql);

$sql = " SELECT COUNT(id) AS total_animal_attack FROM mdl_incident_report WHERE $query_con_str AND attack=73 AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_animal_attack  = $DB->count_records_sql($sql);
$sql = " SELECT COUNT(id) AS total_tbc FROM mdl_incident_report WHERE $query_con_str AND report_category=31 AND is_correct_report_category IS NULL";
$total_tbc  = $DB->count_records_sql($sql);
$incidents_sub = [$total_collision,$total_near_miss,$total_theft,$total_vandalism,$total_general_damage,$total_loss,$total_theft2,$total_wear_and_tear,$total_adverse_weather,$total_flooding_internal,$total_flooding_external,$total_contamination,$total_fly_tipping,$total_abusive_verbal,$total_animal_attack,$total_tbc];
echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: tag('h5',get_string('incidents_by_subcategory', 'local_trend_analysis_report').' ('.$cur_time.')',array('class'=>'card-header'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 400px;','id'=>'container5'));
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');
?>

<script type="text/javascript">
    Highcharts.chart('container1', {
        chart: {
            type: 'column'
        },
        title: {
            text: '<?= get_string('accident_incident_performance', 'local_trend_analysis_report')?>'
        },
        subtitle: {
            text: '<?=$cur_time?>'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [
                'Hazard identification',
                'Near Misses',
                'Number of Riddor reports',
                'Medical Treatment over first aid',
                'Minor Injuries',
                'Incidents',
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
            name: 'Category',
            data: [<?=implode(",", $category)?>]
        }]
    });

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: '<?= get_string('hazard_identification_near_misses_by_classification', 'local_trend_analysis_report')?>'
        },
        subtitle: {
            text: '<?=$cur_time?>'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [
                'Access Restriction',
                'Animals',
                'Asset Issues',
                'Equipment Issues',
                'Gas Detection',
                'Manhole Covers/Frame Issue',
                'Needles/Glass',
                'Other',
                'Slips Trips and Falls',
                'Traffic/Vehicle',
                'Vegetation',
                'TBC'
            ],
            crosshair: true,
            labels: {
                rotation: -45
            }
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
            name: 'Hazards',
            color: '#FF530D',
            data: [<?=implode(",", $hazard_dentification)?>]
        }, {
            name: 'Near Misses',
            color: '#ffdd43',
            data: [<?=implode(",", $near_misses)?>]
        }]
    });

    Highcharts.chart('container3', {
        chart: {
            type: 'column'
        },
        title: {
            text: '<?= get_string('accidents_by_category', 'local_trend_analysis_report')?>'
        },
        subtitle: {
            text: '<?=$cur_time?>'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [
                'Act of Physical Violence',
                'Cuts and Lacerations',
                'Falls from a Height',
                'Manual Handling',
                'Needlestick Injuries',
                'Slips, Trips and Falls on same level',
                'Struck by an Object'
            ],
            crosshair: true,
            labels: {
                rotation: -45
            }
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
        }]
    });

    Highcharts.chart('container4', {
        chart: {
            type: 'column'
        },
        title: {
            text: '<?= get_string('incidents_by_category', 'local_trend_analysis_report')?>'
        },
        subtitle: {
            text: '<?=$cur_time?>'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [
                'Vehicle',
                'Equipment',
                'Environmental',
                'Attack',
                'Other',
                'Customer Complaint',
                'TBC'
            ],
            crosshair: true,
            labels: {
                rotation: -45
            }
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
            name: 'Incidents',
            data: [<?=implode(",", $incidents)?>]
        }]
    });

    Highcharts.chart('container5', {
        chart: {
            type: 'column'
        },
        title: {
            text: '<?= get_string('incidents_by_subcategory', 'local_trend_analysis_report')?>'
        },
        subtitle: {
            text: '<?=$cur_time?>'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: [{
                name: "Vehicle",
                categories: ["Collision", "Near Miss", "Theft", "Vandalism", "General Damage"]
            }, {
                name: "Equipment",
                categories: ["Loss", "Theft", "Wear and Tear"]
            }, {
                name: "Environmental",
                categories: ["Adverse Weather", "Flooding (Internal)", "Flooding (external)", "Contamination", "Fly Tipping"]
            }, {
                name: "Attack",
                categories: ["Abusive/Verbal", "Animal Attack"]
            }, {
                name: "TBC",
                categories: ["TBC"]
            }],
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
            name: 'Incidents',
            data: [<?=implode(",", $incidents_sub)?>]
        }]
    });

</script>
