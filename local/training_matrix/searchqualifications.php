<?php
// Globals.
global $CFG, $OUTPUT, $USER, $SITE, $PAGE;
$pluginname = 'training_matrix';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
require_once($CFG->dirroot.'/local/'.$pluginname.'/functions.php');  // Include our function library.
require_once(dirname(__FILE__).'/classes/searchqualifications_filter_form.php');  // Include form.


$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/chosen/chosen.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/chosen/chosen.jquery.js'),true);

require_login();
$homeurl    = new moodle_url('/local/training_matrix/index.php');

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
echo $OUTPUT->header();
echo $html ='<div class="row" >
                <div class="col-sm-6"><h4>Search Qualifications</h4></div>
                <div class="col-sm-6" style="text-align: right !important;">     
                     <a class="btn btn-dark" onclick="history.back()" style="background-color: #fcc42c; border-color: #fcc42c !important; font-weight: bold"><i class="fa fa-step-backward"> </i> Back </a>
                </div>
             </div>';

$form = new searchqualifications_filter_form(null, array());
if ($form->is_cancelled()) {
    redirect($homeurl);
}
$form->get_data();
$form->display();

if(is_manager() || is_admin() || is_senior_manager() || is_complieance() || is_training_admin() || is_siteadmin()) {
    echo html_writer:: tag('div','',array('id'=>'ajax_content'));
}

echo $OUTPUT->footer();
?>

