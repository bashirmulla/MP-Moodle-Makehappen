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
 * @package    local_training_matrix
 * @copyright  2018 makehappen.com
 * @author     Bash & SAM Harun
 */

defined('MOODLE_INTERNAL') || die;
require_once(dirname(__FILE__).'/classes/sampleimage.php');  // Include form.

function get_userInfo($data){
    global $DB, $USER;;
    return $DB->get_record('user',$data);


}
function uploadFile($filename,$custom_file_path,$id){

    global $CFG;
    $url = $CFG->dirroot.'/training_matrix_certificates';
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

        $target_file =  "/training_matrix_certificates/$id/$name";

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


function is_training_admin($user_id=null){
    global $DB, $USER;
    $context = get_context_instance (CONTEXT_SYSTEM);
    $roles = get_user_roles($context, $user_id ? $user_id : $USER->id, false);

    if(!empty($roles)){
        foreach ($roles as $role){
            if($role->shortname == 'trainingmatrixadmin') return 1;
        }
    }

    return 0;

}



function get_manager_list(){
    global $DB,$USER;

    $arr =  array();

    $sql = "SELECT u.* ,CONCAT(u.firstname, ' ', u.lastname) AS name
              FROM {user} u LEFT JOIN {role_assignments} ra ON (u.id = ra.userid)
             WHERE ra.roleid IN(1)  AND ra.roleid NOT IN(9,10) ORDER BY name ASC";

    $data = $DB->get_records_sql($sql);

    if(!empty($data)){
        foreach ($data as $value){
            //if(!is_senior_manager($value->id)  and !is_complieance($value->id)) /* BM commented-out due to MOOD-187 */
            $arr[$value->id] = $value->name;

        }
    }

    return $arr;
}


function get_manager_list_object(){
    global $DB,$USER;

    $arr =  array();

    $sql = "SELECT u.* ,CONCAT(u.firstname, ' ', u.lastname) AS name
              FROM {user} u LEFT JOIN {role_assignments} ra ON (u.id = ra.userid)
             WHERE ra.roleid IN(1)  AND ra.roleid NOT IN(9,10) ORDER BY name ASC";

    $data = $DB->get_records_sql($sql);

    return $data;
}

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
    global $DB, $USER;
    return $DB->get_record($table,$data);


}

function get_datas($data,$table){
    global $DB;
    return $DB->get_records($table,$data);


}


function update_data($data,$table){
    global $DB, $USER;
    return $DB->update_record($table,$data);
}


