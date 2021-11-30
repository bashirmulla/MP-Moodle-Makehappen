<?php
// NOTE :::: This CRON must be executed every day only once

namespace local_accident_report\task;

use core_completion\progress;

class physical_toolbox_talk_regular_notification extends \core\task\scheduled_task {
    public function get_name() {
        // Shown on admin screens
        return get_string('physical_toolbox_talk_regular_notification', 'local_accident_report'); //get the string from lang/en/
    }

    public function execute() {
        global $CFG,$USER;
        require_once($CFG->dirroot . '/local/accident_report/locallib.php');
        $dayvalue      = 86400;      // 86,400‬  =  1 day
        $weekvalue     = 604800;      //604,800    = 7 days
        $two_weekvalue = 604800 * 2;  //604,800    = 7 days

        $courses =  get_courses();

        foreach($courses as $course){
            $timediff   = 0;

            if($course->visible!=1)           continue;
            if($course->enablecompletion!=1)  continue;
            if(empty($course->duedate))       continue;
            if($course->startdate <=0)        continue;
            if( time() > $course->enddate)    continue;
            if( time() > $course->duedate)    continue;


            $date1    = $course->startdate + $two_weekvalue;

            $date2    = time();
            $timediff = ($date2 - $date1)%$weekvalue;

            if($date2>$date1 && $timediff< $dayvalue){

                $users   = enrol_get_course_users($course->id, true);

                $userArr = array();
                foreach ($users as $user) {
                    $percentage = progress::get_course_progress_percentage($course, $user->id);
                    if($percentage<100) {
                        training_course_due_completion_email($user, $course);
                    }
                }
            }
        }
    }
}