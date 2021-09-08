<?php
$functions = array(
    'local_mp_report_get_standing_table' => array(         //web service function name
        'classname'   => 'local_mp_report_external',       //class containing the external function
        'methodname'  => 'get_standing_table',               //external function name
        'classpath'   => 'local/mp_report/externallib.php',//file containing the class/external function
        'description' => 'Get Report Standing Table Data',   //human readable description of the web service function
        'type'        => 'read',                             //database rights of the web service function (read, write)
        'ajax' => true,                                      // is the service available to 'internal' ajax calls.
        'services' => array('mpreport')  // Optional, only available for Moodle 3.1 onwards. List of built-in services (by shortname) where the function will be included.  Services created manually via the Moodle interface are not supported.
    ),

    'local_mp_report_get_email_table' => array(         //web service function name
        'classname'   => 'local_mp_report_external',       //class containing the external function
        'methodname'  => 'get_email_table',               //external function name
        'classpath'   => 'local/mp_report/externallib.php',//file containing the class/external function
        'description' => 'Get email table Standing Table Data',   //human readable description of the web service function
        'type'        => 'read',                             //database rights of the web service function (read, write)
        'ajax' => true,                                      // is the service available to 'internal' ajax calls.
        'services' => array('mpreport')  // Optional, only available for Moodle 3.1 onwards. List of built-in services (by shortname) where the function will be included.  Services created manually via the Moodle interface are not supported.
    ),

    'local_mp_report_get_manager_list' => array(           //web service function name
        'classname'   => 'local_mp_report_external',       //class containing the external function
        'methodname'  => 'get_manager_list',                 //external function name
        'classpath'   => 'local/mp_report/externallib.php',//file containing the class/external function
        'description' => 'Get manager_list',                 //human readable description of the web service function
        'type'        => 'read',                             //database rights of the web service function (read, write)
        'ajax' => true,                                      // is the service available to 'internal' ajax calls.
        'services' => array('mpreport')  // Optional, only available for Moodle 3.1 onwards. List of built-in services (by shortname) where the function will be included.  Services created manually via the Moodle interface are not supported.
    ),

    'local_mp_report_create_accident' => array(             //web service function name
        'classname'   => 'local_mp_report_external',        //class containing the external function
        'methodname'  => 'create_accident',                   //external function name
        'classpath'   => 'local/mp_report/externallib.php', //file containing the class/external function
        'description' => 'Create Accident',                   //human readable description of the web service function
        'type'        => 'write',                             //database rights of the web service function (read, write)
        'ajax' => true,                                       // is the service available to 'internal' ajax calls.
        'services' => array('mpreport')                     // Optional, only available for Moodle 3.1 onwards. List of built-in services (by shortname) where the function will be included.  Services created manually via the Moodle interface are not supported.
    ),

    'local_mp_report_create_incident' => array(             //web service function name
        'classname'   => 'local_mp_report_external',        //class containing the external function
        'methodname'  => 'create_incident',                   //external function name
        'classpath'   => 'local/mp_report/externallib.php', //file containing the class/external function
        'description' => 'Create Incident',                   //human readable description of the web service function
        'type'        => 'write',                             //database rights of the web service function (read, write)
        'ajax' => true,                                       // is the service available to 'internal' ajax calls.
        'services' => array('mpreport')                     // Optional, only available for Moodle 3.1 onwards. List of built-in services (by shortname) where the function will be included.  Services created manually via the Moodle interface are not supported.
    ),
);

?>
