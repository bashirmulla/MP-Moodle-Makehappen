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
 * @package    training_matrix
 * @copyright  2020 Calm-solutions.com
 * @author     Bash & SAM Harun & Mahedi
 */


// Globals.
global $USER, $CFG,$DB;
define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/training_matrix/locallib.php');  // Include our function library.


$query_con_str =" 1=1 ";
$filterData = get_requests();

$homeurl    = new moodle_url('/local/calm_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    echo ("You are not authorized to view this page");
}

if ($filterData['qry']){
    $expire_type = $filterData['qry'];
    if ($expire_type==3){
        $query_con_str .= " AND expiry_date BETWEEN UNIX_TIMESTAMP(( DATE(NOW()) + INTERVAL 2 MONTH)) AND UNIX_TIMESTAMP(( DATE(NOW()) + INTERVAL 3 MONTH)) ";
    }
    else if ($expire_type==2){
        $query_con_str .= " AND expiry_date BETWEEN UNIX_TIMESTAMP(( DATE(NOW()) + INTERVAL 1 MONTH)) AND UNIX_TIMESTAMP(( DATE(NOW()) + INTERVAL 2 MONTH)) ";
    }
    else if ($expire_type==1){
        $query_con_str .= " AND expiry_date BETWEEN UNIX_TIMESTAMP(( DATE(NOW()))) AND UNIX_TIMESTAMP(( DATE(NOW()) + INTERVAL 1 MONTH)) ";
    }
    else if ($expire_type=='expired'){
        $query_con_str .= " AND expiry_date < UNIX_TIMESTAMP(( DATE(NOW()))) OR (update_status IN(0,7) AND certificate_status = 2)";
    }
}

$_SESSION["expiring_certificates_users_csv"]["where"] = serialize($query_con_str);
$sql = "SELECT id,certificate_user_id,certificate_types_id,copy_of_certificate,expiry_date,from_unixtime(expiry_date,'%d/%m/%Y') AS expiry_date_for FROM {managecertificates} WHERE $query_con_str";

$certificates = $DB->get_records_sql($sql);
$html   = "";
if(count($certificates)>0){
    $html   .= html_writer:: start_tag('div',array('class'=>'form-row'));
    $html   .= html_writer:: div('','col-md-9 form-group-ele');
    $html   .= html_writer:: start_tag('div',array('class'=>'form-group col-md-3 form-group-ele','style'=>'text-align:right;'));
    $html   .= html_writer:: tag('button','<i class="fa fa-download"></i> &nbsp;&nbsp;Download CSV',array('type'=>'button','id'=>'dwn_expiring_certificates_users_csv','class'=>'btn btn-primary','style' =>"margin-right:10px"));
    $html   .= html_writer:: end_tag('div');
    $html   .= html_writer:: end_tag('div');
}
$html   .= html_writer:: start_tag('div',array('class'=>'table-responsive'));
$table = new html_table();
$table->attributes['class'] = 'generaltable userscertificates';
$table->head  = array('Users','Certificate Names','Expiry Dates');

if (!empty($certificates)) {
    foreach ($certificates as $certificate) {
        $sql = "SELECT u.id,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u WHERE u.deleted = 0 AND u.suspended = 0 AND u.id=".$certificate->certificate_user_id;
        $user = $DB->get_record_sql($sql);
        if(empty($user)) continue;

        $row = new html_table_row();

        $cell1 = new html_table_cell();
        $cell1->text = $user->name;
        $row->cells[] = $cell1;

        $cell2 = new html_table_cell();
        $cell2->text = get_certificate_type_name($certificate->certificate_types_id);
        $row->cells[] = $cell2;

        $cell3 = new html_table_cell();
        $cell3->text = $certificate->expiry_date_for;
        $row->cells[] = $cell3;

        $table->data[] = $row;
    }
}
$html .= html_writer::table($table);
$html .= html_writer:: end_tag('div');
$html .= "<hr></br>";


echo json_encode($html);
die;