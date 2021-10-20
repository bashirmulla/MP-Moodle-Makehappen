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
 * @package    training_matrix
 * @copyright  2020 Calm-solutions.com
 * @author     Bash & SAM Harun & Mahedi
 */

defined('MOODLE_INTERNAL') || die;
$pluginname = 'training_matrix';
require_once($CFG->libdir.'/formslib.php');

//$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/datatables/datatables.min.css'));
//$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/datatables/datatables-1.10.18/js/jquery.dataTables.min.js'),true);
//$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/datatables/datatables-1.10.18/js/dateSort.js'));

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/css/managecertificates.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/managecertificates.js'));


class managecertificates_filter_form extends moodleform {

    public function definition() {
        global $USER,$CFG;

        $mform    = $this->_form;

        $mform->_maxFileSize = 90000000;

        $mform->_formname = "managecertificates_filter_form";

        echo $html ='<div class="row" >
                <div class="col-sm-6"><h4>Manage Certificate</h4></div>
                <div class="col-sm-6" style="text-align: right !important;">     
                     <a class="btn btn-dark" onclick="history.back()" style="background-color: #fcc42c; border-color: #fcc42c !important; font-weight: bold"><i class="fa fa-step-backward"> </i> Back </a>
                </div>
             </div>';

        $mform->addElement('html', html_writer:: start_tag('fieldset',array('class'=>'scheduler-border')));
        $mform->addElement('html', html_writer:: tag('legend','Filters',array('class'=>'scheduler-border')));

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));


        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','User',array('for'=>'user','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select((get_system_user_list()), 'user', '', array(),array('class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Certificate type',array('for'=>'certificate_type','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select(createDropdown(certificatetype_dropdown_list()), 'certificate_type', '', array(),array('class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Manager',array('for'=>'manager','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select((get_all_manager_list()),   'manager', '', array(),array('class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Active/Inactive',array('for'=>'user_status','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select(createDropdown(user_status()), 'user_status', 'Active', array(),array('class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Status',array('for'=>'status','class'=>'col-md-12')));
        $status = certificates_status();
        unset($status[7]);
        $mform->addElement('html', html_writer::select(createDropdown($status), 'status', '', array(),array('class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-5 col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','ID Number',array('for'=>'id_number','class'=>'col-md-12')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'id_number','class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));


        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));

        $mform->addElement('html',html_writer:: start_tag('div',array('class'=>'col-md-12','style' =>"margin-bottom:5px;")));
        $mform->addElement('html',html_writer:: tag('button','',array('type'=>'button','class'=>'btn btn-circle status_btn expiring','style' =>"margin-left:2px",'value'=>'1')));
        $mform->addElement('html',html_writer:: tag('span','Expiring',array("class" =>"status_btn", "style" =>"padding:5px")));

        $mform->addElement('html',html_writer:: tag('button','',array('type'=>'button','class'=>'btn btn-circle status_btn expired-notheld','style' =>"margin-left:2px",'value'=>'2')));
        $mform->addElement('html',html_writer:: tag('span','Expired/Not Held',array("class" =>"status_btn", "style" =>"padding:5px")));

        $mform->addElement('html',html_writer:: tag('button','',array('type'=>'button','class'=>'btn btn-circle status_btn booked','style' =>"margin-left:2px",'value'=>'3')));
        $mform->addElement('html',html_writer:: tag('span','Booked',array("class" =>"status_btn", "style" =>"padding:5px")));

        $mform->addElement('html',html_writer:: tag('button','',array('type'=>'button','class'=>'btn btn-circle status_btn awaiting-certificate','style' =>"margin-left:2px",'value'=>'4')));
        $mform->addElement('html',html_writer:: tag('span','Awaiting Certificate',array("class" =>"status_btn", "style" =>"padding:5px")));

        $mform->addElement('html',html_writer:: tag('button','',array('type'=>'button','class'=>'btn btn-circle status_btn no-action-requrired','style' =>"margin-left:2px",'value'=>'5')));
        $mform->addElement('html',html_writer:: tag('span','No Action required',array("class" =>"status_btn", "style" =>"padding:5px")));

        $mform->addElement('html',html_writer:: tag('button','',array('type'=>'button','class'=>'btn btn-circle status_btn na','style' =>"margin-left:2px;",'value'=>'6')));
        $mform->addElement('html',html_writer:: tag('span','N/A',array("class" =>"status_btn", "style" =>"padding:5px")));

        $mform->addElement('html',html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));


        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));



        $mform->addElement('html', html_writer:: div('','col-md-5 col-lg-9 form-group-ele'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-7 col-lg-3 form-group-ele','style'=>'text-align:center;')));
      //  $mform->addElement('html', html_writer:: tag('button','Back',array('type'=>'button','id'=>'bmanagecertificates','class'=>'btn btn-primary','style' =>'background-color: #fcc42c; border-color: #fcc42c !important; font-weight: bold; margin-right:5px')));
        $mform->addElement('html', html_writer:: tag('button','<i class="fa fa-search" ></i> Search',array('type'=>'button','id'=>'managecertificates','class'=>'btn btn-primary','style' =>'margin-right:5px; background-color:#702246')));
        $mform->addElement('html', html_writer::tag('a', '<i class="fa fa-undo" ></i> Reload', array('href'=>$CFG->wwwroot.'/local/training_matrix/managecertificates.php?m=6_2','class'=>'btn btn-secondary')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        $mform->addElement('html', html_writer:: end_tag('fieldset'));


    }

}
