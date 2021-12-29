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

$homeurl    = new moodle_url('/local/accident_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    echo ("You are not authorized to view this page");
}

define('PREFERRED_RENDERER_TARGET', RENDERER_TARGET_GENERAL);

global $USER, $CFG,$DB;

$cur_time = '';
$query_con_str =" 1=1 ";
$query_con_str2 =" 1=1 ";
$query_con_str3 =" 1=1 "; /* BM added */
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

/* BM added */
$query_con_str3 .= " AND (b_date BETWEEN $date_from AND $date_to) ";
$sql = " SELECT d_agents FROM `mdl_new_accident_report` WHERE $query_con_str3 ";
$agentsIdArray = $DB->get_records_sql($sql);
foreach ($agentsIdArray as $d_agents => $record) {
    $agents[] = $record->d_agents;
}
$agents_comma_separated = implode(',', $agents);
echo $agents_comma_separated;
/* EOF BM */

$sql = " SELECT COUNT(id) AS total_hazard FROM mdl_incident_report WHERE $query_con_str AND  (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=30 ELSE  correct_report_category=30 END) ";
$total_hazard = $DB->count_records_sql($sql);

$sql = " SELECT COUNT(id) AS total_near_miss FROM mdl_incident_report WHERE $query_con_str  AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=29 ELSE  correct_report_category=29 END) ";
$total_near_miss = $DB->count_records_sql($sql);

$sql = " SELECT COUNT(id) AS total_medical_treatment_over_first_aid FROM mdl_new_accident_report WHERE $query_con_str3 AND d_first_aid='Yes'"; /* BM added */
$total_medical_treatment_over_first_aid = $DB->count_records_sql($sql); /* BM added */

$sql = " SELECT COUNT(id) AS total_resumed_work FROM mdl_new_accident_report WHERE $query_con_str3 AND a_resumed_work='Yes'"; /* BM added */
$total_resumed_work = $DB->count_records_sql($sql); /* BM added */

$sql = " SELECT COUNT(id) AS total_incidents FROM mdl_incident_report WHERE $query_con_str AND (CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  THEN report_category=31 ELSE  correct_report_category=31 END) ";
$total_incidents = $DB->count_records_sql($sql);

$sql_hours = " SELECT COALESCE(SUM(a_hours), 0) AS accident_total_lost_time_hours FROM mdl_new_accident_report WHERE $query_con_str3 "; /* BM added */
$sql_mins = " SELECT COALESCE(SUM(a_mins), 0) AS accident_total_lost_time_mins FROM mdl_new_accident_report WHERE $query_con_str3 "; /* BM added */

$hours = $DB->get_record_sql($sql_hours); /* BM added */
$mins = $DB->get_record_sql($sql_mins); /* BM added */

$total_lost_time_hours = round($hours->accident_total_lost_time_hours + $mins->accident_total_lost_time_mins/60, 0); /* BM added */

$sql = " SELECT COALESCE(SUM(lost_time_days), 0) AS incident_total_lost_time_days FROM mdl_incident_report WHERE $query_con_str AND lost_time='Yes' "; /* BM added */
$incident_lost_days = $DB->get_record_sql($sql);
$total_lost_time_days_incidents = $incident_lost_days->incident_total_lost_time_days; /* BM added */

$sql = " SELECT COUNT(id) AS total_accidents FROM mdl_new_accident_report WHERE $query_con_str3 "; /* BM added */
$total_accidents = $DB->count_records_sql($sql); /* BM added */

$category = [$total_hazard,$total_near_miss,$total_medical_treatment_over_first_aid,$total_resumed_work,$total_incidents,$total_lost_time_days_incidents,$total_accidents,$total_lost_time_hours]; /* BM added */

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

/* BM added */
$total_machinery_equipment_lift_conveying = substr_count($agents_comma_separated, 1);
$total_building_services_not_electrical = substr_count($agents_comma_separated, 2);
$total_building_structure_excavation_underground_working = substr_count($agents_comma_separated, 3);
$total_carcinogen = substr_count($agents_comma_separated, 4);
$total_construction_shuttering_false_work = substr_count($agents_comma_separated, 5);
$total_entertainment_sporting_facilities_equipment = substr_count($agents_comma_separated, 6);
$total_floor_ground_stairs_any_work_surface = substr_count($agents_comma_separated, 7);
$total_gas_vapour_dust_fume_oxygen_deficient_atmosphere = substr_count($agents_comma_separated, 8);
$total_inclement_weather_conditions = substr_count($agents_comma_separated, 9);
$total_ladder_stepladder_scaffolding = substr_count($agents_comma_separated, 10);
$total_live_animal = substr_count($agents_comma_separated, 11);
$total_machinery_Equipment_lifting_conveying = substr_count($agents_comma_separated, 12);
$total_material_substance_product_being_handled_used_stored = substr_count($agents_comma_separated, 13);
$total_other_machinery = substr_count($agents_comma_separated, 14);
$total_pathogen_infected_material = substr_count($agents_comma_separated, 15);
$total_portable_power_hand_too = substr_count($agents_comma_separated, 16);
$total_process_plant_pipework_bulk_storage = substr_count($agents_comma_separated, 17);

$accidents = [
    $total_machinery_equipment_lift_conveying,
    $total_building_services_not_electrical,
    $total_building_structure_excavation_underground_working,
    $total_carcinogen,
    $total_construction_shuttering_false_work,
    $total_entertainment_sporting_facilities_equipment,
    $total_floor_ground_stairs_any_work_surface,
    $total_gas_vapour_dust_fume_oxygen_deficient_atmosphere,
    $total_inclement_weather_conditions,
    $total_ladder_stepladder_scaffolding,
    $total_live_animal,
    $total_machinery_Equipment_lifting_conveying,
    $total_material_substance_product_being_handled_used_stored,
    $total_other_machinery,
    $total_pathogen_infected_material,
    $total_portable_power_hand_too,
    $total_process_plant_pipework_bulk_storage
];
/* BM added */

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
                'Medical Treatment over first aid',
                'Resumed Work', /* BM added */
                'Incidents',
                'Total lost days for Incidents', /* BM added */
                'Total Accidents', /* BM added */
                'Total lost hours for Accidents' /* BM added */
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
                'Any vehicle or associated equipment / machinery', /* BM added */
                'Building services – not electrical', /* BM added */
                'Building, structure or excavation / underground working', /* BM added */
                'Carcinogen', /* BM added */
                'Construction, shuttering or false work', /* BM added */
                'Entertainment, sporting facilities or equipment', /* BM added */
                'Floor, ground, stairs or any work surface', /* BM added */
                'Gas, vapour, dust, fume or oxygen deficient atmosphere', /* BM added */
                'Inclement weather conditions', /* BM added */
                'Ladder, stepladder or scaffolding', /* BM added */
                'Live animal', /* BM added */
                'Machinery / Equipment for lifting and conveying', /* BM added */
                'Material, substance or product being handled, used or stored', /* BM added */
                'Other machinery', /* BM added */
                'Pathogen or infected material', /* BM added */
                'Portable power / hand too', /* BM added */
                'Process plant, pipework or bulk storage' /* BM added */
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
