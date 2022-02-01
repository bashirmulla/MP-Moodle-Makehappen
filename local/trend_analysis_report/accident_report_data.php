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

$tableName  = "new_accident_report";

$query_con_str =" 1=1 ";
$filterData = get_requests();

require_login();
$homeurl    = new moodle_url('/local/accident_report/index.php');

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

$query_con_str .= " AND (b_date BETWEEN $date_from AND $date_to) ";

if ($filterData['report_number']){
    $params['id']   = $filterData['report_number'];
    $query_con_str .= " AND id=? ";
}
if ($filterData['manager']){
    $params['user_manager']  = $filterData['manager'];
    $query_con_str          .= " AND user_manager=? ";
}

if(is_manager() || is_admin()) $submitter_to_manager = 'Yes';
else                           $submitter_to_manager = 'No';

$query_con_str .= " AND submitter_to_manager='$submitter_to_manager' ";

//echo "<pre>";
//print_r($query_con_str);
//die;
$_SESSION["accident_report_csv"]["where"]  = serialize($query_con_str);
$_SESSION["accident_report_csv"]["params"] = serialize($params);
$sql = " SELECT * FROM mdl_new_accident_report WHERE $query_con_str ";

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

$table->head  = array("No","Surname","First Name","Incident Date","Summary of Accident details","Action Taken","Findings","Recommendations","Status","Action");
$table->align = array( 'left','left','left','left','left','left','left','left','center','center');

$count=0;
$managerList  = get_all_manager_list();
$contract_list = get_dropdown_data(1,'contract');


$result2  = $DB->get_records('new_accident_manager_report');
$dropdown = get_new_dropdown_data(1);

$acc_manager = array();

if(!empty($result2)){
    foreach($result2 as $item){
        $acc_manager[$item->new_accident_id] = $item;
    }
}

//echo "<pre>";
//print_r($contract_list['contract'][87]);
//die;
foreach($result as $rec) {
    $submitterObj = get_userInfo(array("id" => $rec->user_id));
    $submitter = $submitterObj->firstname.' '.$submitterObj->lastname;
    $manager = $managerList[$rec->user_manager];

    //$report_url = new moodle_url($CFG->wwwroot.'/local/accident_report/index.php?cmd=acc_edit&id='.$rec->id);
    // $link = "<a target='new' href='".$report_url."'>View</a>";
    $editDeleteLink = "";
    if(isset($acc_manager[$rec->id])) {
        $editDeleteLink = "<a href='index.php?cmd=accident_event&id=$rec->id' style='color:#5769cf'>Statement</a> | ";
    }
    $editDeleteLink .= "<a href='index.php?cmd=new_acc_edit&id=$rec->id' style='color:#5769cf'>View</a>";
    $reporter = get_userInfo(array("id" => $rec->user_id));
    
    if($rec->status=='Pending')        $status = '<b style="color:#c3ad13">Pending</b>';
    elseif($rec->status=='Confirmed')  $status = '<b style="color:#3aad6d">Confirmed</b>';
    elseif($rec->status=='Approved')   $status = '<b style="color:#2441e7">Approved</b>';

    $table->data[] = new html_table_row(array( ++$count,$rec->a_surname,$rec->a_forename,date("d/m/Y",$rec->b_date),
                            $acc_manager[$rec->id]->incident_description,$rec->f_action_taken,
                            $acc_manager[$rec->id]->results_investigation,
                            $dropdown['recommended_actions'][$acc_manager[$rec->id]->recommended_actions],
                            $status,$editDeleteLink));
}
$html .= html_writer::table($table);
$html .= html_writer:: end_tag('div');
$html .= "<hr></br>";


echo json_encode($html);
die;
