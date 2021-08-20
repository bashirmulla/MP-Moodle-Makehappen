<?php
// Globals.
global $USER, $CFG,$DB;
define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/trend_analysis_report/locallib.php');  // Include our function library.
require_login();

$homeurl    = new moodle_url('/local/mp_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    echo ("You are not authorized to view this page");
}

$query_con_str =" 1=1 ";
$filterData = get_requests();

$params = array();
$toDateArr   = $filterData['date_to'];
$fromDateArr = $filterData['date_from'];

$toStr     = $toDateArr['year'].'-'.$toDateArr['month'].'-'.$toDateArr['day'].' 23:59:59';
$formStr   = $fromDateArr['year'].'-'.$fromDateArr['month'].'-'.$fromDateArr['day'].' 00:00:00';
$date_to   = strtotime($toStr);
$date_from = strtotime($formStr);

$from_to = date('d M Y', $date_from).' to '.date('d M Y', $date_to);

$query_con_str .= " AND (duedate BETWEEN $date_from AND $date_to) ";

$client = "All";
if ($filterData['client']){
    $client = "'".$filterData['client']."'";
    $params['client'] = $client;
    $query_con_str .= " AND client IN (?) ";
}
$_SESSION["toolbox_talks_by_category_csv"]["from_to"] = $from_to;
$_SESSION["toolbox_talks_by_category_csv"]["client"] = $client;

$query_con_str .= " AND coursetype IN (3,4) GROUP BY client,category ";

$_SESSION["toolbox_talks_by_category_csv"]["where"] = serialize($query_con_str);
$sql = " SELECT id,COUNT(id) as total,category,client,coursetype FROM mdl_course WHERE $query_con_str ";
$result = $DB->get_records_sql($sql,$params);
$course_category = get_course_category_subcategory_list();
$datapie = array();
foreach($result as $rec) {
    $category_title = $course_category[$rec->category];
    $url = '/local/trend_analysis_report/search_courses.php?m=1_1&category='.$rec->category.'&client='.urlencode($rec->client).'&date_from='.$date_from.'&date_to='.$date_to.'&coursetype=3,4';
    $datapie[] = array('name'=>$category_title.' - '.$rec->client,'y'=>intval($rec->total),'url'=>$url);
}
//$datapie[] = array('name'=>'FireFox','y'=>10,'url'=>'http://google.com');
$data = json_encode($datapie);
echo html_writer:: start_tag('div',array('class'=>'card mb-4'));
echo html_writer:: start_tag('div',array('class'=>'card-header','style'=>'text-align:right;'));
echo html_writer:: tag('button','<i class="fa fa-download"></i> &nbsp;&nbsp;Download CSV',array('type'=>'button','id'=>'dwn_toolbox_talks_by_category_csv','class'=>'btn btn-primary'));
echo html_writer:: end_tag('div');
echo html_writer:: start_tag('div',array('class'=>'card-body'));
echo html_writer:: tag('div','',array('style'=>'height: 500px;','id'=>'container'));
echo html_writer:: end_tag('div');
echo html_writer:: end_tag('div');
?>
<script type="text/javascript">
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: '<?= get_string('toolbox_talks_by_category', 'local_trend_analysis_report')?>'
        },
        subtitle: {
            text: '<?=$from_to?>'
        },
        tooltip: {
            pointFormat: 'Vol: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Volume',
            colorByPoint: true,
            data: <?php echo $data; ?>,
            point: {
                events: {
                    click: function(e) {
                        window.open(e.point.url);
                        e.preventDefault();
                    }
                }
            }
        }]
    });
</script>
