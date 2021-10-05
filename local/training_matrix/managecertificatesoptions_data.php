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
 * @copyright  2018 CALM
 * @author     Bash & SAM Harun & Mahedi
 */


// Globals.
global $USER, $CFG,$DB;
define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/training_matrix/locallib.php');  // Include our function library.

$formData = get_requests();
//_p($formData);

$homeurl    = new moodle_url('/local/calm_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance() && !is_training_admin() && !is_siteadmin()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}

$json_data = array();
if($formData['options']=='view_certificate') {
    $json_data['options']='view_certificate';
    $userData = get_data(array("certificate_user_id" => $formData['certificate_user_id'], "certificate_types_id" => $formData['certificate_types_id']), 'managecertificates');
    $ext = pathinfo($userData->copy_of_certificate, PATHINFO_EXTENSION);

    $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https' : 'http';
    $context = stream_context_create(array($protocol => array('header' => 'Connection: close\r\n')));

    if (empty($userData->copy_of_certificate)) {
        $json_data['html']= '<button type="button" class="btn btn-outline-danger">No data</button>';
    } else {
        if (strtolower($ext) == 'pdf') {

            $pdf = $CFG->wwroot.$userData->copy_of_certificate;
//        $pdfData = base64_encode(file_get_contents($pdf, false, $context));
//        $src = 'data: ' . mime_content_type($pdf) . ';base64,' . $pdfData;
            $json_data['html'] = '<embed src="' . $pdf . '" type="application/pdf" width="100%" height="200px" />';
        } else {

            $src = $CFG->wwroot.$userData->copy_of_certificate;

            $json_data['html'] = "<img src='$src' height='250px' width='100%' style='border: 1px solid #CCC;' />";
        }
    }
}elseif($formData['options']=='download_certificate') {
    $json_data['options']='download_certificate';
    $userData = get_data(array("certificate_user_id" => $formData['certificate_user_id'], "certificate_types_id" => $formData['certificate_types_id']), 'managecertificates');
    $ext = pathinfo($userData->copy_of_certificate, PATHINFO_EXTENSION);

    $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https' : 'http';
    $context = stream_context_create(array($protocol => array('header' => 'Connection: close\r\n')));

    if ($userData->copy_of_certificate == 'nofile') {
        $json_data['html']= 'nofile';
    } else {
        $filepath          = $CFG->wwroot.$userData->copy_of_certificate;
        $json_data['html'] = $filepath;
    }

}elseif($formData['options']=='edit_certificate') {
    $json_data['options'] = 'edit_certificate';
    $userData = get_data(array("certificate_user_id" => $formData['certificate_user_id'], "certificate_types_id" => $formData['certificate_types_id']), 'managecertificates');
    if(!empty($userData->expiry_date)) {
        $expiry_date_format   = showDateTime($userData->expiry_date, 'managecertificatedateonly');
        $expiry_date_arr   = explode("/", $expiry_date_format);
        $json_data['expiry_date_day'] = intval($expiry_date_arr[0]);
        $json_data['expiry_date_month'] = intval($expiry_date_arr[1]);
        $json_data['expiry_date_year'] = $expiry_date_arr[2];

    }

    if(!empty($userData->attended_date)) {
        $attended_date_format = showDateTime($userData->attended_date, 'managecertificatedateonly');
        $attended_date_arr = explode("/", $attended_date_format);
        $json_data['attended_date_day'] = intval($attended_date_arr[0]);
        $json_data['attended_date_month'] = intval($attended_date_arr[1]);
        $json_data['attended_date_year'] = $attended_date_arr[2];
    }
    else{
        $json_data['attended_date_day']   = "";
        $json_data['attended_date_month'] = "";
        $json_data['attended_date_year']  = "";
    }
    $json_data['update_status'] = $userData->update_status;
}elseif($formData['options']=='delete_certificate') {
    $json_data['options'] = 'delete_certificate';
    $userData = get_data(array("certificate_user_id" => $formData['certificate_user_id'], "certificate_types_id" => $formData['certificate_types_id']), 'managecertificates');
    if ($userData) {
        $userData->copy_of_certificate  = NULL;
        $userData->expiry_date          = NULL;
        $userData->update_status        = "0";
        $userData->certificate_status   = 6;
        $userData->user_id              = $USER->id;
        if ($DB->update_record('managecertificates',$userData)) {
            $json_data['delete_status'] = 'deleted';
        } else {
            $json_data['delete_status'] = 'deletednot';
        }
    }
}elseif($formData['options']=='view_previous_certificates') {
    $json_data['options'] = 'view_previous_certificates';
    $userCertificates = get_datas(array("certificate_user_id" => $formData['certificate_user_id'], "certificate_types_id" => $formData['certificate_types_id']), 'managecertificates_history');
    if(!empty($userCertificates)){
        foreach ($userCertificates as $value){
            $ext = pathinfo($value->copy_of_certificate, PATHINFO_EXTENSION);

            $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https' : 'http';
            $context = stream_context_create(array($protocol => array('header' => 'Connection: close\r\n')));

            if ($value->copy_of_certificate == 'nofile') {
                $html .= '<button type="button" class="btn btn-outline-danger">No data</button>';
            } else {
                if (strtolower($ext) == 'pdf') {
                    $pdf = $CFG->wwroot.$value->copy_of_certificate;
                    $html .= '<embed src="' . $pdf . '" type="application/pdf" width="100%" height="200px"  style="margin-bottom: 5px;" />';
                } else {
                    $src = $CFG->wwroot.$value->copy_of_certificate;
                    $html .= "<img src='$src' height='200px' width='100%' style='border: 1px solid #CCC; margin-bottom: 5px;' />";
                }
            }
        }
    }else{
        $html = '<button type="button" class="btn btn-outline-danger">No data</button>';
    }
    $json_data['html'] = $html;

}

echo json_encode($json_data);
die;