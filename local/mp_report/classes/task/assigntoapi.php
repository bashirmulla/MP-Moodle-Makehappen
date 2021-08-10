<?php

/*
 * Author: Bashir Mulla
 * Date: 11/10/2019
 * Comment: For this functionality to work, you need to add the global variable like $CFG->hs_webserviceid = <webserviceid in the database>;
 * in the config.php file.
 */

namespace local_mp_report\task;

use webservice\token_table;

class assigntoapi extends \core\task\scheduled_task {
    public function get_name() {
        // Shown on admin screens
        return get_string('assign_api', 'local_mp_report'); //get the string from lang/en/
    }

    public function execute() {
        global $CFG,$DB,$USER;
        require_once($CFG->dirroot . '/local/mp_report/locallib.php');
        require_once($CFG->libdir . '/externallib.php');
        require_once($CFG->dirroot . '/webservice/lib.php');

        // get users missing api tokens
        $users = get_user_api_missing_tokens();
        //var_dump($tokens);

        $add = new \webservice();
        $serviceuser = new \stdClass();
        $serviceuser->externalserviceid = $CFG->hs_webserviceid;

        foreach($users as $user){
            if ($user->id != 1) {

                /*
                // Create a new token.
                $token = new \stdClass;
                $token->token = md5(uniqid(rand(), 1));
                $token->userid = $user->id;
                $token->tokentype = 0;
                $token->contextid = \context_system::instance()->id;
                $token->creatorid = $USER->id;
                $token->timecreated = time();
                $token->externalserviceid = $CFG->hs_webserviceid;  //HardCoded
                // By default tokens are valid for 12 weeks.
                $token->validuntil = '0';
                $token->iprestriction = null;
                $token->sid = null;
                $token->lastaccess = null;
                // Generate the private token, it must be transmitted only via https.
                $token->privatetoken = random_string(64);
                $token->id = $DB->insert_record('external_tokens', $token);

                $eventtoken = clone $token;
                $eventtoken->privatetoken = null;
                $params = array(
                    'objectid' => $eventtoken->id,
                    'relateduserid' => $USER->id,
                    'other' => array(
                        'auto' => true
                    )
                );
                $event = \core\event\webservice_token_created::create($params);
                $event->add_record_snapshot('external_tokens', $eventtoken);
                $event->trigger();

                */

                // create api tokens for users

                $context = \context_system::instance()->id;
                external_generate_token(0, $CFG->hs_webserviceid, $user->id, $context, $validuntil = 0, $iprestriction = '');

                // add users to the web service
                $serviceuser->userid = $user->id;
                $add->add_ws_authorised_user($serviceuser);
            }
        }

    }
}