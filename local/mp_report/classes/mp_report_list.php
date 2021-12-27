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


        $result = $DB->get_records($tableName,array('submitter_to_manager' => $submitter_to_manager));

        $table = new html_table();
        $table->attributes['class'] = 'generaltable accident_table';
        $table->width = '100%';


        $table->head  = array("Incident Number","Surname","First Name","Incident Date","Summary of Accident details","Action Taken","Findings","Recommendations","Action");
        $table->align = array( 'left','left','left','left','left','left','left','left','center');
        $table->size  = array( '20%','20%',"25%","25%","10%");

        $count=0;
        foreach($result as $rec) {
            $editDeleteLink = "<a href='index.php?cmd=new_acc_edit&id=$rec->id'>View</a>";
            $reporter = get_userInfo(array("id" => $rec->user_id));
            $table->data[] = new html_table_row(array( $rec->id,date("d/m/Y",$rec->b_date),$reporter->firstname." ".$reporter->lastname,$rec->a_surname,$editDeleteLink));
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


class home_page extends moodleform {


    public function definition() {

        $mform              = $this->_form;
        $manage_manager_div = "";

        if(is_admin() || is_complieance() || is_senior_manager()){
            $manage_manager_div ='<div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/assign.php" data-ccn-c="color1" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(234, 38, 227, 0.6);">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="flaticon-add-contact"></span></div>
							<div class="details">
								<h5 class="color-white">Manage Managers</h5><p class="color-white">Over 0 manager</p>
							</div>
						</div>
					</a>
				</div>';
        }

        $html = '<div class="row justify-content-center" style="text-align: center !important;">
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
                    <a href="/local/mp_report/index.php?cmd=new_accpage" data-ccn-c="color4" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgb(0, 97, 255,0.6);">
                        <div class="overlay">
                            <div class="icon ccn_icon_2 color-white"><span data-ccn="icon4" class="flaticon-checklist"></span></div>
                            <div class="details">
                                <h5 class="color-white">New Accident Report</h5><p class="color-white">Over 0 accident</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!--
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/mp_report/index.php?cmd=accpage" data-ccn-c="color3" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(0, 97, 255, 0.6);">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="ccn-flaticon-add-1"></span></div>
							<div class="details">
								<h5 class="color-white">Accident Report</h5><p class="color-white">Over 1 reports</p>
							</div>
						</div>
					</a>
				</div>
                -->
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/mp_report/index.php?cmd=incpage" data-ccn-c="color4" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(241, 67, 45, 0.6);">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon4" class="flaticon-checklist"></span></div>
							<div class="details">
								<h5 class="color-white">Incident Report</h5><p class="color-white">Over 0 incidents</p>
							</div>
						</div>
					</a>
				</div>

                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
                <a href="/local/mp_report/index.php?cmd=register" data-ccn-c="color4" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(241, 67, 45, 0.6);">
                    <div class="overlay">
                        <div class="icon ccn_icon_2 color-white"><span data-ccn="icon4" class="flaticon-checklist"></span></div>
                        <div class="details">
                            <h5 class="color-white">Accident Register</h5><p class="color-white">Over 0 incidents</p>
                        </div>
                    </div>
                </a>
            </div>
				
				'.$manage_manager_div.'
                
             
          </div>';

      $mform->addElement('html',$html);


    }





}
