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
$homeurl    = new moodle_url('/local/training_matrix/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance() && !is_training_admin() && !is_siteadmin()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}

$expiry_dateStr  = NULL;
if(!empty($formData['expiry_date_year']) && !empty($formData['expiry_date_month']) && !empty($formData['expiry_date_day'])) {
    $expiry_dateStr = strtotime($formData['expiry_date_year'] . '-' . $formData['expiry_date_month'] . '-' . $formData['expiry_date_day']);
}

$attended_dateStr  = NULL;
if(!empty($formData['attended_date_year']) && !empty($formData['attended_date_month']) && !empty($formData['attended_date_day'])) {
    $attended_dateStr = strtotime($formData['attended_date_year'] . '-' . $formData['attended_date_month'] . '-' . $formData['attended_date_day']);
}

$file_status = '';

$userData = get_data(array("certificate_user_id" => $formData['certificate_user_id'], "certificate_types_id" => $formData['certificate_types_id']), 'managecertificates');

if ($formData['mformType']=='re-add') {
    $obj = new stdClass();
    $obj->certificate_user_id  = $userData->certificate_user_id;
    $obj->certificate_types_id = $userData->certificate_types_id;
    $obj->copy_of_certificate  = $userData->copy_of_certificate;
    $obj->expiry_date          = $userData->expiry_date;
    $obj->attended_date        = $userData->attended_date;
    $obj->update_status        = $userData->update_status;
    $obj->certificate_status   = $userData->certificate_status;
    $obj->user_id              = $USER->id;
    save_data($obj, 'managecertificates_history');
}
else {

    if(!empty($userData)) {
        $updateobj = new stdClass();
        $updateobj->id                   = $userData->id;
        $updateobj->certificate_user_id  = $formData['certificate_user_id'];
        $updateobj->certificate_types_id = $formData['certificate_types_id'];
        $updateobj->expiry_date          = ($formData['update_status']!=8) ? $expiry_dateStr : NULL;
        $updateobj->attended_date        = ($formData['update_status']==4) ? $attended_dateStr : NULL;
        $updateobj->update_status        = $formData['update_status'];

        if ($updateobj->update_status == 7 &&
            (empty($_FILES['copy_of_certificate']['tmp_name']) OR empty($updateobj->expiry_date))) {
            if ($formData['certificate_expire'] == 'No') $updateobj->certificate_status = 5;
            else                                         $updateobj->certificate_status = 2;
        }
        update_data($updateobj, 'managecertificates');
        $id = $userData->id;
        if ($userData->copy_of_certificate) {
            $file_status = 'nofile';
        } else {
            $file_status = 'file';
        }
    }
    else{
        $obj = new stdClass();
        $obj->certificate_user_id  = $formData['certificate_user_id'];
        $obj->certificate_types_id = $formData['certificate_types_id'];
        $obj->expiry_date          = ($formData['update_status']!=8) ? $expiry_dateStr : NULL;
        $obj->attended_date        = ($formData['update_status']==4) ? $attended_dateStr : NULL;
        $obj->update_status        = $formData['update_status'];
        $id = save_data($obj, 'managecertificates');
    }
}
if (!empty($_FILES['copy_of_certificate']['tmp_name'])){
    $updateobj                      = new stdClass();
    $updateobj->id                  = $id;
    $updateobj->copy_of_certificate = uploadFile('copy_of_certificate', 'training_matrix/managecertificates', $id);
    update_data($updateobj, 'managecertificates');
    $file_status = 'file';
}

// later added this section for color class based on conditioning data
$color_class='';
$txt='';
if ($formData['certificate_expire']=='No') {

    if($formData['update_status']==8)       {$txt = 'No Refresher';            $color_class = 'training-not-required';}
    elseif($formData['update_status']==2)  {$txt = 'Not Held';                 $color_class = 'expired-notheld';}
    elseif($formData['update_status']==3)   {$txt = 'Booked';                  $color_class = 'booked';}
    elseif($formData['update_status']==4)   {$txt = 'Awaiting Certificate';    $color_class = 'awaiting-certificate';}
    else                                    {$txt = 'No Expiration';           $color_class = 'no-action-requrired';}

    $user_certificates = get_certificates_by_user($formData['certificate_user_id'],$formData['certificate_types_id']);

    if ($formData['update_status'] == 7 &&
        (empty($user_certificates[0]->copy_of_certificate) OR empty($expiry_dateStr))) {
        $txt = "Not Held";
        $color_class = "view-certificate expired-notheld";
    }
    elseif($formData['update_status'] == 7){
        $color_class = "view-certificate ".get_certificates_status_colour_coding($user_certificates);
        $txt         = showDateTime($user_certificates[0]->expiry_date,'managecertificatedateonly');
    }

}elseif ($formData['certificate_expire']=='Yes') {

    if($formData['update_status']==8)       {$txt = 'No Refresher';            $color_class = 'training-not-required';}
    elseif($formData['update_status']==2)  {$txt = 'Not Held';                 $color_class = 'expired-notheld';}
    elseif($formData['update_status']==3)   {$txt = 'Booked';                  $color_class = 'booked';}
    elseif($formData['update_status']==4)   {$txt = 'Awaiting Certificate';    $color_class = 'awaiting-certificate';}
    else                                    {$txt = 'Not Held';                $color_class = 'expired-notheld';}


    $user_certificates = get_certificates_by_user($formData['certificate_user_id'],$formData['certificate_types_id']);

    if ($formData['update_status'] == 7 &&
        (empty($user_certificates[0]->copy_of_certificate) OR empty($expiry_dateStr))) {
        $txt = "Not Held";
        $color_class = "view-certificate expired-notheld";
    }
    elseif($formData['update_status'] == 7){
        $color_class = "view-certificate ".get_certificates_status_colour_coding($user_certificates);
        $txt         = showDateTime($user_certificates[0]->expiry_date,'managecertificatedateonly');
    }

}

$json_data=array(
    'expiry_date_view_format'=>  !empty($expiry_dateStr) ? showDateTime($expiry_dateStr,'managecertificatedateonly') : "",
    'attended_date_view_format'=>  ($formData['update_status']==4) ? showDateTime($attended_dateStr,'managecertificatedateonly') : "",
    'copy_of_certificate'=>$file_status,
    'txt'=>$txt,
    'color_class'=>$color_class
);

echo json_encode($json_data);
die;
