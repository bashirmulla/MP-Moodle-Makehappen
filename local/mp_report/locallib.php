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
 * @package    local_mp_report
 * @copyright  2018 EEG
 * @author     MP
 */

defined('MOODLE_INTERNAL') || die;
require_once(dirname(__FILE__).'/classes/sampleimage.php');  // Include form.
function get_userInfo($data){
    global $DB, $USER;;
    return $DB->get_record('user',$data);


}


function encrypt($string) {
    global $CFG;
    $output = false;



    $ivlen          = openssl_cipher_iv_length($CFG->cipher);
    $iv             = openssl_random_pseudo_bytes($ivlen);

    $ciphertext_raw = openssl_encrypt($string, $CFG->cipher, $CFG->key, $options=OPENSSL_RAW_DATA, $iv);
    $hmac           = hash_hmac('sha256', $ciphertext_raw, $CFG->key, $as_binary=true);
    $output         = base64_encode( $iv.$hmac.$ciphertext_raw );


    return $output;
}

function decrypt($string) {
    global $CFG;
    $original_plaintext = NULL;

    $c     = base64_decode($string);
    $ivlen = openssl_cipher_iv_length($CFG->cipher);
    $iv    = substr($c, 0, $ivlen);
    $hmac  = substr($c, $ivlen, $sha2len=32);

    $ciphertext_raw     = substr($c, $ivlen+$sha2len);
    $original_plaintext = openssl_decrypt($ciphertext_raw, $CFG->cipher, $CFG->key, $options=OPENSSL_RAW_DATA, $iv);

    $calcmac = hash_hmac('sha256', $ciphertext_raw, $CFG->key, $as_binary=true);

    return $original_plaintext;

}

function uploadFile2($filename,$custom_file_path,$id){

    global $CFG;
    $url = $CFG->dirroot.'/accident_riddor_files';
    if(isset($_FILES[$filename])){

        if (!file_exists("$url/$id/")) {
            mkdir("$url/$id/", 0777, true);
        }
        $name = basename($_FILES[$filename]["name"]);
        $name_arr = explode('.', $name);
        $name = current($name_arr);
        $ext = end($name_arr);
        $custom_name = $name.time();
        $name = $custom_name.'.'.$ext;


        move_uploaded_file($_FILES[$filename]['tmp_name'], "$url/$id/$name");

        $target_file =  "/accident_riddor_files/$id/$name";

        return $target_file;

    }
    return null;

}


function uploadFile($filename,$report_type,$id){

    global $CFG;
    $url = $CFG->dataroot.'/filedir/upload';
    if(isset($_FILES[$filename])){

        list($width, $height, $type, $attr) = getimagesize($_FILES[$filename]['tmp_name']);

        $max_width  = 800;
        $max_height = 800;
        //scaling factors
        $xRatio = $max_width / $width;
        $yRatio = $max_height / $height;

        //calculate the new width and height
        if($width <= $max_width && $height <= $max_height)    //image does not need resizing
        {
            $toWidth     = $width;
            $toHeight     = $height;
        }
        else if($xRatio * $height < $max_height)
        {
            $toHeight = round($xRatio * $height);
            $toWidth  = $max_width;
        }
        else
        {
            $toWidth = round($yRatio * $width);
            $toHeight  = $max_height;
        }

        $exif = exif_read_data($_FILES[$filename]['tmp_name']);



        $file_ext=strtolower(end(explode('.',$_FILES[$filename]['name'])));
        if (!file_exists("$url/$report_type/$id")) {
            mkdir("$url/$report_type/$id", 0777, true);
        }

        $target_file =  "$report_type/$id/$filename".".".$file_ext;

        $image = new simpleimage();


        $image->load($_FILES[$filename]['tmp_name']);



        $image->resize($toWidth,$toHeight,$exif['Orientation']);

        $image->save("$url/$report_type/$id/$filename".".".$file_ext);

        return $target_file;

    }
    return null;

}

function createDropdown($option){
    $retrun = array();
    $retrun[""] = "--Select--";

    if(!empty($option)){
        foreach ($option as $key=>$value) {
            $retrun[$key] = $value;
        }
    }
    return $retrun;
}

function get_dropdown_data($report_id,$dropdown_name=null){
    global $DB, $USER;
    $query     = array('field_status'=>1);
    $dropdown  = array();
    $tableName = 'standing_table';

    if(!empty($report_id))   $query['report_id']       = $report_id;
    if(!empty($dropdown_name)) $query['dropdown_name'] = $dropdown_name;

    $result = $DB->get_records($tableName, $query);

    if(!empty($result)){
        foreach ($result as $data){

            $dropdown[$data->dropdown_name][$data->id] = $data->field_value;
        }
    }

    return $dropdown;


}

function is_admin(){
    global $CFG, $USER;

    $admins = explode(",",$CFG->siteadmins);

    if(in_array($USER->id,$admins)) return 1;

    return 0;

}

function is_manager(){
    global $DB, $USER;
    $context = get_context_instance (CONTEXT_SYSTEM);
    $roles = get_user_roles($context, $USER->id, false);

    if(!empty($roles)){
        foreach ($roles as $role){
            if($role->shortname == 'manager') return 1;
        }
    }

    return 0;

}

