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

defined('MOODLE_INTERNAL') || die;

function get_userInfo($data){
    global $DB, $USER;;
    return $DB->get_record('user',$data);
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



function get_manager_list(){
    global $DB,$USER;

    $arr =  array();

    $sql = "SELECT u.id ,CONCAT(u.firstname, ' ', u.lastname) AS name
              FROM {user} u LEFT JOIN {role_assignments} ra ON (u.id = ra.userid)
             WHERE ra.contextid=1 and ra.roleid IN(1)  AND ra.roleid NOT IN(9,10) ORDER BY name ASC";

    $data = $DB->get_records_sql($sql);

    if(!empty($data)){
        foreach ($data as $value){
            if(!is_senior_manager($value->id)  and !is_complieance($value->id))
                $arr[$value->id] = $value->name;

        }
    }

    return $arr;
}

function get_all_manager_list(){
    global $DB,$USER;

    $arr =  array();

    $sql = "SELECT u.id ,CONCAT(u.firstname, ' ', u.lastname) AS name
              FROM {user} u LEFT JOIN {role_assignments} ra ON (u.id = ra.userid)
             WHERE ra.contextid=1 and ra.roleid IN(1,9,10) ORDER BY name ASC";

    $data = $DB->get_records_sql($sql);

    if(!empty($data)){
        foreach ($data as $value){

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

function get_requests(){

    $retArr = array();
    foreach ($_REQUEST as $key =>$data)
    {
        if(!empty($data)){

            $retArr[$key] = $data;
        }

    }

    return $retArr;
}


function save_data($data,$table){
    global $DB, $USER;

    if(empty($data->id)) {
        $data->user_id    = $USER->id;
        $data->created_at = time();
        return $DB->insert_record($table, $data, $returnid = true, $bulk = false);
    }
    else{
        $data->manager_id  = $USER->id;
        $data->updated_at  = time();
        $DB->update_record($table, $data);
        return $data->id;
    }
}

function get_data($data,$table){
    global $DB, $USER;;
    return $DB->get_record($table,$data);


}


function update_data($data,$table,$url=null){
    global $DB, $USER;


    try {
        return $DB->update_record($table,$data);
    } catch (Exception $e) {
        redirect($url,"Error... Unable to process this data","4",'error');
    }



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


function accident_status(){
    return array('New'=>'New','Open'=>'Open','Closed'=>'Closed');
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

function yes_no_status(){
    return array('Yes'=>'Yes','No'=>'No');
}

function na_yes_no_status(){
    return array('N/A'=>'N/A' ,'Yes'=>'Yes','No'=>'No');
}

function get_system_user_list(){
    global $DB,$USER;
    $arr =  array();
    $sql = "SELECT u.id ,CONCAT(u.firstname, ' ', u.lastname) AS name FROM {user} u WHERE u.deleted = 0  ORDER BY name ASC";
    $data = $DB->get_records_sql($sql);
    if(!empty($data)){
        foreach ($data as $value){
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
           WHERE r.shortname='manager' AND (r.shortname!='seniormanager' OR r.shortname!='compliancemanager') AND u.deleted = 0 AND u.id NOT IN (SELECT user_id FROM {h_s_manager_standing_table}) ORDER BY name ASC";


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




/* Get average for quarter */
function get_avg($myObj) {
    $sum = 0;
    $i=0;

    foreach ($myObj as $key=>$value){
        //echo $value. "\n";
        if ($value != 0) {
            $sum += $value;
            $i++;
        }
    }
    $avg = ($sum>0 and $i>0) ? number_format($sum/$i,0) : 0;

    return $avg;
}


function get_course_category_subcategory_list(){
    global $DB;
    $arr =  array();
    $sql = " SELECT * FROM `mdl_course_categories` ";
    $data = $DB->get_records_sql($sql);
    if(!empty($data)){
        foreach ($data as $value){
            $arr[$value->id] = $value->name;
        }
    }
    return $arr;
}

function get_course_client_list(){
    global $DB;
    $arr =  array();
    $sql = " SELECT client FROM `mdl_course` WHERE client IS NOT NULL ORDER by client ASC";
    $data = $DB->get_records_sql($sql);
    if(!empty($data)){
        $dup_arr = array();
        foreach ($data as $value){
            if(in_array(strtolower($value->client),$dup_arr)) continue;
            $dup_arr[strtolower($value->client)] = strtolower($value->client);
            $arr[$value->client] = $value->client;
        }
    }
    return $arr;
}

function get_courses_type()
{
    return $options = array(
        '1' => 'Induction',
        '2' => 'Regular Reading',
        '3' => 'Physical Toolbox Talks',
        '4' => 'Online Toolbox Talks',
        '5' => 'Other'
    );
}

function _p($arr, $is_exit = false) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    if($is_exit) {
        exit;
    }
}

function showDateTime($mySQLDate, $cid="")
{
    if ($cid == "timestamp") {
        $convertedDate = date("d-M-y, H:i", $mySQLDate);
    } else if ($cid == "timeonly") {
        $convertedDate = date("H:i", $mySQLDate);
    } else if ($cid == "dateonly") {
        $convertedDate = date("d-M-y", $mySQLDate);
    } else {
        $convertedDate = date("d-M-y, H:i", strtotime($mySQLDate));
    }

    return $convertedDate;
}

function user_status(){
    return array(''=>"--Select--",'Active'=>'Active','Inactive'=>'Inactive');
}

function user_status1(){
    return array(''=>"--Select--",1=>'Active',2=>'Inactive');
}

function course_dropdown_format_list($data){
    $arr =  array();
    if(!empty($data)){
        foreach ($data as $value){
            $arr[$value->id] = $value->fullname;
        }
    }
    return $arr;
}

function is_course_complete($user_id,$course_id) {
    $params = array(
        'userid'    => $user_id,
        'course'  => $course_id
    );

    $ccompletion = new \completion_completion($params);
    return $ccompletion->is_complete();
}

