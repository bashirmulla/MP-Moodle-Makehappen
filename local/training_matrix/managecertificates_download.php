<?php
// This file is part of MailTest for Moodle - http://moodle.org/
//
// MailTest is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// MailTest is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with MailTest.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Sample plugin
 *
 * @package    training_matrix
 * @copyright  2020 Calm-solutions.com
 * @author     Bash & SAM Harun
 */
// Globals.
global $USER, $CFG,$DB;

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/training_matrix/locallib.php');  // Include our function library.


require_login();

error_reporting(1);

$filterData = get_requests();
$param = array();
if(is_number($filterData['u'])){

    $user    =  get_userInfo(array("id" =>$filterData['u']));
    $param['certificate_user_id'] = $filterData['u'];
    $sql     = "SELECT * FROM {managecertificates} WHERE certificate_user_id=? ";
    $records = $DB->get_records_sql($sql,$param);

    $zip               = new \ZipArchive();
    $archive_file_name = __DIR__ . '/certificates_all/'.$user->firstname.'_'.$user->lastname."_all.zip";

    touch($archive_file_name);  //<--- this line creates the file

    //create the zip file
    if ($zip->open( $archive_file_name, \ZipArchive::OVERWRITE)!==TRUE) {
        exit("cannot open <$archive_file_name>\n");
    }

    foreach($records as $value)
    {
        if(!empty($value->copy_of_certificate)) {
            $zip->addFile($CFG->dirroot."/".$value->copy_of_certificate,basename($value->copy_of_certificate));
        }
    }

    //close the zip file
    $zip->close();
    //send the zip file to browser
    if(file_exists($archive_file_name)){
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=".$user->firstname.'_'.$user->lastname."_all.zip");
        readfile($archive_file_name);
        unlink($archive_file_name);
    }

}



