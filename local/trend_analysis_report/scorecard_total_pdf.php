     <?php
ini_set('memory_limit', '2048M');
ini_set('max_execution_time', 0);
ini_set('upload_max_filesize', "512M");
ini_set('post_max_size', "1024M");
// Globals.
global $USER, $CFG,$DB,$SESSION;
define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/mp_report/locallib.php');  // Include our function library.
require_once($CFG->libdir.'/pdflib.php');

require_login();
if (isset($SESSION->pdf_html_data)) {
    $pdf_html = $SESSION->pdf_html_data;
//    echo $pdf_html;
    $pdf_file = 'scorecard_total.pdf';
    $pdf_file = str_replace(" ","-", $pdf_file);

    $pdf = new pdf('L');
    $pdf -> setPrintHeader(false);
    $pdf -> setPrintFooter(false);

    $pdf -> AddPage();
    $pdf -> WriteHTML($pdf_html);
    $pdf -> Output( pdfs_path() . $pdf_file, 'F' );

    $fileurl = pdfs_path() . $pdf_file;
    header("Content-type:application/pdf");
    header('Content-Disposition: attachment; filename='.$pdf_file);
    readfile( $fileurl );
    @unlink( $fileurl );
    exit;
}
?>
