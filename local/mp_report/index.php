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
 * @copyright  2018 www.makehappengroup.co.uk
 * @author     MP
 */

ini_set('memory_limit', '2048M');
ini_set('max_execution_time', 0);
ini_set('upload_max_filesize', "512M");
ini_set('post_max_size', "1024M");
// Globals.
global $CFG, $OUTPUT, $USER, $SITE, $PAGE;
$pluginname = 'mp_report';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
require_once($CFG->dirroot.'/local/'.$pluginname.'/functions.php');  // Include our function library.
require_once(dirname(__FILE__).'/classes/'.$pluginname.'_success.php');  // Include form.
require_once(dirname(__FILE__).'/classes/accident_report_form.php');  // Include form.
require_once(dirname(__FILE__).'/classes/incident_report_form.php');  // Include form.
require_once(dirname(__FILE__).'/classes/new_accident_report_form.php');  // Include form.
require_once(dirname(__FILE__).'/classes/'.$pluginname.'_list.php');  // Include form.
$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/fancybox/dist/jquery.fancybox.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/fancybox/dist/jquery.fancybox.js'));

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/datatables/datatables.min.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/datatables/datatables-1.10.18/js/jquery.dataTables.min.js'),true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/datatables/datatables-1.10.18/js/dateSort.js'));
require_login();


// Heading ==========================================================.

$title   = get_string('hs_reporting', 'local_'.$pluginname);
$heading = get_string('hs_reporting', 'local_'.$pluginname);
$url     = new moodle_url('/local/'.$pluginname.'/index.php');


$context = context_system::instance();


$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);

if(@$_GET['download'] == '1') {
	if( get_request('cmd') == 'acc_pdf' ) {

	    $data->report_id   = 1;
	    $data->user_id     = $USER->id;
	    $data->download_at = time();

        $uid = get_request('uid');
        $user = get_userInfo(array("id" =>$uid ));
        $date = get_request("d");
        $reportname ="Accident_".$user->firstname."_".$user->lastname."_".date("d-M-Y",$date).".pdf";

	    save_data($data,"report_download_history");
		export_pdf('acc',$reportname);

	} elseif(get_request('cmd') == 'inc_pdf' ) {
        $data->report_id   = 2;
        $data->user_id     = $USER->id;
        $data->download_at = time();

        $catID = get_request('catID');
        if($catID==29)      $reportname = "Near_Miss_";
        else if($catID==30) $reportname = "Hazard_";
        else                $reportname = "Incident_";

        $uid = get_request('uid');
        $user = get_userInfo(array("id" =>$uid ));
        $date = get_request("d");
        $reportname.= $user->firstname."_".$user->lastname."_".date("d-M-Y",$date).".pdf";

        save_data($data,"report_download_history");
		export_pdf('inc',$reportname);
	}elseif( get_request('cmd') == 'acc_full_pdf' ) {

        $data->report_id   = 1;
        $data->user_id     = $USER->id;
        $data->download_at = time();

        $uid = get_request('uid');
        $user = get_userInfo(array("id" =>$uid ));
        $date = get_request("d");
        $reportname ="Accident_".$user->firstname."_".$user->lastname."_".date("d-M-Y",$date).".pdf";

        save_data($data,"report_download_history");
        export_pdf('full_acc',$reportname);

    }elseif(get_request('cmd') == 'inc_full_pdf' ) {
        $data->report_id   = 2;
        $data->user_id     = $USER->id;
        $data->download_at = time();

        $catID = get_request('catID');
        if($catID==29)      $reportname = "Near_Miss_";
        else if($catID==30) $reportname = "Hazard_";
        else                $reportname = "Incident_";

        $uid = get_request('uid');
        $user = get_userInfo(array("id" =>$uid ));
        $date = get_request("d");
        $reportname.= $user->firstname."_".$user->lastname."_".date("d-M-Y",$date).".pdf";

        save_data($data,"report_download_history");
        export_pdf('full_inc',$reportname);
    }

    die();
}

echo $OUTPUT->header();

$cmd = get_request('cmd');


switch ($cmd){
     case 'home'         : home_page();            break;
     case 'new_accpage'  : new_accident_page();    break;
     case 'accpage'      : accident_page();        break;
     case 'incpage'      : incident_page();        break;
     case 'form1'        : accident_form();        break;
     case 'form2'        : incident_form();        break;
     case 'form3'        : new_accident_form();    break;
     case 'acc_edit'     : accident_form();        break;
     case 'inc_edit'     : incident_form();        break;
     case 'new_acc_edit' : new_accident_form();    break;
     
     default             : home_page();            break;

}

echo $OUTPUT->footer();

echo "
<script>

$(document).ready( function () {
    $('.accident_table').DataTable({
        'columnDefs': [
            { 'orderable': false, 'targets': 4 },
            {'targets':1, 'type':'date-eu'}
         ]}
    );
    $('.incident_table').DataTable({
        'columnDefs': [
            { 'orderable': false, 'targets': 4 },
            {'targets':1, 'type':'date-eu'}
         ]}
    );
} );
</script>";
