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
$pluginname = 'mp_report';
require_once($CFG->libdir.'/formslib.php');
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/custom.js'));

class mp_report_list extends moodleform {


    public function definition() {
        global $USER, $CFG,$DB;

        $table  = "test_user_table";
        $html   = "";
        $mform  = $this->_form;

        $mform->addElement('html',get_string('welcome', 'local_mp_report'));

        $buttonarray = array();
        $buttonarray[] = $mform->createElement('button', 'add', get_string('buttonadd', 'local_mp_report'),array("id"=>"add"));
        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);


        $result = $DB->get_records($table);

        $table = new html_table();
        $table->width = '70%';


        $table->head  = array("#","Name","Email","Postcode","Action");
        $table->align = array( 'left','left','left','left','center');
        $table->size  = array( '10%','35%','25%',"15%","15%");

        $count=0;
        foreach($result as $rec) {
            $editDeleteLink = "<a href='index.php?cmd=edit&id=$rec->id'>Edit</a> | <a  href='#' class='deleteUser' data-id='$rec->id'>Delete</a>";
           $table->data[] = new html_table_row(array( ++$count,implode(array($rec->firstname," ",$rec->lastname)), $rec->email,$rec->postcode,$editDeleteLink));
        }
        $html .= html_writer::table($table);



        $mform->addElement('html', $html, 'local_mp_report');


    }

    public function reset() {
        $this->_form->updateSubmission(null, null);
    }


}

class new_accident_register extends moodleform {


    public function definition() {
        $this->accident_report_list();
    }

    public function accident_report_list() {
        global $USER, $CFG,$DB;

         $tableName  = get_string('new_accident_table','local_mp_report');
        
        $html   = "";
        $mform  = $this->_form;

        $mform->addElement('html','
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="ccnMdlHeading">Accident Register</h4>
                 </div>
                  <div class="col-sm-4" style="text-align: right !important;">  
                     <a class="btn btn-dark" style="background-color: #fcc42c; border-color: #fcc42c !important; " href="/local/mp_report/index.php"><i class="fa fa-backward"> </i> Back </a>
                    
                     <a class="btn btn-dark" style="background-color: #2441e7; border-color: #2441e7 !important;" href="/local/mp_report/index.php?cmd=form3"><i class="fa fa-plus-circle"> </i> Add Accident</a>
                 </div>
             </div>    
            <hr>');
        $submitter_to_manager = 'Yes';


        $arr = array('submitter_to_manager' => $submitter_to_manager);

        if(!is_admin() && !is_manager()){
            $arr['user_id'] = $USER->id;
        }
        $result   = $DB->get_records($tableName,$arr);
        $result2  = $DB->get_records('new_accident_manager_report');
        $dropdown = get_new_dropdown_data(1);

        $acc_manager = array();

        if(!empty($result2)){
            foreach($result2 as $item){
                $acc_manager[$item->new_accident_id] = $item;
            }
        }

        $table = new html_table();
        $table->attributes['class'] = 'generaltable accident_table';
        $table->width = '100%';


        $table->head  = array("No","Surname","First Name","Incident Date","Summary of Accident details","Action Taken","Findings","Recommendations","Status","Action");
        $table->align = array( 'left','left','left','left','left','left','left','left','center','center');
        //$table->size  = array( '20%','20%',"25%","25%","10%");

        $count=0;
        
        foreach($result as $rec) {
            $editDeleteLink = "";
            if(isset($acc_manager[$rec->id])) {
                $editDeleteLink = "<a href='index.php?cmd=accident_event&id=$rec->id' style='color:#5769cf'>Statement</a> | ";
            }
            $editDeleteLink .= "<a href='index.php?cmd=new_acc_edit&id=$rec->id' style='color:#5769cf'>View</a>";
            $reporter = get_userInfo(array("id" => $rec->user_id));

            if($rec->status=='Pending')        $status = '<b style="color:#c3ad13">Pending</b>';
            elseif($rec->status=='Confirmed')  $status = '<b style="color:#3aad6d">Confirmed</b>';
            elseif($rec->status=='Approved')   $status = '<b style="color:#2441e7">Approved</b>';


            $table->data[] = new html_table_row(array( ++$count, $rec->a_surname,
                                                                 $rec->a_forename, 
                                                                 date("d/m/Y",$rec->b_date),
                                                                 $acc_manager[$rec->id]->incident_description,$rec->f_action_taken,
                                                                 $acc_manager[$rec->id]->results_investigation,
                                                                 $dropdown['recommended_actions'][$acc_manager[$rec->id]->recommended_actions],
                                                                 $status,
                                                                 $editDeleteLink));
        }
        $html .= html_writer::table($table);
        $html .= "<hr></br>";

        $mform->addElement('html', $html, 'local_mp_report');


    }
}

class new_accident_page extends moodleform {


