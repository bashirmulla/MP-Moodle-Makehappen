<?php
$functions = array(
    'local_training_matrix_get_training_records' => array(      //web service function name
        'classname'   => 'local_training_matrix_external',          //class containing the external function
        'methodname'  => 'get_training_records',                //external function name
        'classpath'   => 'local/training_matrix/externallib.php',   //file containing the class/external function
        'description' => 'Get Training Records',           //human readable description of the web service function
        'type'        => 'read',                                    //database rights of the web service function (read, write)
        'ajax' => true,                                             // is the service available to 'internal' ajax calls.
        'services' => array('mpreport')                             // Optional, only available for Moodle 3.1 onwards. List of built-in services (by shortname) where the function will be included.  Services created manually via the Moodle interface are not supported.
    ),
);

?>