function send_training_matrix_email($from, $subject, $message, $attachment_path, $file_name,$report_title) {

    $toUsers = array();

    $email1 = get_data(array("contact" =>1),"report_table_emaildata");
    $email2 = get_data(array("contact" =>2),"report_table_emaildata");

    $to = new stdClass();

    $to -> email = $email1->email;
    $to -> firstname = $email1->firstname;
    $to -> lastname = $email1->lastname;


    $to -> maildisplay = true;
    $to -> mailformat = 1;
    $to -> id = -99;
    $isSent = email_to_user($to, $from, $subject, '', $message, $attachment_path, $report_title.".pdf", true);


    $to2 = new stdClass();

    $to2 -> email = $email2->email;
    $to2 -> firstname = $email2->firstname;
    $to2 -> lastname = $email2->lastname;


    $to2 -> maildisplay = true;
    $to2 -> mailformat = 1;
    $to2 -> id = -98;

    $isSent = email_to_user($to2, $from, $subject, '', $message, $attachment_path, $report_title.".pdf", true);

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


function get_certificate_data() {
    global $DB;

    $sql = "SELECT MC.*, C.certificate_name,C.number_of_months,C.certificate_expire FROM {managecertificates} AS MC LEFT JOIN {certificate_types} AS C ON (MC.certificate_types_id=C.id)";

    $data = $DB->get_records_sql($sql);

    return $data;
}


function send_training_notification($crd)
{
    global $DB, $CFG;
    $form               = new \stdClass;
    $form->email        = "notify@makehappen.com";
    $form->firstname    = "MP";
    $form->lastname     = "";
    $form->maildisplay  = true;
    $form->mailformat   = 2;
    $form->id           = -99;


    $user    = get_userInfo(['id' => $crd->certificate_user_id]);
    $manager = get_userInfo(['id' => $user->manager_id]);


    $email_title = 'Training Certificate Requires Attention';
    $email_body = 'The following certificate requires attention:<br>
                   <table width="100%">
                        <th>
                           <td>User</td> 
                           <td>Manager</td> 
                           <td>Certificate name</td> 
                           <td>Expiry date (if applicable)</td> 
                        </th>
                        <tr>
                           <td>'.$user->firstname.' '.$user->lastname.'</td> 
                           <td>'.$manager->firstname.' '.$manager->lastname.'</td> 
                           <td>'.$crd->certificate_name.'</td> 
                           <td>'.date("d-M-Y",$crd->expiry_date).'</td> 
                        </tr>
                   </table>';
    email_to_user($user, $form, $email_title, $email_body);

}


function send_training_notification_manager($manager_usercer_arr)
{
    global $DB, $CFG;
    $form               = new \stdClass;
    $form->email        = "notify@makehappen.com";
    $form->firstname    = "MP";
    $form->lastname     = "";
    $form->maildisplay  = true;
    $form->mailformat   = 1;
    $form->id           = -99;




    if (!empty($manager_usercer_arr)) {
        foreach ($manager_usercer_arr as $manager=>$usercer) {
            $manager = get_userInfo(['id' => $manager]);
            $usercer_arr = explode('_',$usercer);
            $user    = get_userInfo(['id' => $usercer_arr[0]]);

            $user_certificates = get_certificates_by_user($usercer_arr[0],$usercer_arr[1]);

            $expd = !empty($user_certificates[0]->expiry_date) ? date("d-M-Y", $user_certificates[0]->expiry_date): "N/A";

            $email_title = 'Training Certificate Requires Attention';
            $email_body = 'The following certificate requires attention:<br><br>
                   <table border="1" cellpadding="2" width="100%">
                        <th>
                           <td>User</td> 
                           <td>Manager</td> 
                           <td>Certificate name</td> 
                           <td>Expiry date (if applicable)</td> 
                        </th>
                        <tr>
                           <td>' . $user->firstname . ' ' . $user->lastname . '</td> 
                           <td>' . $manager->firstname . ' ' . $manager->lastname . '</td> 
                           <td>' . $user_certificates[0]->certificate_name . '</td> 
                           <td>' .$expd. '</td> 
                        </tr>
                   </table><br><br>';
            email_to_user($user, $form, $email_title, null,$email_body);
        }
    }

}


function send_certificate_notification($crt1,$status=null)
{
    global $DB, $CFG;
    $form               = new \stdClass;
    $form->email        = "notify@makehappen.com";
    $form->firstname    = "MP";
    $form->lastname     = "";
    $form->maildisplay  = true;
    $form->mailformat   = 1;
    $form->id           = -99;




    $user        = get_userInfo(['id' => $crt1->certificate_user_id]);
    $manager     = get_userInfo(['id' => $user->manager_id]);
    $cert_status = certificates_status();

    $st   = !empty($status) ? $status : $cert_status[$crt1->certificate_status];
    $expd = !empty($crt1->expiry_date) ? date("d-M-Y",$crt1->expiry_date): "N/A";

    $email_title = 'Training Certificate Requires Attention';
    $email_body = 'The following certificate requires attention:<br><br>
                   <table border=1 cellpadding=2 width=100%>
                        <tr>
                           <td>User</td> 
                           <td>Manager</td> 
                           <td>Certificate name</td> 
                           <td>Status</td> 
                           <td>Expiry date (if applicable)</td> 
                        </tr>
                        <tr>
                           <td>'.$user->firstname.' '.$user->lastname.'</td> 
                           <td>'.$manager->firstname.' '.$manager->lastname.'</td> 
                           <td>'.$crt1->certificate_name.'</td> 
                           <td>'.$st.'</td> 
                           <td>'. $expd.'</td> 
                        </tr>
                   </table>';


    email_to_user($user, $form, $email_title, null,$email_body);

}

/**
 *
 * @param string $sort An SQL field to sort by
 * @param string $dir The sort direction ASC|DESC
 * @param int $page The page or records to return
 * @param int $recordsperpage The number of records to return per page
 * @param string $search A simple string to search for
 * @return array Array of {@link $certificate_types} records
 */
function get_certificate_types_listing($sortorder='', $dir='ASC',$where=null, $page=0, $recordsperpage=0,$search='') {
    global $DB;

    if ($sortorder) {
        $sortorder = " ORDER BY $sortorder $dir";
    }

    if ($where) {
        $where = " WHERE $where ";
    }
    else{
        $where = " WHERE 1 ";
    }
    return $DB->get_records_sql("SELECT * FROM {certificate_types}  $where $sortorder", null, 0, 0);
}

function get_system_user_list(){
    global $DB,$USER,$CFG;
    $arr =  array();
    $sql = "SELECT u.id ,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u WHERE u.deleted = 0 ORDER BY name ASC";
    $data = $DB->get_records_sql($sql);
    if(!empty($data)){
        $arr[""]   = "--SELECT--";
        foreach ($data as $value){
            if(in_array($value->id,$CFG->not_genuine_user)) continue;
            $arr[$value->id] = $value->name;
        }
    }

    return $arr;
}

function certificatetype_dropdown_list(){
    global $CFG;
    $data = get_certificate_types_listing('sortorder','ASC',"status=1");;
    $arr =  array();
    if(!empty($data)){
        foreach ($data as $value){
            $arr[$value->id] = $value->certificate_name;
        }
    }
    return $arr;
}

function get_all_manager_list(){
    global $DB,$CFG;
    $arr =  array();
    $sql = "SELECT u.id ,CONCAT(u.firstname, ' ', u.lastname) AS name
              FROM {user} u LEFT JOIN {role_assignments} ra ON (u.id = ra.userid)
             WHERE ra.contextid=1 and ra.roleid IN(1,9,10) ORDER BY name ASC";
    $data = $DB->get_records_sql($sql);
    if(!empty($data)){
        $arr[""]   = "--SELECT--";
        foreach ($data as $value){
            if(in_array($value->id,$CFG->not_genuine_user)) continue;
            $arr[$value->id] = $value->name;
        }
    }
    return $arr;
}

function user_status(){
    return array(''=>"--Select--",'Active'=>'Active','Inactive'=>'Inactive');
}

function certificates_status(){
    global $DB;
    $arr =  array();
    $sql = "SELECT * FROM `mdl_managecertificates_status`";
    $data = $DB->get_records_sql($sql);
    if(!empty($data)){
        foreach ($data as $value){
            $arr[$value->id] = $value->status_name;
        }
    }
    return $arr;
}

function _p($arr, $is_exit = false) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    if($is_exit) {
        exit;
    }
}

