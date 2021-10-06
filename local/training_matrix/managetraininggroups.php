<?php
// Globals.
global $CFG, $OUTPUT, $USER, $SITE, $PAGE;
$pluginname = 'training_matrix';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
require_once($CFG->dirroot.'/local/'.$pluginname.'/functions.php');  // Include our function library.

require_login();

$access = is_training_admin() ? 1 : (is_siteadmin() ? 1 : 0);

if(!$access){

    redirect($homeurl,"Sorry!!.. You are not authorize to view this page","6",'error');
}

$homeurl    = new moodle_url('/local/calm_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance() && !is_training_admin() && !is_siteadmin()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
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

$active = optional_param('active', 0, PARAM_INT);    //active/inactive recordid
$confirm      = optional_param('confirm', '', PARAM_ALPHANUM);   //md5 confirmation hash

$returnurl = new moodle_url('/local/training_matrix/managetraininggroups.php', array('m' => '6_4'));

if ($active and confirm_sesskey()) {              // Delete a selected user, after confirmation
//    require_capability('moodle/user:delete', $sitecontext);

    $training_group = $DB->get_record('training_groups', array('id'=>$active), '*', MUST_EXIST);

    if ($training_group->deleted) {
        print_error('froupnotdeleteddeleted', 'error');
    }

    if ($confirm != md5($active)) {
        echo $OUTPUT->header();
        $role_name = $training_group->training_role_name;//fullname($user, true);
        echo $OUTPUT->heading('Active/Inactive Training Group');

        $optionsyes = array('active'=>$active, 'confirm'=>md5($active), 'sesskey'=>sesskey());
        $deleteurl = new moodle_url($returnurl, $optionsyes);
        $deletebutton = new single_button($deleteurl, 'Save', 'post');

        echo $OUTPUT->confirm("Are you sure you want to change it?", $deletebutton, $returnurl);
        echo $OUTPUT->footer();
        die;
    } else if (data_submitted()) {
        if($training_group->status ==1)  $status = "0"; else  $status = 1;
        if ($DB->update_record('training_groups',array('id'=>$active,'status' => $status))) {
            redirect($returnurl);
        } else {

            echo $OUTPUT->header();
            echo $OUTPUT->notification($returnurl, get_string('deletednot', '', $training_group));
        }
    }
}

echo $OUTPUT->header();

echo html_writer:: tag('hr','',array());
echo html_writer:: start_tag('div',array('class'=>''));
echo html_writer:: start_tag('form',array('method'=>'get','action'=>'/local/training_matrix/edittraininggroup.php'));
echo html_writer:: tag('input','',array('type'=>'hidden','name'=>'m','value'=>'6_4'));

echo $html ='<div class="row" >
                <div class="col-sm-6"><h4>Manage Training Groups</h4></div>
                <div class="col-sm-6" style="text-align: right !important;">     
                     <a class="btn btn-dark" onclick="history.back()" style="background-color: #fcc42c; border-color: #fcc42c !important; font-weight: bold"><i class="fa fa-step-backward"> </i> Back </a>
                     <a class="btn btn-secondary" onclick="location.href=\'/local/training_matrix/edittraininggroup.php\'" ><i class="fa fa-plus"> </i> Add New Group </a>
 
                </div>
             </div>';

echo html_writer:: end_tag('form');
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('fieldset');
echo html_writer:: tag('hr','',array());
$table = new html_table();
$table->head = array ();
$table->colclasses = array();
//$table->head[] = $fullnamedisplay;
$table->attributes['class'] = 'admintable generaltable';
//foreach ($extracolumns as $field) {
//    $table->head[] = ${$field};
//}
$table->head[] = 'Training Role Name';
$table->head[] = 'Required Certificates';
$table->head[] = 'Action';
$table->colclasses[] = 'centeralign';
//$table->head[] = "";
$table->colclasses[] = 'centeralign';

$table->id = "groups";
$training_groups = get_datas(array(),'training_groups');
foreach ($training_groups as $training_group) {
//    echo "<pre>";
//    print_r($training_group);
//    die('dd');
//    $lastcolumn = '';

    $buttons = array();
    // delete button
    $url = new moodle_url('/local/training_matrix/managetraininggroups.php', array('active'=>$training_group->id,'sesskey'=>sesskey(),'m'=>'6_4'));
    $buttons[] = html_writer::link($url, $OUTPUT->pix_icon($training_group->status==1?'t/hide':'t/show', 'Delete'));

    // edit button
    $url = new moodle_url('/local/training_matrix/edittraininggroup.php', array('id'=>$training_group->id,'m'=>'6_4','sesskey'=>sesskey()));
    $buttons[] = html_writer::link($url, $OUTPUT->pix_icon('t/edit', 'Edit'));

    $row = array ();
    $row[] = "<a href=\"/local/training_matrix/edittraininggroup.php?id=$training_group->id&amp;m=6_4&amp;sesskey=".sesskey()."\">$training_group->training_role_name</a>";
    $row[] = get_certificate_type_name($training_group->required_certificates);
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
