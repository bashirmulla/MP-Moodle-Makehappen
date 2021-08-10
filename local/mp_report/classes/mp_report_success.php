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
require_once($CFG->libdir.'/formslib.php');

class mp_report_success extends moodleform {


    public function definition() {
        global $USER, $CFG;
        $mform = $this->_form;

        //$mform->addElement('html', '<p>'.get_string('success', 'local_mp_report').'</p>');

        $buttonarray = array();
        $buttonarray[] = $mform->createElement('submit', 'back', get_string('backbutton', 'local_mp_report'));

        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
        $mform->closeHeaderBefore('buttonar');


    }

}
