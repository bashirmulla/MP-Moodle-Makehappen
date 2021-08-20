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
 * @package    local_trend_analysis_report
 * @copyright  2019 www.makehappengroup.co.uk
 * @author     MP
 */


// Globals.
global $CFG, $OUTPUT, $USER, $SITE, $PAGE;
$pluginname = 'trend_analysis_report';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
require_once($CFG->dirroot.'/local/'.$pluginname.'/functions.php');  // Include our function library.


require_login();

echo '<script src="'.$CFG->wwwroot.'/local/'.$pluginname.'/highcharts/code/highcharts.js"></script>
<script src="'.$CFG->wwwroot.'/local/'.$pluginname.'/highcharts/code/highcharts-3d.js"></script>
<script src="'.$CFG->wwwroot.'/local/'.$pluginname.'/highcharts/code/modules/exporting.js"></script>
<script src="'.$CFG->wwwroot.'/local/'.$pluginname.'/highcharts/code/modules/export-data.js"></script>';

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
if(is_admin() || is_complieance() || is_senior_manager()) {


    echo $html1 = '<h3> H&S Reports</h3><hr>
                 <div class="row" style="text-align: left !important;">
                
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/accident_report.php" data-ccn-c="color3" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(0, 97, 255, 0.6);">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="ccn-flaticon-add-1"></span></div>
							<div class="details">
								<h5 class="color-white">Accident Reports</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/incident_near_miss_hazard_report.php" data-ccn-c="color4" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(241, 67, 45, 0.6);">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon4" class="flaticon-checklist"></span></div>
							<div class="details">
								<h5 class="color-white">Incident Reports</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
				
				<div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/accident_incident_near_miss_hazard_analysis.php" data-ccn-c="color1" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(234, 38, 227, 0.6);">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="flaticon-add-contact"></span></div>
							<div class="details">
								<h5 class="color-white">H&S Analysis</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
                
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/monthly_trends.php" data-ccn-c="color1" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:#e35a9a;">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="flaticon-book"></span></div>
							<div class="details">
								<h5 class="color-white">Monthly Analysis</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
          </div>';

    echo $html2 = '<h3> Makehappen Scorecard</h3><hr>
                 <div class="row" style="text-align: left !important;">
                
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/mp_scorecard.php" data-ccn-c="color3" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background-color: #0f6674;">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="ccn-flaticon-database"></span></div>
							<div class="details">
								<h5 class="color-white">Scorecard Dashboard</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/incident_near_miss_hazard_report.php" data-ccn-c="color4" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background-color: #6f42c1;">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon4" class="ccn-flaticon-calculator"></span></div>
							<div class="details">
								<h5 class="color-white">Scorecard Total</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
				
				
          </div>';

    echo $html3 = '<h3> Admin Report</h3><hr>
                 <div class="row" style="text-align: left !important;">
                
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/actual.php" data-ccn-c="color3" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background-color: #009999 ;">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="flaticon-account"></span></div>
							<div class="details">
								<h5 class="color-white">Add Monthly Actual</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/target.php" data-ccn-c="color4" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background-color: #2981db;">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon4" class="flaticon-award"></span></div>
							<div class="details">
								<h5 class="color-white">Add Monthly Terget</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
				
				
          </div>';

}
else{
    echo "You are not autorized to view this page";
}
