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
require_once($CFG->libdir . '/completionlib.php');
require_once($CFG->dirroot.'/grade/querylib.php');
require_once($CFG->dirroot.'/grade/lib.php');
require_once($CFG->libdir . '/externallib.php');

use core_completion\progress;
require_login();

$homeurl    = new moodle_url('/local/accident_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    echo ("You are not authorized to view this page");
}

define('PREFERRED_RENDERER_TARGET', RENDERER_TARGET_GENERAL);

$query_con_str =" 1=1 ";
$filterData = get_requests();
$params = array();

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
    $course_id      = $filterData['course_name'];
    $params['id']   = $course_id;
    $query_con_str .= " AND id IN (?) ";
}
if ($filterData['category_subcategory']){
    $category_subcategory = $filterData['category_subcategory'];
    $params['category']   = $category_subcategory;
    $query_con_str       .= " AND category IN (?) ";
}
if ($filterData['course_type']){
    $course_type          = $filterData['course_type'];
    $params['coursetype'] = $course_type;
    $query_con_str       .= " AND coursetype IN (?) ";
}
if ($filterData['client']){
    $client           = $filterData['client'];
    $params['client'] = $course_type;
    $query_con_str   .= " AND client IN (?) ";
}


$query_con_str.= " AND category!=0  AND enablecompletion=1";

$query_con_str2 =" 1 ";

$params2 = array();

if ($filterData['user']){
    $user_id         = $filterData['user'];
    $params2['id']   = $user_id;
    $query_con_str2 .= " AND id IN (?) ";
}
if ($filterData['manager']){
    $manager_id            = $filterData['manager'];
    $params2['manager_id'] = $manager_id;
    $query_con_str2       .= " AND manager_id IN (?) ";
}
if ($filterData['user_status']){
    $user_status          = ($filterData['user_status']=='Active')?'0':'1';
    $params2['suspended'] = $user_status;
    $query_con_str2 .= " AND suspended IN (?) ";
}



$_SESSION["course_completion_csv"]["course_where"] = serialize($query_con_str);
$_SESSION["course_completion_csv"]["params"]       = serialize($params);
$_SESSION["course_completion_csv"]["user_where"]   = serialize($query_con_str2);
$_SESSION["course_completion_csv"]["params2"]      = serialize($params2);

$sql = " SELECT * FROM mdl_course WHERE $query_con_str ";
$course_data = $DB->get_records_sql($sql,$params);

$html   = "";
if(count($course_data)>0) {

    $sql = " SELECT u.* ,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u WHERE  $query_con_str2 AND u.deleted = 0";
    $users = $DB->get_records_sql($sql,$params2);

    $html .= html_writer:: start_tag('div', array('class' => 'form-row'));
    $html .= html_writer:: div('', 'col-md-9 form-group-ele');
    $html .= html_writer:: start_tag('div', array('class' => 'form-group col-md-3 form-group-ele', 'style' => 'text-align:right;'));
    $html .= html_writer:: tag('button', '<i class="fa fa-download"></i> &nbsp;&nbsp;Download CSV', array('type' => 'button', 'id' => 'dwn_course_completion_csv', 'class' => 'btn btn-primary', 'style' => "margin-right:10px"));
    $html .= html_writer:: end_tag('div');
    $html .= html_writer:: end_tag('div');

    $html .= html_writer:: start_tag('div', array('class' => 'table-responsive'));
    $table = new html_table();
    $table->attributes['class'] = 'generaltable list-courses';
    $colheader = array();
    $colheader[] = 'User(s)';
    $colheader[] = 'ID number';
    if (!empty($course_data)) {
        foreach ($course_data as $value) {
            $colheader[] = $value->fullname;
        }
    }
//_p($course_data,true);
    $colheader[] = 'Total completion for user';
    $table->head = $colheader;
    $table->align = array('left','left', 'left', 'left', 'left', 'left');

    if (!empty($users)) {
        foreach ($users as $user) {
            $tableData = array();
            $total_completion = 0;
            $total_course = 0;
            $tableData[] = $user->name;
            $tableData[] = $user->idnumber;


            foreach ($course_data as $course) {
                {

                    $coursecontext = context_course::instance($course->id);
                    $enrolled = is_enrolled($coursecontext, $user, '', true);

                    if($course->enddate>0 AND $user->timecreated >= $course->enddate){
                        $percentage ="N/A";
                    }
                    elseif($enrolled) {
                        $percentage = progress::get_course_progress_percentage($course, $user->id);
                        if (empty($percentage)) $percentage = "0";
                        $percentage = round($percentage,2) . "%";
                        $total_course += 1;
                    }
                    else{
                        $percentage ="N/A";
                    }

                    $tableData[] = $percentage;

                    $total_completion += $percentage;

                }

            }

            // Total completion for user
            $tmp = ($total_course > 0) ? number_format($total_completion / $total_course, 0) . "%" : "-";
            $tableData[] = $tmp;
            $table->data[] = new html_table_row($tableData);

        }
    }
    $html .= html_writer::table($table);
    $html .= html_writer:: end_tag('div');
    $html .= "<hr></br>";
}

echo json_encode($html);
die;
