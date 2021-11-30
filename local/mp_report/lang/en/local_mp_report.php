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

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'H&S Report';
$string['heading']    = 'H&S Report';
$string['welcome']    = 'Report page';
$string['success']    = 'Success Page';
$string['max_length'] = 'Maximum 2000 characters';
$string['max500_length'] = 'Maximum 500 characters';
$string['max_length_help'] = 'Maximum 2000 characters';
$string['max500_length_help'] = 'Maximum 500 characters';
$string['hs_reporting'] = 'H&S Reporting';

// Accident Report Form
$string['accident']    = 'Accident Report';
$string['incident']    = 'Incident, Near Miss or Hazard Report';
$string['success']     = 'Success Page';

$string['name']          = 'Name';
$string['address']       = 'Address';
$string['postcode']      = 'Postcode';
$string['occupation']    = 'Occupation';
$string['user_contract'] = 'Contract';
$string['user_manager']  = 'Manager';
$string['user_date']     = 'Date';

$string['victim_name']            = 'Name';
$string['victim_address']         = 'Address';
$string['victim_postcode']        = 'Postcode';
$string['victim_occupation']      = 'Occupation';

$string['accident_report_number'] = 'Report Number';
$string['accident_date']          = 'Date and Time of accident';
$string['accident_category']      = 'Category';
$string['accident_place']         = 'Where did it happen';
$string['accident_reason']        = 'How did it happen and why';
$string['accident_detail']        = 'Details of any injury suffered or treatment given';
$string['accident_witnesses']     = 'Witnesses?';
$string['accident_treatment']     = 'Medical Treatment over first aid?';
$string['minor_injuries']         = 'Minor Injuries?';
$string['accident_additional_details']  = 'Are additional details required to describe the accident?';
$string['additional_details']           = 'Additional details';
$string['root_cause']                   = 'What is the root cause?';
$string['immediate_action']             = 'What immediate action has been taken?';
$string['further_action_required']      = 'What further action is required to prevent recurrence?';
$string['lost_time']                    = 'Is there lost time?';
$string['lost_time_days']               = 'Lost time (days)';

$string['witnesses_name']               = 'Name of Witness';
$string['witnesses_address']            = 'Home/Work Address';
$string['witnesses_phone_number']       = 'Telephone Number';
$string['witnesses_report_date']        = 'Date of witness report';
$string['witnesses_report_details']     = '"Detail & Describe the occurrence and how it happened. Be specific, who? What? Why?, Where?, when?, how?.
What Injuries to persons or damage to property occurred?';
$string['witnesses_report_diagram']     = 'Diagrams/Sketches';

$string['mgt_review_report_date']       = 'Date of Report';
$string['mgt_review_status']            = 'Injured Party';
$string['mgt_review_comments']          = 'Comments';

$string['s_mgt_rpt_name']               = 'Name of Manager Reviewing';
$string['s_mgt_rpt_report_date']        = 'Date of Report';
$string['s_mgt_rpt_comments']           = 'Comments';
$string['s_mgt_rpt_f_action']           = 'Further Action';
$string['s_mgt_rpt_f_a_comment']        = 'Further action comments';
$string['s_mgt_rpt_a_b_completed']      = 'Accident Book Completed';
$string['s_mgt_rpt_a_b_cpt_date']       = 'Completed Date';
$string['s_mgt_rpt_2508_completed']     = 'Form 2508/2508A Completed (where applicable)';
$string['s_mgt_rpt_2508_cpt_date']      = 'Form 2508/2508A Completed Date';
$string['s_mgt_rpt_riddor_event_clf']   = 'RIDDOR Event Classification';
$string['s_mgt_rpt_riddor_subcategory']   = 'RIDDOR subcategory';
$string['s_mgt_rpt_riddor_files']       = '<i class="fa fa-upload"></i>  RIDDOR files';
$string['confirmdeletedata']            = 'Are you sure, want to delete this  RIDDOR files?';
$string['s_mgt_rpt_reported_en_a']      = 'Reported to Enforcing Authority (where applicable)';
$string['s_mgt_rpt_reported_en_a_date'] = 'Reported to Enforcing Date';

