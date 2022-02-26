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

$delete       = optional_param('delete', 0, PARAM_INT);    //delete recordid
$confirm      = optional_param('confirm', '', PARAM_ALPHANUM);   //md5 confirmation hash
$sort         = optional_param('sort', 'name', PARAM_ALPHANUM);
$dir          = optional_param('dir', 'ASC', PARAM_ALPHA);

echo $OUTPUT->header(get_string('mycertificates_heading', 'local_'.$pluginname));
echo '<div class="alert alert-info alert-block fade in " role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <h5 class="alert-heading">Guidance of update a certificate:</h5>Please send any new or renewed certificates to <strong>trainingcerts@secureituk.com</strong> to be added to the system
</div>';

echo html_writer:: start_tag('fieldset',array('class'=>'mform fieldset'));
echo html_writer:: tag('legend',get_string('mycertificates_heading', 'local_'.$pluginname),array('class'=>'scheduler-border','style'=>'padding-bottom: 0px;margin-bottom: 0px;'));
echo html_writer:: tag('hr','',array());

$columnicon = '';
$columndir = $dir == "ASC" ? "DESC":"ASC";
$columnicon = ($dir == "ASC") ? "sort_asc" : "sort_desc";
$columnicon = $OUTPUT->pix_icon('t/' . $columnicon, get_string(strtolower($columndir)), 'core', ['class' => 'iconsort']);

$certificate_name = "<a href=\"mycertificates.php?sort=certificate_type&amp;dir=$columndir&amp;m=6_1\">Certificate Type</a>";
$certificate_expire = "<a href=\"mycertificates.php?sort=expire_date&amp;dir=$columndir&amp;m=6_1\">Expiry Date</a>";
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
$certificate_types = get_certificate_types_listing($sort,$dir);
$table = new html_table();
$table->head = array ();
$table->colclasses = array();
$table->attributes['class'] = 'admintable generaltable';
$table->head[] = $certificate_name;
$table->head[] = $certificate_expire;
$table->head[] = 'Action';
$table->colclasses[] = 'centeralign';
//$table->colclasses[] = 'centeralign';
$table->id = "certificate_type";



foreach ($certificate_types as $certificate_type) {
    $user_certificates = get_certificates_by_user($USER->id,$certificate_type->id);
    $buttons = array();
    if ($user_certificates) {

        if(empty($user_certificates[0]->copy_of_certificate)) continue;

        $expiry_date = empty($user_certificates[0]->expiry_date) ? "No Expiration" : showDateTime($user_certificates[0]->expiry_date, 'managecertificatedateonly');
        $ext = pathinfo($user_certificates[0]->copy_of_certificate, PATHINFO_EXTENSION);

        $status = "";
        if($user_certificates[0]->update_status==3)       $status = " (Booked)";
        elseif($user_certificates[0]->update_status==4)   $status = " (Awaiting Certificate)";
        elseif($user_certificates[0]->update_status==7 and $user_certificates[0]->certificate_status!=2)   $status = " (No Action required)";
        elseif($user_certificates[0]->update_status==7 and $user_certificates[0]->certificate_status==2)   $status = " (Expired)";

        $expiry_date .=$status;

        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https' : 'http';
        $context = stream_context_create(array($protocol => array('header' => 'Connection: close\r\n')));
        if ($user_certificates[0]->copy_of_certificate == 'nofile') {
            $json_data['html'] = '<button type="button" class="btn btn-outline-danger" data-action="delete-certificate">No data</button>';
        } else {
            if (strtolower($ext) == 'pdf') {

                $pdf = $CFG->wwwroot . $user_certificates[0]->copy_of_certificate;
                $src = $pdf;
            } else {

                $src = $CFG->wwwroot . $user_certificates[0]->copy_of_certificate;
            }
        }
        // download button
        $buttons[] = "<a download=\"certificate\" href=\"$src\"><i class=\"icon fa fa-download fa-fw \" aria-hidden=\"true\" title=\"Download\" aria-label=\"Download\"></i></a>";


        // view button
        $buttons[] = "<a target='_blank' href=\"$src\"><i class=\"icon fa fa-eye fa-fw \" aria-hidden=\"true\" title=\"View\" aria-label=\"View\"></i></a>";

        $row = array();
        $row[] = $certificate_type->certificate_name;
        $row[] = $expiry_date;
        $row[] = implode(' ', $buttons);
        $table->data[] = $row;
    }
}

echo $html ='<div class="row" >
                <div class="col-sm-6"> </div>
                <div class="col-sm-6" style="text-align: right !important;">     
                     <a class="btn btn-dark" onclick="history.back()" style="background-color: #fcc42c; border-color: #fcc42c !important; font-weight: bold"><i class="fa fa-step-backward"> </i> Back </a>
                </div>
             </div>';

if (!empty($table)) {
    echo html_writer::start_tag('div', array('class'=>'no-overflow'));
    echo html_writer::table($table);
    echo html_writer::end_tag('div');
//    echo $OUTPUT->paging_bar($usercount, $page, $perpage, $baseurl);
}

echo $OUTPUT->footer();
