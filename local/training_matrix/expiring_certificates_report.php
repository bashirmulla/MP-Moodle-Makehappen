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
 * @copyright  2020 Calm-solutions.com
 * @author     Bash & SAM Harun & Mahedi
 */


// Globals.
global $CFG, $OUTPUT, $USER, $SITE, $PAGE;
$pluginname = 'training_matrix';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
require_once($CFG->dirroot.'/local/'.$pluginname.'/functions.php');  // Include our function library.


require_login();
$homeurl    = new moodle_url('/local/calm_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}

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
echo $html ='<div class="row" >
                <div class="col-sm-6"><h4>Report - Expiring Certificates</h4></div>
                <div class="col-sm-6" style="text-align: right !important;">     
                     <a class="btn btn-dark" onclick="history.back()" style="background-color: #fcc42c; border-color: #fcc42c !important; font-weight: bold"><i class="fa fa-step-backward"> </i> Back </a>
                </div>
             </div>';

//echo '<div =""></div><><br>';

echo html_writer:: tag('hr','');
echo '</br>';
$sql = "SELECT mc.id,mc.certificate_user_id,mc.certificate_types_id,mc.copy_of_certificate,mc.expiry_date,mc.certificate_status,mc.update_status FROM {managecertificates} mc LEFT JOIN {user} u ON (mc.certificate_user_id = u.id) WHERE u.deleted=0 AND u.suspended=0";
$managecertificates = $DB->get_records_sql($sql);
$report_pie_data = get_expiring_certificates_data($managecertificates);

echo html_writer:: div('','',array('style'=>'height: 400px','id'=>'container'));
echo html_writer:: tag('hr','');
echo '</br>';
echo html_writer:: div('','',array('id'=>'ajax_container'));

echo $OUTPUT->footer();
?>
<script type="text/javascript">
var data = <?=json_encode($report_pie_data)?>;
//console.log(data);



Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Expiring Certificates'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            colors: ['#ffff00','#fed8b1','#ff8c00','#FF0000'],
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Certificates',
        colorByPoint: true,
        data: data,
        point:{
            events:{
                click: function (event) {
//                    alert(this.qry);
                    $.ajax({
                        type: 'POST',
                        url: '/local/training_matrix/expiring_certificates_report_data.php',
                        data: {qry:this.qry},
                        dataType: 'json',
                        success: function(data){
//                            console.log(data);
                            $('#ajax_container').html(data);

                            $('#dwn_expiring_certificates_users_csv').on("click", function (e) {
                                window.onbeforeunload = null;
                                e.preventDefault();
                                document.location.href = '/local/training_matrix/expiring_certificates_users_csv.php';
                            });
                        }

                    });
                }
            }
        }
    }]
});
</script>