$string['s_mgt_rpt_sr_mgr_notified']       = 'Senior Manager Notified (where applicable)';
$string['s_mgt_rpt_sr_mgr_notified_date']  = 'Senior Manager Notified Date';
$string['s_mgt_rpt_in_br_informed']        = 'Insurance Broker Informed (where applicable)';
$string['s_mgt_rpt_in_br_informed_date']   = 'Insurance Broker Informed Date';
$string['s_mgt_rpt_ant_closed_off']        = 'Accident Closed off?';
$string['s_mgt_rpt_ant_closed_off_date']   = 'Accident Closed off Date';

$string['manager_name']                    = 'Manager Name';




// Incident Report Form
$string['i_report_number'] = 'Report Number';
$string['i_name']          = 'Name';
$string['i_date']          = 'Date of Incident';
$string['i_contact']       = 'Contract';
$string['i_manager']       = 'Manager';
$string['i_time']          = 'Time';
$string['day_night']       = 'Day/Night';
$string['location']        = 'Location';
$string['lone_worker']     = 'Lone Worker?';
$string['what_observe']    = 'What did you observe?';
$string['photo_1']         = 'Photo 1';
$string['photo_2']         = 'Photo 2';
$string['photo_3']         = 'Photo 3';
$string['photo_4']         = 'Photo 4';
$string['photo_5']         = 'Photo 5';
$string['photo_6']         = 'Photo 6';
$string['action_taken']          = 'What, if any, actions were taken?';
$string['what_could_happened']   = 'What could have happened?';
$string['report_category']       = 'Report Category';
$string['classification']        = 'Classification';
$string['categorisation']        = 'Categorisation';
$string['vehicles']              = 'Vehicles';
$string['equipment']             = 'Equipment';
$string['environmental']         = 'Environmental';
$string['attack']                = 'Attack';
$string['further_action']        = 'Further Action';
$string['report_to_client']      = 'Report to Client?';
$string['report_priority']       = 'Report Priority';
$string['emailed_to']            = 'Emailed to';
$string['contact_details']       = 'Contact Details';
$string['meeting_date']          = 'Meeting Date';
$string['added_to_rvt_calm_system'] = 'Added to Relevant Makehappen System';

$string['reviewer']                = 'Reviewer';
$string['change_required']         = 'Changes required?';
$string['details_change_required'] = 'Details of changes required?';
$string['is_correct_report_category'] = 'Is Report Category correct?';
$string['correct_report_category']    = 'Correct Report Category';
$string['report_closed']              = 'Report closed?';



$string['accident_table']   = 'accident_report';
$string['incident_table']   = 'incident_report';
$string['savebutton']   = 'Save';
$string['submitbtn']    = 'Submit';
$string['backbutton']   = 'Back';
$string['required']     = 'This field is required';
$string['email_send']   = 'MP Training Notification Task';
$string['assign_api']   = 'MP H&S Assign to Mobile App Api'; /* BM added */
$string['physical_toolbox_talk_notification'] = 'Physical Toolbox Talk Notification';
$string['physical_toolbox_talk_regular_notification'] = 'Physical Toolbox Talk Regular Notification';
$string['high_h_and_s_notification']  = 'Email notification on high H&S report volumes';





$string['injured_surname']          = 'Surname';
$string['injured_forename']         = 'Forename';
$string['home_address']             = 'Home Addres';
$string['telephone']                = 'Telephone';
$string['operative_now_at']         = 'Operative Now At';
$string['time_lost_hours']          = 'Hours';
$string['time_lost_minutes']        = 'Minutes';
$string['time_lost_none']           = 'None';
$string['temporary_address']        = 'Temporary Address';
$string['employment_status']        = 'Employment Status';
$string['occupation']               = 'Occupation';
$string['nature_of_injury']         = 'Nature of Injury';
$string['part_of_body_affected']    = 'Body Affected';
$string['occurrence_date']          = 'Occurence Date';
$string['name_address_of_site']     = 'Name address of site';
$string['exect_location_on_site']   = 'Exect location on site';
$string['work_type_of_occurrence']  = 'Type of Work at Occurrence';
$string['reported_datetime']        = 'Reported Date';
$string['injured_person_believe']   = 'Person believe';
$string['witness_name_address']     = 'Witness name & address';



$string['action_taken_to_prevent']     = 'Action Taken to Prevent';
