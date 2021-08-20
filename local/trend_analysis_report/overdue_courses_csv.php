<?php
// Globals.
global $USER, $CFG,$DB;

define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/trend_analysis_report/locallib.php');  // Include our function library.
//require_once $CFG->dirroot.'/completion/completion_completion.php';
require_once($CFG->libdir . '/completionlib.php');
require_once($CFG->libdir . '/accesslib.php');
require_login();

use core_completion\progress;
$where 	        = unserialize($_SESSION["overdue_courses_csv"]["where"]);
$params         = unserialize($_SESSION["overdue_courses_csv"]["params"]);
$user_status 	= unserialize($_SESSION["overdue_courses_csv"]["user_status"]);

$sql    = " SELECT * FROM mdl_course WHERE $where ";
$result = $DB->get_records_sql($sql,$params);

//populate csv final data array
$csvDataArray = array();
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
        $csvDataArray[] = array($rec->fullname,showDateTime($rec->duedate,'dateonly'),$courses_type_list[$rec->coursetype],$rec->client,$overDue,$userStr);
}

//CSV snippet
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=overdue_courses.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Course Name','Due Date','Course Type','Client','Days Overdue','User left to complete'));

// loop over the rows, outputting them
foreach($csvDataArray as $row){
    fputcsv($output, $row);
}