function is_senior_manager($user_id=null){
    global $DB, $USER;
    $context = get_context_instance (CONTEXT_SYSTEM);
    $roles = get_user_roles($context, $user_id ? $user_id : $USER->id, false);

    //echo "<pre>";
    //print_r($roles);
    //echo "</pre>";

    if(!empty($roles)){
        foreach ($roles as $role){
            if($role->shortname == 'seniormanager') return 1;
        }
    }

    return 0;

}

function is_complieance($user_id=null){
    global $DB, $USER;
    $context = get_context_instance (CONTEXT_SYSTEM);
    $roles = get_user_roles($context, $user_id ? $user_id : $USER->id, false);

    if(!empty($roles)){
        foreach ($roles as $role){
            if($role->shortname == 'compliancemanager') return 1;
        }
    }

    return 0;

}



function get_com_manager_list(){
    global $DB,$USER;

    $arr =  array();

    $sql = "SELECT u.* ,CONCAT(u.firstname, ' ', u.lastname) AS name
              FROM {user} u LEFT JOIN {role_assignments} ra ON (u.id = ra.userid)
              LEFT JOIN {role} r ON (ra.roleid=r.id)
             WHERE   r.shortname='manager' ORDER BY name ASC";

    $data = $DB->get_records_sql($sql);

    if(!empty($data)){
        foreach ($data as $value){
            //if(!is_senior_manager($value->id)  and !is_complieance($value->id)) /* BM commented-out due to MOOD-187 */
            $arr[$value->id] = $value->name;

        }
    }

    return $arr;
}

function get_hs_manager_list(){
    global $DB,$USER;
    $arr =  array();

    $sql = "SELECT u.id ,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u 
            LEFT JOIN {role_assignments} ra ON (u.id = ra.userid)
            LEFT JOIN {role} r ON (ra.roleid=r.id)
           WHERE r.shortname='manager' AND (r.shortname!='seniormanager' OR r.shortname!='compliancemanager') AND u.deleted = 0 AND u.id NOT IN (SELECT user_id FROM {h_s_manager_standing_table}) ORDER BY  name ASC ";

    $data = $DB->get_records_sql($sql);
    if(!empty($data)){
        foreach ($data as $value){
            $arr[$value->id] = $value->name;
        }
    }
    return $arr;
}


function get_user_list_not_in_manager_list(){
    global $DB,$USER;
    $arr =  array();
    $sql = "SELECT u.id ,CONCAT(u.firstname, ' ', u.lastname) AS name FROM  {h_s_manager_standing_table} as hs
            LEFT JOIN  {user} u  ON (u.id=hs.user_id) WHERE u.deleted = 0 ORDER BY name ASC";
    $data = $DB->get_records_sql($sql);
    if(!empty($data)){
        foreach ($data as $value){
            $arr[$value->id] = $value->name;
        }
    }
    return $arr;
}



function get_manager_list_object(){
    global $DB,$USER;
    $arr =  array();
    $sql = "SELECT u.* ,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u 
            LEFT JOIN {role_assignments} ra ON (u.id = ra.userid)
           WHERE ra.roleid IN(9,10) AND u.deleted = 0 AND u.id NOT IN (SELECT user_id FROM {h_s_manager_standing_table}) ORDER BY name ASC";
    $data = $DB->get_records_sql($sql);

    return $data;
}

/*
function get_manager_list_object(){
    global $DB,$USER;

    $arr =  array();

    $sql = "SELECT u.* ,CONCAT(u.firstname, ' ', u.lastname) AS name
              FROM {user} u LEFT JOIN {role_assignments} ra ON (u.id = ra.userid)
             WHERE ra.roleid IN(1)  AND ra.roleid NOT IN(9,10) ORDER BY name ASC";

    $data = $DB->get_records_sql($sql);

    return $data;
}
*/

function get_s_manager_and_complience_list_object()
{
    global $DB, $USER;

    $arr = array();

    $sql = "SELECT u.id ,CONCAT(u.firstname, ' ', u.lastname) AS name
              FROM {user} u LEFT JOIN {role_assignments} ra ON (u.id = ra.userid)
             WHERE ra.roleid IN(9,10) ORDER BY name ASC";

    $data = $DB->get_records_sql($sql);

    return $data;
}

function get_s_manager_and_complience_list(){
    global $DB,$USER;

    $arr =  array();

    $sql = "SELECT u.id ,CONCAT(u.firstname, ' ', u.lastname) AS name
              FROM {user} u LEFT JOIN {role_assignments} ra ON (u.id = ra.userid)
             WHERE ra.roleid IN(9,10) ORDER BY name ASC";

    $data = $DB->get_records_sql($sql);

    if(!empty($data)){
        foreach ($data as $value){
            if(is_senior_manager($value->id)  or is_complieance($value->id))
                $arr[$value->id] = $value->name;

        }
    }

    return $arr;
}


function get_compliance_list(){
    global $DB,$USER;

    $arr =  array();

    $sql = "SELECT u.id ,CONCAT(u.firstname, ' ', u.lastname) AS name
              FROM {user} u LEFT JOIN {role_assignments} ra ON (u.id = ra.userid)
             WHERE ra.contextid=1 and ra.roleid IN(1)  AND ra.roleid NOT IN(9,10) ORDER BY name ASC";

    $data = $DB->get_records_sql($sql);

    if(!empty($data)){
        foreach ($data as $value){
            if(is_complieance($value->id))
                $arr[$value->id] = $value->name;

        }
    }

    return $arr;
}

