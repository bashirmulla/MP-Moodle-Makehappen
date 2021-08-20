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


class manager_assign_form extends moodleform {

    public function definition() {
        global $USER,$CFG;

        $mform    = $this->_form;

        $mform->_formname = "manager_assign_form";

        $mform->addElement('html', html_writer:: start_tag('fieldset',array('class'=>'scheduler-border')));
        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));


        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Excluded managers',array('for'=>'user','class'=>'col-md-12 bold')));
        $mform->addElement('html', html_writer::select(get_user_list_not_in_manager_list(), 'managers[]', '', array(),array('class'=>'form-control','multiple' => 'multiple',"style" => "height:450px;width:300px;")));
        $mform->addElement('html', html_writer:: end_tag('div'));


        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-2 form-group-ele',"style" =>"margin-top:180px; text-align:center")));

        $mform->addElement('html', html_writer:: start_tag('div',array("id" =>"addrole")));
        $mform->addElement('html', html_writer:: tag('button','◄ Add',array('type'=>'submit','name'=>'add','value'=>'add' , 'class'=>'btn btn-dark','style' =>'margin-right:5px; background-color: #2441e7 !important; border-color: #2441e7 !important;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: start_tag('div',array("id" =>"removerolde","style" =>"margin-top:50px")));
        $mform->addElement('html', html_writer:: tag('button','Remove ►',array('type'=>'submit','name'=>'remove','value'=>'remove' ,'class'=>'btn btn-danger','style' =>'margin-right:5px; background-color: RED !important; border-color: RED !important;')));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: end_tag('div'));


        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-group col-md-3 form-group-ele')));
        $mform->addElement('html', html_writer:: tag('label','Included managers',array('for'=>'user','class'=>'col-md-12 bold')));
        $mform->addElement('html', html_writer::select(get_hs_manager_list(), 'users[]', '', array(),array('class'=>'form-control','multiple' => 'multiple',"style" => "height:450px;width:300px")));
        $mform->addElement('html', html_writer:: end_tag('div'));


        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        $mform->addElement('html', html_writer:: end_tag('fieldset'));


    }

}
