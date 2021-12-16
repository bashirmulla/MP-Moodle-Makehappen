<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mariadb';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'mp-moodle-single';
$CFG->dbuser    = 'root';
$CFG->dbpass    = '';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => '',
  'dbsocket' => '',
  'dbcollation' => 'utf8mb4_unicode_ci',
);

$CFG->wwwroot   = 'http://mp-moodle.dev.com:8080';
$CFG->dataroot  = 'C:\\xampp3\\htdocs\\mp-moodledata-single';
$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;

$CFG->hs_webserviceid = 3; /* Makehappen Reports mobile app api service id*/

require_once(__DIR__ . '/lib/setup.php');

// Use the following flag to completely disable the installation of plugins
// (new plugins, available updates and missing dependencies) and related
// features (such as cancelling the plugin installation or upgrade) via the
// server administration web interface.
$CFG->disableupdateautodeploy = true;

// block users added by developer
$CFG->not_genuine_user = [];

// encrypt witness data
$CFG->cipher = "AES-128-CBC";
$CFG->key = "MP@Makehappen#2021##UK";

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
//@error_reporting(E_ALL | E_STRICT);   // NOT FOR PRODUCTION SERVERS!
//@ini_set('display_errors', '1');         // NOT FOR PRODUCTION SERVERS!
//$CFG->debug = (E_ALL | E_STRICT);   // === DEBUG_DEVELOPER - NOT FOR PRODUCTION SERVERS!
//$CFG->debugdisplay = 1;              // NOT FOR PRODUCTION SERVERS!