function get_user_role(){
    global $DB, $USER;
    $context = get_context_instance (CONTEXT_SYSTEM);
    $roles = get_user_roles($context, $USER->id, false);

    $role = key($roles);

    return $roleid = $roles[$role]->roleid;


}

function get_request($fieldName){

    if(isset($_REQUEST[$fieldName])){
        return trim($_REQUEST[$fieldName]);
    }

    return null;
}

function save_data($data,$table){
    global $DB, $USER;

    if(empty($data->id)) {
        $data->user_id    = $USER->id;
        $data->created_at = time();
        return $DB->insert_record($table, $data, $returnid = true, $bulk = false);
    }
    else{
        $data->updated_at   = time();
        $DB->update_record($table, $data);
        return $data->id;
    }
}

function api_save_data($data,$table){
    global $DB, $USER;

    if(empty($data['id'])) {
        $data['created_at'] = time();
        return $DB->insert_record($table, $data, $returnid = true, $bulk = false);
    }
    else{
        $data['manager_id']  = $USER->id;
        $data['updated_at']  = time();
        $DB->update_record($table, $data);
        return $data['id'];
    }
}

function get_data($data,$table){
    global $DB, $USER;;
    return $DB->get_record($table,$data);


}

function get_datas($data,$table){
    global $DB, $USER;;
    return $DB->get_records($table,$data);


}


function update_data($data,$table){
    global $DB, $USER;
    return $DB->update_record($table,$data);
}

function checkWitness($fields)
{
    $retrunArr = [];
    if (!empty($fields['accident_witnesses']) && $fields['accident_witnesses']==1) {

        if(empty($fields['witnesses_name'])) $retrunArr =  array_merge(array('witnesses_name' => 'Required'));
        if(empty($fields['witnesses_address'])) $retrunArr =  array_merge(array('witnesses_address' => 'Required'));
        if(empty($fields['witnesses_phone_number'])) $retrunArr =  array_merge(array('witnesses_name' => 'Required'));
        if(empty($fields['witnesses_report_date'])) $retrunArr =  array_merge(array('witnesses_name' => 'Required'));
        if(empty($fields['witnesses_report_details'])) $retrunArr =  array_merge(array('witnesses_name' => 'Required'));
        //if(empty($_FILES['witnesses_report_diagram']['name'])) $retrunArr =  array_merge(array('witnesses_report_diagram' => 'Required'));

        return $retrunArr;
    }
    return true;
}

function accidentDateRequired($fields)
{
    $retrunArr = [];
    if (!empty($fields['s_mgt_rpt_a_b_completed']) && $fields['s_mgt_rpt_a_b_completed']==1) {
        if(empty($fields['s_mgt_rpt_a_b_cpt_date'])) $retrunArr =  array_merge(array('s_mgt_rpt_a_b_cpt_date' => 'Required'),$retrunArr);
    }

    if (!empty($fields['s_mgt_rpt_2508_completed']) && $fields['s_mgt_rpt_2508_completed']==1) {
        if(empty($fields['s_mgt_rpt_2508_cpt_date'])) $retrunArr =  array_merge(array('s_mgt_rpt_2508_cpt_date' => 'Required'),$retrunArr);
    }

    if (!empty($fields['s_mgt_rpt_2508_completed']) && $fields['s_mgt_rpt_2508_completed']==1) {
        if(empty($fields['s_mgt_rpt_riddor_event_clf'])) $retrunArr =  array_merge(array('s_mgt_rpt_riddor_event_clf' => 'Required'),$retrunArr);
    }

    if (!empty($fields['s_mgt_rpt_reported_en_a']) && $fields['s_mgt_rpt_reported_en_a']==1) {
        if(empty($fields['s_mgt_rpt_reported_en_a_date'])) $retrunArr =  array_merge(array('s_mgt_rpt_reported_en_a_date' => 'Required'),$retrunArr);
    }

    if (!empty($fields['s_mgt_rpt_sr_mgr_notified']) && $fields['s_mgt_rpt_sr_mgr_notified']==1) {
        if(empty($fields['s_mgt_rpt_sr_mgr_notified_date'])) $retrunArr =  array_merge(array('s_mgt_rpt_sr_mgr_notified_date' => 'Required'),$retrunArr);
    }

    //if (!empty($fields['s_mgt_rpt_in_br_informed']) && $fields['s_mgt_rpt_in_br_informed']==1) {
    //    if(empty($fields['s_mgt_rpt_in_br_informed_date'])) $retrunArr =  array_merge(array('s_mgt_rpt_in_br_informed_date' => 'Required'),$retrunArr);
    //}
    if (!empty($fields['s_mgt_rpt_ant_closed_off']) && $fields['s_mgt_rpt_ant_closed_off']==1) {
        if(empty($fields['s_mgt_rpt_ant_closed_off_date'])) $retrunArr =  array_merge(array('s_mgt_rpt_ant_closed_off_date' => 'Required'),$retrunArr);
    }


    if(!empty($retrunArr)) return $retrunArr;
    return true;
}


