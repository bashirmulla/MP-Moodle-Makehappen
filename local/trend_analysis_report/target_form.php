<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

class target_form extends moodleform {

    /**
     * The standard form definiton.
     * @return void
     */
    public function definition () {
        $mform = $this->_form;

        //$mform->addElement('header', 'generalhdr', get_string('general'));


        $year[''] = "--Select--";
        $cyear = date("Y");
        for($i=$cyear-2;$i<=$cyear+10;$i++){
            $year[$i] = $i;
        }

        $mform->addElement('select', 'year', get_string('year', 'local_trend_analysis_report'), $year);
        $mform->addRule('year', "Select Year", 'required');

        $mform->addElement('filepicker', 'targetfile', get_string('targetfile', 'local_trend_analysis_report'));
        $mform->addRule('targetfile', null, 'required');


        $mform->addElement('html', '<div class="fdescription"><i class="icon fa fa-exclamation-circle text-warning fa-fw " aria-hidden="true" title="Required field" aria-label="Required field"></i> CSV Template: <b><a href="/local/trend_analysis_report/sample/Targets_Template.csv">Targets_Template.csv</a> </b></div>');

        $this->add_action_buttons(false, get_string('save', 'local_trend_analysis_report'));
    }
}
