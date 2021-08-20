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
$tableName  = get_string('accident_table','local_trend_analysis_report');

$query_con_str =" 1=1 ";
$filterData = get_requests();


$toDateArr   = $filterData['date_to'];
$fromDateArr = $filterData['date_from'];

$toStr     = $toDateArr['year'].'-'.$toDateArr['month'].'-'.$toDateArr['day'].' 23:59:59';
$formStr   = $fromDateArr['year'].'-'.$fromDateArr['month'].'-'.$fromDateArr['day'].' 00:00:00';
$date_to   = strtotime($toStr);
$date_from = strtotime($formStr);

$params = array();

$query_con_str .= " AND (duedate BETWEEN $date_from AND $date_to) ";

if ($filterData['course_name']){
    $params['fullname'] = $filterData['course_name'];
    $query_con_str     .= " AND fullname LIKE CONCAT( '%',?,'%')";
}
if ($filterData['category_subcategory']){
    $category_subcategory = implode(',',$filterData['category_subcategory']);
    $params['category']   = $category_subcategory;
    $query_con_str       .= " AND category IN (?) ";
}

if ($filterData['course_type']){
    $course_type           = implode(',',$filterData['course_type']);
    $params['coursetype']  = $course_type;
    $query_con_str        .= " AND coursetype IN (?) ";
}
if ($filterData['client']){
    $client            = implode("','",$filterData['client']);
    $params['client']  = $client;
    $query_con_str    .= " AND client IN (?) ";
}


$sql = "SELECT * FROM mdl_course WHERE $query_con_str ";

$result = $DB->get_records_sql($sql,$params);

$html   = "";
if(count($result)>0){
//    $html   .= html_writer:: start_tag('div',array('class'=>'form-row'));
//    $html   .= html_writer:: div('','col-md-9 form-group-ele');
//    $html   .= html_writer:: start_tag('div',array('class'=>'form-group col-md-3 form-group-ele','style'=>'text-align:right;'));
//    $html   .= html_writer:: tag('button','<i class="fa fa-download"></i> &nbsp;&nbsp;Download CSV',array('type'=>'button','id'=>'dwn_accident_report_csv','class'=>'btn btn-primary','style' =>"margin-right:10px"));
//    $html   .= html_writer:: end_tag('div');
//    $html   .= html_writer:: end_tag('div');
}
$html   .= html_writer:: start_tag('div',array('class'=>'table-responsive'));
$table = new html_table();
$table->attributes['class'] = 'generaltable list-courses';
$table->head  = array("Course name","Category/Subcategory","Course type","Client","Due date","Action");
$table->align = array( 'left','left','left','left','left');
$category_subcategory_list = get_course_category_subcategory_list();
$courses_type_list = get_courses_type();
foreach($result as $rec) {
    $report_url = new moodle_url($CFG->wwwroot.'/course/view.php?id='.$rec->id);
    $link = "<a target='new' href='".$report_url."'>View</a>";
    $table->data[] = new html_table_row(array($rec->fullname,$category_subcategory_list[$rec->category],$courses_type_list[$rec->coursetype],$rec->client,date("d/m/Y",$rec->duedate),$link));
}
$html .= html_writer::table($table);
$html .= html_writer:: end_tag('div');
$html .= "<hr></br>";


echo json_encode($html);
die;
