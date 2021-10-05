<?php
// Globals.
global $CFG, $OUTPUT, $USER, $SITE, $PAGE,$DB;
$pluginname = 'training_matrix';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
require_once($CFG->dirroot.'/local/'.$pluginname.'/functions.php');  // Include our function library.

//$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/datatables/datatables.min.css'));
//$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/datatables/datatables-1.10.18/js/jquery.dataTables.min.js'),true);
//$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/datatables/datatables-1.10.18/js/dateSort.js'));
$homeurl    = new moodle_url('/local/'.$pluginname.'/index.php');

require_login();
$homeurl    = new moodle_url('/local/calm_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance() && !is_training_admin() && !is_siteadmin()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}

$access = is_training_admin() ? 1 : (is_siteadmin() ? 1 : 0);

if(!$access){

    redirect($homeurl,"Sorry!!.. You are not authorize to view this page","6",'error');
}

// Heading ==========================================================.

$title   = get_string('pluginname', 'local_'.$pluginname);
$heading = get_string('heading', 'local_'.$pluginname);
$url     = new moodle_url('/local/'.$pluginname.'/index.php');


$context = context_system::instance();


$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);

$active       = optional_param('active', 0, PARAM_INT);    //delete recordid
$confirm      = optional_param('confirm', '', PARAM_ALPHANUM);   //md5 confirmation hash
$sort         = optional_param('sort', 'name', PARAM_ALPHANUM);
$dir          = optional_param('dir', 'ASC', PARAM_ALPHA);
$action       = optional_param('action', false, PARAM_ALPHA);
$sortorder   = optional_param('sortorder', null, PARAM_INT);

$returnurl = new moodle_url('/local/training_matrix/managecertificatetypes.php', array('m' => '6_3'));
//$returnurl = new moodle_url('/local/training_matrix/managecertificatetypes.php', array('m' => '6_3','sort' => $sort, 'dir' => $dir));

if ($active and confirm_sesskey()) {
    // Delete a selected, after confirmation
    //    require_capability('moodle/user:delete', $sitecontext);

    $certificate_type = $DB->get_record('certificate_types', array('id'=>$active), "*", MUST_EXIST);

    if ($confirm != md5($active)) {
        echo $OUTPUT->header();
        $certificate_name = $certificate_type->certificate_name;//fullname($user, true);
        echo $OUTPUT->heading('Active/Inactive Certificate Type');

        $optionsyes = array('active'=>$active, 'confirm'=>md5($active), 'sesskey'=>sesskey());
        $deleteurl = new moodle_url($returnurl, $optionsyes);
        $deletebutton = new single_button($deleteurl, 'OK', 'post');

        echo $OUTPUT->confirm("Are you sure you want to change?", $deletebutton, $returnurl);
        echo $OUTPUT->footer();
        die;
    } else if (data_submitted()) {

        if($certificate_type->status ==1)  $status = "0"; else  $status = 1;

        if ($DB->update_record('certificate_types',array('id'=>$active,'status' => $status))) {
            redirect($returnurl);
        } else {

            echo $OUTPUT->header();
            echo $OUTPUT->notification($returnurl, get_string('deletednot', '', $certificate_type));
        }
    }
}
if ($action !== false && confirm_sesskey()) {
    // Actions:
    // - moveup : move up.
    // - movedown : move down.
    switch ($action) {
        case 'moveup' :
            // specified a sortorder.
            required_param('sortorder', PARAM_INT);
            $certificate_types = $DB->get_record_sql("SELECT id, certificate_name, certificate_expire, number_of_months,sortorder FROM {certificate_types} WHERE sortorder=$sortorder");
            change_sortorder_by_one($certificate_types,'certificate_types',true);
            redirect($returnurl);
            break;
        case 'movedown' :
            // specified a category.
            required_param('sortorder', PARAM_INT);
            $certificate_types = $DB->get_record_sql("SELECT id, certificate_name, certificate_expire, number_of_months,sortorder FROM {certificate_types} WHERE sortorder=$sortorder");
            change_sortorder_by_one($certificate_types,'certificate_types',false);
            redirect($returnurl);
            break;
    }
}

echo $OUTPUT->header();

echo html_writer:: start_tag('fieldset',array('class'=>'mform fieldset'));
echo html_writer:: tag('legend',get_string('managecertificatetypes_heading', 'local_'.$pluginname),array('class'=>'scheduler-border','style'=>'padding-bottom: 0px;margin-bottom: 0px;'));
echo html_writer:: end_tag('fieldset');
echo html_writer:: tag('hr','',array());
echo html_writer:: start_tag('div',array('class'=>'singlebutton'));
echo html_writer:: start_tag('form',array('method'=>'get','action'=>'/local/training_matrix/editcertificatetype.php'));
echo html_writer:: tag('input','',array('type'=>'hidden','name'=>'m','value'=>'6_3'));
echo html_writer:: tag('button',get_string('managecertificatetypes_btn_add', 'local_'.$pluginname),array('type'=>'submit','class'=>'btn btn-secondary'));
echo html_writer:: end_tag('form');
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('fieldset');
echo html_writer:: tag('hr','',array());

