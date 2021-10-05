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
 * @author     Bash & SAM Harun & Mmahedi
 */


// Globals.
global $USER, $CFG,$DB,$PAGE;
define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/training_matrix/locallib.php');  // Include our function library.

require_login();

$homeurl    = new moodle_url('/local/calm_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance() && !is_training_admin() && !is_siteadmin()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}

$query_con_str =" 1=1 ";
$filterData = get_requests();

$params =  array();
if ($filterData['certificate_type']){
    $certificate_type = implode(',',$filterData['certificate_type']);
    $params['certificate_types_id'] = $certificate_type;
    $query_con_str .= " AND certificate_types_id IN (?) ";
}
//$query_con_str .= " AND expiry_date > UNIX_TIMESTAMP(( DATE(NOW()))) ";

$sql          = "SELECT id,certificate_status,update_status,certificate_user_id,certificate_types_id,copy_of_certificate,expiry_date,from_unixtime(expiry_date,'%d/%m/%Y') AS expiry_date_for FROM {managecertificates} WHERE $query_con_str";
$certificates = $DB->get_records_sql($sql,$params);

$userCertificates = array();
if(!empty($certificates)){

    foreach ($certificates as $c){
        if(!empty($c->expiry_date_for)
               && $c->expiry_date > time())
            $userCertificates[$c->certificate_user_id][$c->certificate_types_id] = $c->expiry_date_for;
        elseif(!empty($c->copy_of_certificate)
               && $c->certificate_status==5 && $c->update_status==7)
            $userCertificates[$c->certificate_user_id][$c->certificate_types_id] = "No Expiration";
    }
}

$html   = "";
$html   .= html_writer:: start_tag('div',array('class'=>'table-responsive'));
$table = new html_table();
$table->attributes['class'] = 'generaltable searchqualifications';
$table->head  = array('User Name');

$certificate_types = get_certificate_types_listing();
$certificate_types_arr = array();
foreach ($certificate_types as $certificate_type) {
    if(!empty($filterData['certificate_type']) && !in_array($certificate_type->id,$filterData['certificate_type'])) continue;
    $table->head[] = $certificate_type->certificate_name;

    $certificate_types_obj = new stdClass();
    $certificate_types_obj->certificate_type_id = $certificate_type->id;
    $certificate_types_obj->certificate_expire = $certificate_type->certificate_expire;
    $certificate_types_arr[] = $certificate_types_obj;
}


$sql = "SELECT u.id,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u LEFT JOIN  {managecertificates} c ON (u.id=c.certificate_user_id) WHERE u.deleted = 0  AND u.id=c.certificate_user_id";
$users = $DB->get_records_sql($sql);


if(!empty($users)){

  foreach ($users as $thisUser){

      $row = new html_table_row();

      $cell1        = new html_table_cell();
      $cell1->text  = $thisUser->name;
      $row->cells[] = $cell1;
      $fullCheck    = true;

      foreach ($certificate_types_arr as $objcertificate_types) {
          $cell = new html_table_cell();
          if (!empty($userCertificates[$thisUser->id][$objcertificate_types->certificate_type_id])){
              $cell->text = $userCertificates[$thisUser->id][$objcertificate_types->certificate_type_id];
          }else{
              $fullCheck = false;
              $cell->text = '-';
          }
          $row->cells[] = $cell;
      }

      if($fullCheck)   $table->data[] = $row;

  }
}

//_p($table);
$html .= html_writer::table($table);
$html .= html_writer:: end_tag('div');
$html .= "<hr></br>";


echo json_encode($html);
die;