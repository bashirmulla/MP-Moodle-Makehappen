<?php
// This file is part of the eMailTest plugin for Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Sample plugin
 *
 * @package    local_accident_report
 * @copyright  2018 www.makehappengroup.co.uk
 * @author     MP
 */

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'local_accident_report';  // To check on upgrade, that module sits in correct place
$plugin->version   = 2020101001;        // The current module version (Date: YYYYMMDDXX)
$plugin->requires  = 2013040500;        // Requires Moodle version 2.5.
$plugin->release   = '1.0.0 (2020100100)';
$plugin->maturity  = MATURITY_STABLE;
$plugin->cron      = 1;
