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

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/trend_analysis_report/locallib.php');  // Include our function library.
require_login();


$homeurl    = new moodle_url('/local/accident_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    echo ("You are not authorized to view this page");
}

global $USER, $CFG,$DB;
$where 	= unserialize($_SESSION["toolbox_talks_by_category_csv"]["where"]);
$params['client'] = $_SESSION["toolbox_talks_by_category_csv"]["client"] ;

$sql = " SELECT id,COUNT(id) as total,category,client,coursetype FROM mdl_course WHERE $where ";
$result = $DB->get_records_sql($sql,$params);

//populate csv final data array
$csvDataArray = array();
$course_category = get_course_category_subcategory_list();

foreach($result as $rec){
    $category_title = $course_category[$rec->category];
    $submitterObj = get_userInfo(array("id" => $rec->user_id));
    $submitter = $submitterObj->firstname.' '.$submitterObj->lastname;
    $manager = $managerList[$rec->manager_id];

    $status = '';
    if (($rec->s_mgt_rpt_ant_closed_off==NULL) || ($rec->s_mgt_rpt_ant_closed_off=='')) $status="New";
    else if ($rec->s_mgt_rpt_ant_closed_off=='0') $status = "Open";
    else if ($rec->s_mgt_rpt_ant_closed_off=='1') $status = "Closed";

    $riddor_reportable = '';
    if ($rec->s_mgt_rpt_2508_completed=='1') $riddor_reportable='Yes';
    else $riddor_reportable='No';

    $csvDataArray[] = array(
        $category_title.' - '.$rec->client,
        $rec->total
    );
}
//CSV snippet
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=toolbox_talks_by_category.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array("Date from: ",$_SESSION["toolbox_talks_by_category_csv"]["from_to"]));
fputcsv($output, array("Client: ",$_SESSION["toolbox_talks_by_category_csv"]["client"]));
fputcsv($output, array("Category/Subcategory","Volume"));

// loop over the rows, outputting them
foreach($csvDataArray as $row){
    fputcsv($output, $row);
}
exit();
