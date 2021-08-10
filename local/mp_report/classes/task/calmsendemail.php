<?php

namespace local_mp_report\task;

class calmsendemail extends \core\task\scheduled_task {
    public function get_name() {
        // Shown on admin screens
        return get_string('email_send', 'local_mp_report'); //get the string from lang/en/
    }

    public function execute() {
        global $CFG;
        require_once($CFG->dirroot . '/local/mp_report/locallib.php');

        $courses =  get_courses();

        foreach($courses as $course){

            if(time() > $course->startdate and $course->send_notification=='Yes' and $course->cron_executed=='No')
            {
                $users = enrol_get_course_users($course->id, true);

                $data                = new \stdClass();
                $data->id            = $course->id;
                $data->cron_executed = 'Yes';
                save_data($data,'course');

                foreach ($users as $user) {
                    new_training_eamil($user,$course);
                }

            }
        }


    }
}