function accidentManagerVaidations($fields)
{
    $retrunArr = [];

    if (!empty($fields['lost_time']) && $fields['lost_time']=='Yes') {
        if(empty($fields['lost_time_days'])) $retrunArr =  array_merge(array('lost_time_days' => 'Required'));
    }

    if (!empty($fields['accident_additional_details']) && $fields['accident_additional_details']=='Yes') {
        if(empty($fields['additional_details'])) $retrunArr =  array_merge(array('additional_details' => 'Required'));
    }


    if(!empty($retrunArr)) return $retrunArr;
    return true;
}

function accidentSeniorManagerVaidations($fields)
{
    $retrunArr = [];

    if (!empty($fields['s_mgt_rpt_riddor_event_clf']) && $fields['s_mgt_rpt_riddor_event_clf']==17) {
        if(empty($fields['riddor_subcategory'])) $retrunArr =  array_merge(array('riddor_subcategory' => 'Required'));
    }

    if (!empty($fields['s_mgt_rpt_riddor_event_clf']) && $fields['s_mgt_rpt_riddor_event_clf']==20) {
        if(empty($fields['riddor_subcategory'])) $retrunArr =  array_merge(array('riddor_subcategory' => 'Required'));
    }

    if (!empty($fields['s_mgt_rpt_riddor_event_clf']) && $fields['s_mgt_rpt_riddor_event_clf']==21) {
        if(empty($fields['riddor_subcategory'])) $retrunArr =  array_merge(array('riddor_subcategory' => 'Required'));
    }


    if(!empty($retrunArr)) return $retrunArr;
    return true;
}


function incidentVaidations($fields)
{
    $retrunArr = [];


    if (!empty($fields['is_correct_report_category']) && $fields['is_correct_report_category']=='No') {
        if(empty($fields['correct_report_category'])) $retrunArr =  array_merge(array('correct_report_category' => 'Required'));
    }
    if (!empty($fields['correct_report_category']) && $fields['correct_report_category']!=31) {
        if(empty($fields['classification'])) $retrunArr =  array_merge(array('classification' => 'Required'));
    }



    if (!empty($fields['correct_report_category']) && $fields['correct_report_category']==31) {
        if(empty($fields['categorisation'])) $retrunArr =  array_merge(array('categorisation' => 'Required'));
    }

    if (!empty($fields['correct_report_category']) && $fields['correct_report_category']==31 && $fields['categorisation']==43) {
        if(empty($fields['vehicles'])) $retrunArr =  array_merge(array('vehicles' => 'Required'));
    }

    if (!empty($fields['correct_report_category']) && $fields['correct_report_category']==31 && $fields['categorisation']==44) {
        if(empty($fields['equipment'])) $retrunArr =  array_merge(array('equipment' => 'Required'));
    }

    if (!empty($fields['correct_report_category']) && $fields['correct_report_category']==31 && $fields['categorisation']==45) {
        if(empty($fields['environmental'])) $retrunArr =  array_merge(array('environmental' => 'Required'));
    }

    if (!empty($fields['correct_report_category']) && $fields['correct_report_category']==31 && $fields['categorisation']==46) {
        if(empty($fields['attack'])) $retrunArr =  array_merge(array('attack' => 'Required'));
    }

    if (!empty($fields['report_to_client']) && $fields['report_to_client']==56) {
        if(empty($fields['report_priority'])) $retrunArr =  array_merge(array('report_priority' => 'Required'));
    }

    if (!empty($fields['report_priority']) && $fields['report_priority']==48) {
        if(empty($fields['contact_details'])) $retrunArr =  array_merge(array('contact_details' => 'Required'));
    }

    if (!empty($fields['lost_time']) && $fields['lost_time']=='Yes') {
        if(empty($fields['lost_time_days'])) $retrunArr =  array_merge(array('lost_time_days' => 'Required'));
    }

    if(!empty($retrunArr)) return $retrunArr;
    return true;
}

function send_mp_report_email($from, $subject, $message, $attachment_path, $file_name,$report_title) {

    $toUsers = array();

    $emailOb1 = get_datas(array("contact" =>1),"report_table_emaildata");
    $emailOb2 = get_datas(array("contact" =>2),"report_table_emaildata");



    foreach ($emailOb1 as $email1) {
        $to = new stdClass();
        $to->email = $email1->email;
        $to->firstname = $email1->firstname;
        $to->lastname = $email1->lastname;


        $to->maildisplay = true;
        $to->mailformat = 1;
        $to->id = -99;
        $isSent = email_to_user($to, $from, $subject, '', $message, $attachment_path, $report_title . ".pdf", true);
    }

    foreach ($emailOb2 as $email2) {
        $to2 = new stdClass();
        $to2->email = $email2->email;
        $to2->firstname = $email2->firstname;
        $to2->lastname = $email2->lastname;


        $to2->maildisplay = true;
        $to2->mailformat = 1;
        $to2->id = -98;

        $isSent = email_to_user($to2, $from, $subject, '', $message, $attachment_path, $report_title . ".pdf", true);
    }

    if (file_exists(pdfs_path().$file_name)) {
        unlink(pdfs_path().$file_name);
    }
    return $isSent;
}

function send_email_to_client($contact_id,$from, $subject, $message, $attachment_path, $file_name,$report_title) {


    $user = get_data(array("contact" => $contact_id),"report_table_emaildata");


    if(empty($user) OR empty($user->email)) return null;

    $to              = new stdClass();
    $to -> email     = $user->email;
    $to -> firstname = $user->firstname;
    $to -> lastname  = $user->lastname;

    $to -> maildisplay = true;
    $to -> mailformat  = 1;
    $to -> id          = -97;
    $isSent = email_to_user($to, $from, $subject, '', $message, $attachment_path, $report_title.".pdf", true);


    return $isSent;
}

