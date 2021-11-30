<?php
// NOTE :::: This CRON must be executed every day only once

namespace local_accident_report\task;

use core_completion\progress;

class high_h_and_s_notification extends \core\task\scheduled_task {
    public function get_name() {
        // Shown on admin screens
        return get_string('high_h_and_s_notification', 'local_accident_report'); //get the string from lang/en/
    }

    public function execute() {
        global $CFG;
        require_once($CFG->dirroot . '/local/accident_report/locallib.php');
        $dayvalue  = 86400;  // 86,400‬  =  1 day
        $weekvalue = 604800;  //604,800    = 7 days

        $accident_list  = get_accident_report_list();
        $incident_list  = get_incident_report_list();
    }
}