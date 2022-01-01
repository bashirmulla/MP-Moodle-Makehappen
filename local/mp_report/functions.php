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
 * @package    local_mp_report
 * @copyright  2018 www.makehappengroup.co.uk
 * @author     MP
 */

$pluginname = 'mp_report';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
//require_once(dirname(__FILE__).'/classes/'.$pluginname.'_success.php');  // Include form.
//require_once(dirname(__FILE__).'/classes/accident_report_form.php');  // Include form.
//require_once(dirname(__FILE__).'/classes/incident_report_form.php');  // Include form.
//require_once(dirname(__FILE__).'/classes/'.$pluginname.'_list.php');  // Include form.


$homeurl        = new moodle_url('/local/'.$pluginname.'/index.php');
$accidenturl    = new moodle_url('/local/'.$pluginname.'/index.php?cmd=register');


function home_page(){
    global $CFG,$OUTPUT,$homeurl,$successurl;

    //$form = new mp_report_list(null, array());

    $form = new home_page(null, array());

    if ($form->is_cancelled()) {
        redirect($homeurl);
    }
    $form->get_data();
    $form->display();


}


function save_statement(){
    
    global $accidenturl;
    
    if(empty($_REQUEST['id'])) die;

   

    if($_REQUEST['confirmed']=='on'){
        $updateData['id']                    = $_REQUEST['id'];
        $updateData['status']                = 'Confirmed';
        $updateData['confirmed_person_name'] = $_REQUEST['confirmed_person_name'];
        $updateData['confirmed_date']        = time();

    }

    if(isset($_REQUEST['how_reported'])){
        $updateData = array();
        $updateData['id']              = $_REQUEST['id'];
        $updateData['status']          = 'Approved';
        $updateData['how_reported']    = $_REQUEST['how_reported'];
        $updateData['approve_date']    = time();

    }

    //echo "<pre>";
    //print_r($updateData);
    //die;


    $result =  update_data($updateData,'new_accident_report');

    redirect($accidenturl,"Data has been saved successfully!!...","6",'success');
}


function accident_event(){
    global $CFG,$OUTPUT,$homeurl,$successurl;

    //$form = new mp_report_list(null, array());

    $form = new accident_event(null, array());

    if ($form->is_cancelled()) {
        redirect($homeurl);
    }
    $form->get_data();
    $form->display();


}



function new_accident_register(){
    global $CFG,$OUTPUT,$homeurl,$successurl;

    //$form = new mp_report_list(null, array());

    $form = new new_accident_register(null, array());

    if ($form->is_cancelled()) {
        redirect($homeurl);
    }
    $form->get_data();
    $form->display();


}


function new_accident_page(){
    global $CFG,$OUTPUT,$homeurl,$successurl;

    //$form = new mp_report_list(null, array());

    $form = new new_accident_page(null, array());

    if ($form->is_cancelled()) {
        redirect($homeurl);
    }
    $form->get_data();
    $form->display();


}

function accident_page(){
    global $CFG,$OUTPUT,$homeurl,$successurl;

    //$form = new mp_report_list(null, array());

    $form = new accident_page(null, array());

    if ($form->is_cancelled()) {
        redirect($homeurl);
    }
    $form->get_data();
    $form->display();


}

function incident_page(){
    global $CFG,$OUTPUT,$homeurl,$successurl;

    //$form = new mp_report_list(null, array());

    $form = new incident_page(null, array());

    if ($form->is_cancelled()) {
        redirect($homeurl);
    }
    $form->get_data();
    $form->display();


}


