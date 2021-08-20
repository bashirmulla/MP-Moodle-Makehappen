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

$homeurl    = new moodle_url('/local/mp_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    echo ("You are not authorized to view this page");
}

global $USER, $CFG,$DB;

$tableName  = get_string('incident_table','local_trend_analysis_report');

$where 	 = unserialize($_SESSION["incident_near_miss_hazard_report_csv"]["where"]);
$params  = unserialize($_SESSION["incident_near_miss_hazard_report_csv"]["params"]);

$sql = " SELECT * FROM mdl_$tableName WHERE $where ";
$result = $DB->get_records_sql($sql,$params);

//populate csv final data array
$csvDataArray = array();
$managerList  = get_manager_list();
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
    else if (($rec->report_closed=='No' )) $status = "Open";
    else if ($rec->report_closed=='Yes') $status = "Closed";
    else '';

    $report_to_client = '';
    if ($rec->report_to_client=='56') $report_to_client='Yes';
    else if ($rec->report_to_client=='57') $report_to_client='No';
    else $report_to_client='N/A';

//    $table->data[] = new html_table_row(array( ));
    $csvDataArray[] = array(
        date("d/m/Y",$rec->i_date),
        $rec->id,
        $manager,
        $submitter,
        $status,
        @$contract_list['contract'][$rec->contact],
        @$report_category_list['report_category'][$category_id],
        $classification_list['classification'][$rec->classification],
        $categorisation_list['categorisation'][$rec->categorisation],
        $report_to_client
    );
}
//CSV snippet
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=incident_near_miss_hazard_report.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array("Date of Incident","Report Number","Manager","Submitter","Status","Contract","Category","Classification","Categorisation","Report to client?"));

// loop over the rows, outputting them
foreach($csvDataArray as $row){
    fputcsv($output, $row);
}