    public function definition() {
        $this->accident_report_list();
    }

    public function accident_report_list() {
        global $USER, $CFG,$DB;

         $tableName  = get_string('new_accident_table','local_mp_report');
        
        $html   = "";
        $mform  = $this->_form;

        $mform->addElement('html','
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="ccnMdlHeading">'.get_string('accident', 'local_mp_report')."s</h4>
                 </div>
                  <div class='col-sm-4' style='text-align: right !important;'>  
                     <a class='btn btn-dark' style='background-color: #fcc42c; border-color: #fcc42c !important; ' href='/local/mp_report/index.php'><i class='fa fa-backward'> </i> Back </a>
                    
                     <a class='btn btn-dark' style='background-color: #2441e7; border-color: #2441e7 !important;' href='/local/mp_report/index.php?cmd=form3'><i class='fa fa-plus-circle'> </i> Add Accident</a>
                 </div>
             </div>    
            <hr>");
        $submitter_to_manager = 'Yes';


        $result = $DB->get_records($tableName,array('submitter_to_manager' => $submitter_to_manager));

        $table = new html_table();
        $table->attributes['class'] = 'generaltable accident_table';
        $table->width = '100%';


        $table->head  = array("Report Number","Date of Accident","Reporter","Injured Person","Action");
        $table->align = array( 'left','left','left','left','center');
        $table->size  = array( '20%','20%',"25%","25%","10%");

        $count=0;
        foreach($result as $rec) {
            $editDeleteLink = "<a href='index.php?cmd=new_acc_edit&id=$rec->id'>View</a>";
            //$editDeleteLink = "<a href='index.php?cmd=new_acc_edit&id=$rec->id'>View</a>";
            $reporter = get_userInfo(array("id" => $rec->user_id));
            $table->data[] = new html_table_row(array( $rec->id,date("d/m/Y",$rec->b_date),$reporter->firstname." ".$reporter->lastname,$rec->a_surname,$editDeleteLink));
        }
        $html .= html_writer::table($table);
        $html .= "<hr></br>";



        $mform->addElement('html', $html, 'local_mp_report');


    }
}


class accident_page extends moodleform {


    public function definition() {
        $this->accident_report_list();
    }

    public function accident_report_list() {
        global $USER, $CFG,$DB;

        $tableName  = get_string('accident_table','local_mp_report');
        $html   = "";
        $mform  = $this->_form;

        $mform->addElement('html','
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="ccnMdlHeading">'.get_string('accident', 'local_mp_report')."s</h4>
                 </div>
                  <div class='col-sm-4' style='text-align: right !important;'>  
                     <a class='btn btn-dark' style='background-color: #fcc42c; border-color: #fcc42c !important; ' href='/local/mp_report/index.php'><i class='fa fa-backward'> </i> Back </a>
                    
                     <a class='btn btn-dark' style='background-color: #2441e7; border-color: #2441e7 !important;' href='/local/mp_report/index.php?cmd=form1'><i class='fa fa-plus-circle'> </i> Add Accident</a>
                 </div>
             </div>    
            <hr>");
        $submitter_to_manager = 'Yes';


        $result = $DB->get_records($tableName,array('submitter_to_manager' => $submitter_to_manager));

        $table = new html_table();
        $table->attributes['class'] = 'generaltable accident_table';
        $table->width = '100%';


        $table->head  = array("Report Number","Date of Accident","Reporter","Location","Action");
        $table->align = array( 'left','left','left','left','center');
        $table->size  = array( '20%','20%',"25%","25%","10%");

        $count=0;
        foreach($result as $rec) {
            $editDeleteLink = "<a href='index.php?cmd=acc_edit&id=$rec->id'>Edit</a>";
            $reporter = get_userInfo(array("id" => $rec->user_id));
            $table->data[] = new html_table_row(array( $rec->id,date("d/m/Y",$rec->accident_date),$reporter->firstname." ".$reporter->lastname,$rec->accident_place,$editDeleteLink));
        }
        $html .= html_writer::table($table);
        $html .= "<hr></br>";



        $mform->addElement('html', $html, 'local_mp_report');


    }
}

class incident_page extends moodleform {


