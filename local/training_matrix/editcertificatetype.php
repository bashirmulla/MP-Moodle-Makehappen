<?php
// Globals.
global $CFG, $OUTPUT, $USER, $SITE, $PAGE;
$pluginname = 'training_matrix';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
require_once($CFG->dirroot.'/local/'.$pluginname.'/functions.php');  // Include our function library.

require_once(dirname(__FILE__).'/classes/editcertificatetype_form.php');  // Include form.

require_login();
$id     = optional_param('id', 0, PARAM_INT);
$order   = optional_param('order', 0, PARAM_INT);
if ($id){
    $title   = get_string('managecertificatetypes_edit_title', 'local_'.$pluginname);
    $heading_title = get_string('managecertificatetypes_edit_heading_title', 'local_'.$pluginname);
}else{
    $title   = get_string('managecertificatetypes_add_title', 'local_'.$pluginname);
    $heading_title = get_string('managecertificatetypes_add_heading_title', 'local_'.$pluginname);
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

$mform = new editcertificatetype_form(null, array(
    'certificatetypeid' => $id
));


$certificatetypesurl = new moodle_url('/local/training_matrix/managecertificatetypes.php');
//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    $certificatetypesurl->param('m', '6_3');
    redirect($certificatetypesurl);
} else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.
    if ($fromform->sortorder==0) {
        $maxorderobj = get_max_sortorder('mdl_certificate_types');
        $maxorder = $maxorderobj->maxorder;
        $fromform->sortorder = ($maxorder+1);
    }
    if ($fromform->id) {
        if ($fromform->certificate_expire=='No'){$fromform->number_of_months=0;}
        $id = save_data($fromform,'certificate_types');
    } else {
        $id = save_data($fromform,'certificate_types');
    }
    $certificatetypesurl->param('m', '6_3');
    redirect($certificatetypesurl);
} else {
    // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
    // or on the first display of the form.

    //Set default data (if any)
//    $mform->set_data($toform);
    //displays the form
    $mform->display();
}
echo $OUTPUT->footer();