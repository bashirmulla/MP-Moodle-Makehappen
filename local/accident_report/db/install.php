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

function xmldb_local_accident_report_install() {

    /*
    global $DB;
    $dbman = $DB->get_manager();

    $table = new xmldb_table('course');
    $field1 = new xmldb_field('coursetype');
    $field1->set_attributes(XMLDB_TYPE_INTEGER, '10', false, false, false, null, null ,null, null);

    $field2 = new xmldb_field('client');
    $field2->set_attributes(XMLDB_TYPE_CHAR, '255', false, false, false, null, null ,null, null);

    $field3 = new xmldb_field('duedate');
    $field3->set_attributes(XMLDB_TYPE_INTEGER, '10', false, false, false, null, null ,null, null);

    $dbman->add_field($table, $field1, $continue=true, $feedback=true);
    $dbman->add_field($table, $field2, $continue=true, $feedback=true);
    $dbman->add_field($table, $field3, $continue=true, $feedback=true);


    $report_table_data = array(array( "name" => "Accident Analysis"),array("name" => "Incident Analysis"));
    $DB->insert_records("report_table",$report_table_data);


    $mdl_report_table_emaildata = array(
        array('id' => '1','firstname' => 'SAM','lastname' => 'Harun','email' => 'samh@www.makehappengroup.co.uk','contact' => '1'),
        array('id' => '2','firstname' => 'Bash','lastname' => 'M','email' => 'bashirm@www.makehappengroup.co.uk','contact' => '2'),
        array('id' => '3','firstname' => 'UU','lastname' => 'NPA','email' => 'samharun+1@gmail.com','contact' => '23'),
        array('id' => '4','firstname' => 'UU','lastname' => 'Cyclical','email' => 'samharun+2@gmail.com','contact' => '24')
    );
    $DB->insert_records("report_table_emaildata",$mdl_report_table_emaildata);


    $standing_table_data = array(
        array('id' => '1','report_id' => '1','dropdown_name' => 'yes_no','field_value' => 'Yes','field_status' => '1'),
        array('id' => '2','report_id' => '1','dropdown_name' => 'yes_no','field_value' => 'No','field_status' => '1'),
        array('id' => '3','report_id' => '1','dropdown_name' => 'yes_no','field_value' => 'N/A','field_status' => '1'),
        array('id' => '4','report_id' => '1','dropdown_name' => 'mgt_review_status','field_value' => 'Employee','field_status' => '1'),
        array('id' => '5','report_id' => '1','dropdown_name' => 'mgt_review_status','field_value' => 'Contractor','field_status' => '1'),
        array('id' => '6','report_id' => '1','dropdown_name' => 'mgt_review_status','field_value' => 'Sub-Contractor','field_status' => '1'),
        array('id' => '7','report_id' => '1','dropdown_name' => 'mgt_review_status','field_value' => 'Visitor','field_status' => '1'),
        array('id' => '8','report_id' => '1','dropdown_name' => 'mgt_review_status','field_value' => 'Member of the Public','field_status' => '1'),
        array('id' => '9','report_id' => '1','dropdown_name' => 'further_action','field_value' => 'Toolbox Talk','field_status' => '1'),
        array('id' => '10','report_id' => '1','dropdown_name' => 'further_action','field_value' => 'Training - Internal','field_status' => '1'),
        array('id' => '11','report_id' => '1','dropdown_name' => 'further_action','field_value' => 'Training - Formal','field_status' => '1'),
        array('id' => '12','report_id' => '1','dropdown_name' => 'further_action','field_value' => 'Amended Prochedures','field_status' => '1'),
        array('id' => '13','report_id' => '1','dropdown_name' => 'further_action','field_value' => 'Amended Risk Assessments','field_status' => '1'),
        array('id' => '14','report_id' => '1','dropdown_name' => 'further_action','field_value' => 'Amended COSHH Terms','field_status' => '1'),
        array('id' => '15','report_id' => '1','dropdown_name' => 'further_action','field_value' => 'Other','field_status' => '1'),
        array('id' => '16','report_id' => '1','dropdown_name' => 'riddor_classification','field_value' => 'Fatalities','field_status' => '1'),
        array('id' => '17','report_id' => '1','dropdown_name' => 'riddor_classification','field_value' => 'Specific Injuries','field_status' => '1'),
        array('id' => '18','report_id' => '1','dropdown_name' => 'riddor_classification','field_value' => 'Over 7 Day Incapacity','field_status' => '1'),
        array('id' => '19','report_id' => '1','dropdown_name' => 'riddor_classification','field_value' => 'Non Fatal Accidents to non workers','field_status' => '1'),
        array('id' => '20','report_id' => '1','dropdown_name' => 'riddor_classification','field_value' => 'Occupational Disease','field_status' => '1'),
        array('id' => '21','report_id' => '1','dropdown_name' => 'riddor_classification','field_value' => 'Dangerous Occurrence','field_status' => '1'),
        array('id' => '22','report_id' => '1','dropdown_name' => 'riddor_classification','field_value' => 'Gas Incidents','field_status' => '1'),
        array('id' => '23','report_id' => '2','dropdown_name' => 'contract','field_value' => 'UU - NPA','field_status' => '1'),
        array('id' => '24','report_id' => '2','dropdown_name' => 'contract','field_value' => 'UU - Cyclical','field_status' => '1'),
        array('id' => '25','report_id' => '2','dropdown_name' => 'contract','field_value' => 'YWS - CSO','field_status' => '1'),
        array('id' => '26','report_id' => '2','dropdown_name' => 'contract','field_value' => 'YWS - DG5','field_status' => '1'),
        array('id' => '27','report_id' => '2','dropdown_name' => 'contract','field_value' => 'STW - PWP','field_status' => '1'),
        array('id' => '28','report_id' => '2','dropdown_name' => 'contract','field_value' => 'MAG','field_status' => '1'),
        array('id' => '29','report_id' => '2','dropdown_name' => 'report_category','field_value' => 'Near Miss','field_status' => '1'),
        array('id' => '30','report_id' => '2','dropdown_name' => 'report_category','field_value' => 'Hazard identification','field_status' => '1'),
        array('id' => '31','report_id' => '2','dropdown_name' => 'report_category','field_value' => 'Incident','field_status' => '1'),
        array('id' => '32','report_id' => '2','dropdown_name' => 'classification','field_value' => 'Access Restriction','field_status' => '1'),
        array('id' => '33','report_id' => '2','dropdown_name' => 'classification','field_value' => 'Animals','field_status' => '1'),
        array('id' => '34','report_id' => '2','dropdown_name' => 'classification','field_value' => 'Asset Issues','field_status' => '1'),
        array('id' => '35','report_id' => '2','dropdown_name' => 'classification','field_value' => 'Equipment Issues','field_status' => '1'),
        array('id' => '36','report_id' => '2','dropdown_name' => 'classification','field_value' => 'Gas Detection','field_status' => '1'),
        array('id' => '37','report_id' => '2','dropdown_name' => 'classification','field_value' => 'Manhole Covers/Frame Issue','field_status' => '1'),
        array('id' => '38','report_id' => '2','dropdown_name' => 'classification','field_value' => 'Needles/Glass','field_status' => '1'),
        array('id' => '39','report_id' => '2','dropdown_name' => 'classification','field_value' => 'Other','field_status' => '1'),
        array('id' => '40','report_id' => '2','dropdown_name' => 'classification','field_value' => 'Slips, Trips and Falls','field_status' => '1'),
        array('id' => '41','report_id' => '2','dropdown_name' => 'classification','field_value' => 'Traffic/Vehicle','field_status' => '1'),
        array('id' => '42','report_id' => '2','dropdown_name' => 'classification','field_value' => 'Vegetation','field_status' => '1'),
        array('id' => '43','report_id' => '2','dropdown_name' => 'categorisation','field_value' => 'Vehicle','field_status' => '1'),
        array('id' => '44','report_id' => '2','dropdown_name' => 'categorisation','field_value' => 'Equipment','field_status' => '1'),
        array('id' => '45','report_id' => '2','dropdown_name' => 'categorisation','field_value' => 'Environmental','field_status' => '1'),
        array('id' => '46','report_id' => '2','dropdown_name' => 'categorisation','field_value' => 'Attack','field_status' => '1'),
        array('id' => '47','report_id' => '2','dropdown_name' => 'categorisation','field_value' => 'Other','field_status' => '1'),
        array('id' => '48','report_id' => '2','dropdown_name' => 'report_priority','field_value' => 'Immediately','field_status' => '1'),
        array('id' => '49','report_id' => '2','dropdown_name' => 'report_priority','field_value' => 'Monthly Review','field_status' => '1'),
        array('id' => '50','report_id' => '2','dropdown_name' => 'report_priority','field_value' => 'Quarterly','field_status' => '1'),
        array('id' => '51','report_id' => '2','dropdown_name' => 'calm_systems','field_value' => 'AIMS - Additional Results','field_status' => '1'),
        array('id' => '52','report_id' => '2','dropdown_name' => 'calm_systems','field_value' => 'Sewer Viewer UU','field_status' => '1'),
        array('id' => '53','report_id' => '2','dropdown_name' => 'calm_systems','field_value' => 'Sewer Viewer STW','field_status' => '1'),
        array('id' => '54','report_id' => '2','dropdown_name' => 'calm_systems','field_value' => 'MAG','field_status' => '1'),
        array('id' => '55','report_id' => '2','dropdown_name' => 'calm_systems','field_value' => 'YSW','field_status' => '1'),
        array('id' => '56','report_id' => '2','dropdown_name' => 'yes_no','field_value' => 'Yes','field_status' => '1'),
        array('id' => '57','report_id' => '2','dropdown_name' => 'yes_no','field_value' => 'No','field_status' => '1'),
        array('id' => '58','report_id' => '2','dropdown_name' => 'yes_no','field_value' => 'N/A','field_status' => '1'),
        array('id' => '59','report_id' => '2','dropdown_name' => 'vehicle','field_value' => 'Collision','field_status' => '1'),
        array('id' => '60','report_id' => '2','dropdown_name' => 'vehicle','field_value' => 'Near Miss','field_status' => '1'),
        array('id' => '61','report_id' => '2','dropdown_name' => 'vehicle','field_value' => 'Theft','field_status' => '1'),
        array('id' => '62','report_id' => '2','dropdown_name' => 'vehicle','field_value' => 'Vandalism','field_status' => '1'),
        array('id' => '63','report_id' => '2','dropdown_name' => 'vehicle','field_value' => 'General Damage','field_status' => '1'),
        array('id' => '64','report_id' => '2','dropdown_name' => 'equipment','field_value' => 'Loss','field_status' => '1'),
        array('id' => '65','report_id' => '2','dropdown_name' => 'equipment','field_value' => 'Theft','field_status' => '1'),
        array('id' => '66','report_id' => '2','dropdown_name' => 'equipment','field_value' => 'Wear and Tear','field_status' => '1'),
        array('id' => '67','report_id' => '2','dropdown_name' => 'environment','field_value' => 'Adverse Weather','field_status' => '1'),
        array('id' => '68','report_id' => '2','dropdown_name' => 'environment','field_value' => 'Flooding - Internal','field_status' => '1'),
        array('id' => '69','report_id' => '2','dropdown_name' => 'environment','field_value' => 'Flooding - External','field_status' => '1'),
        array('id' => '70','report_id' => '2','dropdown_name' => 'environment','field_value' => 'Contamination  ','field_status' => '1'),
        array('id' => '71','report_id' => '2','dropdown_name' => 'environment','field_value' => 'Fly Tipping','field_status' => '1'),
        array('id' => '72','report_id' => '2','dropdown_name' => 'attack','field_value' => 'Abusive/Verbal','field_status' => '1'),
        array('id' => '73','report_id' => '2','dropdown_name' => 'attack','field_value' => 'Animal Attack','field_status' => '1'),
        array('id' => '74','report_id' => '1','dropdown_name' => 'category','field_value' => 'Act of Physical Violence','field_status' => '1'),
        array('id' => '75','report_id' => '1','dropdown_name' => 'category','field_value' => 'Cuts and Lacerations','field_status' => '1'),
        array('id' => '76','report_id' => '1','dropdown_name' => 'category','field_value' => 'Falls from a Height','field_status' => '1'),
        array('id' => '77','report_id' => '1','dropdown_name' => 'category','field_value' => 'Manual Handling','field_status' => '1'),
        array('id' => '78','report_id' => '1','dropdown_name' => 'category','field_value' => 'Needlestick Injuries','field_status' => '1'),
        array('id' => '79','report_id' => '1','dropdown_name' => 'category','field_value' => 'Slips, Trips and Falls on same level','field_status' => '1'),
        array('id' => '80','report_id' => '1','dropdown_name' => 'category','field_value' => 'Struck by an Object','field_status' => '1'),
        array('id' => '81','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Carpal Tunnel Syndrome','field_status' => '1'),
        array('id' => '82','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Cramp of the hand or forearm','field_status' => '1'),
        array('id' => '83','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Occupational dermatitis','field_status' => '1'),
        array('id' => '84','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Hand Arm Vibration Syndrome','field_status' => '1'),
        array('id' => '85','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Occupational asthma','field_status' => '1'),
        array('id' => '86','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Tendonitis or tenosynovitis','field_status' => '1'),
        array('id' => '87','report_id' => '1','dropdown_name' => 'contract','field_value' => 'UU - NPA','field_status' => '1'),
        array('id' => '88','report_id' => '1','dropdown_name' => 'contract','field_value' => 'UU - Cyclical','field_status' => '1'),
        array('id' => '89','report_id' => '1','dropdown_name' => 'contract','field_value' => 'YWS - CSO','field_status' => '1'),
        array('id' => '90','report_id' => '1','dropdown_name' => 'contract','field_value' => 'YWS - DG5','field_status' => '1'),
        array('id' => '91','report_id' => '1','dropdown_name' => 'contract','field_value' => 'STW - PWP','field_status' => '1'),
        array('id' => '92','report_id' => '1','dropdown_name' => 'contract','field_value' => 'MAG','field_status' => '1'),
        array('id' => '93','report_id' => '2','dropdown_name' => 'categorisation','field_value' => 'Customer Complaint','field_status' => '1'),
        array('id' => '94','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Fractures, other than to fingers, thumbs and toes','field_status' => '1'),
        array('id' => '95','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Amputation of an arm, hand. finger, thumb, leg, foot or toe','field_status' => '1'),
        array('id' => '96','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any injury likely to lead to permanent loss of sight or reduction in sight in one or both eyes','field_status' => '1'),
        array('id' => '97','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any crush injury to the head or torso, causing damage to the brain or internal organs','field_status' => '1'),
        array('id' => '98','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any burn injury (including scalding)','field_status' => '1'),
        array('id' => '99','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any degree of scalping requiring hospital treatment','field_status' => '1'),
        array('id' => '100','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any loss of consciousness caused by head injury or asphyxia','field_status' => '1'),
        array('id' => '101','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any other injury arising from working in an enclosed space','field_status' => '1'),
        array('id' => '102','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any workplace - Lifting Equipment','field_status' => '1'),
        array('id' => '103','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any workplace - Pressure Systems','field_status' => '1'),
        array('id' => '104','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any workplace - Overhead electric lines','field_status' => '1'),
        array('id' => '105','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any workplace - Electrical incidents causing explosion or fire','field_status' => '1'),
        array('id' => '106','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any workplace - Explosives','field_status' => '1'),
        array('id' => '107','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any workplace - Biological agents','field_status' => '1'),
        array('id' => '108','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any workplace - Radiation generation or radiography','field_status' => '1'),
        array('id' => '109','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any workplace - Breathing Apparatus','field_status' => '1'),
        array('id' => '110','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any workplace - Diving Operations','field_status' => '1'),
        array('id' => '111','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any workplace - Collapse of scaffolding','field_status' => '1'),
        array('id' => '112','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any workplace - Train Collisions','field_status' => '1'),
        array('id' => '113','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any workplace - Wells','field_status' => '1'),
        array('id' => '114','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Any workplace - Pipelines or pipeline works','field_status' => '1'),
        array('id' => '115','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Other locations - Structural Collapse','field_status' => '1'),
        array('id' => '116','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Other locations - Explosion or fire','field_status' => '1'),
        array('id' => '117','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Other locations - Release of flammable liquids or gases','field_status' => '1'),
        array('id' => '118','report_id' => '1','dropdown_name' => 'RIDDOR_subcategory','field_value' => 'Other locations - Hazardous escapes of substances','field_status' => '1')
    );

    $DB->insert_records("standing_table",$standing_table_data);
*/
    return true;
}