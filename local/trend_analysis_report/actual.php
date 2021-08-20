<?php
global $DB,$USER,$CFG;
$pluginname = 'trend_analysis_report';

require(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/coursecatlib.php');
require_once($CFG->libdir . '/csvlib.class.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/actual_form.php');
require_once($CFG->dirroot.'/local/trend_analysis_report/locallib.php');  // Include our function library.
$returnurl = new moodle_url('/local/trend_analysis_report/actual.php');

require_login();
$homeurl    = new moodle_url('/local/mp_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}

$title   = get_string('pluginname', 'local_'.$pluginname);
$heading = get_string('heading', 'local_'.$pluginname);
$url     = new moodle_url('/local/'.$pluginname.'/index.php');


$context = context_system::instance();

$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);



if (empty($importid)) {
    $mform1 = new actual_form();
    if ($form1data = $mform1->get_data()) {
        $importid = csv_import_reader::get_new_iid('uploadactual');
        $cir = new csv_import_reader($importid, 'uploadactual');
        $content = $mform1->get_file_content('targetfile');


        $data = explode("\r\n",$content);
        if (count($data) == 0) {
            print_error('csvemptyfile', 'error', $returnurl, $cir->get_error());
        }

        foreach ($data as $key=>$thisData){
            if($key){

                $temp      = explode(",",$thisData);
                if(!empty($temp))
                $dataArr[] = $temp;

            }
        }

        $saveData = array();

        $saveData['data']       = json_encode($dataArr);
        $saveData['year']       = $form1data->year;
        $saveData['month']      = $form1data->month;
        $saveData['user_id']    = $USER->id;

        $saveData['updated_at'] = time();

        $actual = $DB->get_record("report_actual",array("year" => $form1data->year,'month'=>$form1data->month));

        if(empty($actual)){

            $saveData['created_at'] = time();

            $DB->insert_record("report_actual",$saveData);
        }
        else{
            $saveData['id'] = $actual->id;
            $DB->update_record("report_actual",$saveData);
        }


        if(!empty($DB->get_last_error())){
            print_error('csvemptyfile', 'error', $returnurl, $DB->get_last_error());
        }
        else{
            redirect($returnurl,"Data has been saved successfully!!...","6",'success');
        }


    } else {

        echo $OUTPUT->header();
        echo $OUTPUT->heading_with_help(get_string('uploadactual', 'local_trend_analysis_report'), 'uploadactual', 'local_trend_analysis_report');
        $mform1->display();
        echo $OUTPUT->footer();
        die();
    }
} else {
    $cir = new csv_import_reader($importid, 'uploadactual');
}


echo $OUTPUT->footer();
