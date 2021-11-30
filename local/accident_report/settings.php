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
 * @package    local_accident_report
 * @copyright  2018 www.makehappengroup.co.uk
 * @author     MP
 */

defined('MOODLE_INTERNAL') || die;

/*
if (has_capability('local/accident_report:view', context_system::instance())) {

    $ADMIN->add('root', new admin_category('local_accident_report', new lang_string('pluginname', 'local_accident_report')));

    $ADMIN->add(
        'accident_report',
        new admin_externalpage(
            'accident_report_index',
            new lang_string('pluginname', 'local_accident_report'),
            new moodle_url('/local/accident_report/index.php'),
            'local/accident_report:view'
        )
    );

    $ADMIN->add(
        'accident_report',
        new admin_externalpage(
            'accident_report_admin',
            new lang_string('settings', 'local_accident_report'),
            new moodle_url('/local/accident_report/settings.php'),
            'local/accident_report:view'
        )
    );

}

*/

//die(has_capability('local/accident_report:add', $PAGE->context,NULL, false));
if ($hassiteconfig OR has_capability('local/accident_report:view', $PAGE->context,$USER->id, false)) {

    $section = 'reports';

    $ADMIN->add($section, new admin_externalpage('local_accident_report',
            get_string('pluginname', 'local_accident_report'),
            new moodle_url('/local/accident_report/')
    ));
}
