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
//require_once $CFG->dirroot.'/completion/completion_completion.php';
require_once($CFG->libdir . '/completionlib.php');
require_once($CFG->libdir . '/accesslib.php');
require_login();
$homeurl    = new moodle_url('/local/accident_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    echo ("You are not authorized to view this page");
}
use core_completion\progress;

$query_con_str = " 1=1 ";
$filterData    = get_requests();
$params        = array();

if(isset($filterData['enabled'])) {
    $toDateArr = $filterData['date_to'];
    $fromDateArr = $filterData['date_from'];

    $toStr = $toDateArr['year'] . '-' . $toDateArr['month'] . '-' . $toDateArr['day'] . ' 23:59:59';
    $formStr = $fromDateArr['year'] . '-' . $fromDateArr['month'] . '-' . $fromDateArr['day'] . ' 00:00:00';
    $date_to = strtotime($toStr);
    $date_from = strtotime($formStr);

    $query_con_str .= " AND (duedate BETWEEN $date_from AND $date_to) ";
}

if ($filterData['course_name']){
    $params['fullname']  = $filterData['course_name'];
    $query_con_str .= " AND fullname LIKE CONCAT( '%',?,'%')";
}

if ($filterData['course_type']){
    $course_type          = $filterData['course_type'];
    $params['coursetype'] = $course_type;
    $query_con_str       .= " AND coursetype IN (?) ";
}
if ($filterData['client']){
    $client           = $filterData['client'];
    $params['client'] = $client;
    $query_con_str   .= " AND client IN (?) ";
}

$user_status = -1;
if ($filterData['user_status']){
    $user_status = $filterData['user_status'];
}


$query_con_str.= " AND category!=0  AND enablecompletion=1";

$_SESSION["overdue_courses_csv"]["where"]       = serialize($query_con_str);
$_SESSION["overdue_courses_csv"]["params"]      = serialize($params);
$_SESSION["overdue_courses_csv"]["user_status"] = serialize($user_status);

$sql = " SELECT * FROM mdl_course WHERE $query_con_str ";
$result = $DB->get_records_sql($sql,$params);

$html   = "";
if(count($result)>0){
    $html   .= html_writer:: start_tag('div',array('class'=>'form-row'));
    $html   .= html_writer:: div('','col-md-9 form-group-ele');
    $html   .= html_writer:: start_tag('div',array('class'=>'form-group col-md-3 form-group-ele','style'=>'text-align:right;'));
    $html   .= html_writer:: tag('button','<i class="fa fa-download"></i> &nbsp;&nbsp;Download CSV',array('type'=>'button','id'=>'dwn_overdue_courses_csv','class'=>'btn btn-primary','style' =>"margin-right:10px"));
    $html   .= html_writer:: end_tag('div');
    $html   .= html_writer:: end_tag('div');
}
$html   .= html_writer:: start_tag('div',array('class'=>'table-responsive'));
$table = new html_table();
$table->attributes['class'] = 'generaltable overdue-courses';
$table->head  = array('Course Name','Due Date','Course Type','Client','Days Overdue','User left to complete');
$table->align = array( 'left','left','left','left','left');
$courses_type_list = get_courses_type();
foreach($result as $rec) {
    $toDate   = date("Y-m-d");
    $dueDate  = date("Y-m-d",$rec->duedate);
    $date1    = strtotime($toDate);
    $date2    = strtotime($dueDate);
    $diff     = $date1 - $date2;
    $overDue  = floor($diff/(60*60*24));

    if($overDue<=0) $overDue ="N/A";

    $context      = context_course::instance($rec->id);
    $enroll_users = get_enrolled_users($context);


    $completion = new \completion_info($rec);

    $has_incomplete_user = 0;

    if(!empty($enroll_users)){
        $userStr = "";

        foreach ($enroll_users as $user){

            $is_active_user =  ($user->deleted || $user->suspended) ? 0 : 1;

            if($user_status==1 && !$is_active_user)  continue;
            if($user_status==2 &&  $is_active_user)  continue;

            if($rec->enddate>0 AND $user->timecreated >= $rec->enddate){
                continue;
            }

            $percentage = progress::get_course_progress_percentage($rec, $user->id);
            if($percentage<100){
                if (!empty($userStr)) $userStr.=", ";
                $userStr.= $user->firstname.' '.$user->lastname;
                $has_incomplete_user = 1;
            }
        }
    }

    if($has_incomplete_user)
    $table->data[] = new html_table_row(array($rec->fullname,date("d/m/Y",$rec->duedate),$courses_type_list[$rec->coursetype],$rec->client,$overDue,$userStr));
}
$html .= html_writer::table($table);
$html .= html_writer:: end_tag('div');
$html .= "<hr></br>";


echo json_encode($html);
die;
