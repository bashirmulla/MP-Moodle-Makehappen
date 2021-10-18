<?php
// Globals.
global $USER, $CFG,$DB;
$pluginname = 'training_matrix';

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/training_matrix/locallib.php');  // Include our function library.

$homeurl    = new moodle_url('/local/training_matrix/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance() && !is_training_admin() && !is_siteadmin()) {
    echo ("You are not authorized to view this page");
}

$where = unserialize($_SESSION["expiring_certificates_users_csv"]["where"]);

$sql = "SELECT C.*,from_unixtime(expiry_date,'%d/%m/%Y') AS expiry_date_for FROM {managecertificates} C  WHERE $where";
$result = $DB->get_records_sql($sql);


//populate csv final data array
$csvDataArray = array();

$certificate_types = get_certificate_types_listing();
$certificate_types_arr = array();
$csv_head  = array('Users','Certificate Names','Expiry Dates','Status');
$certificate_status = array();
if (!empty($result)) {
    foreach($result as $rec){
        $row_cells = array();
        $sql = "SELECT u.id,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u WHERE u.deleted = 0 AND u.suspended = 0 AND u.id=".$rec->certificate_user_id;
        $user = $DB->get_record_sql($sql);
        if(empty($user)) continue;

        $user_certificates = get_certificates_by_user($rec->certificate_user_id,$rec->certificate_types_id);
        $color_class = get_certificates_status_colour_coding($user_certificates);

        $status = "";
        if($color_class=='na')                          $status = "N/A";
        elseif($color_class=='expiring')                $status = "Expiring";
        elseif($color_class=='booked')                  $status = "Booked";
        elseif($color_class=='awaiting-certificate')    $status = "Awaiting Certificate";
        elseif($color_class=='expired-notheld')         $status = "Expired-Notheld";

        $row_cells[] = $user->name;
        $row_cells[] = get_certificate_type_name($rec->certificate_types_id);
        $row_cells[] = $rec->expiry_date_for;
        $row_cells[] = $status;

        $csvDataArray[] = $row_cells;
    }
}

//CSV snippet
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=expiring_certificates_users.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, $csv_head);

// loop over the rows, outputting them
foreach($csvDataArray as $row){
    fputcsv($output, $row);
}
