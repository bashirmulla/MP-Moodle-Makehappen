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
require_once($CFG->libdir.'/coursecatlib.php');

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/mp_report/js/datatables/datatables.min.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/mp_report/js/datatables/datatables-1.10.18/js/jquery.dataTables.min.js'),true);

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/trend_analysis_report/css/custom.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/trend_analysis_report/js/search_courses.js'));


class search_courses_filter_form extends moodleform {

    public function definition() {
        global $USER,$CFG;

        $filterData = get_requests();

        $mform    = $this->_form;

        $mform->_maxFileSize = 90000000;

        $mform->_formname = "search_courses_filter_form";

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
        $mform->addElement('date_selector', 'date_from', 'Due date from', 'maxlength="100" size="40" ');
        $mform->setType('date_from', PARAM_TEXT);
        if (!empty($filterData['date_from'])){
            $mform->setDefault('date_from', $filterData['date_from']);
        }
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-8 col-lg-6 form-group-ele')));
        $mform->addElement('date_selector', 'date_to', 'Due date to', 'maxlength="100" size="40" ');
        $mform->setType('date_to', PARAM_TEXT);
        if (!empty($filterData['date_to'])){
            $mform->setDefault('date_to', $filterData['date_to']);
        }
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-5 col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Course name',array('for'=>'course_name','class'=>'col-md-12')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'course_name','class'=>'form-control')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $selected_category = '';
        if (!empty($filterData['category'])){
            $selected_category = $filterData['category'];
        }
        $displaylist = \coursecat::make_categories_list('moodle/course:create');
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label2','Category/Subcategory',array('for'=>'category','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select($displaylist, 'category_subcategory[]', $selected_category, array(),array('class'=>'form-control','multiple'=>'')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $selected_coursetype = '';
        if (!empty($filterData['coursetype'])){
            $array = explode(',', $filterData['coursetype'] );
            $selected_coursetype = array_combine($array, $array);
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Course type',array('for'=>'course_type','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select(get_courses_type(), 'course_type[]', $selected_coursetype, array(),array('class'=>'form-control','multiple'=>'')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $selected_client = '';
        if (!empty($filterData['client'])){
            $selected_client = $filterData['client'];
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-lg-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Client',array('for'=>'client','class'=>'col-md-12')));
        $mform->addElement('html', html_writer::select(get_course_client_list(), 'client[]', $selected_client, array(),array('class'=>'form-control','multiple'=>'')));
        $mform->addElement('html', html_writer:: end_tag('div'));



        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row
        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));



        $mform->addElement('html', html_writer:: div('','col-md-5 col-lg-9 form-group-ele'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-7 col-lg-3 form-group-ele','style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: tag('button','Search',array('type'=>'button','id'=>'search_courses','class'=>'btn btn-primary','style' =>'margin-right:5px')));
        $mform->addElement('html', html_writer::tag('a', 'Reload', array('href'=>$CFG->wwwroot.'/local/trend_analysis_report/search_courses.php?m=1_1','class'=>'btn btn-secondary')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        $mform->addElement('html', html_writer:: end_tag('fieldset'));


    }

}