    public function definition() {
        $this->incident_report_list();
    }
    public function incident_report_list() {
        global $USER, $CFG,$DB;

        $tableName  = get_string('incident_table','local_mp_report');
        $html   = "";
        $mform  = $this->_form;
        $dropdown = get_dropdown_data(2,'report_category');

        $mform->addElement('html','
            <div class="row" >
                <div class="col-sm-8">
                    <h4 class="ccnMdlHeading">'.get_string('incident', 'local_mp_report')."s</h4>
                 </div>
                <div class='col-sm-4' style='text-align: right !important;'>     
                     <a class='btn btn-dark' style='background-color: #fcc42c; border-color: #fcc42c !important;' href='/local/mp_report/index.php'><i class='fa fa-backward'> </i> Back </a>
                
                     <a class='btn btn-dark' style='background-color: #2441e7; border-color: #2441e7 !important;' href='/local/mp_report/index.php?cmd=form2'><i class='fa fa-plus-circle'> </i> Add Incident</a>
                 </div>
             </div>    
            <hr>");

        $submitter_to_manager = 'Yes';

        $result = $DB->get_records($tableName,array('submitter_to_manager' => $submitter_to_manager));

        $table = new html_table();
        $table->attributes['class'] = 'generaltable incident_table';
        $table->width = '100%';


        $table->head  = array("Report Number","Date of Report","Reporter","Report Category","Action");
        $table->align = array( 'left','left','left','left','center');
        $table->size  = array( '20%','20%','25%','25%',"15%");

        $count=0;
        foreach($result as $rec) {
            $editDeleteLink = "<a href='index.php?cmd=inc_edit&id=$rec->id'>Edit</a>";
            $reporter       = get_userInfo(array("id" => $rec->user_id));
            $category_id    = $rec->is_correct_report_category=='No' ?   $rec->correct_report_category : $rec->report_category;
            $table->data[] = new html_table_row(array( $rec->id,date("d/m/Y",$rec->i_date),$reporter->firstname." ".$reporter->lastname,@$dropdown['report_category'][$category_id],$editDeleteLink));
        }
        $html .= html_writer::table($table);



        $mform->addElement('html', $html, 'local_mp_report');


    }

}


class accident_event extends moodleform{

