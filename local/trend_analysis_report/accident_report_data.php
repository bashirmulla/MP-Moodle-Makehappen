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

global $USER, $CFG,$DB;

$tableName  = get_string('accident_table','local_trend_analysis_report');

$query_con_str =" 1=1 ";
$filterData = get_requests();

require_login();
$homeurl    = new moodle_url('/local/mp_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    echo ("You are not authorized to view this page");
}
$params      = array();
$toDateArr   = $filterData['date_to'];
$fromDateArr = $filterData['date_from'];

$toStr     = $toDateArr['year'].'-'.$toDateArr['month'].'-'.$toDateArr['day'].' 23:59:59';
$formStr   = $fromDateArr['year'].'-'.$fromDateArr['month'].'-'.$fromDateArr['day'].' 00:00:00';
$date_to   = strtotime($toStr);
$date_from = strtotime($formStr);

$query_con_str .= " AND (accident_date BETWEEN $date_from AND $date_to) ";

if ($filterData['report_number']){
    $params['id']   = $filterData['report_number'];
    $query_con_str .= " AND id=? ";
}
if ($filterData['manager']){
    $params['user_manager']  = $filterData['manager'];
    $query_con_str          .= " AND user_manager=? ";
}
if ($filterData['submitter']){
    $params['user_id']  = $filterData['submitter'];
    $query_con_str     .= " AND user_id=?";
}
if ($filterData['contract']){
    $params['user_contract']  = $filterData['category'];
    $query_con_str           .= " AND user_contract=? ";
}
if ($filterData['status']){
    if ($filterData['status']=="New") $query_con_str .= " AND (s_mgt_rpt_ant_closed_off IS NULL OR s_mgt_rpt_ant_closed_off='') ";
    else if ($filterData['status']=="Open") $query_con_str .= " AND s_mgt_rpt_ant_closed_off='0' ";
    else if ($filterData['status']=="Closed") $query_con_str .= " AND s_mgt_rpt_ant_closed_off='1' ";
    else '';
}
if ($filterData['category']){
    $params['accident_category']  = $filterData['category'];
    $query_con_str .= " AND accident_category=? ";
}
if ($filterData['riddor_reportable']){
    if ($filterData['s_mgt_rpt_2508_completed']=="Yes") $query_con_str .= " AND s_mgt_rpt_2508_completed='1' ";
    else $query_con_str .= " AND s_mgt_rpt_2508_completed='2' ";
}
if ($filterData['riddor_event_classification']){

    $params['s_mgt_rpt_riddor_event_clf']  = $filterData['riddor_event_classification'];
    $query_con_str               .= " AND s_mgt_rpt_riddor_event_clf=? ";
}
if ($filterData['riddor_subcategory']){
    $params['RIDDOR_subcategory']  = $filterData['riddor_subcategory'];
    $query_con_str .= " AND RIDDOR_subcategory=? ";
}
if ($filterData['medical_treatment_over_firsaccident_treatmentt_aid']){
    $params['accident_treatment']  = $filterData['medical_treatment_over_first_aid'];
    $query_con_str .= " AND accident_treatment=? ";
}
if ($filterData['lost_days']){
    $params['lost_time']  = $filterData['lost_days'];
    $query_con_str .= " AND lost_time=? ";
}
if ($filterData['minor_injuries']){
    $params['minor_injuries']  = $filterData['minor_injuries'];
    $query_con_str       .= " AND minor_injuries=? ";
}

if(is_manager() || is_admin()) $submitter_to_manager = 'Yes';
else                           $submitter_to_manager = 'No';

$query_con_str .= " AND submitter_to_manager='$submitter_to_manager' ";

//echo "<pre>";
//print_r($query_con_str);
//die;
$_SESSION["accident_report_csv"]["where"]  = serialize($query_con_str);
$_SESSION["accident_report_csv"]["params"] = serialize($params);
$sql = " SELECT * FROM mdl_accident_report WHERE $query_con_str ";

