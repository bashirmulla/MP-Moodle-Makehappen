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
 * @package    local_accident_report
 * @copyright  2018 www.makehappengroup.co.uk
 * @author     MP
 */

defined('MOODLE_INTERNAL') || die;
ini_set('memory_limit', '2048M');
ini_set('max_execution_time', 0);
ini_set('upload_max_filesize', "512M");
ini_set('post_max_size', "1024M");

require_once($CFG->libdir.'/formslib.php');
$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/accident_report/css/custom.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/custom.js'));
class accident_report_form extends moodleform {

    public function userPartForm(){

        global $USER, $CFG;

        $mform = $this->_form;
        $mform->_maxFileSize = 90000000;
        $dropdown = get_dropdown_data(1);

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">THE INJURED / INVOLVED PERSON</legend>');

        $mform->addElement('text', 'injured_surname', get_string('injured_surname', 'local_accident_report'), 'maxlength="100" size="40" ');
        $mform->setType('injured_surname', PARAM_TEXT);
        $mform->addRule('injured_surname', get_string('required'), 'required','','client');
       
        $mform->addElement('text', 'injured_forename', get_string('injured_forename', 'local_accident_report'), 'maxlength="100" size="40" ');
        $mform->setType('injured_forename', PARAM_TEXT);
        $mform->addRule('injured_forename', get_string('required'), 'required','','client');


        $mform->addElement('textarea', 'home_address', get_string('home_address', 'local_accident_report'), 'wrap="virtual" rows="3" cols="40"');
        $mform->setType('home_address', PARAM_TEXT);
        $mform->addRule('home_address', get_string('required'), 'required','','client');


        $mform->addElement('text', 'telephone', get_string('telephone', 'local_accident_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('telephone', PARAM_TEXT);
        $mform->addRule('telephone', get_string('required'), 'required','','client');


        $mform->addElement('select', 'operative_now_at', get_string('operative_now_at', 'local_accident_report'), createDropdown($dropdown['contract']));
        $mform->setType('operative_now_at', PARAM_TEXT);
        $mform->addRule('operative_now_at', get_string('required'), 'required','','client');

        

        $mform->addElement('text', 'time_lost_hours', get_string('time_lost_hours', 'local_accident_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('time_lost_hours', PARAM_TEXT);
        $mform->addRule('time_lost_hours', get_string('required'), 'required','','client');

        
        $mform->addElement('text', 'time_lost_minutes', get_string('time_lost_minutes', 'local_accident_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('time_lost_minutes', PARAM_TEXT);
        $mform->addRule('time_lost_minutes', get_string('required'), 'required','','client');

        
        $mform->addElement('text', 'time_lost_none', get_string('time_lost_none', 'local_accident_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('time_lost_none', PARAM_TEXT);
        $mform->addRule('time_lost_none', get_string('required'), 'required','','client');

        

        $mform->addElement('textarea', 'temporary_address', get_string('temporary_address', 'local_accident_report'), 'wrap="virtual" rows="3" cols="40"');
        $mform->setType('temporary_address', PARAM_TEXT);
        $mform->addRule('temporary_address', get_string('required'), 'required','','client');
       
        
        $mform->addElement('select', 'employment_status', get_string('employment_status', 'local_accident_report'), createDropdown($dropdown['contract']));
        $mform->setType('employment_status', PARAM_TEXT);
        $mform->addRule('employment_status', get_string('required'), 'required','','client');

        
        $mform->addElement('select', 'occupation', get_string('occupation', 'local_accident_report'), createDropdown($dropdown['contract']));
        $mform->setType('occupation', PARAM_TEXT);
        $mform->addRule('occupation', get_string('required'), 'required','','client');

        
        $mform->addElement('text', 'nature_of_injury', get_string('nature_of_injury', 'local_accident_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('nature_of_injury', PARAM_TEXT);
        $mform->addRule('nature_of_injury', get_string('required'), 'required','','client');

        $mform->addElement('text', 'part_of_body_affected', get_string('part_of_body_affected', 'local_accident_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('part_of_body_affected', PARAM_TEXT);
        $mform->addRule('part_of_body_affected', get_string('required'), 'required','','client');
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">DATE, TIME, AND PLACE OF ACCIDENT/INCIDENT/DANGEROUS OCCURRENCE</legend>');

        $mform->addElement('date_selector', 'occurrence_date', get_string('occurrence_date', 'local_accident_report'), 'maxlength="100" size="40" ');
        $mform->setType('occurrence_date', PARAM_TEXT);
        $mform->addRule('occurrence_date', get_string('required'), 'required','','client');

        $mform->addElement('text', 'name_address_of_site', get_string('name_address_of_site', 'local_accident_report'), 'maxlength="100" size="40" ');
        $mform->setType('name_address_of_site', PARAM_TEXT);
        $mform->addRule('name_address_of_site', get_string('required'), 'required','','client');

        $mform->addElement('text', 'exect_location_on_site', get_string('exect_location_on_site', 'local_accident_report'), 'maxlength="100" size="40" ');
        $mform->setType('exect_location_on_site', PARAM_TEXT);
        $mform->addRule('exect_location_on_site', get_string('required'), 'required','','client');

        

        $mform->addElement('text', 'work_type_of_occurrence', get_string('work_type_of_occurrence', 'local_accident_report'), 'maxlength="100" size="40" ');
        $mform->setType('work_type_of_occurrence', PARAM_TEXT);
        $mform->addRule('work_type_of_occurrence', get_string('required'), 'required','','client');

        

        $mform->addElement('date_selector', 'reported_datetime', get_string('reported_datetime', 'local_accident_report'), 'maxlength="100" size="40" ');
        $mform->setType('reported_datetime', PARAM_TEXT);
        $mform->addRule('reported_datetime', get_string('required'), 'required','','client');

        $mform->addElement('text', 'injured_person_believe', get_string('injured_person_believe', 'local_accident_report'), 'maxlength="100" size="40" ');
        $mform->setType('injured_person_believe', PARAM_TEXT);
        $mform->addRule('injured_person_believe', get_string('required'), 'required','','client');

        
        $mform->addElement('text', 'witness_name_address', get_string('witness_name_address', 'local_accident_report'), 'maxlength="100" size="40" ');
        $mform->setType('witness_name_address', PARAM_TEXT);
        $mform->addRule('witness_name_address', get_string('required'), 'required','','client');

        $mform->addElement('html', '</fieldset>');

        //$mform->addElement('text', 'accident_report_number', get_string('accident_report_number', 'local_accident_report'), 'maxlength="100" size="40" ');
        //$mform->setType('accident_report_number', PARAM_TEXT);
        //$mform->addRule('accident_report_number', get_string('required'), 'required','','client');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">KIND OF ACCIDENT/INCIDENT/DANGEROUS OCCURRENCE</legend>');

       

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">AGENT(S) INVOLVED</legend>');
       
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">ACCOUNT OF INCIDENT/DANGEROUS OCCURRENCE</legend><br><br>');
       
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">ACTION TAKEN TO PREVENT RE-OCCURRENCE </legend><br><br>');
       
        $mform->addElement('html', '</fieldset>');


        $mform->addFormRule('checkWitness');

    }

    public function userPartView($reportData){

        global $CFG;

        $mform = $this->_form;
        $managerList  = get_com_manager_list();
        $dropdown     = get_dropdown_data(1);
        $user         = get_userInfo(array("id" => $reportData->user_id));

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">User Details</legend>');
        $mform->addElement('static', 'name1', get_string('name', 'local_accident_report'),$user->firstname.' '.$user->lastname );

        $mform->addElement('static', 'address1', get_string('address', 'local_accident_report'),$reportData->user_address);
        $mform->addElement('static', 'postcode1', get_string('postcode', 'local_accident_report'),$reportData->user_postcode);
        $mform->addElement('static', 'occupation1', get_string('occupation', 'local_accident_report'),$reportData->user_occupation);
        $mform->addElement('static', 'user_contract1', get_string('user_contract', 'local_accident_report'),@$dropdown['contract'][$reportData->user_contract]);
        $mform->addElement('static', 'user_manager1', get_string('user_manager', 'local_accident_report'),$managerList[$reportData->user_manager]);
        $mform->addElement('static', 'user_date1', get_string('user_date', 'local_accident_report'), date("d-M-Y",$reportData->user_date));
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">About the Person who had the accident</legend>');
        $mform->addElement('static', 'victim_name1', get_string('victim_name', 'local_accident_report'),$reportData->victim_name);
        $mform->addElement('static', 'victim_address1', get_string('victim_address', 'local_accident_report'),$reportData->victim_address);

        $mform->addElement('static', 'victim_postcode1', get_string('victim_postcode', 'local_accident_report'),$reportData->victim_postcode);
        $mform->addElement('static', 'victim_occupation1', get_string('victim_occupation', 'local_accident_report'),$reportData->victim_occupation);
        $mform->addElement('html', '</fieldset>');


        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">About the accident</legend>');


        $mform->addElement('static', 'accident_date1', get_string('accident_date', 'local_accident_report'), date("d-M-Y G:i:s",$reportData->accident_date));
        $mform->addElement('static', 'accident_place1', get_string('accident_place', 'local_accident_report'),$reportData->accident_place);
        $mform->addElement('static', 'accident_reason1', get_string('accident_reason', 'local_accident_report'),$reportData->accident_reason);
        $mform->addElement('static', 'accident_detail1', get_string('accident_detail', 'local_accident_report'),$reportData->accident_detail);
        $mform->addElement('static', 'accident_category1', get_string('accident_category', 'local_accident_report'), @$dropdown['category'][$reportData->accident_category]);
        $mform->addElement('static', 'accident_treatment1', get_string('accident_treatment', 'local_accident_report'), $reportData->accident_treatment);
        $mform->addElement('static', 'minor_injuries1', get_string('minor_injuries', 'local_accident_report'), $reportData->minor_injuries);

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Accident Witness Report</legend>');
        $mform->addElement('static', 'accident_witnesses1', get_string('accident_witnesses', 'local_accident_report'),$reportData->accident_witnesses ? "Yes" : 'No');

        if($reportData->accident_witnesses==1) {
            $mform->addElement('static', 'witnesses_name1', get_string('witnesses_name', 'local_accident_report'), decrypt($reportData->witnesses_name));
            $mform->addElement('static', 'witnesses_address1', get_string('witnesses_address', 'local_accident_report'), decrypt($reportData->witnesses_address));
            $mform->addElement('static', 'witnesses_phone_number1', get_string('witnesses_phone_number', 'local_accident_report'), decrypt($reportData->witnesses_phone_number));
            $mform->addElement('static', 'witnesses_report_date1', get_string('witnesses_report_date', 'local_accident_report'), date("d-M-Y", $reportData->witnesses_report_date));
            $mform->addElement('static', 'witnesses_report_details1', get_string('witnesses_report_details', 'local_accident_report'), $reportData->witnesses_report_details);

            //$imageCode = "<a data-fancybox='gallery' href='/local/accident_report/upload/$reportData->witnesses_report_diagram' data-lightbox='witnesses_report_diagram'> <img src='/local/accident_report/upload/$reportData->witnesses_report_diagram' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";

            //$mform->addElement('static', 'witnesses_report_diagram1', get_string('witnesses_report_diagram', 'local_accident_report'), $imageCode);
        }
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Photos</legend>');
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https' : 'http';
        $context  = stream_context_create(array($protocol => array('header'=>'Connection: close\r\n')));

        $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_1";
        $imageData   = base64_encode(file_get_contents($image,false,$context));
        $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
        $imageCode1  = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_1'> <img  class='example-image'  src='$src' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /> </a>";
        $mform->addElement('static', 'photo_11', get_string('photo_1', 'local_accident_report'), $imageCode1);

        $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_2";
        $imageData   = base64_encode(file_get_contents($image,false,$context));
        $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
        $imageCode2  = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_2'> <img src='$src' class='fancybox' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";
        $mform->addElement('static', 'photo_21', get_string('photo_2', 'local_accident_report'), $imageCode2);

        if (!empty($reportData->photo_3)){

            $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_3";
            $imageData   = base64_encode(file_get_contents($image,false,$context));
            $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
            $imageCode   = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_2'><img src='$src' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";
            $mform->addElement('static', 'photo_31', get_string('photo_3', 'local_accident_report'), $imageCode);
        }

        if (!empty($reportData->photo_4)){
            $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_4";
            $imageData   = base64_encode(file_get_contents($image,false,$context));
            $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
            $imageCode = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_2'><img src='$src' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";
            $mform->addElement('static', 'photo_41', get_string('photo_4', 'local_accident_report'), $imageCode);
        }

        if (!empty($reportData->photo_5)){
            $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_5";
            $imageData   = base64_encode(file_get_contents($image,false,$context));
            $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
            $imageCode = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_2'><img src='$src' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";
            $mform->addElement('static', 'photo_51', get_string('photo_5', 'local_accident_report'), $imageCode);
        }

        if (!empty($reportData->photo_6)){
            $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_6";
            $imageData   = base64_encode(file_get_contents($image,false,$context));
            $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
            $imageCode = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_2'><img src='$src' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";
            $mform->addElement('static', 'photo_61', get_string('photo_6', 'local_accident_report'), $imageCode);
        }
        $mform->addElement('html', '</fieldset>');

        $mform->addFormRule('checkWitness');
    }

    public function managerPartForm($reportData){
        global $USER, $CFG,$DB;

        $dropdown = get_dropdown_data(1);

        //echo "<pre>";
        //print_r($dropdown);
        //die;

        $mform = $this->_form;

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Line Manager Review</legend>');

        $mform->addElement('select', 'manager_id', get_string('manager_name', 'local_accident_report'), createDropdown(get_com_manager_list()));
        $mform->setType('manager_id', PARAM_TEXT);
        $mform->setDefault('manager_id', $reportData->manager_id);
        $mform->addRule('manager_id', get_string('required'), 'required', '', 'client');

        $radioarray   = array();
        $radioarray[] = $mform->createElement('radio', 'accident_additional_details', '', "Yes", 'Yes');
        $radioarray[] = $mform->createElement('radio', 'accident_additional_details', '', "No", 'No');
        $mform->addGroup($radioarray, 'accident_additional_details', get_string('accident_additional_details','local_accident_report'), array(''), false);
        $mform->addRule('accident_additional_details', get_string('required'), 'required','','client');
        $mform->setDefault('accident_additional_details', $reportData->accident_additional_details);

        $mform->addElement('textarea', 'additional_details', get_string('additional_details', 'local_accident_report'), 'wrap="virtual" rows="6" cols="40"');
        $mform->setType('additional_details', PARAM_TEXT);
        $mform->setDefault('additional_details', $reportData->additional_details);
        //$mform->addRule('additional_details', get_string('required'), 'required','','client');
        $mform->hideIf('additional_details', 'accident_additional_details',  'eq', 'No');

        $mform->addElement('textarea', 'root_cause', get_string('root_cause', 'local_accident_report'), 'wrap="virtual" rows="6" cols="40"');
        $mform->setType('root_cause', PARAM_TEXT);
        $mform->setDefault('root_cause', $reportData->root_cause);
        $mform->addRule('root_cause', get_string('required'), 'required','','client');

        $mform->addElement('textarea', 'immediate_action', get_string('immediate_action', 'local_accident_report'), 'wrap="virtual" rows="6" cols="40"');
        $mform->setType('immediate_action', PARAM_TEXT);
        $mform->setDefault('immediate_action', $reportData->immediate_action);
        $mform->addRule('immediate_action', get_string('required'), 'required','','client');

        $mform->addElement('textarea', 'further_action_required', get_string('further_action_required', 'local_accident_report'), 'wrap="virtual" rows="6" cols="40"');
        $mform->setType('further_action_required', PARAM_TEXT);
        $mform->setDefault('further_action_required', $reportData->further_action_required);
        $mform->addRule('further_action_required', get_string('required'), 'required','','client');


        $radioarray   = array();
        $radioarray[] = $mform->createElement('radio', 'lost_time', '', "Yes", 'Yes');
        $radioarray[] = $mform->createElement('radio', 'lost_time', '', "No", 'No');
        $mform->addGroup($radioarray, 'lost_time', get_string('lost_time','local_accident_report'), array(''), false);
        $mform->addRule('lost_time', get_string('required'), 'required','','client');
        $mform->setDefault('lost_time', $reportData->lost_time);

        $mform->addElement('text', 'lost_time_days', get_string('lost_time_days', 'local_accident_report'), 'maxlength="3" size="10" ');
        $mform->setType('lost_time_days', PARAM_INT);
        $mform->setDefault('lost_time_days', $reportData->lost_time_days);
//        $mform->addRule('lost_time_days', get_string('required'), 'required','','client');
        $mform->disabledIf('lost_time_days', 'lost_time',  'eq', 'No');


        $mform->addElement('date_selector', 'mgt_review_report_date', get_string('mgt_review_report_date', 'local_accident_report'), 'maxlength="100" size="40" ');
        $mform->setType('mgt_review_report_date', PARAM_TEXT);
        $mform->setDefault('mgt_review_report_date', $reportData->mgt_review_report_date);
        $mform->addRule('mgt_review_report_date', get_string('required'), 'required','','client');

        $mform->addElement('select', 'mgt_review_status', get_string('mgt_review_status', 'local_accident_report'), createDropdown($dropdown['mgt_review_status']));
        $mform->setType('mgt_review_status', PARAM_TEXT);
        $mform->setDefault('mgt_review_status', $reportData->mgt_review_status);
        $mform->addRule('mgt_review_status', get_string('required'), 'required','','client');

        $mform->addElement('textarea', 'mgt_review_comments', get_string('mgt_review_comments', 'local_accident_report'), 'wrap="virtual" rows="6" cols="40"');
        $mform->setType('mgt_review_comments', PARAM_TEXT);
        $mform->setDefault('mgt_review_comments', $reportData->mgt_review_comments);
        $mform->addRule('mgt_review_comments', get_string('required'), 'required','','client');
        $mform->addElement('html', '</fieldset>');


        $mform->addFormRule('accidentManagerVaidations');

        if(!empty($reportData->manager_id) and (is_senior_manager() or is_complieance() or is_admin())) {
            $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Senior Management Report</legend>');
            $mform->addElement('select', 's_mgt_rpt_name', get_string('s_mgt_rpt_name', 'local_accident_report'), createDropdown(get_s_manager_and_complience_list()));
            $mform->setType('s_mgt_rpt_name', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_name', $reportData->s_mgt_rpt_name);
            $mform->addRule('s_mgt_rpt_name', get_string('required'), 'required', '', 'client');

            $mform->addElement('date_selector', 's_mgt_rpt_report_date', get_string('s_mgt_rpt_report_date', 'local_accident_report'), 'maxlength="100" size="40" ');
            $mform->setType('s_mgt_rpt_report_date', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_report_date', $reportData->s_mgt_rpt_report_date);
            $mform->addRule('s_mgt_rpt_report_date', get_string('required'), 'required', '', 'client');

            $mform->addElement('textarea', 's_mgt_rpt_comments', get_string('s_mgt_rpt_comments', 'local_accident_report'), 'wrap="virtual" rows="6" cols="40"');
            $mform->setType('s_mgt_rpt_comments', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_comments', $reportData->s_mgt_rpt_comments);
            $mform->addRule('s_mgt_rpt_comments', get_string('required'), 'required', '', 'client');


            $mform->addElement('select', 's_mgt_rpt_f_action', get_string('s_mgt_rpt_f_action', 'local_accident_report'), createDropdown($dropdown['further_action']));
            $mform->setType('s_mgt_rpt_f_action', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_f_action', $reportData->s_mgt_rpt_f_action);
            $mform->addRule('s_mgt_rpt_f_action', get_string('required'), 'required', '', 'client');

            $mform->addElement('textarea', 's_mgt_rpt_f_a_comment', get_string('s_mgt_rpt_f_a_comment', 'local_accident_report'), 'wrap="virtual" rows="6" cols="40"');
            $mform->setType('s_mgt_rpt_f_a_comment', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_f_a_comment', $reportData->s_mgt_rpt_f_a_comment);
            $mform->addRule('s_mgt_rpt_f_a_comment', get_string('required'), 'required', '', 'client');

            /*
            $mform->addElement('select', 's_mgt_rpt_a_b_completed', get_string('s_mgt_rpt_a_b_completed', 'local_accident_report'), $dropdown['yes_no']);
            $mform->setType('s_mgt_rpt_a_b_completed', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_a_b_completed', $reportData->s_mgt_rpt_a_b_completed);
            $mform->addRule('s_mgt_rpt_a_b_completed', get_string('required'), 'required','','client');

            $mform->addElement('date_selector', 's_mgt_rpt_a_b_cpt_date', get_string('s_mgt_rpt_a_b_cpt_date', 'local_accident_report'), 'maxlength="100" size="40" ');
            $mform->setType('s_mgt_rpt_a_b_cpt_date', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_a_b_cpt_date', $reportData->s_mgt_rpt_a_b_cpt_date);
            //$mform->addRule('s_mgt_rpt_a_b_cpt_date', get_string('required'), 'required','','client');
            $mform->disabledIf('s_mgt_rpt_a_b_cpt_date', 's_mgt_rpt_a_b_completed',  'neq', 1);
            */
            $mform->addElement('select', 's_mgt_rpt_2508_completed', get_string('s_mgt_rpt_2508_completed', 'local_accident_report'), $dropdown['yes_no']);
            $mform->setType('s_mgt_rpt_2508_completed', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_2508_completed', $reportData->s_mgt_rpt_2508_completed);
            $mform->addRule('s_mgt_rpt_2508_completed', get_string('required'), 'required', '', 'client');

            $mform->addElement('date_selector', 's_mgt_rpt_2508_cpt_date', get_string('s_mgt_rpt_2508_cpt_date', 'local_accident_report'), 'maxlength="100" size="40" ');
            $mform->setType('s_mgt_rpt_2508_cpt_date', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_2508_cpt_date', $reportData->s_mgt_rpt_2508_cpt_date);
            //$mform->addRule('s_mgt_rpt_2508_cpt_date', get_string('required'), 'required','','client');
            $mform->disabledIf('s_mgt_rpt_2508_cpt_date', 's_mgt_rpt_2508_completed', 'neq', 1);

            $mform->addElement('select', 's_mgt_rpt_riddor_event_clf', get_string('s_mgt_rpt_riddor_event_clf', 'local_accident_report'), createDropdown($dropdown['riddor_classification']));
            $mform->setType('s_mgt_rpt_riddor_event_clf', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_riddor_event_clf', $reportData->s_mgt_rpt_riddor_event_clf);
            //$mform->addRule('s_mgt_rpt_riddor_event_clf', get_string('required'), '','','client');
            $mform->disabledIf('s_mgt_rpt_riddor_event_clf', 's_mgt_rpt_2508_completed', 'neq', 1);

            $mform->addElement('select', 'riddor_subcategory', get_string('s_mgt_rpt_riddor_subcategory', 'local_accident_report'), createDropdown($dropdown['RIDDOR_subcategory']));
            $mform->setType('riddor_subcategory', PARAM_TEXT);
            $mform->setDefault('riddor_subcategory', $reportData->riddor_subcategory);

            $html = "<div class='form-group row' id='riddor_file_div'> 
            
            <div class='col-md-3'> RIDDOR Files</div> <div class='col-md-6'>
           <form method='post' enctype='multipart/form-data'>";

            $html .= "<input type='file' name='riddor_file' id='riddor_file' data-accid='$reportData->id' maxlength='200' size='40'>";
            $html .= '</<form></div></div>';
            $mform->addElement('html', $html, 'local_accident_report');

            $result = $DB->get_records("accident_riddor_files",array('accident_id' => $reportData->id));

            $table = new html_table();
            $table->attributes['class'] = 'table generaltable  dataTable no-footer riddor_file_td';
            $table->width = '100%';


            $table->head  = array("File Name","Action");
            $table->align = array( 'left','center');
            $table->size  = array('75%',"25%");


            $html = "<div class='form-group row' id='riddor_file_table'> <div class='col-md-3'></div> <div class='col-md-6'>";
            foreach($result as $rec) {
                $downoadLink = "<a target='new' href='$rec->file_location'> View </a> | <a href='javascript::void(0)' id='del_riddor_file' data-id='$rec->id' > Delete </a>";
                $table->data[] = new html_table_row(array($rec->file_name,$downoadLink));
            }
            $html .= html_writer::table($table);
            $html .= "<hr></br></div></div>";



            $mform->addElement('html', $html, 'local_accident_report');



            //$mform->addRule('s_mgt_rpt_riddor_event_clf', get_string('required'), '','','client');
            //$mform->hideIf('riddor_file', 's_mgt_rpt_riddor_event_clf', 'eq', '');
            $mform->hideIf('riddor_subcategory', 's_mgt_rpt_2508_completed', 'neq', 1);
            $mform->hideIf('riddor_subcategory', 's_mgt_rpt_riddor_event_clf', 'eq', 16);
            $mform->hideIf('riddor_subcategory', 's_mgt_rpt_riddor_event_clf', 'eq', 18);
            $mform->hideIf('riddor_subcategory', 's_mgt_rpt_riddor_event_clf', 'eq', 19);
            $mform->hideIf('riddor_subcategory', 's_mgt_rpt_riddor_event_clf', 'eq', 22);


            $mform->addElement('select', 's_mgt_rpt_reported_en_a', get_string('s_mgt_rpt_reported_en_a', 'local_accident_report'), $dropdown['yes_no']);
            $mform->setType('s_mgt_rpt_reported_en_a', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_reported_en_a', $reportData->s_mgt_rpt_reported_en_a);
            $mform->addRule('s_mgt_rpt_reported_en_a', get_string('required'), 'required', '', 'client');

            $mform->addElement('date_selector', 's_mgt_rpt_reported_en_a_date', get_string('s_mgt_rpt_reported_en_a_date', 'local_accident_report'), 'maxlength="100" size="40" ');
            $mform->setType('s_mgt_rpt_reported_en_a_date', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_reported_en_a_date', $reportData->s_mgt_rpt_reported_en_a_date);
            //$mform->addRule('s_mgt_rpt_reported_en_a_date', get_string('required'), 'required','','client');
            $mform->disabledIf('s_mgt_rpt_reported_en_a_date', 's_mgt_rpt_reported_en_a', 'neq', 1);

            $mform->addElement('select', 's_mgt_rpt_sr_mgr_notified', get_string('s_mgt_rpt_sr_mgr_notified', 'local_accident_report'), $dropdown['yes_no']);
            $mform->setType('s_mgt_rpt_sr_mgr_notified', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_sr_mgr_notified', $reportData->s_mgt_rpt_sr_mgr_notified);
            $mform->addRule('s_mgt_rpt_sr_mgr_notified', get_string('required'), 'required', '', 'client');

            $mform->addElement('date_selector', 's_mgt_rpt_sr_mgr_notified_date', get_string('s_mgt_rpt_sr_mgr_notified_date', 'local_accident_report'), 'maxlength="100" size="40" ');
            $mform->setType('s_mgt_rpt_sr_mgr_notified_date', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_sr_mgr_notified_date', $reportData->s_mgt_rpt_sr_mgr_notified_date);
            //$mform->addRule('s_mgt_rpt_sr_mgr_notified_date', get_string('required'), 'required','','client');
            $mform->disabledIf('s_mgt_rpt_sr_mgr_notified_date', 's_mgt_rpt_sr_mgr_notified', 'neq', 1);

            $mform->addElement('select', 's_mgt_rpt_in_br_informed', get_string('s_mgt_rpt_in_br_informed', 'local_accident_report'), $dropdown['yes_no']);
            $mform->setType('s_mgt_rpt_in_br_informed', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_in_br_informed', $reportData->s_mgt_rpt_in_br_informed);
            $mform->addRule('s_mgt_rpt_in_br_informed', get_string('required'), 'required', '', 'client');

            //$mform->addElement('date_selector', 's_mgt_rpt_in_br_informed_date', get_string('s_mgt_rpt_in_br_informed_date', 'local_accident_report'), 'maxlength="100" size="40" ');
            //$mform->setType('s_mgt_rpt_in_br_informed_date', PARAM_TEXT);
            //$mform->setDefault('s_mgt_rpt_in_br_informed_date', $reportData->s_mgt_rpt_in_br_informed_date);
            //$mform->addRule('s_mgt_rpt_in_br_informed_date', get_string('required'), 'required','','client');
            //$mform->disabledIf('s_mgt_rpt_in_br_informed_date', 's_mgt_rpt_in_br_informed', 'neq', 1);


            $radioarray = array();
            $radioarray[] = $mform->createElement('radio', 's_mgt_rpt_ant_closed_off', '', "Yes", 1);
            $radioarray[] = $mform->createElement('radio', 's_mgt_rpt_ant_closed_off', '', "No", 0);
            $mform->addGroup($radioarray, 's_mgt_rpt_ant_closed_off', get_string('s_mgt_rpt_ant_closed_off', 'local_accident_report'), array(' '), false);
            $mform->addRule('s_mgt_rpt_ant_closed_off', get_string('required'), 'required', '', 'client');
            $mform->setDefault('s_mgt_rpt_ant_closed_off', $reportData->s_mgt_rpt_ant_closed_off);

            $mform->addElement('date_selector', 's_mgt_rpt_ant_closed_off_date', get_string('s_mgt_rpt_ant_closed_off_date', 'local_accident_report'), 'maxlength="100" size="40" ');
            $mform->setType('s_mgt_rpt_ant_closed_off_date', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_ant_closed_off_date', $reportData->s_mgt_rpt_ant_closed_off_date);
            //$mform->addRule('s_mgt_rpt_ant_closed_off_date', get_string('required'), 'required','','client');
            $mform->disabledIf('s_mgt_rpt_ant_closed_off_date', 's_mgt_rpt_ant_closed_off', 'neq', 1);


            $mform->addElement('html', '</fieldset>');

            $mform->addFormRule('accidentDateRequired');
            $mform->addFormRule('accidentSeniorManagerVaidations');

        }

        if( is_senior_manager() || is_complieance() || is_admin() || is_manager()) {
            $pdfbuttons ='<div class="row" >
                <div class="col-sm-6">
                    
                 </div>
                <div class="col-sm-6" style="text-align: right !important;">     
                     <a class="btn btn-dark" style="background-color: #fcc42c; border-color: #fcc42c !important;" href="index.php?cmd=acc_pdf&id='.$_REQUEST['id'].'&download=1&uid='.$reportData->user_id.'&d='.$reportData->accident_date.'"><i class="fa fa-check-circle"> </i> Export Initial Report as PDF </a>
                
                     <a class="btn btn-dark" style="background-color: #2441e7; border-color: #2441e7 !important;" href="index.php?cmd=acc_full_pdf&id='.$_REQUEST['id'].'&download=1&uid='.$reportData->user_id.'&d='.$reportData->accident_date.'"><i class="fa fa-plus-circle"> </i> Export Full Report as PDF</a>
                 </div>
             </div><hr>';
        }
        $mform->addElement('html', $pdfbuttons);

    }

    public function managerPartView($reportData){
        global $USER, $CFG;

        $dropdown = get_dropdown_data(1);

        //echo "<pre>";
        //print_r($dropdown);
        //die;

        $mform = $this->_form;

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Line Manager Review</legend>');
        $manager_list = get_com_manager_list();
        $mform->addElement('static', 'manager_id', get_string('manager_name', 'local_accident_report'), $manager_list[$reportData->manager_id]);
        $mform->addElement('static', 'accident_additional_details', get_string('accident_additional_details', 'local_accident_report'), $reportData->accident_additional_details);
        $mform->addElement('static', 'additional_details', get_string('additional_details', 'local_accident_report'), $reportData->additional_details);
        $mform->addElement('static', 'root_cause', get_string('root_cause', 'local_accident_report'), $reportData->root_cause);
        $mform->addElement('static', 'immediate_action', get_string('immediate_action', 'local_accident_report'), $reportData->immediate_action);
        $mform->addElement('static', 'further_action_required', get_string('further_action_required', 'local_accident_report'), $reportData->further_action_required);
        $mform->addElement('static', 'lost_time', get_string('lost_time','local_accident_report'), $reportData->lost_time);
        $mform->addElement('static', 'lost_time_days', get_string('lost_time_days', 'local_accident_report'), $reportData->lost_time_days);
        $mform->addElement('static', 'mgt_review_report_date', get_string('mgt_review_report_date', 'local_accident_report'), date('d-M-Y',$reportData->mgt_review_report_date));
        $mform->addElement('static', 'mgt_review_status', get_string('mgt_review_status', 'local_accident_report'), $dropdown['mgt_review_status'][$reportData->mgt_review_status]);
        $mform->addElement('static', 'mgt_review_comments', get_string('mgt_review_comments', 'local_accident_report'), $reportData->mgt_review_comments);
        $mform->addElement('html', '</fieldset>');

        if(!empty($reportData->manager_id) and (is_senior_manager() or is_complieance() or is_admin())) {
            $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Senior Management Report</legend>');

            $s_manager_and_complience_list = get_s_manager_and_complience_list();
            $mform->addElement('static', 's_mgt_rpt_name', get_string('s_mgt_rpt_name', 'local_accident_report'), $s_manager_and_complience_list[$reportData->s_mgt_rpt_name]);
            $mform->addElement('static', 's_mgt_rpt_report_date', get_string('s_mgt_rpt_report_date', 'local_accident_report'), date('d-M-Y',$reportData->s_mgt_rpt_report_date));
            $mform->addElement('static', 's_mgt_rpt_comments', get_string('s_mgt_rpt_comments', 'local_accident_report'), $reportData->s_mgt_rpt_comments);
            $mform->addElement('static', 's_mgt_rpt_f_action', get_string('s_mgt_rpt_f_action', 'local_accident_report'), $dropdown['further_action'][$reportData->s_mgt_rpt_f_action]);
            $mform->addElement('static', 's_mgt_rpt_f_a_comment', get_string('s_mgt_rpt_f_a_comment', 'local_accident_report'), $reportData->s_mgt_rpt_f_a_comment);
            $mform->addElement('static', 's_mgt_rpt_2508_completed', get_string('s_mgt_rpt_2508_completed', 'local_accident_report'), $dropdown['yes_no'][$reportData->s_mgt_rpt_2508_completed]);
            $mform->addElement('static', 's_mgt_rpt_2508_cpt_date', get_string('s_mgt_rpt_2508_cpt_date', 'local_accident_report'), date('d-M-Y',$reportData->s_mgt_rpt_2508_cpt_date));
            $mform->addElement('static', 's_mgt_rpt_riddor_event_clf', get_string('s_mgt_rpt_riddor_event_clf', 'local_accident_report'), $dropdown['riddor_classification'][$reportData->s_mgt_rpt_riddor_event_clf]);
            $mform->addElement('static', 'riddor_subcategory', get_string('s_mgt_rpt_riddor_subcategory', 'local_accident_report'), $dropdown['RIDDOR_subcategory'][$reportData->riddor_subcategory]);
            $mform->addElement('static', 's_mgt_rpt_reported_en_a', get_string('s_mgt_rpt_reported_en_a', 'local_accident_report'), $dropdown['yes_no'][$reportData->s_mgt_rpt_reported_en_a]);
            $mform->addElement('static', 's_mgt_rpt_reported_en_a_date', get_string('s_mgt_rpt_reported_en_a_date', 'local_accident_report'), date('d-M-Y',$reportData->s_mgt_rpt_reported_en_a_date));
            $mform->addElement('static', 's_mgt_rpt_sr_mgr_notified', get_string('s_mgt_rpt_sr_mgr_notified', 'local_accident_report'), $dropdown['yes_no'][$reportData->s_mgt_rpt_sr_mgr_notified]);
            $mform->addElement('static', 's_mgt_rpt_sr_mgr_notified_date', get_string('s_mgt_rpt_sr_mgr_notified_date', 'local_accident_report'), date('d-M-Y',$reportData->s_mgt_rpt_sr_mgr_notified_date));
            $mform->addElement('static', 's_mgt_rpt_in_br_informed', get_string('s_mgt_rpt_in_br_informed', 'local_accident_report'), $dropdown['yes_no'][$reportData->s_mgt_rpt_in_br_informed]);
            $mform->addElement('static', 's_mgt_rpt_ant_closed_off', get_string('s_mgt_rpt_ant_closed_off', 'local_accident_report'), $dropdown['yes_no'][$reportData->s_mgt_rpt_ant_closed_off]);
            $mform->addElement('static', 's_mgt_rpt_ant_closed_off_date', get_string('s_mgt_rpt_ant_closed_off_date', 'local_accident_report'), date('d-M-Y',$reportData->s_mgt_rpt_ant_closed_off_date));

            $mform->addElement('html', '</fieldset>');

        }

        if( is_senior_manager() || is_complieance() || is_admin() || is_manager()) {
            $pdfbuttons ='<div class="row" >
                <div class="col-sm-6">
                    
                 </div>
                <div class="col-sm-6" style="text-align: right !important;">     
                     <a class="btn btn-dark" style="background-color: #fcc42c; border-color: #fcc42c !important;" href="index.php?cmd=acc_pdf&id='.$_REQUEST['id'].'&download=1&uid='.$reportData->user_id.'&d='.$reportData->accident_date.'"><i class="fa fa-check-circle"> </i> Export Initial Report as PDF </a>
                
                     <a class="btn btn-dark" style="background-color: #2441e7; border-color: #2441e7 !important;" href="index.php?cmd=acc_full_pdf&id='.$_REQUEST['id'].'&download=1&uid='.$reportData->user_id.'&d='.$reportData->accident_date.'"><i class="fa fa-plus-circle"> </i> Export Full Report as PDF</a>
                 </div>
             </div><hr>';
         }
        $mform->addElement('html', $pdfbuttons);

    }

    public function definition() {
        global $PAGE,$USER, $CFG;
        $btnLavel = "";

        $mform = $this->_form;


		$heading = '<h3 style="text-align: center">'.get_string('accident', 'local_accident_report');
        $report_closed = FALSE;
        if(isset($_REQUEST['id']) && $_REQUEST['cmd']=='acc_edit' &&( is_senior_manager() || is_complieance() || is_admin() || is_manager()) ) {
            $reportData = get_data(array("id"=>$_REQUEST['id']),get_string('accident_table','local_accident_report'));

            if ($reportData->s_mgt_rpt_ant_closed_off==1){
                $report_closed = TRUE;
            }

            if( is_senior_manager() || is_complieance() || is_admin() || is_manager()) {

                $heading ='<div class="row" >
                <div class="col-sm-6">
                    <h3 id="report_headding">'.get_string('accident', 'local_accident_report').'</h3>
                 </div>
                <div class="col-sm-6" style="text-align: right !important;">    
                     <a class="btn btn-dark" style="background-color: #fcc42c; border-color: #fcc42c !important;" onclick="history.back()"><i class="fa fa-backward"> </i> Back</a>
                 
                     <a class="btn btn-dark" style="background-color: #0a4e8a ; border-color: #0a4e8a !important;" href="index.php?cmd=acc_pdf&id='.$_REQUEST['id'].'&download=1&uid='.$reportData->user_id.'&d='.$reportData->accident_date.'"><i class="fa fa-check-circle"> </i> Export Initial Report as PDF </a>
                
                     <a class="btn btn-dark" style="background-color: #2441e7; border-color: #2441e7 !important;" href="index.php?cmd=acc_full_pdf&id='.$_REQUEST['id'].'&download=1&uid='.$reportData->user_id.'&d='.$reportData->accident_date.'"><i class="fa fa-plus-circle"> </i> Export Full Report as PDF</a>
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
            $btnLavel = get_string('savebutton', 'local_accident_report');
        }
        else {
            $heading .= '</h3><hr>';
            $mform->addElement('html', $heading);
            $this->userPartForm();
            $btnLavel  = get_string('submitbtn', 'local_accident_report');

        }


        //$mform->addFormRule('accidentDateRequired');

        $mform->addElement('hidden', 'cmd', !empty($_REQUEST['cmd']) ? $_REQUEST['cmd'] : 'form1' );
        $mform->addElement('hidden', 'id', !empty($_REQUEST['id']) ? $_REQUEST['id'] : $mform->id);
        $mform->addElement('hidden', 'read_only', $mform->read_only);

        $buttonarray = array();
        if($reportData->read_only==0) {
            $buttonarray[] = $mform->createElement('submit', 'save',$btnLavel ,array("id"=>"save","style" =>"margin:8px;background-color:#137D1F !important"));
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