    public function definition(){
        global $DB,$USER;
        $mform = $this->_form;

        $button   = ""; 
        $display  = '';
        $id       = $_REQUEST['id'];
        $section5 = ""; 
        $disabled2 =  "";
        $reportData = $DB->get_record("new_accident_report",array("id" => $id));

        
        if(!empty($reportData->confirmed_person_name)) $readonly = "readonly";
        else                                           $readonly = "";

        if($reportData->status!='Pending') $checked = "checked";
        else                               $checked = "";

        if($reportData->status=='Pending') { 
            $section5 = ""; 
            $button   = '<a id="saveStatement" class="btn btn-dark" style="background-color: #137D1F; border-color: #137D1F !important;"><i class="fa fa-check-circle"> </i> Submit </a>'; 
        }
        else { 
            
            if($reportData->status=='Confirmed') $disabled = "disabled";
            else                                 $disabled = "";

            
            $button   = '<a id="saveStatement" class="btn btn-dark" style="background-color: #c14070; border-color: #c14070 !important;"><i class="fa fa-check-circle"> </i> Approve </a>'; 

            if($reportData->status=='Approved')  {$disabled2= "disabled";  $display = "none";}
            else { $disabled2= "";}
            
            if(is_admin() || is_manager()){
            $section5 = ' <br> 
                            <table width="100%">            
                                <tr>
                                    <td style="background:#090; color:#000"><b>5.    For the employee only</b></td>
                                </tr>
                                <tr>
                                    <td>Complete this box if the accident is reportable under the Reporting of Injuries, Diseases and Dangerous Occurrences Regulations 1995 (RIDDOR)</td>            
                                </tr>
                                <tr>
                                    <td>How was it reported<br>
                                        <textarea name="how_reported" class="form-control" cols=40 rows=3 '.$disabled2.'>'.$reportData->how_reported.'</textarea>
                                    </td>            
                                </tr>
                            </table>
                            ';
            }
            else{
                $display = "none";
            
            }                
        }   


        if(empty($reportData->confirmed_person_name) && $reportData->user_id!=$USER->id && (is_admin() || is_manager())) {  $section4 = "";  $display="none"; }

        else {

            if($reportData->status=='Approved')  {$disabled= "disabled";}    
        $section4 = ' <table width="100%">
            
                            <tr>
                                <td style="background:#090; color:#000" colspan="3"><b>4.    For the employee only</b></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                <input type="checkbox" 
                                    name="confirmed" 
                                    id="confirmed" '.$checked. ' ' .$disabled.'> 
                                    <a href="javascript:void(0)" onclick="document.getElementById(\'confirmed\').checked=true" >
                                I give consent to my employer to disclose my personal information and details of 
                                the accident which appear on this form to safety representatives and representatives of employee 
                                safety for them to carry out the health and safety functions given to them by law.</a>
                                </td>
                            </tr>
                            
                            </table>
                            <table width="100%">
                            
                            <tr>
                                <td width="25%">Your Full Name: 
                                    <input  tyle="text" name="confirmed_person_name" 
                                            value="'.$reportData->confirmed_person_name.'" 
                                            class="form-control" style="width:250px"; 
                                            '.$readonly.'
                                            id="confirmed_person_name">
                                </td>
                                <td>Date:<br><b>'.Date("d-M-Y").'</b></td>
                            </tr>
                            </table>';
        }

        

        $html ='
        <style>
           table tr td{
               padding: 5px;
           }
        </style>
        
        <table width="100%">
        
        <tr>
            <td colspan="3"><h1 align="center">Accident Statement of Events</h1></td>
            <td style="text-align:right"><a class="btn btn-dark" style="background-color: #fcc42c; border-color: #fcc42c !important; " onclick="history.back()"><i class="fa fa-backward"> </i> Back</a></td>
                 
        </tr>
        <tr>
            <td style="background:#090; color:#000" colspan="4"><b>1.  About the person who had the accident</b></td>
        </tr>
        <tr>
            <td width="10%">Name</td>
            <td>: '.boldText($reportData->a_surname.' '.$reportData->a_forename).'</td>
        </tr>
        <tr>
            <td width="10%">Address</td>
            <td>: '.boldText($reportData->a_home_address).'</td>
        </tr>
        <tr>
            <td width="10%">Postcode</td>
            <td>: '.boldText($reportData->a_postcode).'</td>
        </tr>
        <tr>
            <td width="10%">Occupation</td>
            <td>: '.boldText($reportData->a_job_title).'</td>
        </tr>
        
        </table>
        
        <br />
        
        <table width="100%">
        
        <tr>
            <td style="background:#090; color:#000" colspan="4"><b>2.   About you, the person filling in this record</b></td>
        </tr>
       
        <tr>
            <td width="10%">Name</td>
            <td>: '.boldText($reportData->a_surname.' '.$reportData->a_forename).'</td>
        </tr>
        <tr>
            <td width="10%">Address</td>
            <td>: '.boldText($reportData->a_home_address).'</td>
        </tr>
        <tr>
            <td width="10%">Postcode</td>
            <td>: '.boldText($reportData->a_postcode).'</td>
        </tr>
        <tr>
            <td width="10%">Occupation</td>
            <td>: '.boldText($reportData->a_job_title).'</td>
        </tr>
        
        </table>
        
        <br />
        
        <table width="100%">
        
        <tr>
            <td style="background:#090; color:#000" colspan="4"><b>3.   About the accident</b></td>
        </tr>
        <tr>
            <td width="15%">Date of Occurrence</td>
            <td width="15%">: '.boldText(date("d-M-Y",$reportData->b_date)).'</td>
            <td width="15%">Time of Occurrence</td>
            <td width="15%">: '.boldText(date("g:i A",$reportData->b_date)).'</td>
        </tr>
          
        </table>
        
        <table width="100%">
        
        <tr>
            <td >Describe the location (room or place)</td>
        </tr>
        <tr>
            <td> '.boldText($reportData->b_exact_location_site).'</td>
        </tr>
        
        <tr>
            <td>Say how and if possible, why the accident occurred</td>
        </tr>
        <tr>
            <td> '.boldText($reportData->b_dangerous).'</td>
        </tr>
        <tr>
            <td>Please give details of any injury</td>
        </tr>
        <tr>
            <td> '.boldText($reportData->b_injured).'</td>
        </tr>
        </table>
        <br />
      
        
           '.$section4.'
            
            '.$section5.'

            <hr>
            </div class="row">
            
                <div style="display:'.$display.'" class="col-sm-3" style="text-align: right !important;">     
                    '.$button.'
                    <a class="btn btn-dark" style=""><i class="fa fa-plus-circle"> </i> Cancel </a>
                </div>
            
           </div> 
        ';

        $mform->addElement('hidden', 'cmd', 'savestatement' );
        $mform->addElement('hidden', 'id', !empty($_REQUEST['id']) ? $_REQUEST['id'] : $mform->id);
        $mform->addElement('html',$html);
    }
}


class home_page extends moodleform {


