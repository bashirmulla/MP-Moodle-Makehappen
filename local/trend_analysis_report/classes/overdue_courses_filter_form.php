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
//$pluginname = 'mp_report';
require_once($CFG->libdir.'/formslib.php');

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/mp_report/js/datatables/datatables.min.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/mp_report/js/datatables/datatables-1.10.18/js/jquery.dataTables.min.js'),true);

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/trend_analysis_report/css/custom.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/trend_analysis_report/js/overdue_courses.js'));


class overdue_courses_filter_form extends moodleform {

    public function definition() {
        global $USER,$CFG;

        $mform    = $this->_form;

        $mform->_maxFileSize = 90000000;

        $mform->_formname = "overdue_courses_filter_form";

        $mform->addElement('html', html_writer:: start_tag('fieldset',array('class'=>'scheduler-border')));
        $mform->addElement('html', html_writer:: tag('legend','Filters',array('class'=>'scheduler-border')));

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group row  fitem col-md-12',"style" =>"margin:0px !important")));
        $mform->addElement('html', html_writer:: tag('label','Enable:',array('for'=>'enabled','class'=>'col-md-0',"style" =>"margin:0px !important;padding:0px 5px 3px 0px !important")));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'checkbox','name'=>'enabled','class'=>'col-md-1 form-inline felement', "checked"=>"checked" ,'style'=>"flex:none !important; margin-top:5px; height:15px;width:15px",'id'=>"enable_date")));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-8 col-lg-6 form-group-ele')));
        $mform->addElement('date_selector', 'date_from', 'Due date from', 'maxlength="100" size="40" ');
        $mform->setType('date_from', PARAM_TEXT);
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-8 col-lg-6 form-group-ele')));
        $mform->addElement('date_selector', 'date_to', 'Due date to', 'maxlength="100" size="40" ');
        $mform->setType('date_to', PARAM_TEXT);
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-5 col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Course name',array('for'=>'course_name','class'=>'col-md-12')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'course_name','class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Course type',array('for'=>'course_type','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select(createDropdown(get_courses_type()), 'course_type', '', array(),array('class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Client',array('for'=>'client','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select(createDropdown(get_course_client_list()), 'client', '', array(),array('class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','User Status',array('for'=>'user_status','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select(createDropdown(user_status1()), 'user_status', '1', array(),array('class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));


        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row
        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));

        $mform->addElement('html', html_writer:: div('','col-md-5 col-lg-9 form-group-ele'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-7 col-lg-3 form-group-ele','style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: tag('button','Search',array('type'=>'button','id'=>'overdue_courses','class'=>'btn btn-primary','style' =>'margin-right:5px')));
        $mform->addElement('html', html_writer::tag('a', 'Reload', array('href'=>$CFG->wwwroot.'/local/trend_analysis_report/overdue_courses.php?m=1_3','class'=>'btn btn-secondary')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        $mform->addElement('html', html_writer:: end_tag('fieldset'));


    }

}