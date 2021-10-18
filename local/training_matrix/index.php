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

ini_set('memory_limit', '2048M');
ini_set('max_execution_time', 0);
ini_set('upload_max_filesize', "512M");
ini_set('post_max_size', "1024M");
// Globals.
global $CFG, $OUTPUT, $USER, $SITE, $PAGE;
$pluginname = 'training_matrix';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
require_once($CFG->dirroot.'/local/'.$pluginname.'/functions.php');  // Include our function library.

require_login();


// Heading ==========================================================.

$title   = get_string('pluginname', 'local_'.$pluginname);
$heading = get_string('heading', 'local_'.$pluginname);
$url     = new moodle_url('/local/'.$pluginname.'/index.php');


$context = context_system::instance();


$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);

echo $OUTPUT->header();

$uploadLink = "";

echo $html1 = '<h3>Certificates</h3><hr>
                 <div class="row" style="text-align: left !important;">
                
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/training_matrix/mycertificates.php" data-ccn-c="color3" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(234, 38, 227, 0.6);">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="fa fa-files-o"></span></div>
							<div class="details">
								<h5 class="color-white">My Certificates</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
            
          </div>';

if(is_admin() || is_complieance() || is_senior_manager()) {


    echo $html3 = '<h3> Reports</h3><hr>
                 <div class="row" style="text-align: left !important;">
                
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/training_matrix/expiring_certificates_report.php" data-ccn-c="color3" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(241, 67, 45, 0.6);">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="fa fa-file-archive-o"></span></div>
							<div class="details">
								<h5 class="color-white">Expiring Certificates</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/training_matrix/searchqualifications.php" data-ccn-c="color4" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background-color: #2981db;">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon4" class="fa fa-search"></span></div>
							<div class="details">
								<h5 class="color-white">Search Qualifications</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
          </div>';

    echo $html2 = '<h3> Training Admin</h3><hr>
                 <div class="row" style="text-align: left !important;">
                
                 <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/training_matrix/managecertificates.php" data-ccn-c="color3" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background-color: forestgreen;">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="fa fa-folder"></span></div>
							<div class="details">
								<h5 class="color-white">Manage Certificate</h5><p class="color-red"></p>
							</div>
						</div>
					</a>
				</div>
                
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/training_matrix/managecertificatetypes.php" data-ccn-c="color3" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background-color: #0f6674;">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="fa fa-plus-circle"></span></div>
							<div class="details">
								<h5 class="color-white">Manage Certificate Types</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/training_matrix/managetraininggroups.php" data-ccn-c="color4" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background-color: #6f42c1;">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon4" class="fa fa-plus-circle"></span></div>
							<div class="details">
								<h5 class="color-white">Manage Training Groups</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
				
				
          </div>';



}
else{
    echo "You are not autorized to view this page";
}

echo $OUTPUT->footer();