function gdpr_page(){
    global $DB,$CFG;
    die("GDPR script already executed");
    $records = $DB->get_records("accident_report");

    if(!empty($records)){
        foreach ($records as $acc){
            $dataobject = new stdClass();

            $dataobject->id         = $acc->id;
            $dataobject->witnesses_name         = !empty($acc->witnesses_name) ? encrypt($acc->witnesses_name) : NULL;
            $dataobject->witnesses_address      = !empty($acc->witnesses_address) ? encrypt($acc->witnesses_address) : NULL;;
            $dataobject->witnesses_phone_number = !empty($acc->witnesses_phone_number) ? encrypt($acc->witnesses_phone_number) : NULL;

            $id = save_data($dataobject,"accident_report");
        }
    }
    echo "GDPR fixing  run successfully";
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

function accident_edit_form(){
    global $homeurl,$DB;

    $tableName  = get_string('accident_table','local_mp_report');
    $form = new accident_report_form(null, array());
    if ($form->is_cancelled()) {
        redirect($homeurl);
    }

    $select['id']  = get_request('id');

    $data = $DB->get_record($tableName, $select);

    if(!empty($data))
        $form->set_data($data);

    $form->display();


}

function edit_manager_form(){

    global $homeurl,$DB;

    $tableName  = get_string('new_accident_manager_table','local_mp_report');
    $form = new new_accident_manager_report_form(null, array());
    if ($form->is_cancelled()) {
        redirect($homeurl);
    }

    $dataobject  = $form->get_submitted_data();




    $select['id']  = get_request('aid');

    $data = $DB->get_record($tableName, $select);



    if(!empty($dataobject) && $form->is_validated()){
         $id = save_data($dataobject,$tableName);
        if(!empty($id) ){
            //echo $OUTPUT->notification("Data has been saved successfully!!...",'notifysuccess');
            redirect($homeurl,"Data has been saved successfully!!...","6",'success');
        }
        else{
            //echo $OUTPUT->notification("Sorry!!.. unable to save the data");
            redirect($homeurl,"Sorry!!.. unable to save the data...","6",'error');
        }

    }
    else {
        $form->set_data($data);
        $form->display();
    }

}



function incident_edit_form(){
    global $homeurl,$DB;

    $tableName  = get_string('incident_table','local_mp_report');
    $form = new incident_report_form(null, array());
    if ($form->is_cancelled()) {
        redirect($homeurl);
    }

    $select['id']  = get_request('id');

    $data = $DB->get_record($tableName, $select);

    if(!empty($data))
        $form->set_data($data);

    $form->display();


}
function removeFiles($target) {

    if(is_dir($target)){

        $files = glob( $target . '*', GLOB_MARK );
        foreach( $files as $file ){
            removeFiles( $file );
        }
        rmdir( $target );
    } elseif(is_file($target)) {
        unlink( $target );
    }
}

function accident_form(){
    global $CFG,$OUTPUT,$homeurl,$successurl, $USER,$DB;
    $tableName = get_string('accident_table','local_mp_report');




    $form = new accident_report_form(null, array());
    if ($form->is_cancelled()) {
        redirect($homeurl);
    }

    $dataobject  = $form->get_submitted_data();



    if(!empty($dataobject) && $form->is_validated()){

        if(!empty($dataobject->s_mgt_rpt_2508_completed)){
            if($dataobject->s_mgt_rpt_2508_completed!=1){
                $dataobject->s_mgt_rpt_riddor_event_clf = NULL;
                $dataobject->riddor_subcategory         = NULL;
            }
            else {
                if( !in_array($dataobject->s_mgt_rpt_riddor_event_clf,array(17,20,21))) {
                    $dataobject->riddor_subcategory = NULL;
                }
            }
        }




        $dataobject->submitter_to_manager = 'Yes';

        //GDPR implementation
        $dataobject->witnesses_name         = !empty($dataobject->witnesses_name) ? encrypt($dataobject->witnesses_name) : NULL;
        $dataobject->witnesses_address      = !empty($dataobject->witnesses_address) ? encrypt($dataobject->witnesses_address) : NULL;;
        $dataobject->witnesses_phone_number = !empty($dataobject->witnesses_phone_number) ? encrypt($dataobject->witnesses_phone_number) : NULL;


        $id = save_data($dataobject,$tableName);

        if(!empty($id) ){

            if(empty($dataobject->id)) {
                $updateData['id'] = $dataobject->id ? $dataobject->id : $id;
                $updateData['photo_1'] = uploadFile('photo_1', 'accident', $dataobject->id ? $dataobject->id : $id);
                $updateData['photo_2'] = uploadFile('photo_2', 'accident', $dataobject->id ? $dataobject->id : $id);
                $updateData['photo_3'] = uploadFile('photo_3', 'accident', $dataobject->id ? $dataobject->id : $id);
                $updateData['photo_4'] = uploadFile('photo_4', 'accident', $dataobject->id ? $dataobject->id : $id);
                $updateData['photo_5'] = uploadFile('photo_5', 'accident', $dataobject->id ? $dataobject->id : $id);
                $updateData['photo_6'] = uploadFile('photo_6', 'accident', $dataobject->id ? $dataobject->id : $id);
                $updateData['witnesses_report_diagram'] = uploadFile('witnesses_report_diagram', 'accident', $dataobject->id ? $dataobject->id : $id);
                update_data($updateData, get_string('accident_table', 'local_mp_report'));

                $pdf_file = accident_pdf($id);
                $report_title = "Accident Report";
                $subject = "Notification of Accident Report";
                $message = "A new accident report has been submitted. Please see the attached report.";
                send_email_to_manager($dataobject->user_manager,"Makehappen", $subject, $message, pdfs_email_attachment().$pdf_file, $pdf_file,$report_title);
                send_mp_report_email("Makehappen", $subject, $message, pdfs_email_attachment() . $pdf_file, $pdf_file,$report_title);

            }


            //echo $OUTPUT->notification("Data has been saved successfully!!...",'notifysuccess');
            redirect($homeurl,"Data has been saved successfully!!...","6",'success');
        }
        else{
            //echo $OUTPUT->notification("Sorry!!.. unable to save the data");
            redirect($homeurl,"Sorry!!.. unable to save the data...","6",'error');
        }

    }
    else {

        $data = $form->get_data();
        $form->set_data($data);
        $form->display();
    }


}

function new_accident_form(){
    global $CFG,$OUTPUT,$homeurl,$successurl, $USER,$DB;
    $tableName  = get_string('new_accident_table','local_mp_report');


    

    $form = new new_accident_report_form(null, array());
    if ($form->is_cancelled()) {
        redirect($homeurl);
    }

    $dataobject  = $form->get_submitted_data();

    
    
    $c_kind_of_accident = "";
    $d_agents           = "";

    if(!isset($dataobject->incident_type)){

        foreach($dataobject as $key=>$data){
            if( preg_match('/c_kind_of_accident/i', $key)){
                
                $temp = explode("##",$key);
                                
                if(!empty($c_kind_of_accident)){
                    $c_kind_of_accident .= ",".$temp[1];
                }
                else{
                    $c_kind_of_accident .= $temp[1];
                }
                unset($dataobject->$key);   
            }

            if( preg_match('/d_agents/i', $key)){
                
                $temp = explode("##",$key);
                            
                if(!empty($d_agents)){
                $d_agents .= ",".$temp[1];
                }
                else{
                $d_agents .= $temp[1];
                }
                unset($dataobject->$key);   
            }
        }
        $dataobject->c_kind_of_accident = $c_kind_of_accident;
        $dataobject->d_agents           = $d_agents;

        unset($dataobject->read_only);
        unset($dataobject->save);
        
        if(!empty($dataobject) && $form->is_validated()){

            $dataobject->submitter_to_manager = 'Yes';

            //GDPR implementation
            //$dataobject->witness_name_address  = !empty($dataobject->witness_name_address) ? encrypt($dataobject->witness_name_address) : NULL;
            $dataobject->user_id       = $USER->id;
            //$dataobject->created_at    = date('Y-m-d');   
            //$dataobject->updated_at    = date('Y-m-d'); 
        

            $id = save_data($dataobject,$tableName);

            if(!empty($id) ){

                if(empty($dataobject->id)) {
                
                    $pdf_file = new_accident_pdf($id);
                    $report_title = "Accident Report";
                    $subject = "Notification of Accident Report";
                    $message = "A new accident report has been submitted. Please see the attached report.";
                    //send_email_to_manager($dataobject->user_manager,"Makehappen", $subject, $message, pdfs_email_attachment().$pdf_file, $pdf_file,$report_title);
                    //send_mp_report_email("Makehappen", $subject, $message, pdfs_email_attachment() . $pdf_file, $pdf_file,$report_title);

                }


                //echo $OUTPUT->notification("Data has been saved successfully!!...",'notifysuccess');
                redirect($homeurl,"Data has been saved successfully!!...","6",'success');
            }
            else{
                //echo $OUTPUT->notification("Sorry!!.. unable to save the data");
                redirect($homeurl,"Sorry!!.. unable to save the data...","6",'error');
            }

        }
        else {

            $data = $form->get_data();
            $form->set_data($data);
            $form->display();
        }
   }
   else{



    if(!empty($dataobject) && $form->is_validated()){

        $tableName                   =  $tableName  = get_string('new_accident_manager_table','local_mp_report');
        $dataobject->user_id         = $USER->id;
        $dataobject->new_accident_id = $dataobject->id;
        
        unset($dataobject->id);
        unset($dataobject->read_only);
        unset($dataobject->save);
        unset($dataobject->cmd);

        $id = save_data($dataobject,$tableName);

        if(!empty($id) ){

            //echo $OUTPUT->notification("Data has been saved successfully!!...",'notifysuccess');
            redirect($homeurl,"Data has been saved successfully!!...","6",'success');
        }
        else{
            //echo $OUTPUT->notification("Sorry!!.. unable to save the data");
            redirect($homeurl,"Sorry!!.. unable to save the data...","6",'error');
        }

        }
        else {

            $data = $form->get_data();
            $form->set_data($data);
            $form->display();
        } 
   }


}

function incident_form(){
    global $CFG,$OUTPUT,$homeurl,$successurl, $USER;
    $tableName = get_string('incident_table','local_mp_report');

    $form = new incident_report_form(null, array());
    if ($form->is_cancelled()) {
        redirect($homeurl);
    }

    $dataobject  = $form->get_submitted_data();

    if(!empty($dataobject) && $form->is_validated()){

        if(!empty($dataobject->correct_report_category)){
            if($dataobject->correct_report_category==29 || $dataobject->correct_report_category==30){
                $dataobject->categorisation = NULL;
                $dataobject->vehicles       = NULL;
                $dataobject->equipment      = NULL;
                $dataobject->environmental  = NULL;
                $dataobject->attack         = NULL;
            }
            else if($dataobject->correct_report_category==31){
                $dataobject->classification = NULL;
            }
        }

        $dataobject->submitter_to_manager = 'Yes';
        $id  = save_data($dataobject,$tableName);


        //$dataobject->classification = !empty($dataobject->classification) ? $dataobject->classification : 'NULL';
        //$dataobject->categorisation = !empty($dataobject->categorisation) ? $dataobject->categorisation : 'NULL';
        //$dataobject->vehicles       = !empty($dataobject->vehicles)       ? $dataobject->vehicles : 'NULL';
        //$dataobject->equipment      = !empty($dataobject->equipment)      ? $dataobject->equipment : 'NULL';
        //$dataobject->environmental  = !empty($dataobject->environmental)  ? $dataobject->environmental : 'NULL';
        //$dataobject->attack         = !empty($dataobject->attack)         ? $dataobject->attack : 'NULL';

        if(!empty($id)){
            if(empty($dataobject->id)) {
                $updateData['id'] = $dataobject->id ? $dataobject->id : $id;
                $updateData['photo_1'] = uploadFile('photo_1', 'incident', $dataobject->id ? $dataobject->id : $id);
                $updateData['photo_2'] = uploadFile('photo_2', 'incident', $dataobject->id ? $dataobject->id : $id);
                $updateData['photo_3'] = uploadFile('photo_3', 'incident', $dataobject->id ? $dataobject->id : $id);
                $updateData['photo_4'] = uploadFile('photo_4', 'incident', $dataobject->id ? $dataobject->id : $id);
                $updateData['photo_5'] = uploadFile('photo_5', 'incident', $dataobject->id ? $dataobject->id : $id);
                $updateData['photo_6'] = uploadFile('photo_6', 'incident', $dataobject->id ? $dataobject->id : $id);
                update_data($updateData, get_string('incident_table', 'local_mp_report'));

                $pdf_file = incident_pdf($id);
                $subject = "";
                $message = "";
                $send_to_client = 0;
                $report_title = "";

                $dropdown = get_dropdown_data(2,"report_category");

                switch($dataobject -> report_category) {
                    case 29:
                        $subject = "Notification of Near Miss Report from Makehappen";
                        $message = "A new Near Miss report has been submitted by Makehappen. Please see the attached report. Send all replies to: iw.compliance@ipsumutilities.com ";
                        $send_to_client =1;
                        $report_title = "Near Miss Report";
                        break;
                    case 30:
                        $subject = "Notification of Hazard Report from Makehappen";
                        $message = "A new Hazard report has been submitted by Makehappen. Please see the attached report. Send all replies to: iw.compliance@ipsumutilities.com ";
                        $send_to_client =1;
                        $report_title = "Hazard Report";
                        break;
                    case 31:
                        $subject = "Notification of Incident Report";
                        $message = "A new Incident report has been submitted. Please see the attached report. Send all replies to: iw.compliance@ipsumutilities.com ";
                        $report_title = "Incident Report";
                        break;
                     default:
                        $subject = "Notification of ".$dropdown['report_category'][$dataobject -> report_category];
                        $message = "A new ".$dropdown['report_category'][$dataobject -> report_category]." report has been submitted. Please see the attached report. Send all replies to: iw.compliance@ipsumutilities.com ";
                        $report_title = $dropdown['report_category'][$dataobject -> report_category]." Report";
                }

                send_email_to_manager($dataobject->manager,"Makehappen", $subject, $message, pdfs_email_attachment().$pdf_file, $pdf_file,$report_title);
                if($send_to_client==1) {
                    send_email_to_client($dataobject->contact, "Makehappen", $subject, $message, pdfs_email_attachment() . $pdf_file, $pdf_file,$report_title);
                }
                send_mp_report_email("Makehappen", $subject, $message, pdfs_email_attachment().$pdf_file, $pdf_file,$report_title);



            }


            //echo $OUTPUT->notification("Data has been saved successfully!!...",'notifysuccess',NOTIFY_SUCCESS);
            redirect($homeurl,"Data has been saved successfully!!...","6",'success');
        }
        else{
            //echo $OUTPUT->notification("Sorry!!.. unable to save the data");
            redirect($homeurl,"Sorry!!.. unable to save the data...","6",'error');
        }

    }
    else {

        $data = $form->get_data();
        $form->set_data($data);
        $form->display();
    }


}

function delete_data(){

    global $DB, $OUTPUT,$homeurl,$table;


    $data['id']  = get_request('id');

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
        $pdf_file = new_accident_pdf(intval($_REQUEST['id']));
    } elseif($report_type == 'inc') {
        $pdf_file = incident_pdf(intval($_REQUEST['id']));
    }elseif($report_type == 'full_acc') {
        echo $pdf_file = accident_full_pdf(intval($_REQUEST['id']));
    }elseif($report_type == 'full_inc') {
        $pdf_file = incident_full_pdf(intval($_REQUEST['id']));
    }
    elseif($report_type == 'full_new_acc') {
        echo $pdf_file = new_accident_full_pdf(intval($_REQUEST['id']));
    }
    elseif($report_type == 'accident_event') {
        echo $pdf_file = accident_event_pdf(intval($_REQUEST['id']));
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

function new_accident_pdf($acc_id) {

    global $homeurl,$DB, $CFG;

    $photo_path = $CFG->dataroot."/filedir/upload";
    $tableName  = get_string('new_accident_table','local_mp_report');
    $select['id']  = $acc_id;
    $reportData = $DB->get_record($tableName, $select);
    $user = get_userInfo( array("id" => $reportData -> user_id ));

    //$manager            = get_userInfo( array("id" => $reportData -> user_manager ));
    $dropdown           = get_new_dropdown_data(1);
    $employment_status  = $dropdown['employment_status'];
    $operative_at_now   = $dropdown['operative_at_now'];

    ob_start();
    ?>
    <style type="text/css">        
       
        table, th, td {
           border: 1px solid #CCC;
           border-collapse: collapse;
           padding: 5px;
        }
        p{
            font-weight: bold;
            margin: 10px 0px;
        } 
    </style>
     <center><h1 style="text-align: center;">Accident Incident Report</h1></center>
         <p id="view_p">A. THE INJURED / INVOLVED PERSON</p>
            <table id="view_table" width="100%">
            <tr>
                <td>Surname: <br> <?=boldText($reportData->a_surname   ) ?></td>
                <td>Forename(s): <br><?=boldText($reportData->a_forename   ) ?></td>
            </tr>
            <tr>
                <td>Home Address: <br><?=boldText($reportData->a_home_address   ) ?></td>
                <td>Tel No: <br><?=boldText($reportData->a_tel_no   ) ?></td>
            </tr>
            <tr>
                <td>Sex (M/F): <br><?=boldText($reportData->a_sex   ) ?></td>
                <td>Age: <br><?=boldText($reportData->a_age   ) ?></td>
            </tr>
            <tr>
                <td>Following the accident, the Operative is now at:<br> <?=boldText($dropdown['operative_at_now'][$reportData->a_following_accident]  ) ?></td>
                <td>If resumed work on the day of the accident state time lost: <br>

                <?=($reportData->a_resumed_work=='No')? boldText($reportData->a_resumed_work ): boldText($reportData->a_hours).''. boldText($reportData->a_mins) ?>
                </td>
            </tr>
            <tr>
                <td>Temporary Address (if applicable): <br> <?=boldText($reportData->a_temp_address   ) ?></td>
                <td>Status: <br><?=boldText($dropdown['employment_status'][$reportData->a_status]  ) ?></td>
            </tr>
            <tr>
                <td>Occupation or Job Title: <br><?=boldText($reportData->a_job_title   ) ?></td>
                <td>(If Applicable) Employers Name and Address: </td>
            </tr>
            </table>
            
            <p  id="view_p">B. DATE, TIME, AND PLACE OF ACCIDENT/INCIDENT/DANGEROUS OCCURRENCE</p>
            <table id="view_table" width="100%">
            <tr>
                <td>Date: <br><?=boldText(date("d-M-Y",$reportData->b_date)   ) ?></td>
                <td>Time: <br><?=boldText(date("H:m",$reportData->b_date)   ) ?></td>
            </tr>
            <tr>
                <td>Name & Address of Site: <br><?=boldText($reportData->b_name_address_site   ) ?></td>
                <td>Exact Location on Site: <br><?=boldText($reportData->b_exact_location_site   ) ?></td>
            </tr>
            <tr>
                <td>On what work was the operative engaged upon at the time and/or what was the dangerous occurrence?: <br><?=boldText($reportData->b_dangerous   ) ?></td>
                <td>Reported: <br><?=boldText(date("d-M-Y",$reportData->b2_date)) ?></td>
            </tr>
            <tr>
                <td>What Does the Injured Person Believe Caused the Accident?:<br> <?=boldText($reportData->b_injured   ) ?></td>
                <td>Witness(es) – Names & Addresses:<br> <?=boldText($reportData->b_witness_name   ) ?></td>
            </tr>
            </table>
            
            <p  id="view_p">C. KIND OF ACCIDENT/INCIDENT/DANGEROUS OCCURRENCE</p>
            <div style="border: 1px solid #CCC; padding:5px" width="100%">
            <?php
               $ids = explode(',',$reportData->c_kind_of_accident);
               foreach($dropdown['kind_of_occurrence'] as $key=>$value){
                   if(in_array($key,$ids))
                   echo "&#10157; ".$value."<br>";
               } 
            ?>    
           
            </div>
            
            <p  id="view_p">D. AGENT(S) INVOLVED</p>
            <div style="border: 1px solid #CCC; padding:5px" width="100%">
            <?php
                $ids = explode(',',$reportData->d_agents);
               foreach($dropdown['agent_involved'] as $key=>$value){
                if(in_array($key,$ids))
                   echo "&#10157; ".$value."<br>";
               } 
            ?>    
            </div>
            
            <p  id="view_p">E. ACCOUNT OF INCIDENT/DANGEROUS OCCURRENCE</p>
            <table id="view_table" width="100%">
            <tr>
                <td>Describe what happened and how (in the case of an accident state, what the injured person was doing at the time):<br>
                <?=boldText($reportData->e_accident_state) ?>
            
            </td>
            
            </tr>
            </table>
            
            <p id="view_p">F. ACTION TAKEN TO PREVENT RE-OCCURRENCE</p>
            <table id="view_table" width="100%">
            <tr>
                <td>
                <?=boldText($reportData->f_action_taken) ?>
                </td>
            
            </tr>
            </table>
            
            <br><br>
            <table width="100%">
            <tr>
                <td>Name of Person Making Report: <?=boldText($reportData->declaration_name_of_person) ?></td>
            
           
                <td>Name of Person Making Report: <?=boldText(date("d-M-Y",$reportData->declaration_date)) ?></td>
            
            </tr>
            </table>
             
            <?php

     $html = ob_get_contents();
   
    ob_clean();    


    require_once($CFG->libdir.'/pdflib.php');

    $file_name = $user -> firstname ."-". $user -> lastname .'-'. $data -> id . '.pdf';
    $file_name = str_replace(" ","-", $file_name);

    $pdf = new pdf();
    $PDF_HEADER_LOGO       = '/local/mp_report/images/mh_logo_sm.png'; //any image file. check correct path.
    $PDF_HEADER_LOGO_WIDTH = "60%";
    $PDF_HEADER_TITLE      = "";
    $PDF_HEADER_STRING     = "";

    $pdf->SetMargins(15, 20, 15);
    $pdf->SetHeaderMargin(1);
    $pdf->SetFooterMargin(0);
    $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);


    $pdf -> AddPage();
    $pdf -> WriteHTML($html);
    $pdf -> Output( pdfs_path() . $file_name, 'F' );

    return $file_name;
}


function accident_event_pdf($id){

    global $homeurl,$DB, $CFG;
    
    $reportData = $DB->get_record("new_accident_report",array("id" => $id));

    ob_start();
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Makehappen</title>
    </head>
    <style>
       table tr td{
           padding: 5px;
       }
    </style>
    
    <body>
    
    <table width="100%">
    
    <tr>
        <td colspan="4"><h1 align="center">Accident Statement of Events</h1></td>
    </tr>
    <tr>
        <td style="background:#090; color:#000" colspan="4"><b>1.  About the person who had the accident</b></td>
    </tr>
    <tr>
        <td width="10%">Name</td>
        <td>: <?=boldText($reportData->a_surname.' '.$reportData->a_forename)?></td>
    </tr>
    <tr>
        <td width="10%">Address</td>
        <td>: <?=boldText($reportData->a_home_address)?></td>
    </tr>
    <tr>
        <td width="10%">Postcode</td>
        <td>: <?=boldText($reportData->a_postcode)?></td>
    </tr>
    <tr>
        <td width="10%">Occupation</td>
        <td>: <?=boldText($reportData->a_job_title)?></td>
    </tr>
    
    </table>
    
    <br />
    
    <table width="100%">
    
    <tr>
        <td style="background:#090; color:#000" colspan="4"><b>2.   About you, the person filling in this record</b></td>
    </tr>
    <tr>
        <td colspan="2" style="color:#CCC">If you are the person who had the accident, please state AS ABOVE</td>
    </tr>
    <tr>
        <td width="10%">Name</td>
        <td>: <?=boldText($reportData->a_surname.' '.$reportData->a_forename)?></td>
    </tr>
    <tr>
        <td width="10%">Address</td>
        <td>: <?=boldText($reportData->a_home_address)?></td>
    </tr>
    <tr>
        <td width="10%">Postcode</td>
        <td>: <?=boldText($reportData->a_postcode)?></td>
    </tr>
    <tr>
        <td width="10%">Occupation</td>
        <td>: <?=boldText($reportData->a_job_title)?></td>
    </tr>
    
    </table>
    
    <br />
    
    <table width="100%">
    
    <tr>
        <td style="background:#090; color:#000" colspan="4"><b>3.   About the accident (continue on reverse if needed)</b></td>
    </tr>
    <tr>
        <td>Date of Occurrence</td>
        <td>: <?=boldText(date("d-M-Y",$reportData->b_date))?></td>
        <td>Time of Occurrence</td>
        <td>: <?=boldText(date("d-M-Y",$reportData->b_date))?></td>
    </tr>
    
    </table>
    
    <table width="100%">
    
    <tr>
        <td>Describe the location (room or place)</td>
    </tr>
    <tr>
        <td> <?=boldText($reportData->b_exact_location_site)?></td>
    </tr>
    
    <tr>
        <td>Say how and if possible, why the accident occurred</td>
    </tr>
    <tr>
        <td> <?=boldText($reportData->b_dangerous)?></td>
    </tr>
    <tr>
        <td>Please give details of any injury</td>
    </tr>
    <tr>
        <td> <?=boldText($reportData->b_injured)?></td>
    </tr>
    </table>
    
    <br />
    <br />
    <br />
    <br />
    
    <table width="100%">
    
    <tr>
        <td width="50%">Please Sign and Date <br />Signature</td>
        <td>Date</td>
        <td></td>
    </tr>
    
    </table>
    
    <br />
    
    <table width="100%">
    
    <tr>
        <td style="background:#090; color:#000" colspan="3"><b>4.    For the employee only</b></td>
    </tr>
    <tr>
        <td colspan="3">By ticking this box I give consent to my employer to disclose my personal information and details of 
        the accident which appear on this form to safety representatives and representatives of employee 
        safety for them to carry out the health and safety functions given to them by law.</td>
    </tr>
    
    </table>
    
    <br /><br /><br /><br />
    
    <table width="100%">
    
    <tr>
        <td width="10%">Signature</td>
        <td>Date</td>
        <td></td>
    </tr>
    
    </table>
    
    </body>
    </html>
    
    <?php

    $html = ob_get_contents();


    ob_clean();    


    require_once($CFG->libdir.'/pdflib.php');

    $file_name = "Accident_Event".$user -> firstname ."-". $user -> lastname .'-'. $data -> id . '.pdf';
    $file_name = str_replace(" ","-", $file_name);

    $pdf = new pdf();
    $PDF_HEADER_LOGO       = '/local/mp_report/images/mh_logo_sm.png'; //any image file. check correct path.
    $PDF_HEADER_LOGO_WIDTH = "60%";
    $PDF_HEADER_TITLE      = "";
    $PDF_HEADER_STRING     = "";

    $pdf->SetMargins(15, 20, 15);
    $pdf->SetHeaderMargin(1);
    $pdf->SetFooterMargin(0);
    $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);


    $pdf -> AddPage();
    $pdf -> WriteHTML($html);
    $pdf -> Output( pdfs_path() . $file_name, 'F' );

    return $file_name;

}


