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
 * @package    local_training_matrix
 * @copyright  2018 makehappen.com
 * @author     Bash & SAM Harun
 */

defined('MOODLE_INTERNAL') || die;
$pluginname = 'training_matrix';
require_once($CFG->libdir.'/formslib.php');
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/custom.js'));

class training_matrix_list extends moodleform {


    public function definition() {
        global $USER, $CFG,$DB;

        $table  = "test_user_table";
        $html   = "";
        $mform  = $this->_form;

        $mform->addElement('html',get_string('welcome', 'local_training_matrix'));

        $buttonarray = array();
        $buttonarray[] = $mform->createElement('button', 'add', get_string('buttonadd', 'local_training_matrix'),array("id"=>"add"));
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



        $mform->addElement('html', $html, 'local_training_matrix');


    }

    public function reset() {
        $this->_form->updateSubmission(null, null);
    }


}


class home_page extends moodleform {


    public function definition() {

        $mform = $this->_form;

        //if(!is_manager() && !is_admin()) {
            $buttonarray = array();
            $buttonarray[] = $mform->createElement('button', 'save', "+ ".get_string('accident', 'local_training_matrix'), array("id" => "accident_link"));
            $buttonarray[] = $mform->createElement('button', 'save', "+ ".get_string('incident', 'local_training_matrix'), array("id" => "incident_link"));


            $mform->addGroup($buttonarray, 'linkar', '', array(' '), false);
            $mform->closeHeaderBefore('linkar');
        //}

        if(is_manager() || is_admin()) {
            $this->accident_report_list();
            $this->incident_report_list();
        }


    }

    public function accident_report_list() {
        global $USER, $CFG,$DB;

        $tableName  = get_string('accident_table','local_training_matrix');
        $html   = "";
        $mform  = $this->_form;

        $mform->addElement('html','<h6>'.get_string('accident', 'local_training_matrix')."s</h6><hr>");

        if(is_manager() || is_admin()) $submitter_to_manager = 'Yes';
        else                           $submitter_to_manager = 'No';

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



        $mform->addElement('html', $html, 'local_training_matrix');


    }

    public function incident_report_list() {
        global $USER, $CFG,$DB;

        $tableName  = get_string('incident_table','local_training_matrix');
        $html   = "";
        $mform  = $this->_form;
        $dropdown = get_dropdown_data(2,'report_category');

        $mform->addElement('html','<h6>'.get_string('incident', 'local_training_matrix')."s</h6><hr>");

        if(is_manager() || is_admin()) $submitter_to_manager = 'Yes';
        else                           $submitter_to_manager = 'No';

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



        $mform->addElement('html', $html, 'local_training_matrix');


    }

}
