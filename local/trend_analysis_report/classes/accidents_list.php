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
//$pluginname = 'accident_report';
require_once($CFG->libdir.'/formslib.php');

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/accident_report/js/datatables/datatables.min.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/accident_report/js/datatables/datatables-1.10.18/js/jquery.dataTables.min.js'),true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/accident_report/js/datatables/datatables-1.10.18/js/dateSort.js'));
$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/trend_analysis_report/css/custom.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/trend_analysis_report/js/accident_report.js'));



class accidents_list extends moodleform {

    public function definition() {
        global $USER,$CFG;

        $mform    = $this->_form;

        $mform->_maxFileSize = 90000000;

        $mform->_formname = "accident_report_list";

        $dropdown = get_new_dropdown_data(1);

        $html ='<div class="row" >
                <div class="col-sm-6"> </div>
                <div class="col-sm-6" style="text-align: right !important;">     
                     <a class="btn btn-dark" onclick="history.back()" style="background-color: #fcc42c; border-color: #fcc42c !important; font-weight: bold"><i class="fa fa-step-backward"> </i> Back </a>
                </div>
             </div>';

        $mform->addElement('html',$html);

        $mform->addElement('html', html_writer:: start_tag('fieldset',array('class'=>'scheduler-border')));
        $mform->addElement('html', html_writer:: tag('legend','Filters',array('class'=>'scheduler-border')));

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-8 col-lg-6 form-group-ele')));
        $mform->addElement('date_selector', 'date_from', 'Date from', 'maxlength="100" size="40" ');
        $mform->setType('date_from', PARAM_TEXT);
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-8 col-lg-6 form-group-ele')));
        $mform->addElement('date_selector', 'date_to', 'Date to', 'maxlength="100" size="40" ');
        $mform->setType('date_to', PARAM_TEXT);
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-5 col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Surname',array('for'=>'surname','class'=>'col-md-12')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'surname','class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Manager',array('for'=>'manager','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select(createDropdown(get_hs_manager_list()), 'manager', '', array(),array('class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Submitter',array('for'=>'submitter','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select(createDropdown(get_system_user_list()), 'submitter', '', array(),array('class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

     
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Status',array('for'=>'status','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select(createDropdown(accident_status()), 'status', '', array(),array('class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','The Operative is now at',array('for'=>'a_following_accident','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select(createDropdown($dropdown['operative_at_now']), 'a_following_accident', '', array(),array('class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

      

//        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row
        //start row
//        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));


        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3')));
        $mform->addElement('html', html_writer:: tag('label','Employment Status',array('for'=>'a_status','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select(createDropdown($dropdown['employment_status']), 'a_status', '', array(),array('class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));
        
        $mform->addElement('html', html_writer:: div('','col-md-5 col-lg-9 form-group-ele'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-7 col-lg-3 form-group-ele','style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: tag('button','Search',array('type'=>'button','id'=>'accident_report','class'=>'btn btn-primary','style' =>'margin-right:5px')));
        $mform->addElement('html', html_writer::tag('a', 'Reload', array('href'=>$CFG->wwwroot.'/local/trend_analysis_report/accident_report.php','class'=>'btn btn-secondary')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        $mform->addElement('html', html_writer:: end_tag('fieldset'));


    }

}