    public function definition() {

        global $DB,$USER;
        $mform              = $this->_form;
        $manage_manager_div = "";
        $arr = array();

        if(!is_admin() && !is_manager()){
            $arr = array("user_id" => $USER->id);
        }

        $accidents = $DB->get_records('new_accident_report',$arr);
        $incidents = $DB->get_records('incident_report',$arr);

        //$accident_register = $DB->get_records('new_accident_manager_report');

        if(is_admin() || is_complieance() || is_senior_manager()){
            $manage_manager_div ='<div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/assign.php" data-ccn-c="color1" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(234, 38, 227, 0.6);">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="flaticon-add-contact"></span></div>
							<div class="details">
								<h5 class="color-white">Manage Managers</h5><p class="color-white">0 Manager/s</p>
							</div>
						</div>
					</a>
				</div>';
        }

        $html = '
            <h3> Accident Reports</h3><hr>
            <div class="row" style="text-align: left !important;">
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
                    <a href="/local/mp_report/index.php?cmd=register" data-ccn-c="color4" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgb(8 37 183 / 60%)">
                        <div class="overlay">
                            <div class="icon ccn_icon_2 color-white"><span data-ccn="icon4" class="flaticon-checklist"></span></div>
                            <div class="details">
                                <h5 class="color-white">Accident Register</h5><p class="color-white">'.count($accidents).' Accident/s</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            <h3> Incident Reports</h3><hr>

            <div class="row" style="text-align: left !important;">
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/mp_report/index.php?cmd=incpage" data-ccn-c="color4" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(241, 67, 45, 0.6);">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon4" class="flaticon-checklist"></span></div>
							<div class="details">
								<h5 class="color-white">Incident Report</h5><p class="color-white">'.count($incidents).' Incident/s</p>
							</div>
						</div>
					</a>
				</div>
				
				'.$manage_manager_div.'
          </div>';

      $mform->addElement('html',$html);


    }





}
