<?php
// NOTE :::: This CRON must be executed every day only once

namespace local_accident_report\task;

use core_completion\progress;

class physical_toolbox_talk_notification extends \core\task\scheduled_task {
    public function get_name() {
        // Shown on admin screens
        return get_string('physical_toolbox_talk_notification', 'local_accident_report'); //get the string from lang/en/
    }

    public function execute() {
        global $CFG,$USER;
        require_once($CFG->dirroot . '/local/accident_report/locallib.php');
        $dayvalue  = 86400;  // 86,400‬  =  1 day
        $weekvalue = 604800;  //604,800    = 7 days

        $courses =  get_courses();

        foreach($courses as $course){

            $managerArr =  array();
            $timediff   = 0;
            //  3  = Physical Toolbox Talk

            if(empty($course->duedate)) continue;

            $timediff = ($course->duedate) - time();

                if(abs($timediff) <= $dayvalue and $course->coursetype == 3 and $timediff<0) {
                    $users = enrol_get_course_users($course->id, true);

                    foreach ($users as $user) {

                        $percentage = progress::get_course_progress_percentage($course, $user->id);

                        if($percentage<100) {
                            physical_toolbox_talk_notification_email($user,$course);
                        }

                    }
                }

                echo $weekvalue-$timediff."<br>";
                if($timediff <= $weekvalue && $timediff>0 && abs($weekvalue-$timediff)<=$dayvalue){
                    $users = enrol_get_course_users($course->id, true);
                    $userArr = array();
                    foreach ($users as $user) {

                        $percentage = progress::get_course_progress_percentage($course, $user->id);

                        if($percentage<100) {
                            $userArr[$user->manager_id][] = fullname($user);
                            training_course_due_completion_email($user, $course);

                        }
                    }

                    if(!empty($userArr)) {
                        foreach ($userArr as $key => $value) {
                            $manager = get_userInfo(array("id" => $key));
                            training_course_due_completion_email_to_manager($manager, $course, $value);
                        }
                    }

                }
        }
    }
}