function new_accident_full_pdf($acc_id) {

    global $homeurl,$DB, $CFG;

    $photo_path = $CFG->dataroot."/filedir/upload";
    $tableName  = get_string('new_accident_table','local_mp_report');
    $select['id']  = $acc_id;
    $reportData        = $DB->get_record($tableName, $select);
    $reporManagertData = $DB->get_record('new_accident_manager_report', array("new_accident_id" => $acc_id));
    $user = get_userInfo( array("id" => $reportData -> user_id ));

    //$manager            = get_userInfo( array("id" => $reportData -> user_manager ));
    $dropdown           = get_new_dropdown_data(1);
    $employment_status  = $dropdown['employment_status'];
    $operative_at_now   = $dropdown['operative_at_now'];

    ob_start();
    ?>
    <style type="text/css">        
       
        table, th, td {
           border: 1px solid #CCC;
           border-collapse: collapse;
           padding: 5px;
        }
        p{
            font-weight: bold;
            margin: 10px 0px;
        } 
    </style>
     <center><h1 style="text-align: center;">Accident Incident Report</h1></center>
         <p id="view_p">A. THE INJURED / INVOLVED PERSON</p>
            <table id="view_table" width="100%">
            <tr>
                <td>Surname: <br> <?=boldText($reportData->a_surname   ) ?></td>
                <td>Forename(s): <br><?=boldText($reportData->a_forename   ) ?></td>
            </tr>
            <tr>
                <td>Home Address: <br><?=boldText($reportData->a_home_address   ) ?></td>
                <td>Tel No: <br><?=boldText($reportData->a_tel_no   ) ?></td>
            </tr>
            <tr>
                <td>Sex (M/F): <br><?=boldText($reportData->a_sex   ) ?></td>
                <td>Age: <br><?=boldText($reportData->a_age   ) ?></td>
            </tr>
            <tr>
                <td>Following the accident, the Operative is now at:<br> <?=boldText($dropdown['operative_at_now'][$reportData->a_following_accident]  ) ?></td>
                <td>If resumed work on the day of the accident state time lost: <br>

                <?=($reportData->a_resumed_work=='No')? boldText($reportData->a_resumed_work ): boldText($reportData->a_hours).''. boldText($reportData->a_mins) ?>
                </td>
            </tr>
            <tr>
                <td>Temporary Address (if applicable): <br> <?=boldText($reportData->a_temp_address   ) ?></td>
                <td>Status: <br><?=boldText($dropdown['employment_status'][$reportData->a_status]  ) ?></td>
            </tr>
            <tr>
                <td>Occupation or Job Title: <br><?=boldText($reportData->a_job_title   ) ?></td>
                <td>(If Applicable) Employers Name and Address: </td>
            </tr>
            </table>
            
            <p  id="view_p">B. DATE, TIME, AND PLACE OF ACCIDENT/INCIDENT/DANGEROUS OCCURRENCE</p>
            <table id="view_table" width="100%">
            <tr>
                <td>Date: <br><?=boldText(date("d-M-Y",$reportData->b_date)   ) ?></td>
                <td>Time: <br><?=boldText(date("H:m",$reportData->b_date)   ) ?></td>
            </tr>
            <tr>
                <td>Name & Address of Site: <br><?=boldText($reportData->b_name_address_site   ) ?></td>
                <td>Exact Location on Site: <br><?=boldText($reportData->b_exact_location_site   ) ?></td>
            </tr>
            <tr>
                <td>On what work was the operative engaged upon at the time and/or what was the dangerous occurrence?: <br><?=boldText($reportData->b_dangerous   ) ?></td>
                <td>Reported: <br><?=boldText(date("d-M-Y",$reportData->b2_date)) ?></td>
            </tr>
            <tr>
                <td>What Does the Injured Person Believe Caused the Accident?:<br> <?=boldText($reportData->b_injured   ) ?></td>
                <td>Witness(es) – Names & Addresses:<br> <?=boldText($reportData->b_witness_name   ) ?></td>
            </tr>
            </table>
            
            <p  id="view_p">C. KIND OF ACCIDENT/INCIDENT/DANGEROUS OCCURRENCE</p>
            <div style="border: 1px solid #CCC; padding:5px" width="100%">
            <?php
               $ids = explode(',',$reportData->c_kind_of_accident);
               foreach($dropdown['kind_of_occurrence'] as $key=>$value){
                   if(in_array($key,$ids))
                   echo "&#10157; ".$value."<br>";
               } 
            ?>    
           
            </div>
            
            <p  id="view_p">D. AGENT(S) INVOLVED</p>
            <div style="border: 1px solid #CCC; padding:5px" width="100%">
            <?php
                $ids = explode(',',$reportData->d_agents);
               foreach($dropdown['agent_involved'] as $key=>$value){
                if(in_array($key,$ids))
                   echo "&#10157; ".$value."<br>";
               } 
            ?>    
            </div>
            
            <p  id="view_p">E. ACCOUNT OF INCIDENT/DANGEROUS OCCURRENCE</p>
            <table id="view_table" width="100%">
            <tr>
                <td>Describe what happened and how (in the case of an accident state, what the injured person was doing at the time):<br>
                <?=boldText($reportData->e_accident_state) ?>
            
            </td>
            
            </tr>
            </table>
            
            <p id="view_p">F. ACTION TAKEN TO PREVENT RE-OCCURRENCE</p>
            <table id="view_table" width="100%">
            <tr>
                <td>
                <?=boldText($reportData->f_action_taken) ?>
                </td>
            
            </tr>
            </table>
            
            <br><br>
            <table width="100%">
            <tr>
                <td>Name of Person Making Report: <?=boldText($reportData->declaration_name_of_person) ?></td>
            
           
                <td>Name of Person Making Report: <?=boldText(date("d-M-Y",$reportData->declaration_date)) ?></td>
            
            </tr>
            </table>

        <!-- MANAGER REPORT SECTION -->
        <div style="page-break-before:always">&nbsp;</div> 


        <center><h1 style="text-align: center;">Accident Investigation Form</h1></center>
            <table id="view_table" width="100%">
                <tr>
                    <td>Incident Type: <br> <?=boldText(@$dropdown['incident_type'][$reporManagertData->incident_type] ) ?></td>
                    <td>Affecting: <br><?=boldText(@$dropdown['affecting'][$reporManagertData->affecting]) ?></td>
                    <td>Compensation: <br><?=boldText(@$dropdown['compensation'][$reporManagertData->compensation]) ?></td>
                    
                </tr>
            </table>    
            <p  id="view_p">Affected Employee / Person</p>
            <table id="view_table" width="100%">
                <tr>
                    <td>Name:</td>
                    <td><?=boldText($reportData->a_surname.' '.$reportData->a_forename ) ?></td>
                </tr>
                <tr>
                    <td>Role & Department:</td>
                    <td><?=boldText($reportData->a_surname.' '.$reportData->a_forename ) ?></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><?=boldText($reportData->a_tel_no) ?></td>
                </tr>
                <tr>
                    <td>Date of Incident:</td>
                    <td><?=boldText(date("d-M-Y",$reportData->b_date)) ?></td>
                </tr>
                <tr>
                    <td>Time of Incident:</td>
                    <td><?=boldText(date("d-M-Y",$reportData->b_date)) ?></td>
                </tr>
                <tr>
                    <td>Location of Incident:</td>
                    <td><?=boldText($reportData->b_exact_location_site) ?></td>
                </tr>
                <tr>
                    <td>Supervisor Name:</td>
                    <td><?=boldText($reportData->a_employers_name) ?></td>
                </tr>
            </table>
            
            <p  id="view_p">Interviewees</p>
            <table id="view_table" width="100%">
                <tr>
                    <td></td>
                    <td>Interviewee 1</td>
                    <td>Interviewee 2</td>
                </tr>
                <tr>
                    <td>Name: </td>
                    <td><?=boldText($reporManagertData->interviewee1_name) ?></td>
                    <td><?=boldText($reporManagertData->interviewee2_name) ?></td>
                </tr>
                <tr>
                    <td>Role & Department: </td>
                    <td><?=boldText($reporManagertData->interviewee1_role) ?></td>
                    <td><?=boldText($reporManagertData->interviewee2_role) ?></td>
                </tr>
                <tr>
                    <td>Phone Number: </td>
                    <td><?=boldText($reporManagertData->interviewee1_telephone) ?></td>
                    <td><?=boldText($reporManagertData->interviewee2_telephone) ?></td>
                </tr>
            </table>
            
            <p  id="view_p">Investigator</p>
            <table id="view_table" width="100%">
                <tr>
                    <td>Name:</td>
                    <td><?=boldText($reporManagertData->investigator_name) ?></td>
                </tr>
                <tr>
                    <td>Role & Department:</td>
                    <td><?=boldText($reporManagertData->investigator_role) ?></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><?=boldText($reporManagertData->investigator_telephone) ?></td>
                </tr>               
                <tr>
                    <td>Date of Investigation</td>
                    <td><?=boldText(date("d-M-Y",$reportData->investigation_date)) ?></td>
                </tr>
                
            </table>

            <p  id="view_p">Incident Description</p>
            <table id="view_table" width="100%">
                <tr>
                    <td><?=boldText($reporManagertData->incident_description) ?></td>
                </tr>
            </table>

            <p  id="view_p">Interviewee 1 Statement</p>
            <table id="view_table" width="100%">
                <tr>
                    <td><?=boldText($reporManagertData->interviewee1_statement) ?></td>
                </tr>
            </table>

            <p  id="view_p">Interviewee 2 Statement</p>
            <table id="view_table" width="100%">
                <tr>
                    <td><?=boldText($reporManagertData->interviewee2_statement) ?></td>
                </tr>
            </table>

            <p  id="view_p">Contributors to Incident:</p>
            <table id="view_table" width="100%">
                <tr>
                    <td><?=boldText($reporManagertData->contributors_incident) ?></td>
                </tr>
            </table>

            <p  id="view_p">Results of Investigation:</p>
            <table id="view_table" width="100%">
                <tr>
                    <td><?=boldText($reporManagertData->results_investigation) ?></td>
                </tr>
            </table>
            <br>
            <table id="view_table" width="100%">
                <tr>
                    <td>Did the employee receive medical treatment? (give details)</td>
                    <td><?=boldText($reporManagertData->receive_medical_treatment) ?></td>
                </tr>
                <tr>
                    <td>Is there any lost time to report? (give details)</td>
                    <td><?=boldText($reporManagertData->lost_time_report) ?></td>
                </tr>
            </table>

            <p  id="view_p">Recommended Corrective Actions:</p>
            <table id="view_table" width="100%">
                <tr>
                    <td><?=boldText($reporManagertData->recommended_actions) ?></td>
                </tr>
            </table>

            <p  id="view_p">Please provide additional Information regarding specific corrective actions:</p>
            <table id="view_table" width="100%">
                <tr>
                    <td><?=boldText($reporManagertData->specifice_corrective_actions) ?></td>
                </tr>
            </table>

            <p  id="view_p">Please provide details of when the corrective actions have been completed</p>
            <table id="view_table" width="100%">
                <tr>
                    <td><?=boldText($reporManagertData->corrective_actions_completed) ?></td>
                </tr>
            </table>

            <p  id="view_p">Please detail any other materials including photographs</p>
            <table id="view_table" width="100%">
                <tr>
                    <td><?=boldText($reporManagertData->other_materials) ?></td>
                </tr>
            </table>
             
            <?php

      $html = ob_get_contents();
     
   
    ob_clean();    


    require_once($CFG->libdir.'/pdflib.php');

    $file_name = $user -> firstname ."-". $user -> lastname .'-'. $data -> id . '.pdf';
    $file_name = str_replace(" ","-", $file_name);

    $pdf = new pdf();
    $PDF_HEADER_LOGO       = '/local/mp_report/images/mh_logo_sm.png'; //any image file. check correct path.
    $PDF_HEADER_LOGO_WIDTH = "60%";
    $PDF_HEADER_TITLE      = "";
    $PDF_HEADER_STRING     = "";

    $pdf->SetMargins(15, 20, 15);
    $pdf->SetHeaderMargin(1);
    $pdf->SetFooterMargin(0);
    $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);


    $pdf -> AddPage();
    $pdf -> WriteHTML($html);
    $pdf -> Output( pdfs_path() . $file_name, 'F' );

    return $file_name;
}