function send_email_to_manager($manager_id,$from, $subject, $message, $attachment_path, $file_name,$report_title) {

    $manager = get_userInfo( array("id" => $manager_id ));

    $to              = new stdClass();
    $to -> email     = $manager->email;
    $to -> firstname = $manager->firstname;
    $to -> lastname  = $manager->lastname;

    $to -> maildisplay = true;
    $to -> mailformat  = 1;
    $to -> id          = $manager->id;
    $isSent = email_to_user($to, $from, $subject, '', $message, $attachment_path, $report_title.".pdf", true);


    return $isSent;
}

function pdfs_path() {
    global $CFG;
    if(!file_exists($CFG->dataroot.'/filedir/pdfs/')) {

        mkdir($CFG->dataroot.'/filedir/pdfs/',0777,true);

    }
    return $CFG->dataroot.'/filedir/pdfs/';
}

function pdfs_email_attachment() {

    return 'filedir/pdfs/';
}
function pdfs_url() {
    global $CFG;
    return $CFG->dataroot.'/filedir/pdfs/';
}


function new_training_eamil($user,$course)
{
    global $CFG;
    $form = new \stdClass;
    $form->email        = "notify@www.makehappengroup.co.uk";
    $form->firstname    = "EEG";
    $form->lastname     = "";
    $form->maildisplay  = true;
    $form->mailformat   = 1;
    $form->id           = -99;

    $courselink   = $CFG->wwwroot . "/course/view.php?id=" . $course->id;
    $emailbody    =  "Hi ".fullname($user)."\n\nYou are enrolled to ".strtoupper($course->fullname)." which is now open, Please login to start your course.
                               \nURL: ".$courselink."
                               \n\nThanks, Admin";

    email_to_user($user, $form, "Course Notification", $emailbody);

}

function get_requests()
{
    $retArr = array();
    foreach ($_REQUEST as $key => $data) {
        if (!empty($data)) {

            $retArr[$key] = $data;
        }

    }
    return $retArr;
}


function physical_toolbox_talk_notification_email($user,$course)
{
    global $CFG,$USER,$DB;
    $form = new \stdClass;
    $form->email        = "notify@www.makehappengroup.co.uk";
    $form->firstname    = "EEG";
    $form->lastname     = "";
    $form->maildisplay  = true;
    $form->mailformat   = 1;
    $form->id           = -99;

    $courselink   = $CFG->wwwroot . "/course/view.php?id=" . $course->id;
    $emailbody    =  "Hi ".fullname($user)."\n\nPlease confirm attendance of Toolbox Talk session by accessing the following course.
                               \nURL: ".$courselink."
                               \n\nThanks, Admin";

    $emailbodyhtml    =  "Hi ".fullname($user)."<br>Please confirm attendance of Toolbox Talk session by accessing the following course.
                               <br><br>URL: <a href='".$courselink."'>".$courselink."</a>
                               <br><br>Thanks, Admin";


    $message = new \stdClass();
    $message->component         = 'mod_quiz'; //your component name
    $message->name              = 'submission'; //this is the message name from messages.php
    $message->userfrom          = $USER;
    $message->userto            = $user;
    $message->subject           = "Physical Toolbox Talk Confirmation required";
    $message->fullmessage       = $emailbody;
    $message->fullmessageformat = FORMAT_HTML;
    $message->fullmessagehtml   = $emailbodyhtml;
    $message->smallmessage      = '';
    $message->notification      = 1; //this is only set to 0 for personal messages between users

    $nt['notificationid']  = message_send($message);

    $DB->insert_record('message_popup_notifications',$nt);



    //email_to_user($user, $form, "Physical Toolbox Talk Confirmation required", $emailbody);

}

function training_course_due_completion_email($user,$course)
{
    global $CFG,$USER,$DB;
    $form = new \stdClass;
    $form->email        = "notify@www.makehappengroup.co.uk";
    $form->firstname    = "EEG";
    $form->lastname     = "";
    $form->maildisplay  = true;
    $form->mailformat   = 1;
    $form->id           = -99;

    $courselink   = $CFG->wwwroot . "/course/view.php?id=" . $course->id;
    $emailbody    =  "Hi ".fullname($user)."\n\nThe following course requires completing by ".date("d-M-Y",$course->duedate)."
                               \nURL: ".$courselink."
                               \n\nThanks, Admin";

    $emailbodyhtml    =  "Hi ".fullname($user)."<br>The following course requires completing by ".date("d-M-Y",$course->duedate)."
                               <br><br>URL: <a href='".$courselink."'>".$courselink."</a>
                               <br><br>Thanks, Admin";

    $message = new \stdClass();
    $message->component         = 'mod_quiz'; //your component name
    $message->name              = 'submission'; //this is the message name from messages.php
    $message->userfrom          = $USER;
    $message->userto            = $user;
    $message->subject           = "Training Course due for completion";
    $message->fullmessage       = $emailbody;
    $message->fullmessageformat = FORMAT_HTML;
    $message->fullmessagehtml   = $emailbodyhtml;
    $message->smallmessage      = '';
    $message->notification      = 1; //this is only set to 0 for personal messages between users

    $nt['notificationid']  = message_send($message);

    $DB->insert_record('message_popup_notifications',$nt);

    //email_to_user($user, $form, "Training Course due for completion", $emailbody);

}