function get_certificates_by_user($certificate_user_id,$certificate_types_id){
    global $DB;
    $arr =  array();
    $sql = "SELECT mc.id,mc.certificate_user_id,mc.certificate_types_id,mc.copy_of_certificate,mc.expiry_date,mc.update_status,mc.certificate_status,ct.certificate_expire,ct.number_of_months
              FROM {managecertificates} mc LEFT JOIN {certificate_types} ct ON (ct.id = mc.certificate_types_id)
             WHERE mc.certificate_user_id=$certificate_user_id AND mc.certificate_types_id=$certificate_types_id";
    $data = $DB->get_records_sql($sql);
    if(!empty($data)){
        foreach ($data as $value){
            $arr[] = $value;
        }
    }
    return $arr;
}

function get_certificates_by_user2($arr,$certificate_types_id){
    $ret = array();
    if(!empty($arr))
        foreach ($arr as $data){
            if($data->certificate_types_id==$certificate_types_id){

                $ret[] = $data;
            }

        }
    return $ret;
}

function get_all_certificates(){
    global $DB;
    $arr =  array();
    $sql = "SELECT mc.id,mc.certificate_user_id,mc.certificate_types_id,mc.copy_of_certificate,mc.expiry_date,mc.attended_date,mc.update_status,mc.certificate_status,ct.certificate_expire,ct.number_of_months
              FROM {managecertificates} mc LEFT JOIN {certificate_types} ct ON (ct.id = mc.certificate_types_id)
             WHERE 1";
    $data = $DB->get_records_sql($sql);
    if(!empty($data)){
        foreach ($data as $value){
            $arr['certificates'][$value->certificate_user_id][] = $value;
            if(!empty($value->copy_of_certificate) and $arr['has_certificate'][$value->certificate_user_id]!=1 ) {
                $arr['has_certificate'][$value->certificate_user_id] = 1;
            }
        }
    }
    return $arr;
}


