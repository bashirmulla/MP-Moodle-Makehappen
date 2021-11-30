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
$pluginname = 'trend_analysis_report';
require_once($CFG->libdir.'/formslib.php');

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/css/custom.css'));


class email_notification_on_high_h_s_report extends moodleform {



    public function definition() {
        global $DB,$USER;

        $mform    = $this->_form;

        $mform->_maxFileSize = 90000000;

        $mform->_formname = "email_notification_on_high_h_s_report";

        $record = "";
        $data = $DB->count_records('email_notification_on_high_h_s_report_volumes');
        if($data){
            $record=$DB->get_record_sql("select * from mdl_email_notification_on_high_h_s_report_volumes");
        }

        $html ='<div class="row" >
                <div class="col-sm-6"> </div>
                <div class="col-sm-6" style="text-align: right !important;">     
                     <a class="btn btn-dark" onclick="history.back()" style="background-color: #fcc42c; border-color: #fcc42c !important; font-weight: bold"><i class="fa fa-step-backward"> </i> Back </a>
                </div>
             </div>';

        $mform->addElement('html',$html);

        $mform->addElement('html', html_writer:: start_tag('fieldset',array('class'=>'scheduler-border')));
        $mform->addElement('html', html_writer:: tag('legend',' H&S Monthly Thresholds',array('class'=>'scheduler-border')));

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));

        $mform->addElement('html', html_writer:: tag('label','Accidents',array('class'=>'col-md-4 col-form-label font-weight-bold')));
        $mform->addElement('html', html_writer:: tag('label','Enabled',array('class'=>'col-md-2 col-form-label')));
        $mform->addElement('html', html_writer:: tag('label','Threshold',array('class'=>'col-md-4 col-form-label form-group-ele')));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row
        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Act of Physical Violence',array('class'=>'col-md-4 col-form-label')));

        $input_act_of_physical_violence_status_attr = array('type'=>'checkbox','name'=>'act_of_physical_violence_status','value'=>1,'class'=>'position-static');
        if ($record->act_of_physical_violence_status==1){
            $input_act_of_physical_violence_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_act_of_physical_violence_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'act_of_physical_violence','class'=>'form-control','value'=>$record->act_of_physical_violence,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Cuts and Lacerations',array('class'=>'col-md-4 col-form-label')));
        $input_cuts_and_lacerations_status_attr = array('type'=>'checkbox','name'=>'cuts_and_lacerations_status','value'=>1,'class'=>'position-static');
        if ($record->cuts_and_lacerations_status==1){
            $input_cuts_and_lacerations_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_cuts_and_lacerations_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'cuts_and_lacerations','class'=>'form-control','value'=>$record->cuts_and_lacerations,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Falls from a Height',array('class'=>'col-md-4 col-form-label')));
        $input_falls_from_height_status_attr = array('type'=>'checkbox','name'=>'falls_from_height_status','value'=>1, 'class'=>'position-static');
        if ($record->falls_from_height_status==1){
            $input_falls_from_height_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_falls_from_height_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'falls_from_height','class'=>'form-control','value'=>$record->falls_from_height,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Manual Handling',array('class'=>'col-md-4 col-form-label')));
        $input_manual_handling_status_attr = array('type'=>'checkbox','name'=>'manual_handling_status','value'=>1, 'class'=>'position-static');
        if ($record->manual_handling_status==1){
            $input_manual_handling_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_manual_handling_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'manual_handling','class'=>'form-control','value'=>$record->manual_handling,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Needlestick Injuries',array('class'=>'col-md-4 col-form-label')));
        $input_needlestick_injuries_status_attr = array('type'=>'checkbox','name'=>'needlestick_injuries_status','value'=>1, 'class'=>'position-static');
        if ($record->needlestick_injuries_status==1){
            $input_needlestick_injuries_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_needlestick_injuries_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'needlestick_injuries','class'=>'form-control','value'=>$record->needlestick_injuries,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Slips, Trips and Falls on same level',array('class'=>'col-md-4 col-form-label')));
        $input_slips_trips_and_falls_on_same_level_status_attr = array('type'=>'checkbox','name'=>'slips_trips_and_falls_on_same_level_status','value'=>1, 'class'=>'position-static');
        if ($record->slips_trips_and_falls_on_same_level_status==1){
            $input_slips_trips_and_falls_on_same_level_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_slips_trips_and_falls_on_same_level_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'slips_trips_and_falls_on_same_level','class'=>'form-control','value'=>$record->slips_trips_and_falls_on_same_level,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Struck by an object',array('class'=>'col-md-4 col-form-label')));
        $input_struck_by_an_object_status_attr = array('type'=>'checkbox','name'=>'struck_by_an_object_status','value'=>1, 'class'=>'position-static');
        if ($record->struck_by_an_object_status==1){
            $input_struck_by_an_object_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_struck_by_an_object_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'struck_by_an_object','class'=>'form-control','value'=>$record->struck_by_an_object,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));

        $mform->addElement('html', html_writer:: tag('label','Hazards/Near Misses',array('class'=>'col-md-4 col-form-label font-weight-bold')));
        $mform->addElement('html', html_writer:: tag('label','',array('class'=>'col-md-2 col-form-label')));
        $mform->addElement('html', html_writer:: tag('label','',array('class'=>'col-md-4 col-form-label form-group-ele')));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Animals',array('class'=>'col-md-4 col-form-label')));
        $input_animals_status_attr = array('type'=>'checkbox','name'=>'animals_status','value'=>1, 'class'=>'position-static');
        if ($record->animals_status==1){
            $input_animals_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_animals_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'animals','class'=>'form-control','value'=>$record->animals,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Equipment Issues',array('class'=>'col-md-4 col-form-label')));
        $input_equipment_issues_status_attr = array('type'=>'checkbox','name'=>'equipment_issues_status','value'=>1, 'class'=>'position-static');
        if ($record->equipment_issues_status==1){
            $input_equipment_issues_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_equipment_issues_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'equipment_issues','class'=>'form-control','value'=>$record->equipment_issues,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Gas Detection',array('class'=>'col-md-4 col-form-label')));
        $input_gas_detection_status_attr = array('type'=>'checkbox','name'=>'gas_detection_status','value'=>1, 'class'=>'position-static');
        if ($record->gas_detection_status==1){
            $input_gas_detection_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_gas_detection_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'gas_detection','class'=>'form-control','value'=>$record->gas_detection,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Needle/Glass',array('class'=>'col-md-4 col-form-label')));
        $input_needle_glass_status_attr = array('type'=>'checkbox','name'=>'needle_glass_status','value'=>1, 'class'=>'position-static');
        if ($record->needle_glass_status==1){
            $input_needle_glass_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_needle_glass_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'needle_glass','class'=>'form-control','value'=>$record->needle_glass,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Slips, Trips and Falls',array('class'=>'col-md-4 col-form-label')));
        $input_slips_trips_and_falls_status_attr = array('type'=>'checkbox','name'=>'slips_trips_and_falls_status','value'=>1, 'class'=>'position-static');
        if ($record->slips_trips_and_falls_status==1){
            $input_slips_trips_and_falls_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_slips_trips_and_falls_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'slips_trips_and_falls','class'=>'form-control','value'=>$record->slips_trips_and_falls,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Traffic/Vehicle',array('class'=>'col-md-4 col-form-label')));
        $input_traffic_vehicle_status_attr = array('type'=>'checkbox','name'=>'traffic_vehicle_status','value'=>1, 'class'=>'position-static');
        if ($record->traffic_vehicle_status==1){
            $input_traffic_vehicle_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_traffic_vehicle_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'traffic_vehicle','class'=>'form-control','value'=>$record->traffic_vehicle,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Vegetation',array('class'=>'col-md-4 col-form-label')));
        $input_vegetation_status_attr = array('type'=>'checkbox','name'=>'vegetation_status','value'=>1, 'class'=>'position-static');
        if ($record->vegetation_status==1){
            $input_vegetation_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_vegetation_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'vegetation','class'=>'form-control','value'=>$record->vegetation,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));

        $mform->addElement('html', html_writer:: tag('label','Incidents',array('class'=>'col-md-4 col-form-label font-weight-bold')));
        $mform->addElement('html', html_writer:: tag('label','',array('class'=>'col-md-2 col-form-label')));
        $mform->addElement('html', html_writer:: tag('label','',array('class'=>'col-md-4 col-form-label form-group-ele')));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Vehicle > Collision',array('class'=>'col-md-4 col-form-label')));
        $input_vehicle_collision_status_attr = array('type'=>'checkbox','name'=>'vehicle_collision_status','value'=>1, 'class'=>'position-static');
        if ($record->vehicle_collision_status==1){
            $input_vehicle_collision_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_vehicle_collision_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'vehicle_collision','class'=>'form-control','value'=>$record->vehicle_collision,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Vehicle > Near Miss',array('class'=>'col-md-4 col-form-label')));
        $input_vehicle_near_miss_status_attr = array('type'=>'checkbox','name'=>'vehicle_near_miss_status','value'=>1, 'class'=>'position-static');
        if ($record->vehicle_near_miss_status==1){
            $input_vehicle_near_miss_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_vehicle_near_miss_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'vehicle_near_miss','class'=>'form-control','value'=>$record->vehicle_near_miss,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Vehicle > Theft',array('class'=>'col-md-4 col-form-label')));
        $input_vehicle_theft_status_attr = array('type'=>'checkbox','name'=>'vehicle_theft_status','value'=>1, 'class'=>'position-static');
        if ($record->vehicle_theft_status==1){
            $input_vehicle_theft_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_vehicle_theft_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'vehicle_theft','class'=>'form-control','value'=>$record->vehicle_theft,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Vehicle > Vandalism',array('class'=>'col-md-4 col-form-label')));
        $input_vehicle_vandalism_status_attr = array('type'=>'checkbox','name'=>'vehicle_vandalism_status','value'=>1, 'class'=>'position-static');
        if ($record->vehicle_vandalism_status==1){
            $input_vehicle_vandalism_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_vehicle_vandalism_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'vehicle_vandalism','class'=>'form-control','value'=>$record->vehicle_vandalism,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Vehicle > General Damage',array('class'=>'col-md-4 col-form-label')));
        $input_vehicle_general_damage_status_attr = array('type'=>'checkbox','name'=>'vehicle_general_damage_status','value'=>1, 'class'=>'position-static');
        if ($record->vehicle_general_damage_status==1){
            $input_vehicle_general_damage_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_vehicle_general_damage_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'vehicle_general_damage','class'=>'form-control','value'=>$record->vehicle_general_damage,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Equipment > Loss',array('class'=>'col-md-4 col-form-label')));
        $input_equipment_loss_status_attr = array('type'=>'checkbox','name'=>'equipment_loss_status','value'=>1, 'class'=>'position-static');
        if ($record->equipment_loss_status==1){
            $input_equipment_loss_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_equipment_loss_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'equipment_loss','class'=>'form-control','value'=>$record->equipment_loss,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Equipment > Theft',array('class'=>'col-md-4 col-form-label')));
        $input_equipment_theft_status_attr = array('type'=>'checkbox','name'=>'equipment_theft_status','value'=>1, 'class'=>'position-static');
        if ($record->equipment_theft_status==1){
            $input_equipment_theft_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_equipment_theft_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'equipment_theft','class'=>'form-control','value'=>$record->equipment_theft,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Equipment > Wear and Tear',array('class'=>'col-md-4 col-form-label')));
        $input_equipment_wear_and_tear_status_attr = array('type'=>'checkbox','name'=>'equipment_wear_and_tear_status','value'=>1, 'class'=>'position-static');
        if ($record->equipment_wear_and_tear_status==1){
            $input_equipment_wear_and_tear_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_equipment_wear_and_tear_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'equipment_wear_and_tear','class'=>'form-control','value'=>$record->equipment_wear_and_tear,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Environmental > Flooding - Internal',array('class'=>'col-md-4 col-form-label')));
        $input_environmental_flooding_internal_status_attr = array('type'=>'checkbox','name'=>'environmental_flooding_internal_status','value'=>1, 'class'=>'position-static');
        if ($record->environmental_flooding_internal_status==1){
            $input_environmental_flooding_internal_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_environmental_flooding_internal_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'environmental_flooding_internal','class'=>'form-control','value'=>$record->environmental_flooding_internal,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Environmental > Flooding - External',array('class'=>'col-md-4 col-form-label')));
        $input_environmental_flooding_external_status_attr = array('type'=>'checkbox','name'=>'environmental_flooding_external_status','value'=>1, 'class'=>'position-static');
        if ($record->environmental_flooding_external_status==1){
            $input_environmental_flooding_external_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_environmental_flooding_external_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'environmental_flooding_external','class'=>'form-control','value'=>$record->environmental_flooding_external,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Environmental > Contamination',array('class'=>'col-md-4 col-form-label')));
        $input_environmental_contamination_status_attr = array('type'=>'checkbox','name'=>'environmental_contamination_status','value'=>1, 'class'=>'position-static');
        if ($record->environmental_contamination_status==1){
            $input_environmental_contamination_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_environmental_contamination_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'environmental_contamination','class'=>'form-control','value'=>$record->environmental_contamination,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Environmental > Fly Tipping',array('class'=>'col-md-4 col-form-label')));
        $input_environmental_fly_tipping_status_attr = array('type'=>'checkbox','name'=>'environmental_fly_tipping_status','value'=>1, 'class'=>'position-static');
        if ($record->environmental_fly_tipping_status==1){
            $input_environmental_fly_tipping_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_environmental_fly_tipping_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'environmental_fly_tipping','class'=>'form-control','value'=>$record->environmental_fly_tipping,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Attack > Abusive/Verbal',array('class'=>'col-md-4 col-form-label')));
        $input_attack_abusive_verbal_status_attr = array('type'=>'checkbox','name'=>'attack_abusive_verbal_status','value'=>1, 'class'=>'position-static');
        if ($record->attack_abusive_verbal_status==1){
            $input_attack_abusive_verbal_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_attack_abusive_verbal_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'attack_abusive_verbal','class'=>'form-control','value'=>$record->attack_abusive_verbal,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row form-group-ele')));

        $mform->addElement('html', html_writer:: tag('label','Attack > Animal Attack',array('class'=>'col-md-4 col-form-label')));
        $input_attack_animal_attack_status_attr = array('type'=>'checkbox','name'=>'attack_animal_attack_status','value'=>1, 'class'=>'position-static');
        if ($record->attack_animal_attack_status==1){
            $input_attack_animal_attack_status_attr['checked'] = 'checked' ;
        }
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-md-2 form-check')));
        $mform->addElement('html', html_writer:: empty_tag('input',$input_attack_animal_attack_status_attr));
        $mform->addElement('html', html_writer:: end_tag('div'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'col-lg-6')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'text','name'=>'attack_animal_attack','class'=>'form-control','value'=>$record->attack_animal_attack,'style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: end_tag('div'));

        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row

        //start row
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-row')));

        $mform->addElement('html', html_writer:: div('','col-md-5 col-lg-8 form-group-ele'));
        $mform->addElement('html', html_writer:: start_tag('div',array('class'=>'form-groupcol-md-7 col-lg-4 form-group-ele','style'=>'text-align:center;')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'hidden','name'=>'id','value'=>!empty($record->id) ? $record->id : '')));
        $mform->addElement('html', html_writer:: empty_tag('input',array('type'=>'hidden','name'=>'user_id','value'=>$USER->id)));
        $mform->addElement('html', html_writer:: tag('button','Save',array('type'=>'submit','class'=>'btn btn-primary','style' =>'margin-right:5px')));
        $mform->addElement('html', html_writer:: end_tag('div'));
//
        $mform->addElement('html', html_writer:: end_tag('div'));
        //end row
//
        $mform->addElement('html', html_writer:: end_tag('fieldset'));
    }

}
