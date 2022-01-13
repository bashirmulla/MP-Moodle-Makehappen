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
        $mform->setType('a_age', PARAM_INT);
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

        $mform->addElement('textarea', 'a_employers_name', get_string('a_employers_name', 'local_mp_report'), 'wrap="virtual" rows="3" cols="40"');
        $mform->setType('a_employers_name', PARAM_TEXT);
        $mform->addRule('a_employers_name', get_string('required'), 'required','','client');
        

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">B. DATE, TIME, AND PLACE OF ACCIDENT/INCIDENT/DANGEROUS OCCURRENCE</legend>');

        $mform->addElement('date_time_selector', 'b_date', get_string('b_date', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('b_date', PARAM_TEXT);
        $mform->addRule('b_date', get_string('required'), 'required','','client');

        $mform->addElement('textarea', 'b_name_address_site', get_string('b_name_address_site', 'local_mp_report'), 'wrap="virtual" rows="3" cols="40"');
        $mform->setType('b_name_address_site', PARAM_TEXT);
        $mform->addRule('b_name_address_site', get_string('required'), 'required','','client');

        $mform->addElement('textarea', 'b_exact_location_site', get_string('b_exact_location_site', 'local_mp_report'), 'wrap="virtual" rows="3" cols="40"');
        $mform->setType('b_exact_location_site', PARAM_TEXT);
        $mform->addRule('b_exact_location_site', get_string('required'), 'required','','client');

        

        $mform->addElement('textarea', 'b_dangerous', get_string('b_dangerous', 'local_mp_report'), 'wrap="virtual" rows="3" cols="40"');
        $mform->setType('b_dangerous', PARAM_TEXT);
        $mform->addRule('b_dangerous', get_string('required'), 'required','','client');

        

        $mform->addElement('date_time_selector', 'b2_date', get_string('b2_date', 'local_mp_report'), 'maxlength="100" size="40" ');
        $mform->setType('b2_date', PARAM_TEXT);
        $mform->addRule('b2_date', get_string('required'), 'required','','client');

        $mform->addElement('text', 'b_injured', get_string('b_injured', 'local_mp_report'), 'maxlength="200" size="40" ');
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

        $mform->addElement('textarea', 'b_witness_address', get_string('b_witness_address', 'local_mp_report'), 'wrap="virtual" rows="3" cols="40"');
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
            if($key==28)
            {
                
                $mform->addElement('text', 'c_metres', NULL, 'maxlength="100" size="40" style="width:150px" ');                
                $mform->hideIf('c_metres', 'c_kind_of_accident##28',  'notchecked');
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
        $mform->addElement('html', '<p>Describe what happened and how (in the case of an accident state, what the injured person was doing at the time)</p>');
       

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
        <style>
            .scheduler-border{
                background-color: WHITE !important;
            }

            #view_table.table > th , td {
                border-bottom: 1px solid #CCC;
                padding: 5px;
                width: 50%;
                margin-bottom: 10px;
            }

            #view_table.table > tr:last-child {
                border-bottom: none !important;
            }
           

            #view_p{
                font-weight: bold;
                margin: 10px 0px;
            } 
        </style>
                
            <fieldset class="scheduler-border"><legend class="scheduler-border">A. THE INJURED / INVOLVED PERSON</legend>
         
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
                    <td>Age: <br><?=boldText($reportData->a_age   ) ?></td>
                </tr>
                <tr>
                    <td>Following the accident, the Operative is now at:<br> <?=boldText($dropdown['operative_at_now'][$reportData->a_following_accident]   ) ?></td>
                    <td>If resumed work on the day of the accident state time lost: <br>

                    <?=($reportData->a_resumed_work=='No')? boldText('None'): boldText($reportData->a_hours).''. boldText($reportData->a_mins) ?>
                    </td>
                </tr>
                <tr>
                    <td>Temporary Address (if applicable): <br> <?=boldText($reportData->a_temp_address   ) ?></td>
                    <td>Status: <br><?=boldText($dropdown['employment_status'][$reportData->a_status]   ) ?></td>
                </tr>
                <tr>
                    <td style="border: none !important;">Occupation or Job Title: <br><?=boldText($reportData->a_job_title   ) ?></td>
                    <td style="border: none !important;">(If Applicable) Employers Name and Address: <br><?=boldText($reportData->a_employers_name) ?></td>
                </tr>
                </table>
            </fieldset>
            
            <fieldset class="scheduler-border"><legend class="scheduler-border">B. DATE, TIME, AND PLACE OF ACCIDENT/INCIDENT/DANGEROUS OCCURRENCE</legend>
                
                <table id="view_table" width="100%">
                <tr>
                    <td>Date: <br><?=boldText(date("d-M-Y",$reportData->b_date))?></td>
                    <td>Time: <br><?=boldText(date("H",$reportData->b_date)) ?> hours <?=boldText(date("m",$reportData->b_date)) ?> mins</td>
                </tr>
                <tr>
                    <td>Name & Address of Site: <br><?=boldText($reportData->b_name_address_site   ) ?></td>
                    <td>Exact Location on Site: <br><?=boldText($reportData->b_exact_location_site   ) ?></td>
                </tr>
                <tr>
                    <td>On what work was the operative engaged upon at the time and/or what was the dangerous occurrence?: <br><?=boldText($reportData->b_dangerous   ) ?></td>
                    <td>Reported: <br><?=boldText(date("d-M-Y",$reportData->b2_date)   ) ?></td>
                </tr>
                <tr>
                    <td style="border: none !important;">What Does the Injured Person Believe Caused the Accident?:<br> <?=boldText($reportData->b_injured   ) ?></td>
                    <td style="border: none !important;">Witness(es) – Names & Addresses:<br> <?=boldText($reportData->b_witness_name   ) ?></td>
                </tr>
                </table>
            </fieldset>    
            
            <fieldset class="scheduler-border"><legend class="scheduler-border">C. KIND OF ACCIDENT/INCIDENT/DANGEROUS OCCURRENCE</legend>
                
                <?php
                   $ids = explode(',',$reportData->c_kind_of_accident);
                   foreach($dropdown['kind_of_occurrence'] as $key=>$value){
                    if(in_array($key,$ids))
                    {  echo "&#10157; ".$value;
 
                         if($key==28) { echo ' ('.$reportData->c_metres. ' Metres )';}
                         echo "<br>";
                    }
                   } 
                ?>    
               
            </fieldset>
            
            <fieldset class="scheduler-border"><legend class="scheduler-border">D. AGENT(S) INVOLVED</legend>
               
                <?php
                    $ids = explode(',',$reportData->d_agents);
                   foreach($dropdown['agent_involved'] as $key=>$value){
                    if(in_array($key,$ids))
                       echo "<tr> <td style='border:0px'> &#10157; ".$value."<br>";
                   } 
                ?>    
            
            </fieldset>
            
            <fieldset class="scheduler-border"><legend class="scheduler-border">E. ACCOUNT OF INCIDENT/DANGEROUS OCCURRENCE</legend>
                
                
                    Describe what happened and how (in the case of an accident state, what the injured person was doing at the time):<br>
                    <?=boldText($reportData->e_accident_state) ?>
               
               
            </fieldset>
            
            <fieldset class="scheduler-border"><legend class="scheduler-border">F. ACTION TAKEN TO PREVENT RE-OCCURRENCE</legend>
                <?=boldText($reportData->f_action_taken) ?>
                  
            </fieldset>    
            
            
                <table id="view_table" width="100%">
                <tr>
                    <td>Name of Person Making Report: <?=boldText($reportData->declaration_name_of_person) ?></td>
                
                
                    <td>Date: <?=boldText(date("d-M-Y",$reportData->declaration_date)) ?></td>
                
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

        $dropdown = get_new_dropdown_data(1);
      
        $mform = $this->_form;

        //$mform->addElement('hidden', 'new_accident_id', !empty($_REQUEST['id']) ? $_REQUEST['id'] : $mform->new_accident_id);
        
        $mform->addElement('html', '<h3 style="text-align:center;margin-top:30px">Accident Investigation Form</h3>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Information</legend>');

            $mform->addElement('select', 'incident_type', 'Incident Type', createDropdown($dropdown['incident_type']));
            $mform->setType('incident_type', PARAM_TEXT);
            $mform->addRule('incident_type', get_string('required'), 'required','','client');

            $mform->addElement('select', 'affecting', 'Affecting', createDropdown($dropdown['affecting']));
            $mform->setType('affecting', PARAM_TEXT);
            $mform->addRule('affecting', get_string('required'), 'required','','client');

            $mform->addElement('select', 'compensation', 'Compensation', createDropdown($dropdown['compensation']));
            $mform->setType('compensation', PARAM_TEXT);
            $mform->addRule('compensation', get_string('required'), 'required','','client');
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Affected Employee / Person</legend>');
        
            $mform->addElement('static', 'name1', 'Name',$reportData->a_surname.' '.$reportData->a_forename );
            $mform->addElement('static', 'name2', 'Role & Department','' );
            $mform->addElement('static', 'name3', 'Phone Number',$reportData->a_tel_no );
            $mform->addElement('static', 'name4', 'Date of Incident',date("d-M-Y",$reportData->b_date ));
            $mform->addElement('static', 'name5', 'Time of Incident',date("d-M-Y",$reportData->b_date ));
            $mform->addElement('static', 'name7', 'Location of Incident',$reportData->b_exact_location_site );
            $mform->addElement('static', 'name8', 'Supervisor Name',$reportData->a_employers_name );

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Interviewee 1</legend>');

            $mform->addElement('text', 'interviewee1_name', 'Name', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee1_name', PARAM_TEXT);
            $mform->addRule('interviewee1_name', get_string('required'), 'required','','client');

            $mform->addElement('text', 'interviewee1_role', 'Role & Department', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee1_role', PARAM_TEXT);
            $mform->addRule('interviewee1_role', get_string('required'), 'required','','client');

            $mform->addElement('text', 'interviewee1_telephone', 'Phone Number', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee1_telephone', PARAM_TEXT);
            $mform->addRule('interviewee1_telephone', get_string('required'), 'required','','client');

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Interviewee 2</legend>');

            $mform->addElement('text', 'interviewee2_name', 'Name', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee2_name', PARAM_TEXT);
            $mform->addRule('interviewee2_name', get_string('required'), 'required','','client');

            $mform->addElement('text', 'interviewee2_role', 'Role & Department', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee2_role', PARAM_TEXT);
            $mform->addRule('interviewee2_role', get_string('required'), 'required','','client');

            $mform->addElement('text', 'interviewee2_telephone', 'Phone Number', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee2_telephone', PARAM_TEXT);
            $mform->addRule('interviewee2_telephone', get_string('required'), 'required','','client');

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Investigator</legend>');

            $mform->addElement('text', 'investigator_name', 'Name', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('investigator_name', PARAM_TEXT);
            $mform->addRule('investigator_name', get_string('required'), 'required','','client');

            $mform->addElement('text', 'investigator_role', 'Role & Department', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('investigator_role', PARAM_TEXT);
            $mform->addRule('investigator_role', get_string('required'), 'required','','client');

            $mform->addElement('text', 'investigator_telephone', 'Phone Number', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('investigator_telephone', PARAM_TEXT);
            $mform->addRule('investigator_telephone', get_string('required'), 'required','','client');

            $mform->addElement('date_selector', 'investigation_date', 'Date of Investigation', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('investigation_date', PARAM_TEXT);
            $mform->addRule('investigation_date', get_string('required'), 'required','','client');

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Other Information</legend>');

            $mform->addElement('textarea', 'incident_description', 'Incident Description', 'wrap="virtual" rows="3" cols="40"');
            $mform->setType('incident_description', PARAM_TEXT);
            $mform->addRule('incident_description', get_string('required'), 'required','','client');

            $mform->addElement('textarea', 'interviewee1_statement', 'Interviewee 1 Statement', 'wrap="virtual" rows="3" cols="40"');
            $mform->setType('interviewee1_statement', PARAM_TEXT);
            $mform->addRule('interviewee1_statement', get_string('required'), 'required','','client');

            $mform->addElement('textarea', 'interviewee2_statement', 'Interviewee 2 Statement', 'wrap="virtual" rows="3" cols="40"');
            $mform->setType('interviewee2_statement', PARAM_TEXT);
            $mform->addRule('interviewee2_statement', get_string('required'), 'required','','client');

            $mform->addElement('select', 'contributors_incident', 'Contributors to Incident', createDropdown($dropdown['contributors_incident']));
            $mform->setType('contributors_incident', PARAM_TEXT);
            $mform->addRule('contributors_incident', get_string('required'), 'required','','client');

            $mform->addElement('textarea', 'results_investigation', 'Results of Investigation', 'wrap="virtual" rows="3" cols="40"');
            $mform->setType('results_investigation', PARAM_TEXT);
            $mform->addRule('results_investigation', get_string('required'), 'required','','client');

            $radioarray   = array();
            $radioarray[] = $mform->createElement('radio', 'receive_medical_treatment', '', "Yes", 'Yes');
            $radioarray[] = $mform->createElement('radio', 'receive_medical_treatment', '', "No", 'No');
            $mform->addGroup($radioarray, 'receive_medical_treatment','Did the employee receive medical treatment? (give details)', array(''), false);
            $mform->addRule('receive_medical_treatment', get_string('required'), 'required','','client');
            //$mform->setDefault('a_resumed_work', 'Yes');

            $radioarray   = array();
            $radioarray[] = $mform->createElement('radio', 'lost_time_report', '', "Yes", 'Yes');
            $radioarray[] = $mform->createElement('radio', 'lost_time_report', '', "No", 'No');
            $mform->addGroup($radioarray, 'lost_time_report','Is there any lost time to report? (give details)', array(''), false);
            $mform->addRule('lost_time_report', get_string('required'), 'required','','client');

            $mform->addElement('select', 'recommended_actions', 'Recommended Corrective Actions', createDropdown($dropdown['recommended_actions']));
            $mform->setType('recommended_actions', PARAM_TEXT);
            $mform->addRule('recommended_actions', get_string('required'), 'required','','client');


            $mform->addElement('textarea', 'specifice_corrective_actions', 'Please provide additional Information regarding specific corrective actions:', 'wrap="virtual" rows="3" cols="40"');
            $mform->setType('specifice_corrective_actions', PARAM_TEXT);
            $mform->addRule('specifice_corrective_actions', get_string('required'), 'required','','client');

            $mform->addElement('textarea', 'corrective_actions_completed', 'Please provide details of when the corrective actions have been completed', 'wrap="virtual" rows="3" cols="40"');
            $mform->setType('corrective_actions_completed', PARAM_TEXT);
            $mform->addRule('corrective_actions_completed', get_string('required'), 'required','','client');
            
            $mform->addElement('textarea', 'other_materials', 'Please detail any other materials including photographs', 'wrap="virtual" rows="3" cols="40"');
            $mform->setType('other_materials', PARAM_TEXT);
            $mform->addRule('other_materials', get_string('required'), 'required','','client');

           
        $mform->addElement('html', '</fieldset>');
       
    }

    public function managerPartView($reportData,$accidentData){
        global $USER, $CFG,$DB;

        $dropdown = get_new_dropdown_data(1);
      
        $mform = $this->_form;

        //$mform->addElement('hidden', 'new_accident_id', !empty($_REQUEST['id']) ? $_REQUEST['id'] : $mform->new_accident_id);
        
        $headding= '<div class="row">
                        <div class="col-sm-6" style="text-align: left !important;">
                            <h3 id="report_headding">Accident Investigation Form</h3>
                        </div>
                        <div class="col-sm-6" style="text-align: right !important;">   
                            <a class="btn btn-dark" style="background-color: #7c77a3; border-color: #7c77a3 !important;" href="index.php?cmd=edit_manager&aid='.$reportData->id.'&id='.$accidentData->id.'"><i class="fa fa-edit"> </i> Edit Investigation </a>
                        </div>
                    </div>';

        $mform->addElement('html', '<h3 style="text-align:center;margin-top:30px">'.$headding.'</h3>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Information</legend>');
            $mform->addElement('static', 'm1', 'Incident Type', @$dropdown['incident_type'][$reportData->incident_type]);
            $mform->addElement('static', 'm2', 'Affecting',     @$dropdown['affecting'][$reportData->affecting]);
            $mform->addElement('static', 'm3', 'Compensation',  @$dropdown['compensation'][$reportData->compensation]);
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Affected Employee / Person</legend>');        
            $mform->addElement('static', 'name1', 'Name',$accidentData->a_surname.' '.$accidentData->a_forename );
            $mform->addElement('static', 'name2', 'Role & Department','' );
            $mform->addElement('static', 'name3', 'Phone Number',$accidentData->a_tel_no );
            $mform->addElement('static', 'name4', 'Date of Incident',date("d-M-Y",$accidentData->b_date ));
            $mform->addElement('static', 'name5', 'Time of Incident',date("d-M-Y",$accidentData->b_date ));
            $mform->addElement('static', 'name7', 'Location of Incident',$accidentData->b_exact_location_site );
            $mform->addElement('static', 'name8', 'Supervisor Name',$accidentData->a_employers_name );
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Interviewee 1</legend>');
            $mform->addElement('static', 'interviewee1_nameM', 'Name', $reportData->interviewee1_name);  
            $mform->addElement('static', 'interviewee1_roleM', 'Role & Department', $reportData->interviewee1_role);
            $mform->addElement('static', 'interviewee1_telephoneM', 'Phone Number', $reportData->interviewee1_telephone);
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Interviewee 2</legend>');
            $mform->addElement('static', 'interviewee2_nameM', 'Name', $reportData->interviewee2_name);
            $mform->addElement('static', 'interviewee2_roleM', 'Role & Department', $reportData->interviewee2_role);
            $mform->addElement('static', 'interviewee2_telephoneM', 'Phone Number', $reportData->interviewee2_telephone);
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Investigator</legend>');
            $mform->addElement('static', 'investigator_nameM', 'Name', $reportData->investigator_name);
            $mform->addElement('static', 'investigator_roleM', 'Role & Department', $reportData->investigator_role);
            $mform->addElement('static', 'investigator_telephoneM', 'Phone Number', $reportData->investigator_telephone);
            $mform->addElement('static', 'investigation_dateM', 'Date of Investigation', date("d-M-Y",$reportData->investigation_date));
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Other Information</legend>');
            $mform->addElement('static', 'incident_descriptionM', 'Incident Description', $reportData->incident_description);
            $mform->addElement('static', 'interviewee1_statementM', 'Interviewee 1 Statement', $reportData->interviewee1_statement);
            $mform->addElement('static', 'interviewee2_statementM', 'Interviewee 2 Statement', $reportData->interviewee2_statement);
            $mform->addElement('static', 'contributors_incidentM', 'Contributors to Incident', @$dropdown['contributors_incident'][$reportData->contributors_incident]);
            $mform->addElement('static', 'results_investigationM', 'Results of Investigation', $reportData->results_investigation);
            $mform->addElement('static', 'receive_medical_treatmentM', 'Did the employee receive medical treatment?(give details)', $reportData->receive_medical_treatment);
            $mform->addElement('static', 'lost_time_reportM', 'Is there any lost time to report?(give details)', $reportData->lost_time_report);
            $mform->addElement('static', 'recommended_actionsM', 'Recommended Corrective Actions', @$dropdown['recommended_actions'][$reportData->recommended_actions]);
            $mform->addElement('static', 'specifice_corrective_actionsM', 'Please provide additional Information regarding specific corrective actions:', $reportData->specifice_corrective_actions);
            $mform->addElement('static', 'corrective_actions_completedM', 'Please provide details of when the corrective actions have been completed', $reportData->corrective_actions_completed);
            $mform->addElement('static', 'other_materialsM', 'Please detail any other materials including photographs', $reportData->other_materials);
            

           
        $mform->addElement('html', '</fieldset>');

        

        if( is_senior_manager() || is_complieance() || is_admin() || is_manager()) {
            $pdfbuttons ='<div class="row" >
                <div class="col-sm-6">
                    
                 </div>
                <div class="col-sm-6" style="text-align: right !important;">     
                     <a class="btn btn-dark" style="background-color: #fcc42c; border-color: #fcc42c !important;" href="index.php?cmd=acc_pdf&id='.$_REQUEST['id'].'&download=1&uid='.$reportData->user_id.'&d='.$reportData->accident_date.'"><i class="fa fa-check-circle"> </i> Export Initial Report as PDF </a>
                
                     <a class="btn btn-dark" style="background-color: #2441e7; border-color: #2441e7 !important;" href="index.php?cmd=new_acc_full_pdf&id='.$_REQUEST['id'].'&download=1&uid='.$reportData->user_id.'&d='.$reportData->accident_date.'"><i class="fa fa-plus-circle"> </i> Export Full Report as PDF</a>
                 </div>
             </div><hr>';
         }
        $mform->addElement('html', $pdfbuttons);

    }

    public function definition() {
        global $PAGE,$USER, $CFG;
        $btnLavel = "";

        $mform = $this->_form;

        $reportData        = get_data(array("id"=>$_REQUEST['id']),get_string('new_accident_table','local_mp_report'));
        $reportDataManager = get_data(array("new_accident_id"=>$reportData->id),get_string('new_accident_manager_table','local_mp_report'));

		$heading = '<h3 style="text-align: center">'.get_string('accident', 'local_mp_report');
        $report_closed = FALSE;
        if(isset($_REQUEST['id']) && $_REQUEST['cmd']=='new_acc_edit' &&( is_senior_manager() || is_complieance() || is_admin() || is_manager()) ) {
           

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
                
                     <a class="btn btn-dark" style="background-color: #2441e7; border-color: #2441e7 !important;" href="index.php?cmd=new_acc_full_pdf&id='.$_REQUEST['id'].'&download=1&uid='.$reportData->user_id.'&d='.$reportData->accident_date.'"><i class="fa fa-plus-circle"> </i> Export Full Report as PDF</a>
                 </div>
             </div>    
            <hr>';
            }

            $mform->addElement('html', $heading);
            $this->userPartViewNew($reportData);
            //$this->managerPartForm($reportData);
            if (!empty($reportDataManager)){
                $this->managerPartView($reportDataManager,$reportData);
            }else {
                $this->managerPartForm($reportData);
                $btnLavel = get_string('savebutton', 'local_mp_report');
            }
           
        }
        else {
            $heading ='<div class="row" >
                            <div class="col-sm-6">
                                <h3 id="report_headding">'.get_string('accident', 'local_mp_report').'</h3>
                            </div>
                            <div class="col-sm-6" style="text-align: right !important;">    
                                <a class="btn btn-dark" style="background-color: #fcc42c; border-color: #fcc42c !important;" onclick="history.back()"><i class="fa fa-backward"> </i> Back</a>
                                <a class="btn btn-dark" style="background-color: #0a4e8a ; border-color: #0a4e8a !important;" href="index.php?cmd=acc_pdf&id='.$_REQUEST['id'].'&download=1&uid='.$reportData->user_id.'&d='.$reportData->accident_date.'"><i class="fa fa-check-circle"> </i> Export Initial Report as PDF </a>
                            </div>
                        </div>    
                        <hr>';
            $mform->addElement('html', $heading);
            if(isset($_REQUEST['id']) && $_REQUEST['cmd']=='new_acc_edit')
            { 
                
                $btnLavel  = "";
                $this->userPartViewNew($reportData);
            }
            else{
                $this->userPartForm();
                $btnLavel  = get_string('submitbtn', 'local_mp_report');
            }

        }
      

        //$mform->addFormRule('accidentDateRequired');

        $mform->addElement('hidden', 'cmd', !empty($_REQUEST['cmd']) ? $_REQUEST['cmd'] : 'form1' );
        $mform->addElement('hidden', 'id', !empty($_REQUEST['id']) ? $_REQUEST['id'] : $mform->id);
        $mform->addElement('hidden', 'read_only', $mform->read_only);

        

        if(!empty($btnLavel)){
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


    }

    public function reset() {
        $this->_form->updateSubmission(null, null);
    }


}


class new_accident_manager_report_form extends moodleform {

   
    public function managerPartForm($reportData){
        global $USER, $CFG,$DB;

        $dropdown = get_new_dropdown_data(1);
      
        $mform = $this->_form;

        //$mform->addElement('hidden', 'new_accident_id', !empty($_REQUEST['id']) ? $_REQUEST['id'] : $mform->new_accident_id);
        
        $mform->addElement('html', '<h3 style="text-align:center;margin-top:30px">Accident Investigation Form</h3>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Information</legend>');

            $mform->addElement('select', 'incident_type', 'Incident Type', createDropdown($dropdown['incident_type']));
            $mform->setType('incident_type', PARAM_TEXT);
            $mform->addRule('incident_type', get_string('required'), 'required','','client');

            $mform->addElement('select', 'affecting', 'Affecting', createDropdown($dropdown['affecting']));
            $mform->setType('affecting', PARAM_TEXT);
            $mform->addRule('affecting', get_string('required'), 'required','','client');

            $mform->addElement('select', 'compensation', 'Compensation', createDropdown($dropdown['compensation']));
            $mform->setType('compensation', PARAM_TEXT);
            $mform->addRule('compensation', get_string('required'), 'required','','client');
        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Affected Employee / Person</legend>');
        
            $mform->addElement('static', 'name1', 'Name',$reportData->a_surname.' '.$reportData->a_forename );
            $mform->addElement('static', 'name2', 'Role & Department','' );
            $mform->addElement('static', 'name3', 'Phone Number',$reportData->a_tel_no );
            $mform->addElement('static', 'name4', 'Date of Incident',date("d-M-Y",$reportData->b_date ));
            $mform->addElement('static', 'name5', 'Time of Incident',date("d-M-Y",$reportData->b_date ));
            $mform->addElement('static', 'name7', 'Location of Incident',$reportData->b_exact_location_site );
            $mform->addElement('static', 'name8', 'Supervisor Name',$reportData->a_employers_name );

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Interviewee 1</legend>');

            $mform->addElement('text', 'interviewee1_name', 'Name', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee1_name', PARAM_TEXT);
            $mform->addRule('interviewee1_name', get_string('required'), 'required','','client');

            $mform->addElement('text', 'interviewee1_role', 'Role & Department', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee1_role', PARAM_TEXT);
            $mform->addRule('interviewee1_role', get_string('required'), 'required','','client');

            $mform->addElement('text', 'interviewee1_telephone', 'Phone Number', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee1_telephone', PARAM_TEXT);
            $mform->addRule('interviewee1_telephone', get_string('required'), 'required','','client');

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Interviewee 2</legend>');

            $mform->addElement('text', 'interviewee2_name', 'Name', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee2_name', PARAM_TEXT);
            $mform->addRule('interviewee2_name', get_string('required'), 'required','','client');

            $mform->addElement('text', 'interviewee2_role', 'Role & Department', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee2_role', PARAM_TEXT);
            $mform->addRule('interviewee2_role', get_string('required'), 'required','','client');

            $mform->addElement('text', 'interviewee2_telephone', 'Phone Number', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee2_telephone', PARAM_TEXT);
            $mform->addRule('interviewee2_telephone', get_string('required'), 'required','','client');

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Investigator</legend>');

            $mform->addElement('text', 'investigator_name', 'Name', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('investigator_name', PARAM_TEXT);
            $mform->addRule('investigator_name', get_string('required'), 'required','','client');

            $mform->addElement('text', 'investigator_role', 'Role & Department', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('investigator_role', PARAM_TEXT);
            $mform->addRule('investigator_role', get_string('required'), 'required','','client');

            $mform->addElement('text', 'investigator_telephone', 'Phone Number', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('investigator_telephone', PARAM_TEXT);
            $mform->addRule('investigator_telephone', get_string('required'), 'required','','client');

            $mform->addElement('date_selector', 'investigation_date', 'Date of Investigation', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('investigation_date', PARAM_TEXT);
            $mform->addRule('investigation_date', get_string('required'), 'required','','client');

        $mform->addElement('html', '</fieldset>');

        $mform->addElement('html', '<fieldset class="scheduler-border"><legend class="scheduler-border">Other Information</legend>');

            $mform->addElement('textarea', 'incident_description', 'Incident Description', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('incident_description', PARAM_TEXT);
            $mform->addRule('incident_description', get_string('required'), 'required','','client');

            $mform->addElement('textarea', 'interviewee1_statement', 'Interviewee 1 Statement', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee1_statement', PARAM_TEXT);
            $mform->addRule('interviewee1_statement', get_string('required'), 'required','','client');

            $mform->addElement('textarea', 'interviewee2_statement', 'Interviewee 2 Statement', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('interviewee2_statement', PARAM_TEXT);
            $mform->addRule('interviewee2_statement', get_string('required'), 'required','','client');

            $mform->addElement('select', 'contributors_incident', 'Contributors to Incident', createDropdown($dropdown['contributors_incident']));
            $mform->setType('contributors_incident', PARAM_TEXT);
            $mform->addRule('contributors_incident', get_string('required'), 'required','','client');

            $mform->addElement('textarea', 'results_investigation', 'Results of Investigation', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('results_investigation', PARAM_TEXT);
            $mform->addRule('results_investigation', get_string('required'), 'required','','client');

            $radioarray   = array();
            $radioarray[] = $mform->createElement('radio', 'receive_medical_treatment', '', "Yes", 'Yes');
            $radioarray[] = $mform->createElement('radio', 'receive_medical_treatment', '', "No", 'No');
            $mform->addGroup($radioarray, 'receive_medical_treatment','Did the employee receive medical treatment? (give details)', array(''), false);
            $mform->addRule('receive_medical_treatment', get_string('required'), 'required','','client');
            //$mform->setDefault('a_resumed_work', 'Yes');

            $radioarray   = array();
            $radioarray[] = $mform->createElement('radio', 'lost_time_report', '', "Yes", 'Yes');
            $radioarray[] = $mform->createElement('radio', 'lost_time_report', '', "No", 'No');
            $mform->addGroup($radioarray, 'lost_time_report','Is there any lost time to report? (give details)', array(''), false);
            $mform->addRule('lost_time_report', get_string('required'), 'required','','client');

            $mform->addElement('select', 'recommended_actions', 'Recommended Corrective Actions', createDropdown($dropdown['recommended_actions']));
            $mform->setType('recommended_actions', PARAM_TEXT);
            $mform->addRule('recommended_actions', get_string('required'), 'required','','client');


            $mform->addElement('textarea', 'specifice_corrective_actions', 'Please provide additional Information regarding specific corrective actions:', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('specifice_corrective_actions', PARAM_TEXT);
            $mform->addRule('specifice_corrective_actions', get_string('required'), 'required','','client');

            $mform->addElement('textarea', 'corrective_actions_completed', 'Please provide details of when the corrective actions have been completed', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('corrective_actions_completed', PARAM_TEXT);
            $mform->addRule('corrective_actions_completed', get_string('required'), 'required','','client');
            
            $mform->addElement('textarea', 'other_materials', 'Please detail any other materials including photographs', 'maxlength="100" size="40" width="40px" ');
            $mform->setType('other_materials', PARAM_TEXT);
            $mform->addRule('other_materials', get_string('required'), 'required','','client');

           
        $mform->addElement('html', '</fieldset>');
       
    }

   
    public function definition() {
        global $PAGE,$USER, $CFG;
        $btnLavel = "";

        $mform = $this->_form;


        $report_closed = FALSE;
        if(isset($_REQUEST['id']) &&( is_senior_manager() || is_complieance() || is_admin() || is_manager()) ) {
            $reportData        = get_data(array("id"=>$_REQUEST['id']),get_string('new_accident_table','local_mp_report'));
            $reportDataManager = get_data(array("new_accident_id"=>$reportData->id),get_string('new_accident_manager_table','local_mp_report'));
            $this->managerPartForm($reportData);
            
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

