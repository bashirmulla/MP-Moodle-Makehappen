<?php
// This file is part of eMailTest plugin for Moodle - http://moodle.org/
//
// eMailTest is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// eMailTest is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with eMailTest.  If not, see <http://www.gnu.org/licenses/>.

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
defined('MOODLE_INTERNAL') || die;
require_once($CFG->libdir.'/formslib.php');

$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/custom.js'));

class incident_report_form extends moodleform {


    public function userPartForm(){
        global $USER, $CFG;
        $mform    = $this->_form;

        $mform->_maxFileSize = 90000000;

        $dropdown = get_dropdown_data(2);

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Details</legend>');

        $mform->addElement('static', 'name1', get_string('name', 'local_mp_report'),$USER->firstname.' '.$USER->lastname );


        $mform->addElement('select', 'contact', get_string('i_contact', 'local_mp_report'), createDropdown($dropdown['contract']));
        $mform->setType('contact', PARAM_TEXT);
        $mform->addRule('contact', get_string('required'), 'required');

        $mform->addElement('select', 'manager', get_string('i_manager', 'local_mp_report'), get_com_manager_list());
        $mform->setType('manager', PARAM_TEXT);
        $mform->addRule('manager', get_string('required'), 'required');

        $mform->addElement('date_time_selector', 'i_date', get_string('i_date', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('i_date', PARAM_TEXT);
        $mform->addRule('i_date', get_string('required'), 'required');


        $radioarray   = array();
        $radioarray[] = $mform->createElement('radio', 'day_night', '', "Day", 'Day');
        $radioarray[] = $mform->createElement('radio', 'day_night', '', "Night", 'Night');
        $mform->addGroup($radioarray, 'day_night', get_string('day_night', 'local_mp_report'), array(' '), false);
        $mform->addRule('day_night', get_string('required'), 'required');

        $mform->addElement('text', 'location', get_string('location', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('location', PARAM_TEXT);
        $mform->addRule('location', get_string('required'), 'required');


        $radioarray   = array();
        $radioarray[] = $mform->createElement('radio', 'lone_worker', '', "Yes", 'Yes');
        $radioarray[] = $mform->createElement('radio', 'lone_worker', '', "No", 'No');
        $mform->addGroup($radioarray, 'lone_worker', get_string('lone_worker','local_mp_report'), array(' '), false);
        $mform->addRule('lone_worker', get_string('required'), 'required','','client');

        $mform->addElement('textarea', 'what_observe', get_string('what_observe', 'local_mp_report'), 'wrap="virtual" maxlength="2000" rows="6" cols="40"');
        $mform->setType('what_observe', PARAM_TEXT);
        $mform->addHelpButton('what_observe', "max_length",'local_mp_report');
        $mform->addRule('what_observe', get_string('required'), 'required');

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-8 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label',get_string('max_length','local_mp_report'),array('for'=>'help_text','class'=>'helptext col-md-10')));
        $mform->addElement('html', html_writer:: end_tag('div'));


        $mform->addElement('file', 'photo_1', get_string('photo_1', 'local_mp_report'), 'accept="image/*" maxlength="200" size="40" ');
        $mform->setType('photo_1', PARAM_FILE);
        $mform->addRule('photo_1', get_string('required'), 'required');

        $mform->addElement('file', 'photo_2', get_string('photo_2', 'local_mp_report'), 'accept="image/*" maxlength="200" size="40" ');
        $mform->setType('photo_2', PARAM_FILE);
        $mform->addRule('photo_2', get_string('required'), 'required');

        $mform->addElement('file', 'photo_3', get_string('photo_3', 'local_mp_report'), 'accept="image/*" maxlength="200" size="40" ');
        $mform->setType('photo_3', PARAM_FILE);
        $mform->addElement('file', 'photo_4', get_string('photo_4', 'local_mp_report'), 'accept="image/*" maxlength="200" size="40" ');
        $mform->setType('photo_4', PARAM_FILE);
        $mform->addElement('file', 'photo_5', get_string('photo_5', 'local_mp_report'), 'accept="image/*" maxlength="200" size="40" ');
        $mform->setType('photo_5', PARAM_FILE);
        $mform->addElement('file', 'photo_6', get_string('photo_6', 'local_mp_report'), 'accept="image/*" maxlength="200" size="40" ');
        $mform->setType('photo_6', PARAM_FILE);



        $mform->addElement('textarea', 'action_taken', get_string('action_taken', 'local_mp_report'), 'wrap="virtual" maxlength="500" rows="6" cols="40"');
        $mform->setType('action_taken', PARAM_TEXT);
        $mform->addRule('action_taken', get_string('required'), 'required');
        $mform->addHelpButton('action_taken', "max500_length",'local_mp_report');

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-8 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label',get_string('max500_length','local_mp_report'),array('for'=>'help_text','class'=>'helptext col-md-10')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('textarea', 'what_could_happened', get_string('what_could_happened', 'local_mp_report'), 'wrap="virtual" maxlength="500" rows="6" cols="40"');
        $mform->setType('what_could_happened', PARAM_TEXT);
        $mform->addRule('what_could_happened', get_string('required'), 'required');
        $mform->addHelpButton('what_could_happened', "max500_length",'local_mp_report');

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-8 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label',get_string('max500_length','local_mp_report'),array('for'=>'help_text','class'=>'helptext col-md-10')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('select', 'report_category', get_string('report_category', 'local_mp_report'), createDropdown($dropdown['report_category']),'width="100% !important"');
        $mform->setType('report_category', PARAM_TEXT);
        $mform->addRule('report_category', get_string('required'), 'required');

        $mform->addElement('html', '</fieldset>');
    }

    public function userPartView($reportData)
    {
        global $USER, $CFG;
        $mform = $this->_form;
        $dropdown = get_dropdown_data(2);

        $managerList = get_com_manager_list();
        $user        = get_userInfo(array("id" => $reportData->user_id));

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Details</legend>');

        //$mform->addElement('static', 'report_number1', get_string('i_report_number', 'local_mp_report'), $reportData->report_number);
        $mform->addElement('static', 'name1', get_string('name', 'local_mp_report'),$user->firstname.' '.$user->lastname );

        $mform->addElement('static', 'contact1', get_string('i_contact', 'local_mp_report'), $dropdown['contract'][$reportData->contact]);

        $mform->addElement('static', 'manager1', get_string('i_manager', 'local_mp_report'), @$managerList[$reportData->manager]);
        $mform->addElement('static', 'i_date1', get_string('i_date', 'local_mp_report'), date("d-M-Y G:i:s", $reportData->i_date));
        $mform->addElement('static', 'day_night1', get_string('day_night', 'local_mp_report'), $reportData->day_night);
        $mform->addElement('static', 'location1', get_string('location', 'local_mp_report'), $reportData->location);
        $mform->addElement('static', 'lone_worker1', get_string('lone_worker', 'local_mp_report'), $reportData->lone_worker);
        $mform->addElement('static', 'what_observe1', get_string('what_observe', 'local_mp_report'), $reportData->what_observe);

        //$imageCode1 = ' <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-1.jpg" data-lightbox="example-1"><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-1.jpg" alt="image-1" /></a>';
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https' : 'http';
        $context  = stream_context_create(array($protocol => array('header'=>'Connection: close\r\n')));

        $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_1";
        $imageData   = base64_encode(file_get_contents($image,false,$context));
        $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
        $imageCode1 = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_1'> <img  class='example-image'  src='$src' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /> </a>";
        $mform->addElement('static', 'photo_11', get_string('photo_1', 'local_mp_report'), $imageCode1);

        $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_2";
        $imageData   = base64_encode(file_get_contents($image,false,$context));
        $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
        $imageCode2 = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_2'> <img src='$src' class='fancybox' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";
        $mform->addElement('static', 'photo_21', get_string('photo_2', 'local_mp_report'), $imageCode2);

        if (!empty($reportData->photo_3)){
            $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_3";
            $imageData   = base64_encode(file_get_contents($image,false,$context));
            $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
            $imageCode = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_2'><img src='$src' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";
            $mform->addElement('static', 'photo_31', get_string('photo_3', 'local_mp_report'), $imageCode);
        }

        if (!empty($reportData->photo_4)){
            $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_4";
            $imageData   = base64_encode(file_get_contents($image,false,$context));
            $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
            $imageCode = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_2'><img src='$src' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";
            $mform->addElement('static', 'photo_41', get_string('photo_4', 'local_mp_report'), $imageCode);
        }

        if (!empty($reportData->photo_5)){
            $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_5";
            $imageData   = base64_encode(file_get_contents($image,false,$context));
            $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
            $imageCode = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_2'><img src='$src' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";
            $mform->addElement('static', 'photo_51', get_string('photo_5', 'local_mp_report'), $imageCode);
        }

        if (!empty($reportData->photo_6)){
            $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_6";
            $imageData   = base64_encode(file_get_contents($image,false,$context));
            $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
            $imageCode = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_2'><img src='$src' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";
            $mform->addElement('static', 'photo_61', get_string('photo_6', 'local_mp_report'), $imageCode);
        }


        $mform->addElement('static', 'action_taken1', get_string('action_taken', 'local_mp_report'),$reportData->action_taken);
        $mform->addElement('static', 'what_could_happened1  ', get_string('what_could_happened', 'local_mp_report'),$reportData->what_could_happened);
        $mform->addElement('static', 'contact1', get_string('report_category', 'local_mp_report'), $dropdown['report_category'][$reportData->report_category]);

        $mform->addElement('html', '</fieldset>');
    }


    public function managerPartForm($reportData){
        global $USER, $CFG;
        $mform = $this->_form;

        $dropdown = get_dropdown_data(2);

        //echo "<pre>";
        //print_r($reportData);
        //echo "</pre>";

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Management Review</legend>');
        $radioarray   = array();
        $radioarray[] = $mform->createElement('radio', 'is_correct_report_category', '', "Yes", 'Yes');
        $radioarray[] = $mform->createElement('radio', 'is_correct_report_category', '', "No", 'No');
        $mform->addGroup($radioarray, 'is_correct_report_category', get_string('is_correct_report_category','local_mp_report'), array(''), false);
        $mform->addRule('is_correct_report_category', get_string('required'), 'required','','client');
        $mform->setDefault('is_correct_report_category', !empty($reportData->is_correct_report_category) ? $reportData->is_correct_report_category : 'Yes');

        $mform->addElement('select', 'correct_report_category', get_string('correct_report_category', 'local_mp_report'), createDropdown($dropdown['report_category']),'width="100% !important"');
        $mform->setType('correct_report_category', PARAM_TEXT);
        //$mform->addRule('correct_report_category', get_string('required'), 'required');
        $mform->setDefault('correct_report_category', !empty($reportData->correct_report_category) ? $reportData->correct_report_category : $reportData->report_category);

        $mform->hideIf('correct_report_category', 'is_correct_report_category',  'eq', 'Yes');

        $mform->addElement('select', 'classification', get_string('classification', 'local_mp_report'), createDropdown($dropdown['classification']),'width="100% !important"');
        $mform->setType('classification', PARAM_TEXT);
        $mform->setDefault('classification', $reportData->classification);


        $mform->addElement('select', 'categorisation', get_string('categorisation', 'local_mp_report'), createDropdown($dropdown['categorisation']),'id="categorisation" width="100% !important"');
        $mform->setType('categorisation', PARAM_TEXT);
        $mform->setDefault('categorisation', $reportData->categorisation);

        $mform->hideIf('classification', 'correct_report_category',  'eq', 31);
        $mform->hideIf('categorisation', 'correct_report_category',  'neq', 31);



        $mform->addElement('select', 'vehicles', get_string('vehicles', 'local_mp_report'), createDropdown($dropdown['vehicle']),'id="vehicle" width="100% !important"');
        $mform->setType('vehicles', PARAM_TEXT);
        $mform->setDefault('vehicles', $reportData->vehicles);

        $mform->addElement('select', 'equipment', get_string('equipment', 'local_mp_report'), createDropdown($dropdown['equipment']),'id="equipment" width="100% !important"');
        $mform->setType('equipment', PARAM_TEXT);
        $mform->setDefault('equipment', $reportData->equipment);


        $mform->addElement('select', 'environmental', get_string('environmental', 'local_mp_report'), createDropdown($dropdown['environment']),'id="environment" width="100% !important"');
        $mform->setType('environmental', PARAM_TEXT);
        $mform->setDefault('environmental', $reportData->environmental);

        $mform->addElement('select', 'attack', get_string('attack', 'local_mp_report'), createDropdown($dropdown['attack']),'id="attack" width="100% !important"');
        $mform->setType('attack', PARAM_TEXT);
        $mform->setDefault('attack', $reportData->attack);

        $mform->addElement('textarea', 'further_action', get_string('further_action', 'local_mp_report'), 'wrap="virtual" maxlength="2000" rows="6" cols="40"');
        $mform->setType('further_action', PARAM_TEXT);
        $mform->addHelpButton('further_action', "max_length",'local_mp_report');
        $mform->addRule('further_action', get_string('required'), 'required');
        $mform->setDefault('further_action', $reportData->further_action);

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-8 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label',get_string('max_length','local_mp_report'),array('for'=>'help_text','class'=>'helptext col-md-10')));
        $mform->addElement('html', html_writer:: end_tag('div'));


        $radioarray   = array();
        $radioarray[] = $mform->createElement('radio', 'lost_time', '', "Yes", 'Yes');
        $radioarray[] = $mform->createElement('radio', 'lost_time', '', "No", 'No');
        $mform->addGroup($radioarray, 'lost_time', get_string('lost_time','local_mp_report'), array(''), false);
        $mform->addRule('lost_time', get_string('required'), 'required','','client');
        $mform->setDefault('lost_time', $reportData->lost_time);

        $mform->addElement('text', 'lost_time_days', get_string('lost_time_days', 'local_mp_report'), 'id="lost_time_days" maxlength="3" size="10" ');
        $mform->setType('lost_time_days', PARAM_INT);
        $mform->setDefault('lost_time_days', $reportData->lost_time_days);
        $mform->disabledIf('lost_time_days', 'lost_time',  'eq', 'No');
        //$mform->addRule('lost_time_days', get_string('required'), 'required','','client');


        $mform->addElement('select', 'report_to_client', get_string('report_to_client', 'local_mp_report'), $dropdown['yes_no']);
        $mform->setType('report_to_client', PARAM_TEXT);
        $mform->addRule('report_to_client', get_string('required'), 'required');
        $mform->setDefault('report_to_client', $reportData->report_to_client);

        $mform->addElement('select', 'report_priority', get_string('report_priority', 'local_mp_report'), createDropdown($dropdown['report_priority']));
        $mform->setType('report_priority', PARAM_TEXT);
        $mform->setDefault('report_priority', $reportData->report_priority);

        $mform->addElement('textarea', 'contact_details', get_string('contact_details', 'local_mp_report'), 'wrap="virtual" maxlength="2000" rows="6" cols="40"');
        $mform->setType('contact_details', PARAM_TEXT);
        $mform->addHelpButton('contact_details', "max_length",'local_mp_report');
        $mform->setDefault('contact_details', $reportData->contact_details);

        //$mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-8 form-group-ele')));
        //$mform->addElement('html', html_writer:: tag('label',get_string('max_length','local_mp_report'),array('for'=>'help_text','class'=>'helptext col-md-10')));
        //$mform->addElement('html', html_writer:: end_tag('div'));


        $mform->addElement('date_selector', 'meeting_date', get_string('meeting_date', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('meeting_date', PARAM_TEXT);
        //$mform->addRule('meeting_date', get_string('required'), 'required');
        $mform->setDefault('meeting_date', $reportData->meeting_date);


        $mform->hideIf('meeting_date', 'report_to_client',  'neq', 56);
        $mform->hideIf('contact_details', 'report_priority',  'neq', 48);
        $mform->hideIf('contact_details', 'report_to_client',  'neq', 56);
        $mform->hideIf('report_priority', 'report_to_client',  'neq', 56);



        $mform->hideIf('vehicles', 'correct_report_category',  'neq', 31);
        $mform->disabledIf('vehicles', 'categorisation',  'neq', 43);

        $mform->hideIf('equipment', 'correct_report_category',  'neq', 31);
        $mform->disabledIf('equipment', 'categorisation',  'neq', 44);

        $mform->hideIf('environmental', 'correct_report_category',  'neq', 31);
        $mform->disabledIf('environmental', 'categorisation',  'neq', 45);

        $mform->hideIf('attack', 'correct_report_category',  'neq', 31);
        $mform->disabledIf('attack', 'categorisation',  'neq', 46);


        $mform->addElement('select', 'added_to_rvt_calm_system', get_string('added_to_rvt_calm_system', 'local_mp_report'), createDropdown($dropdown['calm_systems']));
        $mform->setType('added_to_rvt_calm_system', PARAM_TEXT);
        $mform->addRule('added_to_rvt_calm_system', get_string('required'), 'required');
        $mform->setDefault('added_to_rvt_calm_system', !empty($reportData->added_to_rvt_calm_system) ? $reportData->added_to_rvt_calm_system: 133);

        $radioarray   = array();
        $radioarray[] = $mform->createElement('radio', 'report_closed', '', "Yes", 'Yes');
        $radioarray[] = $mform->createElement('radio', 'report_closed', '', "No", 'No');
        $mform->addGroup($radioarray, 'report_closed', get_string('report_closed','local_mp_report'), array(''), false);
        $mform->addRule('report_closed', get_string('required'), 'required','','client');
        $mform->setDefault('report_closed', $reportData->report_closed );


        $mform->addElement('hidden','manager_id',$reportData->manager_id ? $reportData->manager_id : $USER->id);


        $mform->addElement('html', '</fieldset>');

        if(!empty($reportData->manager_id)  and (is_complieance() or is_admin() ) ) { // @to do: need to discuss with @SAM for manager_id,manager in same table and both are contains user id
            $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Compliance Review</legend>');

            $mform->addElement('select', 'compliance_id', get_string('reviewer', 'local_mp_report'), createDropdown(get_compliance_list()));
            $mform->setType('compliance_id', PARAM_TEXT);
            $mform->setDefault('compliance_id', $reportData->compliance_id);
            $mform->addRule('compliance_id', get_string('required'), 'required', '', 'client');

            $radioarray = array();
            $radioarray[] = $mform->createElement('radio', 'change_required', '', "Yes", 'Yes');
            $radioarray[] = $mform->createElement('radio', 'change_required', '', "No", 'No');
            $mform->addGroup($radioarray, 'change_required', get_string('change_required', 'local_mp_report'), array(''), false);
            $mform->setDefault('change_required', $reportData->change_required);


            $mform->addElement('textarea', 'details_change_required', get_string('details_change_required', 'local_mp_report'), 'wrap="virtual" maxlength="2000" rows="6" cols="40"');
            $mform->setType('details_change_required', PARAM_TEXT);
            $mform->setDefault('details_change_required', $reportData->details_change_required);
            $mform->addHelpButton('details_change_required', "max_length",'local_mp_report');
            $mform->disabledIf('details_change_required', 'change_required', 'eq', 'No');

            $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-8 form-group-ele')));
            $mform->addElement('html', html_writer:: tag('label',get_string('max_length','local_mp_report'),array('for'=>'help_text','class'=>'helptext col-md-10')));
            $mform->addElement('html', html_writer:: end_tag('div'));

            $mform->addElement('html', '</fieldset>');
        }

        if( is_senior_manager() || is_complieance() || is_admin() || is_manager()) {
            $pdfbuttons ='<div class="row" >
                <div class="col-sm-6">
                    
                 </div>
                <div class="col-sm-6" style="text-align: right !important;">     
                     <a class="btn btn-dark" style="background-color: #fcc42c; border-color: #fcc42c !important;" href="index.php?cmd=inc_pdf&id='.$_REQUEST['id'].'&download=1&catID='.$reportData->report_category.'&uid='.$reportData->user_id.'&d='.$reportData->i_date.'"><i class="fa fa-check-circle"> </i> Export Initial Report as PDF </a>
                
                     <a class="btn btn-dark" style="background-color: #2441e7; border-color: #2441e7 !important;" href="index.php?cmd=inc_full_pdf&id='.$_REQUEST['id'].'&download=1&catID='.$reportData->report_category.'&uid='.$reportData->user_id.'&d='.$reportData->i_date.'"><i class="fa fa-plus-circle"> </i> Export Full Report as PDF</a>
                 </div>
             </div>    
            <hr>';

        }
        $mform->addElement('html', $pdfbuttons);

        $mform->addFormRule('incidentVaidations');
    }

    public function managerPartView($reportData){
        global $USER, $CFG;
        $mform = $this->_form;

        $dropdown = get_dropdown_data(2);

        //echo "<pre>";
        //print_r($reportData);
        //echo "</pre>";

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Management Review</legend>');
        $mform->addElement('static', 'is_correct_report_category', get_string('is_correct_report_category', 'local_mp_report'), $reportData->is_correct_report_category);
        $mform->addElement('static', 'correct_report_category', get_string('correct_report_category', 'local_mp_report'), $reportData->correct_report_category);
        $mform->addElement('static', 'classification', get_string('classification', 'local_mp_report'), $dropdown['classification'][$reportData->classification]);
        $mform->addElement('static', 'categorisation', get_string('categorisation', 'local_mp_report'), $dropdown['categorisation'][$reportData->categorisation]);
        $mform->addElement('static', 'vehicle', get_string('vehicles', 'local_mp_report'), $dropdown['vehicle'][$reportData->vehicles]);
        $mform->addElement('static', 'equipment', get_string('equipment', 'local_mp_report'), $dropdown['equipment'][$reportData->equipment]);
        $mform->addElement('static', 'environmental', get_string('environmental', 'local_mp_report'), $dropdown['environmental'][$reportData->equipment]);
        $mform->addElement('static', 'attack', get_string('attack', 'local_mp_report'), $dropdown['attack'][$reportData->attack]);
        $mform->addElement('static', 'further_action', get_string('further_action', 'local_mp_report'), $reportData->further_action);
        $mform->addElement('static', 'lost_time', get_string('lost_time', 'local_mp_report'), $reportData->lost_time);
        $mform->addElement('static', 'lost_time_days', get_string('lost_time_days', 'local_mp_report'), $reportData->lost_time_days);
        $mform->addElement('static', 'report_to_client', get_string('report_to_client', 'local_mp_report'), $dropdown['yes_no'][$reportData->report_to_client]);
        $mform->addElement('static', 'report_priority', get_string('report_priority', 'local_mp_report'), $dropdown['report_priority'][$reportData->report_priority]);
        $mform->addElement('static', 'contact_details', get_string('contact_details', 'local_mp_report'), $reportData->contact_details);
        $mform->addElement('static', 'meeting_date', get_string('meeting_date', 'local_mp_report'), date('d-M-Y',$reportData->meeting_date));
        $mform->addElement('static', 'added_to_rvt_calm_system', get_string('added_to_rvt_calm_system', 'local_mp_report'), $dropdown['calm_systems'][$reportData->added_to_rvt_calm_system]);
        $mform->addElement('static', 'report_closed', get_string('report_closed', 'local_mp_report'), $reportData->report_closed);


        $mform->addElement('html', '</fieldset>');

        if(!empty($reportData->manager_id)  and (is_complieance() or is_admin() ) ) { // @to do: need to discuss with @SAM for manager_id,manager in same table and both are contains user id
            $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Compliance Review</legend>');

            $compliance_list = get_compliance_list();
            $mform->addElement('static', 'reviewer', get_string('reviewer', 'local_mp_report'), $compliance_list[$reportData->compliance_id]);
            $mform->addElement('static', 'change_required', get_string('change_required', 'local_mp_report'), $reportData->change_required);
            $mform->addElement('static', 'details_change_required', get_string('details_change_required', 'local_mp_report'), $reportData->details_change_required);

            $mform->addElement('html', '</fieldset>');
        }

        if( is_senior_manager() || is_complieance() || is_admin()) {
            $pdfbuttons ='<div class="row" >
                <div class="col-sm-6">
                   
                 </div>
                <div class="col-sm-6" style="text-align: right !important;">     
                     <a class="btn btn-dark" style="background-color: #fcc42c; border-color: #fcc42c !important;" href="index.php?cmd=inc_pdf&id='.$_REQUEST['id'].'&download=1&catID='.$reportData->report_category.'&uid='.$reportData->user_id.'&d='.$reportData->i_date.'"><i class="fa fa-check-circle"> </i> Export Initial Report as PDF </a>
                
                     <a class="btn btn-dark" style="background-color: #2441e7; border-color: #2441e7 !important;" href="index.php?cmd=inc_full_pdf&id='.$_REQUEST['id'].'&download=1&catID='.$reportData->report_category.'&uid='.$reportData->user_id.'&d='.$reportData->i_date.'"><i class="fa fa-plus-circle"> </i> Export Full Report as PDF</a>
                 </div>
             </div>    
            <hr>';
        }
        $mform->addElement('html', $pdfbuttons);

        $mform->addFormRule('incidentVaidations');
    }

    public function definition() {
        global $USER, $CFG;
        $btnLavel = "";
        $mform = $this->_form;


        $heading = '<h3 style="text-align: center">'.get_string('incident', 'local_mp_report');

        $report_closed = FALSE;
        if(isset($_REQUEST['id']) && $_REQUEST['cmd']=='inc_edit' && (is_senior_manager() || is_complieance() || is_admin() || is_manager())) {
            $reportData = get_data(array("id"=>$_REQUEST['id']),get_string('incident_table','local_mp_report'));

            if ($reportData->report_closed=='Yes'){
                $report_closed = TRUE;
            }

            if( is_senior_manager() || is_complieance() || is_admin() || is_manager()) {
                $heading ='<div class="row" >
                <div class="col-sm-6">
                    <h3 id="report_headding">'.get_string('incident', 'local_mp_report').'</h3>
                 </div>
                <div class="col-sm-6" style="text-align: right !important;">     
                     <a class="btn btn-dark" style="background-color: #fcc42c; border-color: #fcc42c !important;" href="index.php?cmd=inc_pdf&id='.$_REQUEST['id'].'&download=1&catID='.$reportData->report_category.'&uid='.$reportData->user_id.'&d='.$reportData->i_date.'"><i class="fa fa-check-circle"> </i> Export Initial Report as PDF </a>
                
                     <a class="btn btn-dark" style="background-color: #2441e7; border-color: #2441e7 !important;" href="index.php?cmd=inc_full_pdf&id='.$_REQUEST['id'].'&download=1&catID='.$reportData->report_category.'&uid='.$reportData->user_id.'&d='.$reportData->i_date.'"><i class="fa fa-plus-circle"> </i> Export Full Report as PDF</a>
                 </div>
             </div>    
            <hr>';
            }

            $mform->addElement('html', $heading);
            $this->userPartView($reportData);
            if ($reportData->read_only==1){
                $this->managerPartView($reportData);
            }else {
                $this->managerPartForm($reportData);
            }
            $btnLavel  = get_string('savebutton', 'local_mp_report');

        }
        else{
            $heading .= '</h3><hr>';
            $mform->addElement('html', $heading);
            $this->userPartForm();
            $btnLavel  = get_string('submitbtn', 'local_mp_report');
        }



        $mform->addElement('hidden', 'cmd', !empty($_REQUEST['cmd']) ? $_REQUEST['cmd'] : 'form2' );
        $mform->addElement('hidden', 'id', !empty($_REQUEST['id']) ? $_REQUEST['id'] : $mform->id);
        $mform->addElement('hidden', 'read_only', $mform->read_only);

        $buttonarray = array();
        if($reportData->read_only==0) {
            $buttonarray[] = $mform->createElement('submit', 'save', $btnLavel, array("id" => "save", "style" => "margin:8px;background-color:#137D1F !important"));
        }
        $buttonarray[] = $mform->createElement('cancel');
        if ((is_complieance() OR is_admin()) && $report_closed && ($reportData->read_only==0)) {
            $buttonarray[] = $mform->createElement('submit', 'finalise_report', 'Finalise Report', array("id" => "item-confirm", "style" =>"background-color:#8E0A0A !important"));
        }

        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
        $mform->closeHeaderBefore('buttonar');


    }



    public function reset() {
        $this->_form->updateSubmission(null, null);
    }


}
