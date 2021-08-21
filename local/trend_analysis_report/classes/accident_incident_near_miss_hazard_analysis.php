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
$pluginname = 'trend_analysis_report';
require_once($CFG->libdir.'/formslib.php');

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/css/custom.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/accident_incident_near_miss_hazard_analysis.js'));


class accident_incident_near_miss_hazard_analysis extends moodleform {

    public function definition() {
        global $USER,$CFG;

        $mform    = $this->_form;

        $mform->_maxFileSize = 90000000;

        $mform->_formname = "accident_report_list";

//        $dropdown = get_dropdown_data(2);
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

        $defaulttime = strtotime(date('Y-m-01 00:00:00'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-8 col-lg-6 form-group-ele')));
        $mform->addElement('date_selector', 'date_from', 'Date from', 'maxlength="100" size="40" ');
        $mform->setType('date_from', PARAM_TEXT);
        $mform->setDefault('date_from',  $defaulttime);
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-8 col-lg-6 form-group-ele')));
        $mform->addElement('date_selector', 'date_to', 'Date to', 'maxlength="100" size="40" ');
        $mform->setType('date_to', PARAM_TEXT);
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'btn-group btn-group-toggle','data-toggle'=>'buttons','style'=>'display: inline-block;')));

        $mform->addElement('html', html_writer:: start_tag('label',array('class'=>'btn btn-secondary')));
        $mform->addElement('html', html_writer:: tag('input','Last month',array('type'=>'radio','name'=>'date_btn','id'=>'option1','value'=>'last_month','autocomplete'=>'off')));
        $mform->addElement('html', html_writer:: end_tag('label'));
        $mform->addElement('html', html_writer:: start_tag('label',array('class'=>'btn btn-secondary')));
        $mform->addElement('html', html_writer:: tag('input','This Month',array('type'=>'radio','name'=>'date_btn','id'=>'option1','value'=>'this_month','autocomplete'=>'off')));
        $mform->addElement('html', html_writer:: end_tag('label'));
        $mform->addElement('html', html_writer:: start_tag('label',array('class'=>'btn btn-secondary')));
        $mform->addElement('html', html_writer:: tag('input','This Year',array('type'=>'radio','name'=>'date_btn','id'=>'option1','value'=>'this_year','autocomplete'=>'off')));
        $mform->addElement('html', html_writer:: end_tag('label'));

        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));

        $mform->addElement('html', html_writer:: div('','col-md-5 col-lg-8 form-group-ele'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-groupcol-md-7 col-lg-4 form-group-ele','style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: tag('button','Search',array('type'=>'button','id'=>'accident_incident_near_miss_hazard_analysis','class'=>'btn btn-primary','style' =>'margin-right:5px')));
        $mform->addElement('html', html_writer::tag('a', 'Reload', array('href'=>$CFG->wwwroot.'/local/trend_analysis_report/accident_incident_near_miss_hazard_analysis.php','class'=>'btn btn-secondary')));
        $mform->addElement('html', html_writer:: end_tag('div'));
//
        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row
//
        $mform->addElement('html', html_writer:: end_tag('fieldset'));
    }

}