function training_course_due_completion_email_to_manager($manager,$course,$userArr)
{
    global $CFG,$USER,$DB;
    $form = new \stdClass;
    $form->email        = "notify@www.makehappengroup.co.uk";
    $form->firstname    = "EEG";
    $form->lastname     = "";
    $form->maildisplay  = true;
    $form->mailformat   = 1;
    $form->id           = -99;

    $courselink   = $CFG->wwwroot . "/course/view.php?id=" . $course->id;
    $users        = implode("<br>",$userArr);

    $emailbody    =  'The following course requires completing by '.date("d-M-Y",$course->duedate)." URL: <a href='".$courselink."'>".$courselink."</a> by the below users:<br><br>"
                       .$users."\n\nThanks, Admin";


    $emailbodyhtml    =  "The following course requires completing by ".date("d-M-Y",$course->duedate)." URL: <a href='".$courselink."'>".$courselink."</a> by the below users:<br><br>"
                           .$users."      
                           <br><br>Thanks, Admin";

    $message = new \stdClass();
    $message->component         = 'mod_quiz'; //your component name
    $message->name              = 'submission'; //this is the message name from messages.php
    $message->userfrom          = $USER;
    $message->userto            = $manager;
    $message->subject           = "Training Course due for completion by users";
    $message->fullmessage       = $emailbody;
    $message->fullmessageformat = FORMAT_HTML;
    $message->fullmessagehtml   = $emailbodyhtml;
    $message->smallmessage      = '';
    $message->notification      = 1; //this is only set to 0 for personal messages between users

    $nt['notificationid']  = message_send($message);

    $DB->insert_record('message_popup_notifications',$nt);

    //email_to_user($manager, $form, "Training Course due for completion by users", $emailbody);

}

function get_user_api_missing_tokens() {
    global $DB;

    $sql = "SELECT u.id FROM {user} u
            LEFT JOIN {external_tokens} et ON (u.id = et.userid)
            WHERE et.token IS NULL";

    $data = $DB->get_records_sql($sql);

    return $data;
}


