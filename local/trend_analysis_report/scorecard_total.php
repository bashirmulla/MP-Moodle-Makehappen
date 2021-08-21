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

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/trend_analysis_report/css/calm_scorecard_total.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/trend_analysis_report/js/calm_scorecard_total.js'));

require_login();
// Heading ==========================================================.

$homeurl    = new moodle_url('/local/mp_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}

$title   = get_string('calm_scorecard_total', 'local_'.$pluginname);
$heading = get_string('calm_scorecard_total', 'local_'.$pluginname);
$url     = new moodle_url('/local/'.$pluginname.'/index.php');


$context = context_system::instance();


$PAGE->set_pagelayout('admin');
$PAGE->set_url($url);
$PAGE->set_context($context);
$PAGE->set_title($title);
$PAGE->set_heading($heading);


echo $OUTPUT->header();

$cur_year = date("Y");
echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer::empty_tag('input',array('type'=>'hidden','id'=>'default_year','value'=>$cur_year));
echo html_writer:: start_tag('div',array('class'=>'dropdown show md-4 float-right'));
echo $html ='<a class="btn btn-dark" onclick="history.back()" style="background-color: #fcc42c; border-color: #fcc42c !important; font-weight: bold"><i class="fa fa-step-backward"> </i> Back </a>';
echo $html ='<a class="btn btn-dark" id="dwn_calm_scorecard_total_pdf"  style="background-color: #e35a9a; border-color: #e35a9a !important; font-weight: bold"><i class="fa fa-download"></i> &nbsp;&nbsp;Download PDF</a>';

echo html_writer::tag('button', $cur_year, array('href'=>'#','class'=>'btn btn-secondary btn-lg dropdown-toggle',
    'type'=>'button','id'=>'dropdownMenuButton','data-toggle'=>'dropdown','aria-haspopup'=>'true','aria-expanded'=>'false'));

echo html_writer:: start_tag('div',array('class'=>'dropdown-menu cur_year','aria-labelledby'=>'dropdownMenuButton'));
$min = 2018;
$max = $year = date('Y');
for($i=$min;$i<=$max;$i++)
{
    $active = '';
    if($i==$cur_year) {$active = ' active ';}
    echo html_writer::tag('a', $i, array('class'=>'dropdown-item'.$active,'href'=>'#'));
}
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');

//echo html_writer::select(createDropdown(accident_status()), 'status', '', array(),array('class'=>'form-control'));

echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');

if(is_manager() || is_admin() || is_senior_manager() || is_complieance()) {
    echo html_writer:: tag('div','',array('id'=>'ajax_content'));
}
echo $OUTPUT->footer();
