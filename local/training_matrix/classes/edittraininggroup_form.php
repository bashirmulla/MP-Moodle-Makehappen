<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');

class edittraininggroup_form extends moodleform {

    /**
     * The form definition.
     */
    public function definition() {
        global $CFG, $DB;
        $mform = $this->_form;
        $traininggroupid = $this->_customdata['traininggroupid'];

        $parent = $this->_customdata['parent'];

        // Get list of categories to use as parents, with site as the first one.
        $options = array();


        $types = get_datas(array('status' => 1),'certificate_types');

        foreach ($types as $t){

            $options[$t->id] = $t->certificate_name;
        }


        if ($traininggroupid and confirm_sesskey()) {
            // Editing an existing category.
            $traininggroup =  get_data(array("id" =>$traininggroupid),'training_groups');

            $strsubmit = 'update group';
        } else {

            $strsubmit = 'create group';
        }

        $mform->addElement('text', 'training_role_name', 'Training Role Name', array('size' => '30'));
        $mform->addRule('training_role_name', 'Required', 'required', null);
        $mform->setType('training_role_name', PARAM_TEXT);
        $mform->setDefault('training_role_name', $traininggroup->training_role_name);

        $mform->addElement('select', 'required_certificates', 'Required Certificates', $options);
        $mform->getElement('required_certificates')->setMultiple(true);
        $mform->getElement('required_certificates')->setSelected(explode(",",$traininggroup->required_certificates));
        $mform->addRule('required_certificates', 'Required', 'required', null);
//        $mform->addHelpButton('required_certificates', 'required_certificates');

        $mform->addElement('select', 'status', 'Status', array('' =>"SELECT","1" => "Active", "0" =>"Inactive"));
        $mform->getElement('required_certificates')->setSelected(explode(",",$traininggroup->status));
        $mform->addRule('required_certificates', 'Required', 'required', null);
//        $mform->addHelpButton('required_certificates', 'required_certificates');

        $mform->addElement('hidden', 'id', 0);
          $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $traininggroupid);

        $this->add_action_buttons(true, $strsubmit);
    }

    /**
     * Validates the data submit for this form.
     *
     * @param array $data An array of key,value data pairs.
     * @param array $files Any files that may have been submit as well.
     * @return array An array of errors.
     */
    public function validation($data, $files) {
        global $DB;
        $errors = parent::validation($data, $files);
        if (!empty($data['idnumber'])) {
            if ($existing = $DB->get_record('course_categories', array('idnumber' => $data['idnumber']))) {
                if (!$data['id'] || $existing->id != $data['id']) {
                    $errors['idnumber'] = get_string('categoryidnumbertaken', 'error');
                }
            }
        }
        return $errors;
    }
}