function check_certificates_by_status($certificate_user_id,$certificate_status){
    global $DB;

    $sql  = "SELECT mc.id  FROM {managecertificates} mc 
             WHERE mc.certificate_user_id=$certificate_user_id AND (mc.certificate_status=$certificate_status OR mc.update_status=$certificate_status)";
    $data = $DB->get_records_sql($sql);

    if(!empty($data)){
        return true;
    }
    return false;
}

function check_inactive_group_by_user($user_id,$certificate_type_id){
    global $DB;
    $SQL    = "SELECT required_certificates FROM {training_groups} WHERE status!=1";
    $result =  $DB->get_records_sql($SQL);

    foreach ($result as $data){
        $cetTypeIds = explode(",",$data->required_certificates);
    }

}

function check_certificates_by_status2($arr,$status){

    if(!empty($arr))
    foreach ($arr as $data){
        if($data->certificate_status==$status OR $data->update_status==$status) return true;
    }
    return false;
}

function get_certificate_type_name($ids){

    global $DB;
    $sql  = "SELECT GROUP_CONCAT(certificate_name) as names  FROM {certificate_types}  WHERE id IN($ids)";
    $data = $DB->get_record_sql($sql);

    if(!empty($data)){
        return $data->names;
    }

    return null;
}

function showDateTime($mySQLDate, $cid="")
{
    if ($cid == "timestamp") {
        $convertedDate = date("d-M-y, H:i", $mySQLDate);
    } else if ($cid == "timeonly") {
        $convertedDate = date("H:i", $mySQLDate);
    } else if ($cid == "dateonly") {
        $convertedDate = date("d-M-y", $mySQLDate);
    }else if ($cid == "managecertificatedateonly") {
        $convertedDate = date("d/m/Y", $mySQLDate);
    } else {
        $convertedDate = date("d-M-y, H:i", strtotime($mySQLDate));
    }

    return $convertedDate;
}

function get_courses_list() {
    global $DB;
    return $DB->get_records_sql("SELECT id, fullname, shortname, idnumber FROM {course}");
}

function get_expiring_certificates_data($certificates) {
    $data = array();
    if (!empty($certificates)) {
        $expires_in_3_months = 0;
        $expires_in_2_months = 0;
        $expires_in_1_months = 0;
        $expired = 0;
        $today = time();
        $delta3=3600*24*30*3;  //3600 seconds per hours *24 hours * 30 day * 3 months
        $delta2=3600*24*30*2;  //3600 seconds per hours *24 hours * 30 day * 2 months
        $delta1=3600*24*30*1;  //3600 seconds per hours *24 hours * 30 day * 1 months
        foreach ($certificates as $certificate) {
            //if (empty($certificate->expiry_date)) continue;
            $tbl_expiry_date = $certificate->expiry_date;
            if(!empty($certificate->expiry_date) && ($tbl_expiry_date<($today+$delta3)) && ($tbl_expiry_date>($today+$delta2))) {
                $expires_in_3_months+=1;
            }
            elseif(!empty($certificate->expiry_date) &&  ($tbl_expiry_date<($today+$delta2)) && ($tbl_expiry_date>($today+$delta1))){
                $expires_in_2_months+=1;
            }
            elseif(!empty($certificate->expiry_date) && ($tbl_expiry_date<($today+$delta1)) && ($tbl_expiry_date>=$today)){
                $expires_in_1_months+=1;
            }
            elseif((!empty($certificate->expiry_date) && $tbl_expiry_date<$today)
                    OR ($certificate->certificate_status==2 AND in_array($certificate->update_status,[0,7]) )){
                $expired+=1;
            }
        }
    }
    $data[] = array('name'=>'Expires in less than 3 months','y'=>$expires_in_3_months,'qry'=>3);
    $data[] = array('name'=>'Expires in less than 2 months','y'=>$expires_in_2_months,'qry'=>2);
    $data[] = array('name'=>'Expires in less than 1 months','y'=>$expires_in_1_months,'qry'=>1);
    $data[] = array('name'=>'Expired/Not Held','y'=>$expired,'qry'=>'expired');

    return $data;
}

