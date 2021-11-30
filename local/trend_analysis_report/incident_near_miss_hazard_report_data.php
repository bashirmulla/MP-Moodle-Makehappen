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

define('PREFERRED_RENDERER_TARGET', RENDERER_TARGET_GENERAL);
require_login();

$homeurl    = new moodle_url('/local/accident_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    echo ("You are not authorized to view this page");
}

global $USER, $CFG,$DB;

$tableName  = get_string('incident_table','local_trend_analysis_report');

$query_con_str =" 1=1 ";
$filterData = get_requests();
$params = array();

$toDateArr   = $filterData['date_to'];
$fromDateArr = $filterData['date_from'];

$toStr     = $toDateArr['year'].'-'.$toDateArr['month'].'-'.$toDateArr['day'].' 23:59:59';
$formStr   = $fromDateArr['year'].'-'.$fromDateArr['month'].'-'.$fromDateArr['day'].' 00:00:00';
$date_to   = strtotime($toStr);
$date_form = strtotime($formStr);

//echo date("Y-m-d H:i:s",$toDateArr['year'].'-'.$toDateArr['month'].'-',$toDateArr['day'].' 00:00:00');

$query_con_str .= " AND (i_date BETWEEN $date_form  AND $date_to) ";

if ($filterData['report_number']){
    $params['id']   = $filterData['report_number'];
    $query_con_str .= " AND id=? ";
}
if ($filterData['manager']){
    $params['manager']   = $filterData['manager'];
    $query_con_str .= " AND manager=? ";
}
if ($filterData['submitter']){
    $params['user_id']   = $filterData['submitter'];
    $query_con_str      .= " AND user_id=? ";
}
if ($filterData['contract']){
    $params['contact']   = $filterData['contract'];
    $query_con_str      .= " AND contact=? ";
}
if ($filterData['status']){
    if ($filterData['status']=="New") $query_con_str .= " AND (report_closed IS NULL OR report_closed='') ";
    else if ($filterData['status']=="Open") $query_con_str .= " AND   report_closed='No' ";
    else if ($filterData['status']=="Closed") $query_con_str .= " AND report_closed='Yes' ";
}
if ($filterData['category']){
    $params['report_category']           = $filterData['category'];
    $params['correct_report_category']   = $filterData['category'];
    $query_con_str .= " AND ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL THEN report_category=? ELSE  correct_report_category=? END) ";
}
if ($filterData['classification']){
    $params['classification']   = $filterData['classification'];
    $query_con_str .= " AND classification=? ";
}
if ($filterData['categorisation']){
    $params['categorisation']   = $filterData['categorisation'];
    $query_con_str .= " AND categorisation=? ";
}
if (!empty($filterData['report_to_client'])){
    if ($filterData['report_to_client']=="Yes") $query_con_str .= " AND report_to_client='56' ";
    else if ($filterData['report_to_client']=="No") $query_con_str .= " AND report_to_client='57' ";
    else if ($filterData['report_to_client']=="N/A") $query_con_str .= " AND report_to_client IS NULL ";
}

if(is_manager() || is_admin()) $submitter_to_manager = 'Yes';
else                           $submitter_to_manager = 'No';

$query_con_str .= " AND submitter_to_manager='$submitter_to_manager' ";

$_SESSION["incident_near_miss_hazard_report_csv"]["where"]  = serialize($query_con_str);
$_SESSION["incident_near_miss_hazard_report_csv"]["params"] = serialize($params);
$sql = " SELECT * FROM mdl_$tableName WHERE $query_con_str ";

$result = $DB->get_records_sql($sql,$params);



$html   = "";

if(count($result)>0){
    $html   .= html_writer:: start_tag('div',array('class'=>'form-row'));
    $html   .= html_writer:: div('','col-md-9 form-group-ele');
    $html   .= html_writer:: start_tag('div',array('class'=>'form-group col-md-3 form-group-ele','style'=>'text-align:right;'));
    $html   .= html_writer:: tag('button','<i class="fa fa-download"></i> &nbsp;&nbsp;Download CSV',array('type'=>'button','id'=>'dwn_incident_near_miss_hazard_report_csv','class'=>'btn btn-primary','style' =>"margin-right:10px"));
    $html   .= html_writer:: end_tag('div');
    $html   .= html_writer:: end_tag('div');
}

$html   .= html_writer:: start_tag('div',array('class'=>'table-responsive'));

$table = new html_table();
$table->attributes['class'] = 'generaltable list-incident';
$table->width = '100%';


$table->head  = array("Date of Incident","Report Number","Manager","Submitter","Status","Contract","Category","Classification","Categorisation","Report client?","Action");
$table->align = array( 'left','left','left','left','left','left','left','left','left','left');
$table->size  = array( '20%','20%','20%','20%',"20%","20%","20%","20%","20%","20%");

$count=0;
$managerList  = get_all_manager_list();
$contract_list = get_dropdown_data(2,'contract');
$report_category_list = get_dropdown_data(2,'report_category');
$classification_list = get_dropdown_data(2,'classification');
$categorisation_list = get_dropdown_data(2,'categorisation');
//echo "<pre>";
//print_r($contract_list['contract'][87]);
//die;
foreach($result as $rec) {
    $submitterObj = get_userInfo(array("id" => $rec->user_id));
    $submitter = $submitterObj->firstname.' '.$submitterObj->lastname;
    $manager = $managerList[$rec->manager];
    $category_id    = $rec->is_correct_report_category=='No' ?   $rec->correct_report_category : $rec->report_category;

    $status = '';
    if (($rec->report_closed==NULL) || ($rec->report_closed=='')) $status="New";
    else if (($rec->report_closed=='No')) $status = "Open";
    else if ($rec->report_closed=='Yes') $status = "Closed";

    $report_to_client = '';
    if ($rec->report_to_client=='56') $report_to_client='Yes';
    else if ($rec->report_to_client=='57') $report_to_client='No';
    else $report_to_client='N/A';

    $report_url = new moodle_url($CFG->wwwroot.'/local/accident_report/index.php?cmd=inc_edit&id='.$rec->id);
    $link = "<a target='new' href='".$report_url."'>View</a>";

    $table->data[] = new html_table_row(array( date("d/m/Y",$rec->i_date),$rec->id,$manager,$submitter,$status,@$contract_list['contract'][$rec->contact],@$report_category_list['report_category'][$category_id],$classification_list['classification'][$rec->classification],$categorisation_list['categorisation'][$rec->categorisation],$report_to_client,$link));
}
$html .= html_writer::table($table);
$html .= html_writer:: end_tag('div');
$html .= "<hr></br>";


echo json_encode($html);
die;
