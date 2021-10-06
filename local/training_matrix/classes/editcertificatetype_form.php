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

class editcertificatetype_form extends moodleform {

    /**
     * The form definition.
     */
    public function definition() {
        global $CFG, $DB;
        $mform = $this->_form;
        $certificatetypeid = $this->_customdata['certificatetypeid'];
        $parent = $this->_customdata['parent'];

        // Get list of categories to use as parents, with site as the first one.
        $options = array();
        if ($certificatetypeid and confirm_sesskey()) {
            // Editing an existing category.
            $certificatetype = get_data(array("id"=>$certificatetypeid),'certificate_types');
//            echo "<pre>";
//            print_r($certificatetype);
//            die('dd');
            $sortorder = $certificatetype->sortorder;
            $strsubmit = 'update Type';
        } else {
            // Making a new category.
            $strsubmit = 'create Type';
            $sortorder = 0;
        }

        $mform->addElement('text', 'certificate_name', 'Certificate Name', array('size' => '30'));
        $mform->addRule('certificate_name', 'Required', 'required', null);
        $mform->setType('certificate_name', PARAM_TEXT);
        $mform->setDefault('certificate_name', $certificatetype->certificate_name);

        $radioarray   = array();
        $radioarray[] = $mform->createElement('radio', 'certificate_expire', '', 'Yes', 'Yes');
        $radioarray[] = $mform->createElement('radio', 'certificate_expire', '', 'No', 'No');
        $mform->addGroup($radioarray, 'certificate_expire', 'Does the certificate expire?', array(''), false);
        $mform->addRule('certificate_expire', 'Required', 'required',null);
        $mform->setDefault('certificate_expire', $certificatetype->certificate_expire);

        $mform->addElement('text', 'number_of_months', 'Number of months before expiry that refresher training should be undertaken?', array('size' => '30','maxlength'=>'100','id'=>''));
//        $mform->addRule('number_of_months', '', 'required', 'client');
//        $mform->addHelpButton('number_of_months', get_string('number_of_months', 'local_training_matrix'), 'local_training_matrix');
//        $mform->addHelpButton('number_of_months', 'number_of_month','local_training_matrix');
        $mform->disabledIf('number_of_months', 'certificate_expire', 'eq', 'No');
//        $mform->disabledIf('number_of_months', 'certificate_expire', 'eq', '');
        $mform->setType('number_of_months', PARAM_INT);
        $mform->setDefault('number_of_months', $certificatetype->number_of_months);


        $mform->addElement('select', 'status', 'Status', array('' =>"SELECT","1" => "Active", "0" =>"Inactive"));
        $mform->getElement('status')->setSelected(explode(",",$certificatetype->status));
        $mform->addRule('status', 'Required', 'required', null);
//        $mform->addHelpButton('required_certificates', 'required_certificates');


        $mform->addElement('hidden', 'id', 0);
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $certificatetypeid);
        $mform->addElement('hidden', 'sortorder', 0);
        $mform->setType('sortorder', PARAM_INT);
        $mform->setDefault('sortorder', $sortorder);

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