function get_certificates_status_colour_coding($certificates) {
    $color_class = '';
    if (!empty($certificates)) {
        $today = time();
        foreach ($certificates as $certificate) {
//            _p($certificate);

            $tbl_expiry_date   = $certificate->expiry_date;
            $tbl_update_status = $certificate->update_status;
            $delta = 3600 * 24 * 30 * $certificate->number_of_months;  //3600 seconds per hours *24 hours * 30 day * number_of_months

             if(($tbl_expiry_date<($today+$delta)) && ($tbl_expiry_date>$today)) {
                $color_class = 'expiring';
                $update_certificate_status = 1;//Expiring
                if ($tbl_update_status==3){
                    $color_class = 'booked';
                    $update_certificate_status = 3;//Booked
                }elseif ($tbl_update_status==4){
                    $color_class = 'awaiting-certificate';
                    $update_certificate_status = 4;//Awaiting Certificate
                }
                $updateobj = new stdClass();
                $updateobj->id = $certificate->id;
                $updateobj->certificate_status = intval($update_certificate_status);
                update_data($updateobj, 'managecertificates');
                break;
            }
            elseif($tbl_expiry_date>($today+$delta)) {
                $color_class = 'no-action-requrired';
                $update_certificate_status = 5;//No Action required

                if ($tbl_update_status==3){
                    $color_class = 'booked';
                    $update_certificate_status = 3;//Booked
                }elseif ($tbl_update_status==4){
                    $color_class = 'awaiting-certificate';
                    $update_certificate_status = 4;//Awaiting Certificate
                }

                $updateobj = new stdClass();
                $updateobj->id = $certificate->id;
                $updateobj->certificate_status = intval($update_certificate_status);
                update_data($updateobj, 'managecertificates');
                break;
            }
            elseif($tbl_expiry_date<$today){
                $color_class = 'expired-notheld';
                $update_certificate_status = 2;//Expired/Not Held
                if ($tbl_update_status==3){
                    $color_class = 'booked';
                    $update_certificate_status = 3;//Booked
                }elseif ($tbl_update_status==4){
                    $color_class = 'awaiting-certificate';
                    $update_certificate_status = 4;//Awaiting Certificate
                }
                $updateobj = new stdClass();
                $updateobj->id = $certificate->id;
                $updateobj->certificate_status = intval($update_certificate_status);
                update_data($updateobj, 'managecertificates');
                break;
            }
            else{
                $color_class = ' na ';
                $update_certificate_status = 2;//Expired/Not Held
                break;
            }
        }
    }
    return $color_class;
}

function get_max_sortorder($table) {
    global $DB;
    return$DB->get_record_sql("SELECT max(sortorder) AS maxorder FROM {$table}");
}

function change_sortorder_by_one($data, $tblename, $up) {
    global $DB;
    $params = array($data->sortorder);
    if ($up) {
        $select = 'sortorder < ? ';
        $sort = 'sortorder DESC';
    } else {
        $select = 'sortorder > ? ';
        $sort = 'sortorder ASC';
    }
    $swaprecord = $DB->get_records_select($tblename, $select, $params, $sort, '*', 0, 1);
    if ($swaprecord) {
        $swaprecord = reset($swaprecord);
        $DB->set_field($tblename, 'sortorder', $swaprecord->sortorder, array('id' => $data->id));
        $DB->set_field($tblename, 'sortorder', $data->sortorder, array('id' => $swaprecord->id));
        return true;
    }
    return false;
}