$columnicon = '';
$columndir = $dir == "ASC" ? "DESC":"ASC";
$columnicon = ($dir == "ASC") ? "sort_asc" : "sort_desc";
$columnicon = $OUTPUT->pix_icon('t/' . $columnicon, get_string(strtolower($columndir)), 'core', ['class' => 'iconsort']);

$certificate_name = "<a href=\"managecertificatetypes.php?sort=certificate_name&amp;dir=$columndir&amp;m=6_3\">Certificate Name</a>";
$certificate_expire = "<a href=\"managecertificatetypes.php?sort=certificate_expire&amp;dir=$columndir&amp;m=6_3\">Does the certificate expire?</a>";
if ($sort == "name") {
    // Use the first item in the array.
    $sort = 'certificate_name';
}else{
    if ($sort == "certificatename"){
        $certificate_name .= $columnicon;
        $sort = 'certificate_name';
    }elseif ($sort == "certificateexpire"){
        $certificate_expire .= $columnicon;
        $sort = 'certificate_expire';
    }
}

$certificate_types = get_certificate_types_listing('sortorder','ASC');
$table = new html_table();
$table->head = array ();
$table->colclasses = array();
//$table->head[] = $fullnamedisplay;
$table->attributes['class'] = 'admintable generaltable';
//foreach ($extracolumns as $field) {
//    $table->head[] = ${$field};
//}
$table->head[] = "Certificate Name";
$table->head[] = "Does the certificate expire?";
$table->head[] = 'Number of months';
$table->head[] = 'Order';
$table->head[] = 'Action';
$table->colclasses[] = 'centeralign';
//$table->colclasses[] = 'centeralign';
$table->id = "certificate_type";

$total_certificate_type = count($certificate_types);
//print_r($total_certificate_type);
$row_number = 0;
foreach ($certificate_types as $certificate_type) {

//    $lastcolumn = '';
    $row_number++;

    $actions = array();
    if ($row_number!=1){
        // Up button
        $url = new moodle_url('/local/training_matrix/managecertificatetypes.php', array('action'=>'moveup','sesskey'=>sesskey(),'sortorder'=>$certificate_type->sortorder));
        $actions[] = html_writer::link($url, $OUTPUT->pix_icon('t/up', 'Up'));
    }else{
        $actions[] = '&nbsp;&nbsp;&nbsp;';
    }
    if ($row_number!=$total_certificate_type) {
        // Down button
        $url = new moodle_url('/local/training_matrix/managecertificatetypes.php', array('action' => 'movedown', 'sesskey' => sesskey(),'sortorder'=>$certificate_type->sortorder));
        $actions[] = html_writer::link($url, $OUTPUT->pix_icon('t/down', 'Down'));
    }

    $buttons = array();
    // delete button
    $url = new moodle_url('/local/training_matrix/managecertificatetypes.php', array('active'=>$certificate_type->id,'sesskey'=>sesskey(),'m'=>'6_3'));
    $buttons[] = html_writer::link($url, $OUTPUT->pix_icon($certificate_type->status==1?'t/hide':'t/show', 'Status'));


    // edit button
    $url = new moodle_url('/local/training_matrix/editcertificatetype.php', array('id'=>$certificate_type->id,'m'=>'6_3','sesskey'=>sesskey()));
    $buttons[] = html_writer::link($url, $OUTPUT->pix_icon('t/edit', 'Edit'));

    $row = array ();
    $row[] = "<a href=\"/local/training_matrix/editcertificatetype.php?id=$certificate_type->id&amp;m=6_3&amp;sesskey=".sesskey()."\">$certificate_type->certificate_name</a>";
    $row[] = $certificate_type->certificate_expire;
    $row[] = $certificate_type->number_of_months?$certificate_type->number_of_months:'N/A';
    $row[] = implode(' ', $actions);
    $row[] = implode(' ', $buttons);
//    $row[] = $lastcolumn;
    $table->data[] = $row;
}

if (!empty($table)) {
    echo html_writer::start_tag('div', array('class'=>'no-overflow'));
    echo html_writer::table($table);
    echo html_writer::end_tag('div');
//    echo $OUTPUT->paging_bar($usercount, $page, $perpage, $baseurl);
}

echo $OUTPUT->footer();

//echo "
//<script>
//
//$(document).ready( function () {
//    $('.generaltable').DataTable({
//        'columnDefs': [
//            { 'orderable': false, 'targets':[3] }
//         ]}
//    );
//
//} );
//</script>";