//echo $sql;
//die;
$result = $DB->get_records_sql($sql,$params);

$html = '';
if(count($result)>0){
    $html   .= html_writer:: start_tag('div',array('class'=>'form-row'));
    $html   .= html_writer:: div('','col-md-9 form-group-ele');
    $html   .= html_writer:: start_tag('div',array('class'=>'form-group col-md-3 form-group-ele','style'=>'text-align:right;'));
    $html   .= html_writer:: tag('button','<i class="fa fa-download"></i> &nbsp;&nbsp;Download CSV',array('type'=>'button','id'=>'dwn_accident_report_csv','class'=>'btn btn-primary','style' =>"margin-right:10px"));
    $html   .= html_writer:: end_tag('div');
    $html   .= html_writer:: end_tag('div');
}
$html   .= html_writer:: start_tag('div',array('class'=>'table-responsive'));
$table = new html_table();
$table->attributes['class'] = 'generaltable list-accident';
$table->width = '100%';

$table->head  = array("Date of Accident","Report Number","Manager","Submitter","Status","Contract","Category","RIDDOR Reportable?",wordwrap("RIDDOR event..",12),"RIDDOR subcategory","Medical Treatment..","Minor Injuries","Lost days?","Lost days","Action");
$table->align = array( 'left','left','left','left','left','left','left','left','left','left','left','left','left');
$table->size  = array( '20%','20%','20%','20%',"20%","20%","20%","20%","20%","30%","20%","20%","20%");

$count=0;
$managerList  = get_all_manager_list();
$contract_list = get_dropdown_data(1,'contract');
$accident_category_list = get_dropdown_data(1,'category');
$riddor_classification_list = get_dropdown_data(1,'riddor_classification');
$riddor_subcategory_list = get_dropdown_data(1,'RIDDOR_subcategory');
//echo "<pre>";
//print_r($contract_list['contract'][87]);
//die;
foreach($result as $rec) {
    $submitterObj = get_userInfo(array("id" => $rec->user_id));
    $submitter = $submitterObj->firstname.' '.$submitterObj->lastname;
    $manager = $managerList[$rec->user_manager];

    $status = '';
    if (($rec->s_mgt_rpt_ant_closed_off==NULL) || ($rec->s_mgt_rpt_ant_closed_off=='')) $status="New";
    else if ($rec->s_mgt_rpt_ant_closed_off=='0') $status = "Open";
    else if ($rec->s_mgt_rpt_ant_closed_off=='1') $status = "Closed";

    $riddor_reportable = '';
    if ($rec->s_mgt_rpt_2508_completed=='1')      $riddor_reportable ='Yes';
    else if ($rec->s_mgt_rpt_2508_completed=='2') $riddor_reportable ='No';
    else if ($rec->s_mgt_rpt_2508_completed=='3') $riddor_reportable ='N/A';
    else                                          $riddor_reportable ='';

    $report_url = new moodle_url($CFG->wwwroot.'/local/mp_report/index.php?cmd=acc_edit&id='.$rec->id);
    $link = "<a target='new' href='".$report_url."'>View</a>";

    $table->data[] = new html_table_row(array( date("d/m/Y",$rec->accident_date),$rec->id,$manager,$submitter,$status,$contract_list['contract'][$rec->user_contract],$accident_category_list['category'][$rec->accident_category],$riddor_reportable,$riddor_classification_list['riddor_classification'][$rec->s_mgt_rpt_riddor_event_clf],$riddor_subcategory_list['RIDDOR_subcategory'][$rec->riddor_subcategory],$rec->accident_treatment,$rec->minor_injuries,$rec->lost_time,$rec->lost_time_days,$link));
}
$html .= html_writer::table($table);
$html .= html_writer:: end_tag('div');
$html .= "<hr></br>";


echo json_encode($html);
die;
