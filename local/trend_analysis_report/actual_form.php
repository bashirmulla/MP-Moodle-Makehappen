<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

class actual_form extends moodleform {

    /**
     * The standard form definiton.
     * @return void
     */
    public function definition () {
        $mform = $this->_form;


        $year[''] = "--Select--";
        $month[''] = "--Select--";
        $cyear = date("Y");
        for($i=$cyear-2;$i<=$cyear+10;$i++){
            $year[$i] = $i;
        }

        for($i=1;$i<=12;$i++){
            $month[$i] = date('F', mktime(0, 0, 0, $i, 1));
        }

        $mform->addElement('select', 'year', get_string('year', 'local_trend_analysis_report'), $year);
        $mform->addRule('year', "Select Year", 'required');
        $mform->addElement('select', 'month', get_string('month', 'local_trend_analysis_report'), $month);
        $mform->addRule('month', "Select Month", 'required');

        $mform->addElement('filepicker', 'targetfile', get_string('targetfile', 'local_trend_analysis_report'));
        $mform->addRule('targetfile', null, 'required');

        $mform->addElement('html', '<div class="fdescription"><i class="icon fa fa-exclamation-circle text-warning fa-fw " aria-hidden="true" title="Required field" aria-label="Required field"></i> CSV Template: <b><a href="/local/trend_analysis_report/sample/Actuals_Template.csv">Actuals_Template.csv</a> </b></div>');

        $this->add_action_buttons(false, get_string('save', 'local_trend_analysis_report'));
    }
}
