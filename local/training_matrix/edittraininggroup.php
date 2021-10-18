<?php
// Globals.
global $CFG, $OUTPUT, $USER, $SITE, $PAGE;
$pluginname = 'training_matrix';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
require_once($CFG->dirroot.'/local/'.$pluginname.'/functions.php');  // Include our function library.

require_once(dirname(__FILE__).'/classes/edittraininggroup_form.php');  // Include form.

require_login();
$id = optional_param('id', 0, PARAM_INT);
if ($id){
    $title   = 'TM: edit group';//get_string('pluginname', 'local_'.$pluginname);
    $heading_title = ' Edit Training Group ';
}else{
    $title   = 'TM: add group';//get_string('pluginname', 'local_'.$pluginname);
    $heading_title = ' Add Training Group ';
}

// Heading ==========================================================.
$heading = get_string('heading', 'local_'.$pluginname);
$url     = new moodle_url('/local/'.$pluginname.'/index.php');


$context = context_system::instance();

$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);
echo $OUTPUT->header();
echo $OUTPUT->heading($heading_title);

$mform = new edittraininggroup_form(null, array(
    'traininggroupid' => $id
));


$traininggroupsurl = new moodle_url('/local/training_matrix/managetraininggroups.php');
//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    $traininggroupsurl->param('m', '6_4');
    redirect($traininggroupsurl);
} else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.
    if ($fromform->id) {
        $comma_separated = implode(",", $fromform->required_certificates);
        $fromform->required_certificates = $comma_separated;
        $id = save_data($fromform,'training_groups');
    } else {
        $comma_separated = implode(",", $fromform->required_certificates);
        $fromform->required_certificates = $comma_separated;
        $id = save_data($fromform,'training_groups');
    }
    $traininggroupsurl->param('m', '6_4');
    redirect($traininggroupsurl);
} else {
    // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
    // or on the first display of the form.

    //Set default data (if any)
//    $mform->set_data($toform);
    //displays the form
    $mform->display();
}
echo $OUTPUT->footer();