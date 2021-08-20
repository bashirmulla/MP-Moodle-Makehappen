<?php
// Globals.
global $USER, $CFG,$DB;


define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/trend_analysis_report/locallib.php');  // Include our function library.
require_once($CFG->libdir . '/completionlib.php');
require_once($CFG->dirroot.'/grade/querylib.php');
require_once($CFG->dirroot.'/grade/lib.php');
require_once($CFG->libdir . '/externallib.php');
require_login();


use core_completion\progress;

$course_where 	= unserialize($_SESSION["course_completion_csv"]["course_where"]);
$params  	    = unserialize($_SESSION["course_completion_csv"]["params"]);

$sql = " SELECT * FROM mdl_course WHERE $course_where ";
$course_data = $DB->get_records_sql($sql,$params);

$user_where 	= unserialize($_SESSION["course_completion_csv"]["user_where"]);
$params2 	    = unserialize($_SESSION["course_completion_csv"]["params2"]);
$sql = " SELECT u.* ,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u WHERE  $user_where AND u.deleted = 0 ORDER BY name ASC"; /*BM added ORDER BY ASC for MOOD-302*/
$users = $DB->get_records_sql($sql,$params2);


//populate csv final data array
$csvDataArray = array();

$csvheader = array();
$csvheader[] = 'user(s)';
$csvheader[] = 'ID number';
if (!empty($course_data)) {
    foreach ($course_data as $value) {
        $csvheader[] = $value->fullname;
    }
}
$csvheader[] = 'Total completion for user';

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
                    $percentage = $percentage . "%";
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
        $csvDataArray[] = $tableData;

    }
}



//CSV snippet
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=course_completion.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, $csvheader);

// loop over the rows, outputting them
foreach($csvDataArray as $row){
    fputcsv($output, $row);
}