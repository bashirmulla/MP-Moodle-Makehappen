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

defined('MOODLE_INTERNAL') || die;
ini_set('memory_limit', '2048M');
ini_set('max_execution_time', 0);
ini_set('upload_max_filesize', "512M");
ini_set('post_max_size', "1024M");

require_once($CFG->libdir.'/formslib.php');
$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/mp_report/css/custom.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/mp_report/js/custom.js'));
class new_accident_report_form extends moodleform {

    public function userPartForm(){

        global $USER, $CFG;

        $mform = $this->_form;
        $mform->_maxFileSize = 90000000;
        $dropdown = get_new_dropdown_data(1);

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">A. THE INJURED / INVOLVED PERSON</legend>');

        $mform->addElement('text', 'a_surname', get_string('a_surname', 'local_mp_report'), 'maxlength="100" style="background-color:#efecec" size="40" disabled readonly');
        $mform->setType('a_surname', PARAM_TEXT);
        
        $mform->setDefault('a_surname', $USER->firstname);
       
        $mform->addElement('text', 'a_forename', get_string('a_forename', 'local_mp_report'), 'maxlength="100" style="background-color:#efecec" size="40" disabled readonly');
        $mform->setType('a_forename', PARAM_TEXT);
        
        $mform->setDefault('a_forename', $USER->lastname);


        $mform->addElement('textarea', 'a_home_address', get_string('a_home_address', 'local_mp_report'), 'wrap="virtual" rows="3" cols="40"');
        $mform->setType('a_home_address', PARAM_TEXT);
        $mform->addRule('a_home_address', get_string('required'), 'required','','client');
        

        $mform->addElement('text', 'a_postcode', get_string('a_postcode', 'local_mp_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('a_postcode', PARAM_TEXT);
        $mform->addRule('a_postcode', get_string('required'), 'required','','client');

        $mform->addElement('text', 'a_tel_no', get_string('a_tel_no', 'local_mp_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('a_tel_no', PARAM_TEXT);
        $mform->addRule('a_tel_no', get_string('required'), 'required','','client');

        $mform->addElement('select', 'a_sex', get_string('a_sex', 'local_mp_report'), createDropdown(array('Male' =>'Male','Female' =>'Female')));
        $mform->setType('a_sex', PARAM_TEXT);
        $mform->addRule('a_sex', get_string('required'), 'required','','client');
        
        $mform->addElement('text', 'a_age', get_string('a_age', 'local_mp_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('a_age', PARAM_TEXT);
        $mform->addRule('a_age', get_string('required'), 'required','','client');

        $mform->addElement('select', 'a_following_accident', get_string('a_following_accident', 'local_mp_report'), createDropdown($dropdown['operative_at_now']));
        $mform->setType('a_following_accident', PARAM_TEXT);
        $mform->addRule('a_following_accident', get_string('required'), 'required','','client');

        $mform->addElement("html","<hr><h5> <b>THIS SECTION MUST BE COMPLETED </b> if resumed work on the day of the accident state time lost</h5>");

        $radioarray   = array();
        $radioarray[] = $mform->createElement('radio', 'a_resumed_work', '', "Yes", 'Yes');
        $radioarray[] = $mform->createElement('radio', 'a_resumed_work', '', "No", 'No');
        $mform->addGroup($radioarray, 'a_resumed_work', get_string('a_resumed_work','local_mp_report'), array(''), false);
        $mform->addRule('a_resumed_work', get_string('required'), 'required','','client');
        //$mform->setDefault('a_resumed_work', 'Yes');

           
        $mform->addElement('text', 'a_hours', get_string('a_hours', 'local_mp_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('a_hours', PARAM_INT);
       
        
        $mform->addElement('text', 'a_mins', get_string('a_mins', 'local_mp_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('a_mins', PARAM_INT);
       
        $mform->addElement("html","<hr>");


        $mform->addElement('textarea', 'a_temp_address', get_string('a_temp_address', 'local_mp_report'), 'wrap="virtual" rows="3" cols="40"');
        $mform->setType('a_temp_address', PARAM_TEXT);
        $mform->addRule('a_temp_address', get_string('required'), 'required','','client');
       
        
        $mform->addElement('select', 'a_status', get_string('a_status', 'local_mp_report'), createDropdown($dropdown['employment_status']));
        $mform->setType('a_status', PARAM_TEXT);
        $mform->addRule('a_status', get_string('required'), 'required','','client');

        
        $mform->addElement('text', 'a_job_title', get_string('a_job_title', 'local_mp_report'),  'maxlength="100" size="40" width="40px" ');
        $mform->setType('a_job_title', PARAM_TEXT);
        $mform->addRule('a_job_title', get_string('required'), 'required','','client');

        
        $mform->addElement('text', 'a_injury_condition', get_string('a_injury_condition', 'local_mp_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('a_injury_condition', PARAM_TEXT);
        $mform->addRule('a_injury_condition', get_string('required'), 'required','','client');

        $mform->addElement('text', 'a_body_affected', get_string('a_body_affected', 'local_mp_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('a_body_affected', PARAM_TEXT);
        $mform->addRule('a_body_affected', get_string('required'), 'required','','client');

        $mform->addElement('text', 'a_employers_name', get_string('a_employers_name', 'local_mp_report'), 'maxlength="100" size="40" width="40px" ');
        $mform->setType('a_employers_name', PARAM_TEXT);
        $mform->addRule('a_employers_name', get_string('required'), 'required','','client');
        

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">B. DATE, TIME, AND PLACE OF ACCIDENT/INCIDENT/DANGEROUS OCCURRENCE</legend>');

        $mform->addElement('date_time_selector', 'b_date', get_string('b_date', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('b_date', PARAM_TEXT);
        $mform->addRule('b_date', get_string('required'), 'required','','client');

        $mform->addElement('text', 'b_name_address_site', get_string('b_name_address_site', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('b_name_address_site', PARAM_TEXT);
        $mform->addRule('b_name_address_site', get_string('required'), 'required','','client');

        $mform->addElement('text', 'b_exact_location_site', get_string('b_exact_location_site', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('b_exact_location_site', PARAM_TEXT);
        $mform->addRule('b_exact_location_site', get_string('required'), 'required','','client');

        

        $mform->addElement('text', 'b_dangerous', get_string('b_dangerous', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('b_dangerous', PARAM_TEXT);
        $mform->addRule('b_dangerous', get_string('required'), 'required','','client');

        

        $mform->addElement('date_time_selector', 'b2_date', get_string('b2_date', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('b2_date', PARAM_TEXT);
        $mform->addRule('b2_date', get_string('required'), 'required','','client');

        $mform->addElement('text', 'b_injured', get_string('b_injured', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('b_injured', PARAM_TEXT);
        $mform->addRule('b_injured', get_string('required'), 'required','','client');


        
        $radioarray   = array();
        $radioarray[] = $mform->createElement('radio', 'b_witness', '', "Yes", 'Yes');
        $radioarray[] = $mform->createElement('radio', 'b_witness', '', "No", 'No');
        $mform->addGroup($radioarray, 'b_witness', get_string('b_witness','local_mp_report'), array(''), false);
        $mform->addRule('b_witness', get_string('required'), 'required','','client');
        
        $mform->addElement('text', 'b_witness_name', get_string('b_witness_name', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('b_witness_name', PARAM_TEXT);
        //$mform->addRule('b_witness_name', get_string('required'), 'required','','client');

        $mform->addElement('text', 'b_witness_address', get_string('b_witness_address', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('b_witness_address', PARAM_TEXT);
        //$mform->addRule('b_witness_address', get_string('required'), 'required','','client');

        $mform->addElement('text', 'b_tel_witness', get_string('b_tel_witness', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('b_tel_witness', PARAM_TEXT);
        //$mform->addRule('b_tel_witness', get_string('required'), 'required','','client');


        $mform->addElement('html', '</fieldset>');

        //$mform->addElement('text', 'mp_report_number', get_string('mp_report_number', 'local_mp_report'), 'maxlength="100" size="40" ');
        //$mform->setType('mp_report_number', PARAM_TEXT);
        //$mform->addRule('mp_report_number', get_string('required'), 'required','','client');

        $mform->addElement('html', '<fieldset id="occurrance_section" class="scheduler-border"><legend class="scheduler-border">C. KIND OF ACCIDENT/INCIDENT/DANGEROUS OCCURRENCE</legend>');
        $mform->addElement("html","<h6> Indicate what kind of accident, incident or dangerous occurrence led to the injury or condition (one box)</h6>");
         foreach($dropdown['kind_of_occurrence'] as $key=>$value){
            $mform->addElement('checkbox', 'c_kind_of_accident##'.$key, $value);
            $mform->setDefault('c_kind_of_accident##'.$key, '0');
            if($key==10)
            {
                
                $mform->addElement('text', 'c_metres', NULL, 'maxlength="100" size="40" style="width:150px" ');
                
                $mform->hideIf('c_metres', 'c_kind_of_accident##10',  'notchecked');
            }

         } 
       
        

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">D. AGENT(S) INVOLVED</legend>');
        $mform->addElement("html","<h6> Indicate which, if any of the categories of agent or factor were involved (tick one or more boxes)</h6>");

        foreach($dropdown['agent_involved'] as $key=>$value){
            $mform->addElement('checkbox', 'd_agents##'.$key, $value);
         } 


        $radioarray   = array();
        $radioarray[] = $mform->createElement('radio', 'd_first_aid', '', "Yes", 'Yes');
        $radioarray[] = $mform->createElement('radio', 'd_first_aid', '', "No", 'No');
        $mform->addGroup($radioarray, 'd_first_aid', get_string('firstaid_administered','local_mp_report'), array(''), false);
        $mform->addRule('d_first_aid', get_string('required'), 'required','','client');
      
        
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">E. ACCOUNT OF INCIDENT/DANGEROUS OCCURRENCE</legend>');
       
        $mform->addElement('textarea', 'e_accident_state', get_string('e_accident_state', 'local_mp_report'), 'wrap="virtual" rows="3" cols="40"');
        $mform->setType('e_accident_state', PARAM_TEXT);
        $mform->addRule('e_accident_state', get_string('required'), 'required','','client');

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">F. ACTION TAKEN TO PREVENT RE-OCCURRENCE </legend>');
        
        $mform->addElement('textarea', 'f_action_taken', get_string('f_action_taken', 'local_mp_report'), 'wrap="virtual" rows="3" cols="40"');
        $mform->setType('f_action_taken', PARAM_TEXT);
        $mform->addRule('f_action_taken', get_string('required'), 'required','','client');

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">DECLERATION </legend>');
        
        $mform->addElement('text', 'declaration_name_of_person', get_string('declaration_name_of_person', 'local_mp_report'), 'maxlength="100" style="background-color:#efecec" size="40" disabled readonly');
        $mform->setType('declaration_name_of_person', PARAM_TEXT);        
        $mform->setDefault('declaration_name_of_person', $USER->firstname.' '.$USER->lastname);

        $mform->addElement('date_time_selector', 'declaration_date', get_string('declaration_date', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('declaration_date', PARAM_TEXT);
        $mform->addRule('declaration_date', get_string('required'), 'required','','client');

        $mform->addElement('html', '</fieldset>');


        $mform->addFormRule('checkNewAccidentValidation');

    }

    
    public function userPartViewNew($reportData){

        global $CFG;

        $mform = $this->_form;
        $managerList  = get_com_manager_list();
        $dropdown     = get_new_dropdown_data(1);
        $user         = get_userInfo(array("id" => $reportData->user_id));
        ob_start();
        ?>
        
         <p id="view_p">A. THE INJURED / INVOLVED PERSON</p>
                <table id="view_table" width="100%">
                <tr>
                    <td>Surname: <br> <?=boldText($reportData->a_surname   ) ?></td>
                    <td>Forename(s): <br><?=boldText($reportData->a_forename   ) ?></td>
                </tr>
                <tr>
                    <td>Home Address: <br><?=boldText($reportData->a_home_address   ) ?></td>
                    <td>Tel No: <br><?=boldText($reportData->a_tel_no   ) ?></td>
                </tr>
                <tr>
                    <td>Sex (M/F): <br><?=boldText($reportData->a_sex   ) ?></td>
                    <td>Age: <?=boldText($reportData->a_age   ) ?></td>
                </tr>
                <tr>
                    <td>Following the accident, the Operative is now at:<br> <?=boldText($reportData->a_following_accident   ) ?></td>
                    <td>THIS SECTION MUST BE COMPLETED <br>If resumed work on the day of the accident state time lost: <br>

                    <?=($reportData->a_resumed_work=='No')? boldText($reportData->a_resumed_work ): boldText($reportData->a_hours).''. boldText($reportData->a_mins) ?>
                    </td>
                </tr>
                <tr>
                    <td>Temporary Address (if applicable): <br> <?=boldText($reportData->a_temp_address   ) ?></td>
                    <td>Status: <br><?=boldText($reportData->a_status   ) ?></td>
                </tr>
                <tr>
                    <td>Occupation or Job Title: <br><?=boldText($reportData->a_job_title   ) ?></td>
                    <td>(If Applicable) Employers Name and Address: </td>
                </tr>
                </table>
                
                <p  id="view_p">B. DATE, TIME, AND PLACE OF ACCIDENT/INCIDENT/DANGEROUS OCCURRENCE</p>
                <table id="view_table" width="100%">
                <tr>
                    <td>Date: <br><?=boldText(date("d-M-Y",$reportData->b_date)   ) ?></td>
                    <td>Time: <br><?=boldText(date("H:m",$reportData->b_date)   ) ?></td>
                </tr>
                <tr>
                    <td>Name & Address of Site: <br><?=boldText($reportData->b_name_address_site   ) ?></td>
                    <td>Exact Location on Site: <br><?=boldText($reportData->b_exact_location_site   ) ?></td>
                </tr>
                <tr>
                    <td>On what work was the operative engaged upon at the time and/or what was the dangerous occurrence?: <br><?=boldText($reportData->b_dangerous   ) ?></td>
                    <td>Reported: <br><?=boldText($reportData->b2_date   ) ?></td>
                </tr>
                <tr>
                    <td>What Does the Injured Person Believe Caused the Accident?:<br> <?=boldText($reportData->b_injured   ) ?></td>
                    <td>Witness(es) – Names & Addresses:<br> <?=boldText($reportData->b_witness_name   ) ?></td>
                </tr>
                </table>
                
                <p  id="view_p">C. KIND OF ACCIDENT/INCIDENT/DANGEROUS OCCURRENCE</p>
                <table id="view_table" width="100%">
                <?php
                   $ids = explode(',',$reportData->c_kind_of_accident);
                   foreach($dropdown['kind_of_occurrence'] as $key=>$value){
                       if(in_array($key,$ids))
                       echo "<tr> <td style='border:0px'> &#10157; ".$value."</td></tr>";
                   } 
                ?>    
               
                </table>
                
                <p  id="view_p">D. AGENT(S) INVOLVED</p>
                <table id="view_table" width="100%">
                <?php
                    $ids = explode(',',$reportData->d_agents);
                   foreach($dropdown['agent_involved'] as $key=>$value){
                    if(in_array($key,$ids))
                       echo "<tr> <td style='border:0px'> &#10157; ".$value."</td></tr>";
                   } 
                ?>    
                </table>
                
                <p  id="view_p">E. ACCOUNT OF INCIDENT/DANGEROUS OCCURRENCE</p>
                <table id="view_table" width="100%">
                <tr>
                    <td>Describe what happened and how (in the case of an accident state, what the injured person was doing at the time):<br>
                    <?=boldText($reportData->e_accident_state) ?>
                
                </td>
                
                </tr>
                </table>
                
                <p id="view_p">F. ACTION TAKEN TO PREVENT RE-OCCURRENCE</p>
                <table id="view_table" width="100%">
                <tr>
                    <td>
                    
                    </td>
                
                </tr>
                </table>
                
                
                <table id="view_table" width="100%">
                <tr>
                    <td>Name of Person Making Report</td>
                    <td>Date</td>
                
                </tr>
                </table>
                 
                <?php

        $html = ob_get_contents();
        ob_clean();    


        $mform->addElement('html', $html);
        
    }

    public function userPartView($reportData){

        global $CFG;

        $mform = $this->_form;
        $managerList  = get_com_manager_list();
        $dropdown     = get_dropdown_data(1);
        $user         = get_userInfo(array("id" => $reportData->user_id));

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">User Details</legend>');
        $mform->addElement('static', 'name1', get_string('name', 'local_mp_report'),$user->firstname.' '.$user->lastname );

        $mform->addElement('static', 'address1', get_string('address', 'local_mp_report'),$reportData->user_address);
        $mform->addElement('static', 'postcode1', get_string('postcode', 'local_mp_report'),$reportData->user_postcode);
        $mform->addElement('static', 'occupation1', get_string('occupation', 'local_mp_report'),$reportData->user_occupation);
        $mform->addElement('static', 'user_contract1', get_string('user_contract', 'local_mp_report'),@$dropdown['contract'][$reportData->user_contract]);
        $mform->addElement('static', 'user_manager1', get_string('user_manager', 'local_mp_report'),$managerList[$reportData->user_manager]);
        $mform->addElement('static', 'user_date1', get_string('user_date', 'local_mp_report'), date("d-M-Y",$reportData->user_date));
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">About the Person who had the accident</legend>');
        $mform->addElement('static', 'victim_name1', get_string('victim_name', 'local_mp_report'),$reportData->victim_name);
        $mform->addElement('static', 'victim_address1', get_string('victim_address', 'local_mp_report'),$reportData->victim_address);

        $mform->addElement('static', 'victim_postcode1', get_string('victim_postcode', 'local_mp_report'),$reportData->victim_postcode);
        $mform->addElement('static', 'victim_occupation1', get_string('victim_occupation', 'local_mp_report'),$reportData->victim_occupation);
        $mform->addElement('html', '</fieldset>');


        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">About the accident</legend>');


        $mform->addElement('static', 'accident_date1', get_string('accident_date', 'local_mp_report'), date("d-M-Y G:i:s",$reportData->accident_date));
        $mform->addElement('static', 'accident_place1', get_string('accident_place', 'local_mp_report'),$reportData->accident_place);
        $mform->addElement('static', 'accident_reason1', get_string('accident_reason', 'local_mp_report'),$reportData->accident_reason);
        $mform->addElement('static', 'accident_detail1', get_string('accident_detail', 'local_mp_report'),$reportData->accident_detail);
        $mform->addElement('static', 'accident_category1', get_string('accident_category', 'local_mp_report'), @$dropdown['category'][$reportData->accident_category]);
        $mform->addElement('static', 'accident_treatment1', get_string('accident_treatment', 'local_mp_report'), $reportData->accident_treatment);
        $mform->addElement('static', 'minor_injuries1', get_string('minor_injuries', 'local_mp_report'), $reportData->minor_injuries);

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Accident Witness Report</legend>');
        $mform->addElement('static', 'accident_witnesses1', get_string('accident_witnesses', 'local_mp_report'),$reportData->accident_witnesses ? "Yes" : 'No');

        if($reportData->accident_witnesses==1) {
            $mform->addElement('static', 'witnesses_name1', get_string('witnesses_name', 'local_mp_report'), decrypt($reportData->witnesses_name));
            $mform->addElement('static', 'witnesses_address1', get_string('witnesses_address', 'local_mp_report'), decrypt($reportData->witnesses_address));
            $mform->addElement('static', 'witnesses_phone_number1', get_string('witnesses_phone_number', 'local_mp_report'), decrypt($reportData->witnesses_phone_number));
            $mform->addElement('static', 'witnesses_report_date1', get_string('witnesses_report_date', 'local_mp_report'), date("d-M-Y", $reportData->witnesses_report_date));
            $mform->addElement('static', 'witnesses_report_details1', get_string('witnesses_report_details', 'local_mp_report'), $reportData->witnesses_report_details);

            //$imageCode = "<a data-fancybox='gallery' href='/local/mp_report/upload/$reportData->witnesses_report_diagram' data-lightbox='witnesses_report_diagram'> <img src='/local/mp_report/upload/$reportData->witnesses_report_diagram' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";

            //$mform->addElement('static', 'witnesses_report_diagram1', get_string('witnesses_report_diagram', 'local_mp_report'), $imageCode);
        }
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Photos</legend>');
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https' : 'http';
        $context  = stream_context_create(array($protocol => array('header'=>'Connection: close\r\n')));

        $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_1";
        $imageData   = base64_encode(file_get_contents($image,false,$context));
        $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
        $imageCode1  = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_1'> <img  class='example-image'  src='$src' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /> </a>";
        $mform->addElement('static', 'photo_11', get_string('photo_1', 'local_mp_report'), $imageCode1);

        $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_2";
        $imageData   = base64_encode(file_get_contents($image,false,$context));
        $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
        $imageCode2  = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_2'> <img src='$src' class='fancybox' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";
        $mform->addElement('static', 'photo_21', get_string('photo_2', 'local_mp_report'), $imageCode2);

        if (!empty($reportData->photo_3)){

            $image       = "$CFG->dataroot/filedir/upload/$reportData->photo_3";
            $imageData   = base64_encode(file_get_contents($image,false,$context));
            $src         = 'data: '.mime_content_type($image).';base64,'.$imageData;
            $imageCode   = "<a data-fancybox='gallery' href='$src' data-lightbox='photo_2'><img src='$src' height='250px' width='250px' style='border: 1px solid #CCC; padding: 5px; ' /></a>";
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

        $mform->addElement('select', 'manager_id', get_string('manager_name', 'local_mp_report'), createDropdown(get_com_manager_list()));
        $mform->setType('manager_id', PARAM_TEXT);
        $mform->setDefault('manager_id', $reportData->manager_id);
        $mform->addRule('manager_id', get_string('required'), 'required', '', 'client');

        $radioarray   = array();
        $radioarray[] = $mform->createElement('radio', 'accident_additional_details', '', "Yes", 'Yes');
        $radioarray[] = $mform->createElement('radio', 'accident_additional_details', '', "No", 'No');
        $mform->addGroup($radioarray, 'accident_additional_details', get_string('accident_additional_details','local_mp_report'), array(''), false);
        $mform->addRule('accident_additional_details', get_string('required'), 'required','','client');
        $mform->setDefault('accident_additional_details', $reportData->accident_additional_details);

        $mform->addElement('textarea', 'additional_details', get_string('additional_details', 'local_mp_report'), 'wrap="virtual" rows="6" cols="40"');
        $mform->setType('additional_details', PARAM_TEXT);
        $mform->setDefault('additional_details', $reportData->additional_details);
        //$mform->addRule('additional_details', get_string('required'), 'required','','client');
        $mform->hideIf('additional_details', 'accident_additional_details',  'eq', 'No');

        $mform->addElement('textarea', 'root_cause', get_string('root_cause', 'local_mp_report'), 'wrap="virtual" rows="6" cols="40"');
        $mform->setType('root_cause', PARAM_TEXT);
        $mform->setDefault('root_cause', $reportData->root_cause);
        $mform->addRule('root_cause', get_string('required'), 'required','','client');

        $mform->addElement('textarea', 'immediate_action', get_string('immediate_action', 'local_mp_report'), 'wrap="virtual" rows="6" cols="40"');
        $mform->setType('immediate_action', PARAM_TEXT);
        $mform->setDefault('immediate_action', $reportData->immediate_action);
        $mform->addRule('immediate_action', get_string('required'), 'required','','client');

        $mform->addElement('textarea', 'further_action_required', get_string('further_action_required', 'local_mp_report'), 'wrap="virtual" rows="6" cols="40"');
        $mform->setType('further_action_required', PARAM_TEXT);
        $mform->setDefault('further_action_required', $reportData->further_action_required);
        $mform->addRule('further_action_required', get_string('required'), 'required','','client');


        $radioarray   = array();
        $radioarray[] = $mform->createElement('radio', 'lost_time', '', "Yes", 'Yes');
        $radioarray[] = $mform->createElement('radio', 'lost_time', '', "No", 'No');
        $mform->addGroup($radioarray, 'lost_time', get_string('lost_time','local_mp_report'), array(''), false);
        $mform->addRule('lost_time', get_string('required'), 'required','','client');
        $mform->setDefault('lost_time', $reportData->lost_time);

        $mform->addElement('text', 'lost_time_days', get_string('lost_time_days', 'local_mp_report'), 'maxlength="3" size="10" ');
        $mform->setType('lost_time_days', PARAM_INT);
        $mform->setDefault('lost_time_days', $reportData->lost_time_days);
//        $mform->addRule('lost_time_days', get_string('required'), 'required','','client');
        $mform->disabledIf('lost_time_days', 'lost_time',  'eq', 'No');


        $mform->addElement('date_selector', 'mgt_review_report_date', get_string('mgt_review_report_date', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('mgt_review_report_date', PARAM_TEXT);
        $mform->setDefault('mgt_review_report_date', $reportData->mgt_review_report_date);
        $mform->addRule('mgt_review_report_date', get_string('required'), 'required','','client');

        $mform->addElement('select', 'mgt_review_status', get_string('mgt_review_status', 'local_mp_report'), createDropdown($dropdown['mgt_review_status']));
        $mform->setType('mgt_review_status', PARAM_TEXT);
        $mform->setDefault('mgt_review_status', $reportData->mgt_review_status);
        $mform->addRule('mgt_review_status', get_string('required'), 'required','','client');

        $mform->addElement('textarea', 'mgt_review_comments', get_string('mgt_review_comments', 'local_mp_report'), 'wrap="virtual" rows="6" cols="40"');
        $mform->setType('mgt_review_comments', PARAM_TEXT);
        $mform->setDefault('mgt_review_comments', $reportData->mgt_review_comments);
        $mform->addRule('mgt_review_comments', get_string('required'), 'required','','client');
        $mform->addElement('html', '</fieldset>');


        $mform->addFormRule('accidentManagerVaidations');

        if(!empty($reportData->manager_id) and (is_senior_manager() or is_complieance() or is_admin())) {
            $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Senior Management Report</legend>');
            $mform->addElement('select', 's_mgt_rpt_name', get_string('s_mgt_rpt_name', 'local_mp_report'), createDropdown(get_s_manager_and_complience_list()));
            $mform->setType('s_mgt_rpt_name', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_name', $reportData->s_mgt_rpt_name);
            $mform->addRule('s_mgt_rpt_name', get_string('required'), 'required', '', 'client');

            $mform->addElement('date_selector', 's_mgt_rpt_report_date', get_string('s_mgt_rpt_report_date', 'local_mp_report'), 'maxlength="100" size="40" ');
            $mform->setType('s_mgt_rpt_report_date', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_report_date', $reportData->s_mgt_rpt_report_date);
            $mform->addRule('s_mgt_rpt_report_date', get_string('required'), 'required', '', 'client');

            $mform->addElement('textarea', 's_mgt_rpt_comments', get_string('s_mgt_rpt_comments', 'local_mp_report'), 'wrap="virtual" rows="6" cols="40"');
            $mform->setType('s_mgt_rpt_comments', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_comments', $reportData->s_mgt_rpt_comments);
            $mform->addRule('s_mgt_rpt_comments', get_string('required'), 'required', '', 'client');


            $mform->addElement('select', 's_mgt_rpt_f_action', get_string('s_mgt_rpt_f_action', 'local_mp_report'), createDropdown($dropdown['further_action']));
            $mform->setType('s_mgt_rpt_f_action', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_f_action', $reportData->s_mgt_rpt_f_action);
            $mform->addRule('s_mgt_rpt_f_action', get_string('required'), 'required', '', 'client');

            $mform->addElement('textarea', 's_mgt_rpt_f_a_comment', get_string('s_mgt_rpt_f_a_comment', 'local_mp_report'), 'wrap="virtual" rows="6" cols="40"');
            $mform->setType('s_mgt_rpt_f_a_comment', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_f_a_comment', $reportData->s_mgt_rpt_f_a_comment);
            $mform->addRule('s_mgt_rpt_f_a_comment', get_string('required'), 'required', '', 'client');

            /*
            $mform->addElement('select', 's_mgt_rpt_a_b_completed', get_string('s_mgt_rpt_a_b_completed', 'local_mp_report'), $dropdown['yes_no']);
            $mform->setType('s_mgt_rpt_a_b_completed', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_a_b_completed', $reportData->s_mgt_rpt_a_b_completed);
            $mform->addRule('s_mgt_rpt_a_b_completed', get_string('required'), 'required','','client');

            $mform->addElement('date_selector', 's_mgt_rpt_a_b_cpt_date', get_string('s_mgt_rpt_a_b_cpt_date', 'local_mp_report'), 'maxlength="100" size="40" ');
            $mform->setType('s_mgt_rpt_a_b_cpt_date', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_a_b_cpt_date', $reportData->s_mgt_rpt_a_b_cpt_date);
            //$mform->addRule('s_mgt_rpt_a_b_cpt_date', get_string('required'), 'required','','client');
            $mform->disabledIf('s_mgt_rpt_a_b_cpt_date', 's_mgt_rpt_a_b_completed',  'neq', 1);
            */
            $mform->addElement('select', 's_mgt_rpt_2508_completed', get_string('s_mgt_rpt_2508_completed', 'local_mp_report'), $dropdown['yes_no']);
            $mform->setType('s_mgt_rpt_2508_completed', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_2508_completed', $reportData->s_mgt_rpt_2508_completed);
            $mform->addRule('s_mgt_rpt_2508_completed', get_string('required'), 'required', '', 'client');

            $mform->addElement('date_selector', 's_mgt_rpt_2508_cpt_date', get_string('s_mgt_rpt_2508_cpt_date', 'local_mp_report'), 'maxlength="100" size="40" ');
            $mform->setType('s_mgt_rpt_2508_cpt_date', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_2508_cpt_date', $reportData->s_mgt_rpt_2508_cpt_date);
            //$mform->addRule('s_mgt_rpt_2508_cpt_date', get_string('required'), 'required','','client');
            $mform->disabledIf('s_mgt_rpt_2508_cpt_date', 's_mgt_rpt_2508_completed', 'neq', 1);

            $mform->addElement('select', 's_mgt_rpt_riddor_event_clf', get_string('s_mgt_rpt_riddor_event_clf', 'local_mp_report'), createDropdown($dropdown['riddor_classification']));
            $mform->setType('s_mgt_rpt_riddor_event_clf', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_riddor_event_clf', $reportData->s_mgt_rpt_riddor_event_clf);
            //$mform->addRule('s_mgt_rpt_riddor_event_clf', get_string('required'), '','','client');
            $mform->disabledIf('s_mgt_rpt_riddor_event_clf', 's_mgt_rpt_2508_completed', 'neq', 1);

            $mform->addElement('select', 'riddor_subcategory', get_string('s_mgt_rpt_riddor_subcategory', 'local_mp_report'), createDropdown($dropdown['RIDDOR_subcategory']));
            $mform->setType('riddor_subcategory', PARAM_TEXT);
            $mform->setDefault('riddor_subcategory', $reportData->riddor_subcategory);

            $html = "<div class='form-group row' id='riddor_file_div'> 
            
            <div class='col-md-3'> RIDDOR Files</div> <div class='col-md-6'>
           <form method='post' enctype='multipart/form-data'>";

            $html .= "<input type='file' name='riddor_file' id='riddor_file' data-accid='$reportData->id' maxlength='200' size='40'>";
            $html .= '</<form></div></div>';
            $mform->addElement('html', $html, 'local_mp_report');

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



            $mform->addElement('html', $html, 'local_mp_report');



            //$mform->addRule('s_mgt_rpt_riddor_event_clf', get_string('required'), '','','client');
            //$mform->hideIf('riddor_file', 's_mgt_rpt_riddor_event_clf', 'eq', '');
            $mform->hideIf('riddor_subcategory', 's_mgt_rpt_2508_completed', 'neq', 1);
            $mform->hideIf('riddor_subcategory', 's_mgt_rpt_riddor_event_clf', 'eq', 16);
            $mform->hideIf('riddor_subcategory', 's_mgt_rpt_riddor_event_clf', 'eq', 18);
            $mform->hideIf('riddor_subcategory', 's_mgt_rpt_riddor_event_clf', 'eq', 19);
            $mform->hideIf('riddor_subcategory', 's_mgt_rpt_riddor_event_clf', 'eq', 22);


            $mform->addElement('select', 's_mgt_rpt_reported_en_a', get_string('s_mgt_rpt_reported_en_a', 'local_mp_report'), $dropdown['yes_no']);
            $mform->setType('s_mgt_rpt_reported_en_a', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_reported_en_a', $reportData->s_mgt_rpt_reported_en_a);
            $mform->addRule('s_mgt_rpt_reported_en_a', get_string('required'), 'required', '', 'client');

            $mform->addElement('date_selector', 's_mgt_rpt_reported_en_a_date', get_string('s_mgt_rpt_reported_en_a_date', 'local_mp_report'), 'maxlength="100" size="40" ');
            $mform->setType('s_mgt_rpt_reported_en_a_date', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_reported_en_a_date', $reportData->s_mgt_rpt_reported_en_a_date);
            //$mform->addRule('s_mgt_rpt_reported_en_a_date', get_string('required'), 'required','','client');
            $mform->disabledIf('s_mgt_rpt_reported_en_a_date', 's_mgt_rpt_reported_en_a', 'neq', 1);

            $mform->addElement('select', 's_mgt_rpt_sr_mgr_notified', get_string('s_mgt_rpt_sr_mgr_notified', 'local_mp_report'), $dropdown['yes_no']);
            $mform->setType('s_mgt_rpt_sr_mgr_notified', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_sr_mgr_notified', $reportData->s_mgt_rpt_sr_mgr_notified);
            $mform->addRule('s_mgt_rpt_sr_mgr_notified', get_string('required'), 'required', '', 'client');

            $mform->addElement('date_selector', 's_mgt_rpt_sr_mgr_notified_date', get_string('s_mgt_rpt_sr_mgr_notified_date', 'local_mp_report'), 'maxlength="100" size="40" ');
            $mform->setType('s_mgt_rpt_sr_mgr_notified_date', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_sr_mgr_notified_date', $reportData->s_mgt_rpt_sr_mgr_notified_date);
            //$mform->addRule('s_mgt_rpt_sr_mgr_notified_date', get_string('required'), 'required','','client');
            $mform->disabledIf('s_mgt_rpt_sr_mgr_notified_date', 's_mgt_rpt_sr_mgr_notified', 'neq', 1);

            $mform->addElement('select', 's_mgt_rpt_in_br_informed', get_string('s_mgt_rpt_in_br_informed', 'local_mp_report'), $dropdown['yes_no']);
            $mform->setType('s_mgt_rpt_in_br_informed', PARAM_TEXT);
            $mform->setDefault('s_mgt_rpt_in_br_informed', $reportData->s_mgt_rpt_in_br_informed);
            $mform->addRule('s_mgt_rpt_in_br_informed', get_string('required'), 'required', '', 'client');

            //$mform->addElement('date_selector', 's_mgt_rpt_in_br_informed_date', get_string('s_mgt_rpt_in_br_informed_date', 'local_mp_report'), 'maxlength="100" size="40" ');
            //$mform->setType('s_mgt_rpt_in_br_informed_date', PARAM_TEXT);
            //$mform->setDefault('s_mgt_rpt_in_br_informed_date', $reportData->s_mgt_rpt_in_br_informed_date);
            //$mform->addRule('s_mgt_rpt_in_br_informed_date', get_string('required'), 'required','','client');
            //$mform->disabledIf('s_mgt_rpt_in_br_informed_date', 's_mgt_rpt_in_br_informed', 'neq', 1);


            $radioarray = array();
            $radioarray[] = $mform->createElement('radio', 's_mgt_rpt_ant_closed_off', '', "Yes", 1);
            $radioarray[] = $mform->createElement('radio', 's_mgt_rpt_ant_closed_off', '', "No", 0);
            $mform->addGroup($radioarray, 's_mgt_rpt_ant_closed_off', get_string('s_mgt_rpt_ant_closed_off', 'local_mp_report'), array(' '), false);
            $mform->addRule('s_mgt_rpt_ant_closed_off', get_string('required'), 'required', '', 'client');
            $mform->setDefault('s_mgt_rpt_ant_closed_off', $reportData->s_mgt_rpt_ant_closed_off);

            $mform->addElement('date_selector', 's_mgt_rpt_ant_closed_off_date', get_string('s_mgt_rpt_ant_closed_off_date', 'local_mp_report'), 'maxlength="100" size="40" ');
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
        $mform->addElement('static', 'manager_id', get_string('manager_name', 'local_mp_report'), $manager_list[$reportData->manager_id]);
        $mform->addElement('static', 'accident_additional_details', get_string('accident_additional_details', 'local_mp_report'), $reportData->accident_additional_details);
        $mform->addElement('static', 'additional_details', get_string('additional_details', 'local_mp_report'), $reportData->additional_details);
        $mform->addElement('static', 'root_cause', get_string('root_cause', 'local_mp_report'), $reportData->root_cause);
        $mform->addElement('static', 'immediate_action', get_string('immediate_action', 'local_mp_report'), $reportData->immediate_action);
        $mform->addElement('static', 'further_action_required', get_string('further_action_required', 'local_mp_report'), $reportData->further_action_required);
        $mform->addElement('static', 'lost_time', get_string('lost_time','local_mp_report'), $reportData->lost_time);
        $mform->addElement('static', 'lost_time_days', get_string('lost_time_days', 'local_mp_report'), $reportData->lost_time_days);
        $mform->addElement('static', 'mgt_review_report_date', get_string('mgt_review_report_date', 'local_mp_report'), date('d-M-Y',$reportData->mgt_review_report_date));
        $mform->addElement('static', 'mgt_review_status', get_string('mgt_review_status', 'local_mp_report'), $dropdown['mgt_review_status'][$reportData->mgt_review_status]);
        $mform->addElement('static', 'mgt_review_comments', get_string('mgt_review_comments', 'local_mp_report'), $reportData->mgt_review_comments);
        $mform->addElement('html', '</fieldset>');

        if(!empty($reportData->manager_id) and (is_senior_manager() or is_complieance() or is_admin())) {
            $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Senior Management Report</legend>');

            $s_manager_and_complience_list = get_s_manager_and_complience_list();
            $mform->addElement('static', 's_mgt_rpt_name', get_string('s_mgt_rpt_name', 'local_mp_report'), $s_manager_and_complience_list[$reportData->s_mgt_rpt_name]);
            $mform->addElement('static', 's_mgt_rpt_report_date', get_string('s_mgt_rpt_report_date', 'local_mp_report'), date('d-M-Y',$reportData->s_mgt_rpt_report_date));
            $mform->addElement('static', 's_mgt_rpt_comments', get_string('s_mgt_rpt_comments', 'local_mp_report'), $reportData->s_mgt_rpt_comments);
            $mform->addElement('static', 's_mgt_rpt_f_action', get_string('s_mgt_rpt_f_action', 'local_mp_report'), $dropdown['further_action'][$reportData->s_mgt_rpt_f_action]);
            $mform->addElement('static', 's_mgt_rpt_f_a_comment', get_string('s_mgt_rpt_f_a_comment', 'local_mp_report'), $reportData->s_mgt_rpt_f_a_comment);
            $mform->addElement('static', 's_mgt_rpt_2508_completed', get_string('s_mgt_rpt_2508_completed', 'local_mp_report'), $dropdown['yes_no'][$reportData->s_mgt_rpt_2508_completed]);
            $mform->addElement('static', 's_mgt_rpt_2508_cpt_date', get_string('s_mgt_rpt_2508_cpt_date', 'local_mp_report'), date('d-M-Y',$reportData->s_mgt_rpt_2508_cpt_date));
            $mform->addElement('static', 's_mgt_rpt_riddor_event_clf', get_string('s_mgt_rpt_riddor_event_clf', 'local_mp_report'), $dropdown['riddor_classification'][$reportData->s_mgt_rpt_riddor_event_clf]);
            $mform->addElement('static', 'riddor_subcategory', get_string('s_mgt_rpt_riddor_subcategory', 'local_mp_report'), $dropdown['RIDDOR_subcategory'][$reportData->riddor_subcategory]);
            $mform->addElement('static', 's_mgt_rpt_reported_en_a', get_string('s_mgt_rpt_reported_en_a', 'local_mp_report'), $dropdown['yes_no'][$reportData->s_mgt_rpt_reported_en_a]);
            $mform->addElement('static', 's_mgt_rpt_reported_en_a_date', get_string('s_mgt_rpt_reported_en_a_date', 'local_mp_report'), date('d-M-Y',$reportData->s_mgt_rpt_reported_en_a_date));
            $mform->addElement('static', 's_mgt_rpt_sr_mgr_notified', get_string('s_mgt_rpt_sr_mgr_notified', 'local_mp_report'), $dropdown['yes_no'][$reportData->s_mgt_rpt_sr_mgr_notified]);
            $mform->addElement('static', 's_mgt_rpt_sr_mgr_notified_date', get_string('s_mgt_rpt_sr_mgr_notified_date', 'local_mp_report'), date('d-M-Y',$reportData->s_mgt_rpt_sr_mgr_notified_date));
            $mform->addElement('static', 's_mgt_rpt_in_br_informed', get_string('s_mgt_rpt_in_br_informed', 'local_mp_report'), $dropdown['yes_no'][$reportData->s_mgt_rpt_in_br_informed]);
            $mform->addElement('static', 's_mgt_rpt_ant_closed_off', get_string('s_mgt_rpt_ant_closed_off', 'local_mp_report'), $dropdown['yes_no'][$reportData->s_mgt_rpt_ant_closed_off]);
            $mform->addElement('static', 's_mgt_rpt_ant_closed_off_date', get_string('s_mgt_rpt_ant_closed_off_date', 'local_mp_report'), date('d-M-Y',$reportData->s_mgt_rpt_ant_closed_off_date));

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


		$heading = '<h3 style="text-align: center">'.get_string('accident', 'local_mp_report');
        $report_closed = FALSE;
        if(isset($_REQUEST['id']) && $_REQUEST['cmd']=='new_acc_edit' &&( is_senior_manager() || is_complieance() || is_admin() || is_manager()) ) {
            $reportData = get_data(array("id"=>$_REQUEST['id']),get_string('new_accident_table','local_mp_report'));

            if ($reportData->s_mgt_rpt_ant_closed_off==1){
                $report_closed = TRUE;
            }

            if( is_senior_manager() || is_complieance() || is_admin() || is_manager()) {

                $heading ='<div class="row" >
                <div class="col-sm-6">
                    <h3 id="report_headding">'.get_string('accident', 'local_mp_report').'</h3>
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
            $this->userPartViewNew($reportData);
            //if ($reportData->read_only==1){
            //    $this->managerPartView($reportData);
            //}else {
            //    $this->managerPartForm($reportData);
            //}
            $btnLavel = get_string('savebutton', 'local_mp_report');
        }
        else {
            $heading .= '</h3><hr>';
            $mform->addElement('html', $heading);
            $this->userPartForm();
            $btnLavel  = get_string('submitbtn', 'local_mp_report');

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
