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

global $USER, $CFG,$DB;
$where 	 = unserialize($_SESSION["accident_report_csv"]["where"]);
$params  = unserialize($_SESSION["accident_report_csv"]["params"]);
$sql = " SELECT * FROM mdl_accident_report WHERE $where ";
$result = $DB->get_records_sql($sql,$params);

//populate csv final data array
$csvDataArray = array();
$managerList  = get_manager_list();
$contract_list = get_dropdown_data(1,'contract');
$accident_category_list = get_dropdown_data(1,'category');
$riddor_classification_list = get_dropdown_data(1,'riddor_classification');
$riddor_subcategory_list = get_dropdown_data(1,'RIDDOR_subcategory');

foreach($result as $rec){
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
        date("d/m/Y",$rec->accident_date),
        $rec->id,
        $manager,
        $submitter,
        $status,$contract_list['contract'][$rec->user_contract],
        $accident_category_list['category'][$rec->accident_category],
        $riddor_reportable,
        $riddor_classification_list['riddor_classification'][$rec->s_mgt_rpt_riddor_event_clf],
        $riddor_subcategory_list['RIDDOR_subcategory'][$rec->riddor_subcategory],
        $rec->accident_treatment,
        $rec->minor_injuries,
        $rec->lost_time,
        $rec->lost_time_days
    );
}
//CSV snippet
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=accident_report.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array("Date of Accident","Report Number","Manager","Submitter","Status","Contract","Category","RIDDOR Reportable?","RIDDOR event classification","RIDDOR subcategory","Medical Treatment over First Aid","Minor Injuries","Lost days?","Number of Lost days"));

// loop over the rows, outputting them
foreach($csvDataArray as $row){
    fputcsv($output, $row);
}
//exit();
