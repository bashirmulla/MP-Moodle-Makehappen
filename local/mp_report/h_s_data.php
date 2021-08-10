<?php
// Globals.
global $USER, $CFG,$DB;
define('AJAX_SCRIPT', true);

require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/mp_report/locallib.php');  // Include our function library.

define('PREFERRED_RENDERER_TARGET', RENDERER_TARGET_GENERAL);

$formData = get_requests();



if($formData['cmd']=='del_riddor_file'){

    $data = get_data(array("id"=>$formData['id']),"accident_riddor_files");

    unlink($CFG->dirroot.$data->file_location);
    echo $DB->delete_records("accident_riddor_files",array("id"=>$formData['id']));
    die;

}
if (!empty($_FILES['upload_file']['tmp_name'])){

    $obj = new stdClass();
    $obj->accident_id      = $formData['accident_id'];
    $obj->uploaded_by      = $USER->id;
    $obj->file_location    = uploadFile2('upload_file', '', $formData['accident_id']);;
    $obj->file_name        = basename($obj->file_location);

    $id = save_data($obj, 'accident_riddor_files');

    if($id)  echo  "<tr data-id='$id'><td class='cell c0'>$obj->file_name</td><td class='cell c1' style='text-align:center;width:25%;'><a href='$obj->file_location' target='new'>View</a> | <a href='javascript::void(0)' id='del_riddor_file' data-id='$id' > Delete </a></td></tr>";
    echo  "";
    die;
}



$filterData = get_requests();
if ($filterData['cmd']=='inc_edit'){
    $tableName  = get_string('incident_table', 'local_calm_report');
    $status = $DB->set_field($tableName, 'read_only', '1', array('id' => intval($filterData['id'])));
}elseif ($filterData['cmd']=='acc_edit'){
    $tableName  = get_string('accident_table', 'local_calm_report');
    $status = $DB->set_field($tableName, 'read_only', '1', array('id' => intval($filterData['id'])));
}else{
    $status = "no action";
}

$response_data = array('id'=>$filterData['id'],'status'=>$status);

echo json_encode($response_data);
