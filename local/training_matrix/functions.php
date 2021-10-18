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
 * @package    local_training_matrix
 * @copyright  2018 Calm-solutions.com
 * @author     Bash & SAM Harun
 */

$pluginname = 'training_matrix';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.



$homeurl    = new moodle_url('/local/'.$pluginname.'/index.php');


function home_page(){
    global $CFG,$OUTPUT,$homeurl,$successurl;

    //$form = new training_matrix_list(null, array());

    $form = new home_page(null, array());

    if ($form->is_cancelled()) {
        redirect($homeurl);
    }
    $form->get_data();
    $form->display();


}


function show_form(){
    global $homeurl;

    $form = new accident_report_form(null, array());
    if ($form->is_cancelled()) {
        redirect($homeurl);
    }
    $data = $form->get_data();
    $form->display();


}

function delete_data(){

    global $DB, $OUTPUT,$homeurl,$table;


    $data['id']  = get_request('id');

    if(!is_numeric($data['id'])){
        die("Sorry!!.. unable to process this data");
    }

    $result = $DB->delete_records($table, $data);

    if(!empty($result)){

        echo $OUTPUT->notification("Data has been deleted successfully!!...",'notifysuccess');
        redirect($homeurl);
    }
    else{
        echo $OUTPUT->notification("Sorry!!.. unable to delete the data");
    }
}

function export_pdf($report_type,$filename) {

	if($report_type == 'acc') {
		$pdf_file = accident_pdf(intval($_REQUEST['id']));
	} elseif($report_type == 'inc') {
		$pdf_file = incident_pdf(intval($_REQUEST['id']));
	}elseif($report_type == 'full_acc') {
        echo $pdf_file = accident_full_pdf(intval($_REQUEST['id']));
    }elseif($report_type == 'full_inc') {
        $pdf_file = incident_full_pdf(intval($_REQUEST['id']));
    }

    if($pdf_file) {
		$fileurl = pdfs_path() . $pdf_file;
		header("Content-type:application/pdf");
		header('Content-Disposition: attachment; filename=' . $filename);
		readfile( $fileurl );
		@unlink( $fileurl );
		exit;
	}

}

function processFile($filename,$fileContents,$report_type,$id){

    global $CFG;

    if(empty($fileContents)) return "";

    $url      = $CFG->dataroot.'/filedir/upload';
    $temp_url = $CFG->dataroot.'/temp/';
    $fcontent = str_replace(' ', '+', $fileContents);

    $fcontent = base64_decode($fcontent);

    //----File Name
    $fileExt = 'jpg';
    $fileName = rand(10,100).'_'.rand(100000,999999);
    $fileNameLoc = $fileName.'.'.$fileExt;
    //----File Location
    $fileLocation = $temp_url.$fileNameLoc;
    $fh=fopen($fileLocation,"w");
    //====Save the file in local system
    $totalBytes = fwrite($fh,$fcontent);
    //----Close the file pointer
    fclose($fh);



    if(isset($fileLocation)){

        list($width, $height, $type, $attr) = getimagesize($fileLocation);

        $max_width  = 800;
        $max_height = 800;
        //scaling factors
        $xRatio = $max_width / $width;
        $yRatio = $max_height / $height;

        //calculate the new width and height
        if($width <= $max_width && $height <= $max_height)    //image does not need resizing
        {
            $toWidth     = $width;
            $toHeight     = $height;
        }
        else if($xRatio * $height < $max_height)
        {
            $toHeight = round($xRatio * $height);
            $toWidth  = $max_width;
        }
        else
        {
            $toWidth = round($yRatio * $width);
            $toHeight  = $max_height;
        }

        $exif = exif_read_data($fileLocation);



        $file_ext="jpg";
        if (!file_exists("$url/$report_type/$id")) {
            mkdir("$url/$report_type/$id", 0777, true);
        }

        $target_file =  "$report_type/$id/$filename".".".$file_ext;

        $image = new simpleimage();


        $image->load($fileLocation);



        $image->resize($toWidth,$toHeight,$exif['Orientation']);

        $image->save("$url/$report_type/$id/$filename".".".$file_ext);

        return $target_file;

    }
    return null;

}