function get_accident_report_list()
{
    global $DB, $CFG;
    $form               = new \stdClass;
    $form->email        = "notify@www.makehappengroup.co.uk";
    $form->firstname    = "EEG";
    $form->lastname     = "";
    $form->maildisplay  = true;
    $form->mailformat   = 1;
    $form->id           = -99;




    $sql = " SELECT id,accident_category FROM mdl_accident_report WHERE MONTH(FROM_UNIXTIME(created_at)) = MONTH(CURRENT_TIMESTAMP) ";
    $result = $DB->get_records_sql($sql);
    $acc_received = array();
    foreach ($result as $data )
    {
        $acc_received[$data->accident_category] +=1;
    }

    $sql1   = "SELECT * FROM mdl_high_mp_report_send_notification WHERE month= MONTH(CURRENT_TIMESTAMP) AND year= YEAR(CURRENT_TIMESTAMP)"; // BM changed for MOOD-241
    $result = $DB->get_records_sql($sql1);
    $notificationArr = array();
    foreach ($result as $data )
    {
        $notificationArr[$data->volume_id]=1;
    }


    // 76 = 7    falls_from_height_status = enabled and  falls_from_height >= $acc_received[76]  then goes

    $sql2 = " SELECT * FROM mdl_email_notification_on_high_h_s_report_volumes ";
    $result2 = $DB->get_record_sql($sql2);
    if($result2->act_of_physical_violence_status==1){
        $act_of_physical_violence = $result2->act_of_physical_violence;
        if ($acc_received[74] >= $act_of_physical_violence ){

            $threshold = 'Act of Physical Violence';

            if(!isset($notificationArr[74])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 74;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);


                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $act_of_physical_violence . '
                            Received: ' . $acc_received[74];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->cuts_and_lacerations_status==1){
        $cuts_and_lacerations = $result2->cuts_and_lacerations;

        if ($acc_received[75]>=$cuts_and_lacerations){
            $threshold = 'Cuts and Lacerations';

            if(!isset($notificationArr[75])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 75;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);


                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $cuts_and_lacerations . '
                            Received: ' . $acc_received[75];
                $users = get_manager_list_object();


                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->falls_from_height_status==1){
        $falls_from_height = $result2->falls_from_height;
        if ($acc_received[76]>=$falls_from_height){
            $threshold = 'Falls from a Height';


            if(!isset($notificationArr[76])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 76;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);


                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $falls_from_height . '
                            Received: ' . $acc_received[76];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->manual_handling_status==1){
        $manual_handling = $result2->manual_handling;
        if ($acc_received[77]>=$manual_handling){
            $threshold = 'Manual Handling';

            if(!isset($notificationArr[77])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 77;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);


                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $manual_handling . '
                            Received: ' . $acc_received[77];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->needlestick_injuries_status==1){
        $needlestick_injuries = $result2->needlestick_injuries;
        if ($acc_received[78]>=$needlestick_injuries){
            $threshold = 'Needlestick Injuries';

            if(!isset($notificationArr[78])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 78;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);


                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $needlestick_injuries . '
                            Received: ' . $acc_received[78];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->slips_trips_and_falls_on_same_level_status==1){
        $slips_trips_and_falls_on_same_level = $result2->slips_trips_and_falls_on_same_level;
        if ($acc_received[79]>=$slips_trips_and_falls_on_same_level){
            $threshold = 'Slips, Trips and Falls on same level';

            if(!isset($notificationArr[79])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 79;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);


                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $slips_trips_and_falls_on_same_level . '
                            Received: ' . $acc_received[79];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->struck_by_an_object_status==1){
        $struck_by_an_object = $result2->struck_by_an_object;
        if ($acc_received[80]>=$struck_by_an_object){
            $threshold = 'Struck by an object';

            if(!isset($notificationArr[80])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 80;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);


                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $struck_by_an_object . '
                            Received: ' . $acc_received[80];
                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }



    return $data;
}

function get_incident_report_list()
{
    global $DB, $CFG;
    $form               = new \stdClass;
    $form->email        = "notify@www.makehappengroup.co.uk";
    $form->firstname    = "EEG";
    $form->lastname     = "";
    $form->maildisplay  = true;
    $form->mailformat   = 1;
    $form->id           = -99;

    $sql = "SELECT id,vehicles,equipment,environmental,attack,classification FROM mdl_incident_report WHERE MONTH(FROM_UNIXTIME(created_at)) = MONTH(CURRENT_TIMESTAMP) ";
    $result = $DB->get_records_sql($sql);

    $inci_received = array();
    foreach ($result as $data ){
        if (!empty($data->vehicles)){
            $inci_received[$data->vehicles] +=1;
        }elseif (!empty($data->equipment)){
            $inci_received[$data->equipment] +=1;
        }elseif (!empty($data->environmental)){
            $inci_received[$data->environmental] +=1;
        }elseif (!empty($data->attack)){
            $inci_received[$data->attack] +=1;
        }elseif (!empty($data->classification)){
            $inci_received[$data->classification] +=1;
        }
        else{}
    }
//    print_r($inci_received);
    // 76 = 7    falls_from_height_status = enabled and  falls_from_height >= $acc_received[76]  then goes


    $sql1   = "SELECT * FROM mdl_high_mp_report_send_notification WHERE month= MONTH(CURRENT_TIMESTAMP) AND year= YEAR(CURRENT_TIMESTAMP)"; // BM changed for MOOD-241
    $result = $DB->get_records_sql($sql1);
    $notificationArr = array();
    foreach ($result as $data )
    {
        $notificationArr[$data->volume_id]=1;
    }


    $sql2 = " SELECT * FROM mdl_email_notification_on_high_h_s_report_volumes ";
    $result2 = $DB->get_record_sql($sql2);

    if($result2->animals_status==1){
        $animals = $result2->animals;
        if ($inci_received[33]>=$animals){
            $threshold = 'Animals';

            if(!isset($notificationArr[33])) {

                $dt                    = new \stdClass();
                $dt->volume_name       = $threshold;
                $dt->volume_id         = 33;
                $dt->month             = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $animals . '
                            Received: ' . $inci_received[33];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }

    $TH = 9999;
    if($result2->equipment_issues_status==1){
        $TH = $result2->equipment_issues;
        if ($inci_received[35]>=$TH){
            $threshold = 'Equipment Issues';

            if(!isset($notificationArr[35])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 35;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $TH . '
                            Received: ' . $inci_received[35];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }


    $TH = 9999;
    if($result2->gas_detection_status==1){
        $TH = $result2->gas_detection;
        if ($inci_received[36]>=$TH){
            $threshold = 'Gas Detection';

            if(!isset($notificationArr[36])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 36;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);
                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $TH . '
                            Received: ' . $inci_received[36];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }

    $TH = 9999;
    if($result2->needle_glass_status==1){
        $TH = $result2->needle_glass;
        if ($inci_received[38]>=$TH){
            $threshold = 'Needle/Glass';

            if(!isset($notificationArr[38])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 38;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $TH . '
                            Received: ' . $inci_received[38];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }

    $TH = 9999;
    if($result2->slips_trips_and_falls_status==1){
        $TH = $result2->slips_trips_and_falls;
        if ($inci_received[40]>=$TH){
            $threshold = 'Slips, Trips and Falls';

            if(!isset($notificationArr[40])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 40;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);
                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $TH . '
                            Received: ' . $inci_received[40];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }


    $TH = 9999;
    if($result2->traffic_vehicle_status==1){
        $TH = $result2->traffic_vehicle;
        if ($inci_received[41]>=$TH){
            $threshold = 'Traffic/Vehicle';

            if(!isset($notificationArr[41])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 41;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);
                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $TH . '
                            Received: ' . $inci_received[41];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }

    $TH = 9999;
    if($result2->vegetation_status==1){
        $TH = $result2->vegetation;
        if ($inci_received[42]>=$TH){
            $threshold = 'Vegetation';

            if(!isset($notificationArr[42])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 42;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $TH . '
                            Received: ' . $inci_received[42];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }



    if($result2->vehicle_collision_status==1){
        $vehicle_collision = $result2->vehicle_collision;
        if ($inci_received[59]>=$vehicle_collision){
            $threshold = 'Vehicle > Collision';

            if(!isset($notificationArr[59])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 59;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $vehicle_collision . '
                            Received: ' . $inci_received[59];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->vehicle_near_miss_status==1){
        $vehicle_near_miss = $result2->vehicle_near_miss;
        if ($inci_received[60]>=$vehicle_near_miss){
            $threshold = 'Vehicle > Near Miss';

            if(!isset($notificationArr[60])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 60;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $vehicle_near_miss . '
                            Received: ' . $inci_received[60];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->vehicle_theft_status==1){
        $vehicle_theft = $result2->vehicle_theft;
        if ($inci_received[61]>=$vehicle_theft){
            $threshold = 'Vehicle > Theft';

            if(!isset($notificationArr[61])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 61;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $vehicle_theft . '
                            Received: ' . $inci_received[61];

                $users = get_manager_list();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->vehicle_vandalism_status==1){
        $vehicle_vandalism = $result2->vehicle_vandalism;
        if ($inci_received[62]>=$vehicle_vandalism){
            $threshold = 'Vehicle > Vandalism';

            if(!isset($notificationArr[62])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 62;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $vehicle_vandalism . '
                            Received: ' . $inci_received[62];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->vehicle_general_damage_status==1){
        $vehicle_general_damage = $result2->vehicle_general_damage;
        if ($inci_received[63]>=$vehicle_general_damage){
            $threshold = 'Vehicle > General Damage';

            if(!isset($notificationArr[63])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 63;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $vehicle_general_damage . '
                            Received: ' . $inci_received[63];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->equipment_loss_status==1){
        $equipment_loss = $result2->equipment_loss;
        if ($inci_received[64]>=$equipment_loss){
            $threshold = 'Equipment > Loss';

            if(!isset($notificationArr[64])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 64;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $equipment_loss . '
                            Received: ' . $inci_received[64];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->equipment_theft_status==1){
        $equipment_theft = $result2->equipment_theft;
        if ($inci_received[65]>=$equipment_theft){
            $threshold = 'Equipment > Theft';


            if(!isset($notificationArr[65])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 65;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $equipment_theft . '
                            Received: ' . $inci_received[65];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->equipment_wear_and_tear_status==1){
        $equipment_wear_and_tear = $result2->equipment_wear_and_tear;
        if ($inci_received[66]>=$equipment_wear_and_tear){
            $threshold = 'Equipment > Wear and Tear';

            if(!isset($notificationArr[66])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 66;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $equipment_wear_and_tear . '
                            Received: ' . $inci_received[66];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->environmental_flooding_internal_status==1){
        $environmental_flooding_internal = $result2->environmental_flooding_internal;
        if ($inci_received[68]>=$environmental_flooding_internal){
            $threshold = 'Environmental > Flooding - Internal';

            if(!isset($notificationArr[68])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 68;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $environmental_flooding_internal . '
                            Received: ' . $inci_received[68];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->environmental_flooding_external_status==1){
        $environmental_flooding_external = $result2->environmental_flooding_external;
        if ($inci_received[69]>=$environmental_flooding_external){
            $threshold = 'Environmental > Flooding - External';

            if(!isset($notificationArr[69])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 69;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $environmental_flooding_external . '
                            Received: ' . $inci_received[69];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->environmental_contamination_status==1){
        $environmental_contamination = $result2->environmental_contamination;
        if ($inci_received[70]>=$environmental_contamination){
            $threshold = 'Environmental > Contamination';

            if(!isset($notificationArr[70])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 70;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $environmental_contamination . '
                            Received: ' . $inci_received[70];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->environmental_fly_tipping_status==1){
        $environmental_fly_tipping = $result2->environmental_fly_tipping;
        if ($inci_received[71]>=$environmental_fly_tipping){
            $threshold = 'Environmental > Fly Tipping';

            if(!isset($notificationArr[71])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 71;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $environmental_fly_tipping . '
                            Received: ' . $inci_received[71];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->attack_abusive_verbal_status==1){
        $attack_abusive_verbal_status = $result2->attack_abusive_verbal;
        if ($inci_received[72]>=$attack_abusive_verbal_status){
            $threshold = 'Attack > Abusive/Verbal';

            if(!isset($notificationArr[72])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 72;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $attack_abusive_verbal_status . '
                            Received: ' . $inci_received[72];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }
    if($result2->attack_animal_attack_status==1){
        $attack_animal_attack = $result2->attack_animal_attack;
        if ($inci_received[73]>=$attack_animal_attack){
            $threshold = 'Attack > Animal Attack';

            if(!isset($notificationArr[73])) {

                $dt = new \stdClass();
                $dt->volume_name = $threshold;
                $dt->volume_id = 73;
                $dt->month = date("n");
                $dt->year = date("Y"); // BM added MOOD-241
                $dt->send_notification = "Yes";
                $DB->insert_record('high_mp_report_send_notification', $dt);

                $email_title = 'Threshold reached for ' . $threshold;
                $email_body = 'The monthly threshold for ' . $threshold . ' has been reached for month. Please review and consider whether additional action is required. 
                            Threshold: ' . $attack_animal_attack . '
                            Received: ' . $inci_received[73];

                $users = get_manager_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }

                $users = get_s_manager_and_complience_list_object();
                foreach ($users as $user) {
                    email_to_user($user, $form, $email_title, $email_body);
                }
            }
        }
    }

    return $data;
}
