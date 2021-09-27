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
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.

require_login();

// Heading ==========================================================.

$title   = "Course Reporting";
$heading = "Course Reporting";
$url     = new moodle_url('/local/'.$pluginname.'/course.php');


$context = context_system::instance();


$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);


echo $OUTPUT->header();
$uploadLink = "";
if(is_admin() || is_complieance() || is_senior_manager()) {


    echo $html1 = '
               <div class="row" style="text-align: left !important;">
                
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/search_courses.php" data-ccn-c="color3" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(0, 97, 255, 0.6);">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="flaticon-review"></span></div>
							<div class="details">
								<h5 class="color-white">Search Courses</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/course_completion.php" data-ccn-c="color4" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(241, 67, 45, 0.6);">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon4" class="flaticon-checklist"></span></div>
							<div class="details">
								<h5 class="color-white">Course Completion</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
				
				<div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/overdue_courses.php" data-ccn-c="color1" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:rgba(234, 38, 227, 0.6);">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="flaticon-clock"></span></div>
							<div class="details">
								<h5 class="color-white">Overdue Courses</h5><p class="color-white"></p>
							</div>
						</div>
					</a>
				</div>
                
                <div class="col-sm-6 col-md-6 col-lg-4 col-lg-5th-1">
					<a href="/local/trend_analysis_report/toolbox_talks_by_category.php" data-ccn-c="color1" data-ccn-co="bg" class="icon_hvr_img_box ccn-color-cat-boxes" style="background:#e35a9a;">
						<div class="overlay">
							<div class="icon ccn_icon_2 color-white"><span data-ccn="icon3" class="flaticon-book"></span></div>
							<div class="details">
								<h5 class="color-white">Toolbox Talks by Category</h5><p class="color-white"></p>
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