function accident_pdf($acc_id) {

    global $homeurl,$DB, $CFG;

    $photo_path = $CFG->dataroot."/filedir/upload";
    $tableName  = get_string('accident_table','local_mp_report');
    $select['id']  = $acc_id;
    $data = $DB->get_record($tableName, $select);
    $user = get_userInfo( array("id" => $data -> user_id ));

    $manager    = get_userInfo( array("id" => $data -> user_manager ));
    $dropdown   = get_dropdown_data(1);
    $contracts  = $dropdown['contract'];
    $categories = $dropdown['category'];


    ob_start();
    ?>
    <style type="text/css">
        table { border-collapse: }
        td, th { font-family:Arial, Helvetica, sans-serif; font-size:7pt; line-height:12pt; padding: 8px; }
        th { text-align:right; }

        table.data-table td, table.data-table th { font-size:7pt; border:.5px solid #333; margin-top:10px; }

        table.data-table tr th { background-color:#f6f6f6; }

        .section-hd { font-weight:bold; border-bottom:.5px solid #333; }

    </style>

    <div style="font-size:10pt; text-align:center;">
        Accident Report
    </div>
    <table width="100%">
        <tr>
            <td colspan="2" style="padding-bottom:15px;">
                <table width="100%" style="border-bottom:.5px solid #333; padding-bottom:2px;">
                    <tr>
                        <td align="left"><strong><?= $user -> firstname?> <?= $user -> lastname?></strong></td>
                        <td align="right"><strong><?= date("d-M-Y G:i:s", $data -> accident_date)?></strong></td>
                    </tr>
                </table>
            </td>

        </tr>
        <tr>
            <td colspan="2">
                <div class="section-hd">User Details</div>
                <table width="100%" class="data-table">

                    <tr class="even">
                        <th width="15%">Occupation</th>
                        <td width="35%"><?= $data -> user_occupation?></td>
                        <th width="15%">Postcode</th>
                        <td width="35%"><?= $data -> user_postcode?></td>

                    </tr>
                    <tr>
                        <th>Contract</th>
                        <td><?= @$contracts[$data -> user_contract];?></td>
                        <th>Manager</th>
                        <td><?= $manager -> firstname?> <?= $manager -> lastname?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td colspan="3"><?= $data -> user_address?></td>
                    </tr>
                </table>
                <div class="section-hd">About the Person who had the accident</div>
                <table width="100%" class="data-table">
                    <tr>
                        <th width="15%">Name</th>
                        <td width="35%"><?= $data -> victim_name?></td>
                        <th width="15%">Occupation</th>
                        <td width="35%"><?= $data -> victim_occupation?></td>

                    </tr>
                    <tr>
                        <th>Postcode</th>
                        <td><?= $data -> victim_postcode?></td>
                        <th>Address</th>
                        <td><?= $data -> victim_address?></td>
                    </tr>
                </table>
            </td>

        </tr>

        <tr>
            <td colspan="2">
                <div class="section-hd">About the accident</div>
                <table width="100%" class="data-table">
                    <tr>
                        <th width="15%">Category</th>
                        <td width="35%"><?= @$categories[$data -> accident_category]?></td>
                        <th width="15%">Medical Treatment over first aid?</th>
                        <td width="35%"><?= $data -> accident_treatment?></td>
                    </tr>
                    <tr>
                        <th>Minor Injuries?</th>
                        <td><?= $data -> minor_injuries?></td>
                        <th>Date and Time of accident</th>
                        <td><?= date("d-M-Y G:i:s", $data -> accident_date)?> </td>

                    </tr>
                    <tr>
                        <th>Where did it happen</th>
                        <td><?= $data -> accident_place?></td>
                        <th>How did it happen and why</th>
                        <td><?= $data -> accident_reason?></td>
                    </tr>
                    <tr>
                        <th>Details of any injury suffered or treatment given</th>
                        <td colspan="3"><?= $data -> accident_detail?></td>

                    </tr>

                </table>
                <div class="section-hd">Accident Witness Report</div>
                <?php if($data -> accident_witnesses > 0) {?>
                    <table width="100%" class="data-table" >
                        <tr>
                            <th width="15%">Name of Witness </th>
                            <td width="35%"><?= decrypt($data -> witnesses_name)?></td>
                            <th width="15%">Home/Work Address </th>
                            <td width="35%"><?= decrypt($data -> witnesses_address)?></td>

                        </tr>
                        <tr>
                            <th> Telephone Number </th>
                            <td><?= decrypt($data -> witnesses_phone_number)?></td>
                            <th> Date of witness report </th>
                            <td><?= date("d-M-Y", $data -> witnesses_report_date)?></td>
                        </tr>
                        <tr>
                            <th colspan="4" style="text-align: left">Detail & Describe the occurrence and how it happened. Be specific, who? What? Why?, Where?, when?, how?. What Injuries to persons or damage to property occurred? </th>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <?= $data -> witnesses_report_details?>
                            </td>
                        </tr>

                    </table>
                <?php } ?>
            </td>

        </tr>
        <tr>
            <td colspan="2">
                <div class="section-hd">Photos</div><br />
                <table width="100%" style="margin-top:20px;">
                    <tr>
                        <?php
                        $c = 0;
                        for($i=1; $i<=6; $i++){
                        $photo = 'photo_'.$i;
                        if(!empty($data -> $photo) && file_exists( $photo_path."/".$data -> $photo )) {
                        $c++;?>
                        <td width="30%"><img src="<?= $photo_path."/".$data -> $photo;?>" width="130px"/></td>
                        <?php
                        if($i == 3) { ?></tr><tr> <?php }
                        }
                        else{
                            ?><td width="30%"></td> <?php
                        }
                        }
                        if($c == 0) { ?>
                            <span style="color:#F00"></span>
                        <?php }?>
                    </tr>

                </table>
            </td>
        </tr>

    </table>

    <?php

    $html = ob_get_contents();
    ob_clean();

    require_once($CFG->libdir.'/pdflib.php');

    $file_name = $user -> firstname ."-". $user -> lastname .'-'. $data -> id . '.pdf';
    $file_name = str_replace(" ","-", $file_name);

    $pdf = new pdf();
    $PDF_HEADER_LOGO       = '/local/mp_report/images/mh_logo_sm.png'; //any image file. check correct path.
    $PDF_HEADER_LOGO_WIDTH = "60%";
    $PDF_HEADER_TITLE      = "";
    $PDF_HEADER_STRING     = "";

    $pdf->SetMargins(15, 20, 15);
    $pdf->SetHeaderMargin(1);
    $pdf->SetFooterMargin(0);
    $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);


    $pdf -> AddPage();
    $pdf -> WriteHTML($html);
    $pdf -> Output( pdfs_path() . $file_name, 'F' );

    return $file_name;
}
function incident_pdf($inc_id) {

    global $homeurl,$DB, $CFG;

    $photo_path = $CFG->dataroot."/filedir/upload";

    $select['id']  = $inc_id;

    $tableName  = get_string('incident_table','local_mp_report');
    $data = $DB->get_record($tableName, $select);

    if($data -> report_category == 29) $report_title = "Near Miss Report";
    if($data -> report_category == 30) $report_title = "Hazard Report";
    if($data -> report_category == 31) $report_title = "Incident Report";

    $user = get_userInfo( array("id" => $data -> user_id ));
    $manager = get_userInfo( array("id" => $data -> manager ));
    $contracts = get_dropdown_data(2,'contract')['contract'];
    $report_categories = get_dropdown_data(2,'report_category')['report_category'];



    ///echo '<pre>'; print_r($contracts); echo '</pre>';

    ob_start();
    ?>
    <style type="text/css">
        table { border-collapse: }
        td, th { font-family:Arial, Helvetica, sans-serif; font-size:7pt; line-height:12pt; }
        th { text-align:right; }

        table.data-table td, table.data-table th { font-size:7pt; border:.5px solid #333; margin-top:10px; }

        table.data-table tr th { background-color:#f6f6f6; }

        .section-hd { font-weight:bold; border-bottom:.5px solid #333; }

    </style>

    <div style="font-size:10pt; text-align:center;">
        <?=$report_title?>
    </div>
    <table width="100%">
        <tr>
            <td style="padding-bottom:15px;">
                <table width="100%" style="border-bottom:.5px solid #333; padding-bottom:2px;">
                    <tr>
                        <td align="left"><strong><?= $user -> firstname?> <?= $user -> lastname?></strong></td>
                        <td align="right"><strong><?= date("d-M-Y G:i:s", $data -> i_date)?></strong></td>
                    </tr>
                </table>
            </td>

        </tr>
        <tr>
            <td>
                <div class="section-hd">Details</div>
                <table width="100%" class="data-table">

                    <tr class="even">
                        <th>Contract</th>
                        <td><?= $contracts[$data -> contact];?></td>
                        <th>Manager</th>
                        <td><?= $manager -> firstname?> <?= $manager -> lastname?></td>

                    </tr>
                    <tr>
                        <th>Date of Incident</th>
                        <td><?= date("d-M-Y G:i:s", $data -> i_date)?></td>
                        <th>Day/Night</th>
                        <td><?= $data -> day_night?></td>
                    </tr>

                    <tr>
                        <th>Location</th>
                        <td><?= $data -> location?></td>
                        <th>Lone Worker?</th>
                        <td><?= $data -> lone_worker?></td>
                    </tr>
                    <tr>
                        <th>What did you observe?</th>
                        <td colspan="3"><?= $data -> what_observe?></td>
                    </tr>

                    <tr>
                        <th>What, if any, actions were taken?</th>
                        <td colspan="3"><?= $data -> action_taken?></td>
                    </tr>

                    <tr>
                        <th>What could have happened?</th>
                        <td colspan="3"><?= $data -> what_could_happened?></td>
                    </tr>

                    <tr>
                        <th>Report Category </th>
                        <td colspan="3"><?= $report_categories[$data -> report_category];?></td>
                    </tr>
                </table>
            </td>
        </tr>


        <tr>
            <td>
                <div class="section-hd">Photos</div><br />
                <table width="100%" style="margin-top:20px;">
                    <tr>
                        <?php
                        $c = 0;
                        for($i=1; $i<=6; $i++){
                            $photo = 'photo_'.$i;
                            if(!empty($data -> $photo) && file_exists( $photo_path."/".$data -> $photo )) {
                                $c++;?>
                                <td><img src="<?= $photo_path."/".$data -> $photo;?>" width="150"/></td>
                                <?php
                                if($c == 3) { echo '</tr><tr>'; $c=0;}
                            }
                            else{
                                echo "<td></td>";
                            }
                        }
                        if($c == 0) { ?>
                            <span style="color:#F00"></span>
                        <?php }?>
                    </tr>

                </table>
            </td>
        </tr>

    </table>

    <?php

    $html = ob_get_contents();
    ob_clean();

    require_once($CFG->libdir.'/pdflib.php');

    $file_name = $user -> firstname ."-". $user -> lastname .'-'.$data -> id . '.pdf';
    $file_name = str_replace(" ","-", $file_name);

    $pdf = new pdf();
    $PDF_HEADER_LOGO       = '/local/mp_report/images/mh_logo_sm.png'; //any image file. check correct path.
    $PDF_HEADER_LOGO_WIDTH = "60%";
    $PDF_HEADER_TITLE      = "";
    $PDF_HEADER_STRING     = "";

    $pdf->SetMargins(15, 20, 15);
    $pdf->SetHeaderMargin(1);
    $pdf->SetFooterMargin(0);
    $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

    $pdf -> AddPage();
    $pdf -> WriteHTML($html);
    $pdf -> Output( pdfs_path() . $file_name, 'F' );

    return $file_name;
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

function create_accident($dataobject){
    global $CFG,$OUTPUT,$homeurl,$successurl, $USER;

    $tableName = get_string('new_accident_table','local_mp_report');


    if(!empty($dataobject)){

        //$photo_1  = isset($dataobject['photo_1']) ?  $dataobject['photo_1'] : null;
        //$photo_2  = isset($dataobject['photo_2']) ?  $dataobject['photo_2'] : null;
        //$photo_3  = isset($dataobject['photo_3']) ?  $dataobject['photo_3'] : null;
        //$photo_4  = isset($dataobject['photo_4']) ?  $dataobject['photo_4'] : null;
        //$photo_5  = isset($dataobject['photo_5']) ?  $dataobject['photo_5'] : null;
        //$photo_6  = isset($dataobject['photo_6']) ?  $dataobject['photo_6'] : null;

        //unset($dataobject['photo_1']);
        //unset($dataobject['photo_2']);
        //unset($dataobject['photo_3']);
        //unset($dataobject['photo_4']);
        //unset($dataobject['photo_5']);
        //unset($dataobject['photo_6']);

        $dataobject['submitter_to_manager'] = 'Yes';


        $id = api_save_data($dataobject,$tableName);

        if(!empty($id) ){

            //$updateData['id'] =  $id;
            //$updateData['photo_1'] = processFile('photo_1',$photo_1, 'accident',  $id);
            //$updateData['photo_2'] = processFile('photo_2',$photo_2, 'accident',  $id);
            //$updateData['photo_3'] = processFile('photo_3',$photo_3, 'accident',  $id);
            //$updateData['photo_4'] = processFile('photo_4',$photo_4, 'accident',  $id);
            //$updateData['photo_5'] = processFile('photo_5',$photo_5, 'accident',  $id);
            //$updateData['photo_6'] = processFile('photo_6',$photo_6, 'accident',  $id);

            //update_data($updateData, get_string('accident_table', 'local_mp_report'));

            $pdf_file = accident_pdf($id);
            $report_title = "Accident Report";
            $subject = "Notification of Accident Report";
            $message = "A new accident report has been submitted. Please see the attached report.";
            //send_email_to_manager($dataobject['user_manager'],"Makehappen", $subject, $message, pdfs_email_attachment().$pdf_file, $pdf_file,$report_title);
            send_mp_report_email("Makehappen", $subject, $message, pdfs_email_attachment() . $pdf_file, $pdf_file,$report_title);

            return array("id" => $id);
        }
        else{
            return null;
        }

    }

}



function create_incident($dataobject){
    global $CFG,$OUTPUT,$homeurl,$successurl, $USER;
    $tableName = get_string('incident_table','local_mp_report');


    if(!empty($dataobject)){

        $photo_1  = isset($dataobject['photo_1']) ?  $dataobject['photo_1'] : null;
        $photo_2  = isset($dataobject['photo_2']) ?  $dataobject['photo_2'] : null;
        $photo_3  = isset($dataobject['photo_3']) ?  $dataobject['photo_3'] : null;
        $photo_4  = isset($dataobject['photo_4']) ?  $dataobject['photo_4'] : null;
        $photo_5  = isset($dataobject['photo_5']) ?  $dataobject['photo_5'] : null;
        $photo_6  = isset($dataobject['photo_6']) ?  $dataobject['photo_6'] : null;

        unset($dataobject['photo_1']);
        unset($dataobject['photo_2']);
        unset($dataobject['photo_3']);
        unset($dataobject['photo_4']);
        unset($dataobject['photo_5']);
        unset($dataobject['photo_6']);

        $dataobject['submitter_to_manager'] = 'Yes';

        $dataobject['witnesses_name']         = !empty($dataobject['witnesses_name']) ? encrypt($dataobject['witnesses_name']) : NULL;
        $dataobject['witnesses_address']      = !empty($dataobject['witnesses_address']) ? encrypt($dataobject['witnesses_address']) : NULL;;
        $dataobject['witnesses_phone_number'] = !empty($dataobject['witnesses_phone_number']) ? encrypt($dataobject['witnesses_phone_number']) : NULL;

        $id = api_save_data($dataobject,$tableName);

        if(!empty($id)){

            $updateData['id'] =  $id;
            $updateData['photo_1'] = processFile('photo_1',$photo_1, 'incident',  $id);
            $updateData['photo_2'] = processFile('photo_2',$photo_2, 'incident',  $id);
            $updateData['photo_3'] = processFile('photo_3',$photo_3, 'incident',  $id);
            $updateData['photo_4'] = processFile('photo_4',$photo_4, 'incident',  $id);
            $updateData['photo_5'] = processFile('photo_5',$photo_5, 'incident',  $id);
            $updateData['photo_6'] = processFile('photo_6',$photo_6, 'incident',  $id);

            update_data($updateData, get_string('incident_table', 'local_mp_report'));

            $pdf_file = incident_pdf($id);
            $subject = "";
            $message = "";
            $send_to_client = 0;
            $report_title = "";

            switch($dataobject['report_category']) {
                case 29:
                    $subject = "Notification of Near Miss Report from Makehappen";
                    $message = "A new Near Miss report has been submitted by Makehappen. Please see the attached report.";
                    $send_to_client =1;
                    $report_title = "Near Miss Report";
                    break;
                case 30:
                    $subject = "Notification of Hazard Report from Makehappen";
                    $message = "A new Hazard report has been submitted by Makehappen. Please see the attached report.";
                    $send_to_client =1;
                    $report_title = "Hazard Report";
                    break;
                case 31:
                    $subject = "Notification of Incident Report";
                    $message = "A new Incident report has been submitted. Please see the attached report.";
                    $report_title = "Incident Report";
                    break;
            }

            send_email_to_manager($dataobject['manager'],"Makehappen", $subject, $message, pdfs_email_attachment().$pdf_file, $pdf_file,$report_title);
            if($send_to_client==1) {
                send_email_to_client($dataobject['contact'], "Makehappen", $subject, $message, pdfs_email_attachment() . $pdf_file, $pdf_file,$report_title);
            }
            send_mp_report_email("Makehappen", $subject, $message, pdfs_email_attachment().$pdf_file, $pdf_file,$report_title);


            return array("id" =>$id);
        }
        else{
            return null;
        }

    }

}

function accident_full_pdf($acc_id) {

    global $homeurl,$DB, $CFG;

    $photo_path = $CFG->dataroot."/filedir/upload";
    $tableName  = get_string('accident_table','local_mp_report');
    $select['id']  = $acc_id;
    $data = $DB->get_record($tableName, $select);
    $user = get_userInfo( array("id" => $data -> user_id ));

    $manager    = get_userInfo( array("id" => $data -> user_manager ));
    $dropdown   = get_dropdown_data(1);
    $contracts  = $dropdown['contract'];
    $categories = $dropdown['category'];


    ob_start();
    ?>
    <style type="text/css">
        table { border-collapse: }
        td, th { font-family:Arial, Helvetica, sans-serif; font-size:7pt; line-height:12pt; padding: 8px; }
        th { text-align:left; }

        table.data-table td, table.data-table th { font-size:7pt; border:.5px solid #333; margin-top:10px; }

        table.data-table tr th { background-color:#f6f6f6; }

        .section-hd { font-weight:bold; border-bottom:.5px solid #333; padding: 3px !important; }

    </style>

    <div style="font-size:12pt; text-align:center;">
        Accident Report
    </div>

    <table width="100%" >
        <tr>
            <td colspan="2" style="padding-bottom:15px;">
                <table width="100%" style="border-bottom:.5px solid #333; padding-bottom:2px;">
                    <tr>
                        <td align="left"><strong><?= $user -> firstname?> <?= $user -> lastname?></strong></td>
                        <td align="right"><strong><?= date("d-M-Y G:i:s", $data -> accident_date)?></strong></td>
                    </tr>
                </table>
            </td>

        </tr>
        <tr>
            <td colspan="2">
                <div class="section-hd">User Details</div>
                <table width="100%" class="data-table" >

                    <tr class="even">
                        <th width="15%">Occupation</th>
                        <td width="35%"><?= $data -> user_occupation?></td>
                        <th width="15%">Postcode</th>
                        <td width="35%"><?= $data -> user_postcode?></td>

                    </tr>
                    <tr>
                        <th>Contract</th>
                        <td><?= @$contracts[$data -> user_contract];?></td>
                        <th>Manager</th>
                        <td><?= $manager -> firstname?> <?= $manager -> lastname?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td colspan="3"><?= $data -> user_address?></td>
                    </tr>
                </table>
                <div class="section-hd">About the Person who had the accident</div>
                <table width="100%" class="data-table">
                    <tr>
                        <th width="15%">Name</th>
                        <td width="35%"><?= $data -> victim_name?></td>
                        <th width="15%">Occupation</th>
                        <td width="35%"><?= $data -> victim_occupation?></td>

                    </tr>
                    <tr>
                        <th>Postcode</th>
                        <td><?= $data -> victim_postcode?></td>
                        <th>Address</th>
                        <td><?= $data -> victim_address?></td>
                    </tr>
                </table>
            </td>

        </tr>

        <tr>
            <td colspan="2">
                <div class="section-hd">About the accident</div>
                <table width="100%" class="data-table" >
                    <tr>
                        <th width="15%">Category</th>
                        <td width="35%"><?= @$categories[$data -> accident_category]?></td>
                        <th width="15%">Medical Treatment over first aid?</th>
                        <td width="35%"><?= $data -> accident_treatment?></td>
                    </tr>
                    <tr>
                        <th>Minor Injuries?</th>
                        <td><?= $data -> minor_injuries?></td>
                        <th>Date and Time of accident</th>
                        <td><?= date("d-M-Y G:i:s", $data -> accident_date)?> </td>

                    </tr>
                    <tr>
                        <th>Where did it happen</th>
                        <td><?= $data -> accident_place?></td>
                        <th>How did it happen and why</th>
                        <td><?= $data -> accident_reason?></td>
                    </tr>
                    <tr>
                        <th>Details of any injury suffered or treatment given</th>
                        <td colspan="3"><?= $data -> accident_detail?></td>

                    </tr>

                </table>
                <div class="section-hd">Accident Witness Report</div>
                <?php if($data -> accident_witnesses > 0) {?>
                    <table width="100%" class="data-table">
                        <tr>
                            <th width="15%">Name of Witness </th>
                            <td width="35%"><?= decrypt($data -> witnesses_name)?></td>
                            <th width="15%">Home/Work Address </th>
                            <td width="35%"><?= decrypt($data -> witnesses_address)?></td>

                        </tr>
                        <tr>
                            <th> Telephone Number </th>
                            <td><?= decrypt($data -> witnesses_phone_number)?></td>
                            <th> Date of witness report </th>
                            <td><?= date("d-M-Y", $data -> witnesses_report_date)?></td>
                        </tr>
                        <tr>
                            <th colspan="4" style="text-align: left">Detail & Describe the occurrence and how it happened. Be specific, who? What? Why?, Where?, when?, how?. What Injuries to persons or damage to property occurred? </th>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <?= $data -> witnesses_report_details?>
                            </td>
                        </tr>

                    </table>
                <?php } ?>
            </td>

        </tr>
    </table>

    <table width="100%"  >
        <tr>
            <td colspan="2">
                <div class="section-hd">Photos</div><br>

                <table width="100%" border="0" >
                    <tr>
                        <?php
                        $c = 0;
                        for($i=1; $i<=6; $i++){
                        $photo = 'photo_'.$i;
                        if(!empty($data -> $photo) && file_exists( $photo_path."/".$data -> $photo )) {
                            $c++;?>
                            <td width="32%" style="margin-bottom: 10px; padding: 5px;"><img src="<?= $photo_path."/".$data -> $photo;?>" style="115px; height:125px;border:1px solid #CCC;"/><br> Photo <?=$i;?></td>
                            <?php

                        }
                        else{
                            ?> <td width='30%'></td> <?php
                        }

                        if($i == 3) { ?> </tr><tr> <?php }
                        }
                        ?>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
    <br pagebreak="true"/>
    <table width="100%" >
        <tr>
            <td style="padding: 0px !important;margin-bottom: 10px; !important;">
                <div class="section-hd">Line Manager Review</div>
            </td>
        </tr>

    </table>
    <table width="100%" class="data-table"  >

    <?php if(!empty($data->manager_id)) {?>

        <?php
        $managerList  = get_manager_list();
        $dropdown   = get_dropdown_data(1);
        ?>

        <tr >
            <th colspan="4"><?= get_string('manager_name', 'local_mp_report')?></th>
        </tr>
        <tr>
            <td colspan="4"> <?= $managerList[$data->manager_id]?></td>
        </tr>
        </table>

        <table width="100%" class="data-table"  >
            <tr>
                <th colspan="4"><?= get_string('accident_additional_details','local_mp_report')?></th>
            </tr>
            <tr>
                <td colspan="4"><?= $data->accident_additional_details?></td>
            </tr>
        </table>


        <table width="100%" class="data-table"  >
            <tr>
                <th colspan="4"><?= get_string('additional_details','local_mp_report')?></th>
            </tr>
            <tr>
                <td colspan="4"><?= $data->additional_details?></td>
            </tr>
        </table>

        <table width="100%" class="data-table"  style="page-break-inside:avoid">
            <tr>
                <th colspan="4"><?= get_string('root_cause','local_mp_report')?></th>
            </tr>
            <tr>
                <td colspan="4"><?= $data->root_cause?></td>
            </tr>
        </table>


        <table width="100%" class="data-table"  style="page-break-inside:avoid">
            <tr>
                <th colspan="4"><?= get_string('immediate_action','local_mp_report')?></th>
            </tr>
            <tr>
                <td colspan="4"><?= $data->immediate_action?></td>
            </tr>
        </table>


        <table width="100%" class="data-table"  style="page-break-inside:avoid">
            <tr>
                <th  colspan="4"><?= get_string('further_action_required','local_mp_report')?></th>
            </tr>
            <tr>
                <td  colspan="4"><?= $data->further_action_required?></td>
            </tr>
        </table>

        <table width="100%" class="data-table"  style="page-break-inside:avoid">
            <tr>
                <th width="15%"><?= get_string('lost_time','local_mp_report')?></th>
                <td width="35%"><?= $data->lost_time?></td>
                <th width="15%"><?= get_string('lost_time_days','local_mp_report')?></th>
                <td width="35%"><?= $data->lost_time_days?></td>
            </tr>
            <tr>
                <th><?= get_string('mgt_review_report_date','local_mp_report')?></th>
                <td><?= date('d-M-Y',$data->mgt_review_report_date)?></td>
                <th><?= get_string('mgt_review_status','local_mp_report')?></th>
                <td><?= @$dropdown['mgt_review_status'][$data->mgt_review_status]?></td>
            </tr>
        </table>

        <table width="100%" class="data-table"  style="page-break-inside:avoid">
            <tr>
                <th colspan="4"><?= get_string('mgt_review_comments','local_mp_report')?></th>
            </tr>
            <tr>
                <td colspan="4"><?= $data->mgt_review_comments?></td>
            </tr>

        </table>

        <table width="100%" >
            <tr>
                <td style="padding: 0px !important;margin-bottom: 10px; !important;">
                    <div class="section-hd">Senior Management Report</div>
                </td>
            </tr>

        </table>

    <?php }?>
    <?php
    if (!empty($data->s_mgt_rpt_report_date)){
        if(!empty($data->manager_id) and (is_senior_manager() or is_complieance() or is_admin())) {
            ?>

            <?php
            $senior_manager_list  = get_s_manager_and_complience_list();
            ?>
            <table width="100%" class="data-table" style="page-break-inside:avoid">
                <tr>
                    <th width="15%"><?= get_string('s_mgt_rpt_name', 'local_mp_report')?></th>
                    <td width="35%"><?= $senior_manager_list[$data->s_mgt_rpt_name]?></td>
                    <th width="15%"><?= get_string('s_mgt_rpt_report_date','local_mp_report')?></th>
                    <td width="35%"><?= date('d-M-Y',$data->s_mgt_rpt_report_date)?></td>
                </tr>
            </table>
            <table width="100%" class="data-table" style="page-break-inside:avoid">
                <tr>
                    <th><?= get_string('s_mgt_rpt_comments','local_mp_report')?></th>
                </tr>
                <tr>
                    <td><?= $data->s_mgt_rpt_comments?></td>
                </tr>
            </table>
            <table width="100%" class="data-table" style="page-break-inside:avoid">
                <tr>
                    <th><?= get_string('s_mgt_rpt_f_action','local_mp_report')?></th>
                </tr>
                <tr>
                    <td><?= @$dropdown['further_action'][$data->s_mgt_rpt_f_action]?></td>
                </tr>
            </table>

            <table width="100%" class="data-table" style="page-break-inside:avoid">
                <tr>
                    <th><?= get_string('s_mgt_rpt_f_a_comment','local_mp_report')?></th>
                    <td><?= $data->s_mgt_rpt_f_a_comment?></td>
                </tr>
            </table>
            <table width="100%" class="data-table" style="page-break-inside:avoid">
                <tr>
                    <th><?= get_string('s_mgt_rpt_2508_completed','local_mp_report')?></th>
                    <td><?= $dropdown['yes_no'][$data->s_mgt_rpt_2508_completed]?></td>
                </tr>
            </table>
            <table width="100%" class="data-table" style="page-break-inside:avoid">
                <tr>
                    <th><?= get_string('s_mgt_rpt_2508_cpt_date','local_mp_report')?></th>
                    <td><?= date('d-M-Y',$data->s_mgt_rpt_2508_cpt_date)?></td>
                    <th><?= get_string('s_mgt_rpt_riddor_event_clf','local_mp_report')?></th>
                    <td><?= $dropdown['riddor_classification'][$data->s_mgt_rpt_riddor_event_clf]?></td>
                </tr>
                <tr>
                    <th><?= get_string('s_mgt_rpt_riddor_subcategory','local_mp_report')?></th>
                    <td><?= $dropdown['RIDDOR_subcategory'][$data->riddor_subcategory]?></td>
                    <th><?= get_string('s_mgt_rpt_reported_en_a','local_mp_report')?></th>
                    <td><?= $dropdown['yes_no'][$data->s_mgt_rpt_reported_en_a]?></td>
                </tr>
                <tr>
                    <th><?= get_string('s_mgt_rpt_reported_en_a_date','local_mp_report')?></th>
                    <td><?= date('d-M-Y',$data->s_mgt_rpt_reported_en_a_date)?></td>
                    <th><?= get_string('s_mgt_rpt_sr_mgr_notified','local_mp_report')?></th>
                    <td><?= $dropdown['yes_no'][$data->s_mgt_rpt_sr_mgr_notified]?></td>
                </tr>
                <tr>
                    <th><?= get_string('s_mgt_rpt_sr_mgr_notified_date','local_mp_report')?></th>
                    <td><?= date('d-M-Y',$data->s_mgt_rpt_sr_mgr_notified_date)?></td>
                    <th><?= get_string('s_mgt_rpt_in_br_informed','local_mp_report')?></th>
                    <td><?= $dropdown['yes_no'][$data->s_mgt_rpt_in_br_informed]?></td>
                </tr>
                <tr>
                    <th><?= get_string('s_mgt_rpt_ant_closed_off','local_mp_report')?></th>
                    <td><?php if($data->s_mgt_rpt_ant_closed_off==1) echo "Yes";else echo  "No";?></td>
                    <th><?= get_string('s_mgt_rpt_ant_closed_off_date','local_mp_report')?></th>
                    <td><?= date('d-M-Y',$data->s_mgt_rpt_ant_closed_off_date)?></td>
                </tr>
            </table>

        <?php }?>
    <?php }?>


    <?php

    $html = ob_get_contents();

    ob_clean();



    require_once($CFG->libdir.'/pdflib.php');

    $file_name = $user -> firstname ."-". $user -> lastname .'-'. $data -> id . '.pdf';
    $file_name = str_replace(" ","-", $file_name);

    $pdf = new pdf();


    $PDF_HEADER_LOGO       = '/local/mp_report/images/mh_logo_sm.png'; //any image file. check correct path.
    $PDF_HEADER_LOGO_WIDTH = "60%";
    $PDF_HEADER_TITLE      = "";
    $PDF_HEADER_STRING     = "";

    $pdf->SetMargins(15, 20, 15);
    $pdf->SetHeaderMargin(1);
    $pdf->SetFooterMargin(0);
    $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);


    $pdf -> addPage();
    $pdf -> autoPageBreak = false;
    $pdf -> WriteHTML($html);
    $pdf -> Output( pdfs_path() . $file_name, 'F' );

    return $file_name;
}

function incident_full_pdf($inc_id) {

    global $homeurl,$DB, $CFG;

    $photo_path = $CFG->dataroot."/filedir/upload";

    $select['id']  = $inc_id;

    $tableName  = get_string('incident_table','local_mp_report');
    $data = $DB->get_record($tableName, $select);

    if(!empty($data->is_correct_report_category)){
        if ($data->correct_report_category == 29) $report_title = "Near Miss Report";
        if ($data->correct_report_category == 30) $report_title = "Hazard Report";
        if ($data->correct_report_category == 31) $report_title = "Incident Report";
    }else {
        if ($data->report_category == 29) $report_title = "Near Miss Report";
        if ($data->report_category == 30) $report_title = "Hazard Report";
        if ($data->report_category == 31) $report_title = "Incident Report";
    }

    $user = get_userInfo( array("id" => $data -> user_id ));
    $manager = get_userInfo( array("id" => $data -> manager ));
    $contracts = get_dropdown_data(2,'contract')['contract'];
    $report_categories = get_dropdown_data(2,'report_category')['report_category'];



    ///echo '<pre>'; print_r($contracts); echo '</pre>';

    ob_start();
    ?>
    <style type="text/css">
        table { border-collapse: }
        td, th { font-family:Arial, Helvetica, sans-serif; font-size:7pt; line-height:12pt; padding: 8px; }
        th { text-align:left; }

        table.data-table td, table.data-table th { font-size:7pt; border:.5px solid #333; margin-top:10px; }

        table.data-table tr th { background-color:#f6f6f6; }

        .section-hd { font-weight:bold; border-bottom:.5px solid #333; padding: 3px !important; }

    </style>

    <div style="font-size:10pt; text-align:center;">
        <?=$report_title?>
    </div>
    <table width="100%">
        <tr>
            <td style="padding-bottom:15px;">
                <table width="100%" style="border-bottom:.5px solid #333; padding-bottom:2px;">
                    <tr>
                        <td align="left"><strong><?= $user -> firstname?> <?= $user -> lastname?></strong></td>
                        <td align="right"><strong><?= date("d-M-Y G:i:s", $data -> i_date)?></strong></td>
                    </tr>
                </table>
            </td>

        </tr>
        <tr>
            <td>
                <div class="section-hd">Details</div>
                <table width="100%" class="data-table">

                    <tr class="even">
                        <th width="15%">Contract</th>
                        <td width="35%"><?= $contracts[$data -> contact];?></td>
                        <th width="15%">Manager</th>
                        <td width="35%"><?= $manager -> firstname?> <?= $manager -> lastname?></td>

                    </tr>
                    <tr>
                        <th>Date of Incident</th>
                        <td><?= date("d-M-Y G:i:s", $data -> i_date)?></td>
                        <th>Day/Night</th>
                        <td><?= $data -> day_night?></td>
                    </tr>

                    <tr>
                        <th>Location</th>
                        <td><?= $data -> location?></td>
                        <th>Lone Worker?</th>
                        <td><?= $data -> lone_worker?></td>
                    </tr>
                    <tr>
                        <th>What did you observe?</th>
                        <td colspan="3"><?= $data -> what_observe?></td>
                    </tr>
                    <tr>
                        <th>What, if any, actions were taken?</th>
                        <td colspan="3"><?= $data -> action_taken?></td>
                    </tr>

                    <tr>
                        <th>What could have happened?</th>
                        <td colspan="3"><?= $data -> what_could_happened?></td>
                    </tr>

                    <tr>
                        <th>Report Category </th>
                        <td colspan="3"><?= $report_categories[$data -> report_category];?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <div class="section-hd">Photos</div><br />
                <table width="100%" style="margin-top:20px;">
                    <tr>
                        <?php
                        $c = 0;
                        for($i=1; $i<=6; $i++){
                        $photo = 'photo_'.$i;
                        if(!empty($data -> $photo) && file_exists( $photo_path."/".$data -> $photo )) {
                            $c++;?>
                            <td width="32%" style="margin-bottom: 10px; padding: 5px;"><img src="<?= $photo_path."/".$data -> $photo;?>" style="115px; height:125px;border:1px solid #CCC;"/><br> Photo <?=$i;?></td>
                            <?php

                        }
                        else{
                            ?> <td width='30%'></td> <?php
                        }

                        if($i == 3) { ?> </tr><tr> <?php }

                        }
                        ?>
                    </tr>

                </table>
            </td>
        </tr>

        <br pagebreak="true"/>
        <?php
        if (!empty($data->is_correct_report_category)) {
            $dropdown2 = get_dropdown_data(2); ?>
            <tr>
                <td>
                    <div class="section-hd">Management Review</div>
                    <table width="100%" class="data-table">
                        <tr class="even">
                            <th width="15%"><?= get_string('is_correct_report_category', 'local_mp_report') ?></th>
                            <td width="35%"><?= $data->is_correct_report_category; ?></td>
                            <th width="15%"><?= get_string('correct_report_category', 'local_mp_report') ?></th>
                            <td width="35%"><?= $dropdown2['report_category'][$data->correct_report_category] ?></td>

                        </tr>
                        <tr>
                            <th><?= get_string('classification', 'local_mp_report') ?></th>
                            <td><?= $dropdown2['classification'][$data->classification] ?></td>
                            <th><?= get_string('categorisation', 'local_mp_report') ?></th>
                            <td><?= $dropdown2['categorisation'][$data->categorisation] ?></td>
                        </tr>
                        <tr>
                            <th><?= get_string('vehicles', 'local_mp_report') ?></th>
                            <td><?= $dropdown2['vehicle'][$data->vehicles] ?></td>
                            <th><?= get_string('equipment', 'local_mp_report') ?></th>
                            <td><?= $dropdown2['equipment'][$data->equipment] ?></td>
                        </tr>
                        <tr>
                            <th><?= get_string('environmental', 'local_mp_report') ?></th>
                            <td><?= $dropdown2['environment'][$data->environmental] ?></td>
                            <th><?= get_string('attack', 'local_mp_report') ?></th>
                            <td><?= $dropdown2['attack'][$data->action_taken] ?></td>
                        </tr>
                        <tr>
                            <th><?= get_string('further_action', 'local_mp_report') ?></th>
                            <td colspan="3"><?= $data->further_action ?></td>
                        </tr>
                        <tr>
                            <th><?= get_string('lost_time', 'local_mp_report') ?></th>
                            <td><?= $data->lost_time; ?></td>
                            <th><?= get_string('lost_time_days', 'local_mp_report') ?></th>
                            <td><?= $data->lost_time_days ?></td>

                        </tr>
                        <tr>
                            <th><?= get_string('report_to_client', 'local_mp_report') ?></th>
                            <td><?= $dropdown2['yes_no'][$data->report_to_client] ?></td>
                            <th><?= get_string('report_priority', 'local_mp_report') ?></th>
                            <td><?= $dropdown2['report_priority'][$data->report_priority] ?></td>

                        </tr>
                        <tr>
                            <th><?= get_string('contact_details', 'local_mp_report') ?></th>
                            <td colspan="3"><?= $data->contact_details; ?></td>
                        </tr>
                        <tr>
                            <th><?= get_string('meeting_date', 'local_mp_report') ?></th>
                            <td><?= date("d-M-Y",$data->meeting_date) ?></td>
                            <th><?= get_string('added_to_rvt_calm_system', 'local_mp_report') ?></th>
                            <td><?= $dropdown2['calm_systems'][$data->added_to_rvt_calm_system] ?></td>
                        </tr>
                        <tr>
                            <th><?= get_string('report_closed', 'local_mp_report') ?></th>
                            <td colspan="3"><?= $data->report_closed ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php
        }


        /*
    if(!empty($data->manager_id)  and (is_complieance() or is_admin() ) ) {
        $compliance_list = get_compliance_list();
        ?>
        <tr>
            <td>
                <div class="section-hd">Compliance Review</div>
                <table width="100%" class="data-table">
                    <tr class="even">
                        <th><?= get_string('reviewer', 'local_mp_report') ?></th>
                        <td><?= $compliance_list[$data->compliance_id] ?></td>
                        <th><?= get_string('change_required', 'local_mp_report') ?></th>
                        <td><?php $data->change_required ?></td>

                    </tr>
                    <tr>




                        <th><?= get_string('details_change_required', 'local_mp_report') ?></th>
                        <td colspan="3"><?= $data->details_change_required ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    <?php
    }
    */?>


    </table>

    <?php

    $html = ob_get_contents();
    ob_clean();

    require_once($CFG->libdir.'/pdflib.php');

    $file_name = $user -> firstname ."-". $user -> lastname .'-'.$data -> id . '.pdf';
    $file_name = str_replace(" ","-", $file_name);

    $pdf = new pdf();

    $PDF_HEADER_LOGO       = '/local/mp_report/images/mh_logo_sm.png'; //any image file. check correct path.
    $PDF_HEADER_LOGO_WIDTH = "60%";
    $PDF_HEADER_TITLE      = "";
    $PDF_HEADER_STRING     = "";

    $pdf->SetMargins(15, 20, 15);
    $pdf->SetHeaderMargin(1);
    $pdf->SetFooterMargin(0);
    $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

    $pdf -> AddPage();
    $pdf -> WriteHTML($html);
    $pdf -> Output( pdfs_path() . $file_name, 'F' );

    return $file_name;
}
