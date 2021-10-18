<?php
// Globals.
global $CFG, $OUTPUT, $USER, $SITE, $PAGE;
$pluginname = 'training_matrix';

// Include config.php.
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/local/'.$pluginname.'/locallib.php');  // Include our function library.
require_once($CFG->dirroot.'/local/'.$pluginname.'/functions.php');  // Include our function library.
require_once(dirname(__FILE__).'/classes/managecertificates_filter_form.php');  // Include form.
$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/datatables/datatables.min.css'));
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/datatables/datatables-1.10.18/js/jquery.dataTables.min.js'),true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/'.$pluginname.'/js/datatables/datatables-1.10.18/js/dateSort.js'));
require_login();
$homeurl    = new moodle_url('/local/training_matrix/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance() && !is_training_admin() && !is_siteadmin()) {
    redirect($homeurl,"You are not authorized to view this page",6,'error');
}
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

$form = new managecertificates_filter_form(null, array());
if ($form->is_cancelled()) {
    redirect($homeurl);
}
$form->get_data();
$form->display();

if(is_manager() || is_admin() || is_senior_manager() || is_complieance() || is_training_admin() || is_siteadmin()) {
    echo html_writer:: tag('div','',array('id'=>'ajax_content'));
}

echo $OUTPUT->footer();

$access = is_training_admin() ? 1 : (is_siteadmin() ? 1 : 0);

echo "<script> var readonly='$access' ; </script>"

?>
<!--<form autocomplete="off" method="post" accept-charset="utf-8" id="mformCertificate" class="mform" enctype="multipart/form-data">-->
<!--    <div class="fcontainer clearfix">-->
<!--        <div class="form-group row fitem ">-->
<!--            <div class="col-md-3">-->
<!--                <input name="mformType" type="hidden" value="add">-->
<!--                <label class="col-form-label d-inline " for="id_copy_of_certificate">-->
<!--                    Copy of Certificate-->
<!--                </label>-->
<!--            </div>-->
<!--            <div class="col-md-9 form-inline felement" data-fieldtype="file">-->
<!--                <input accept=".pdf, .jpg, .jpeg" maxlength="200" size="40" name="copy_of_certificate" type="file" id="id_copy_of_certificate">-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="form-group row fitem ">-->
<!--            <div class="col-md-3">-->
<!--                <label class="col-form-label d-inline " for="id_expiry_date">-->
<!--                    Expiry Date-->
<!--                </label>-->
<!--            </div>-->
<!--            <div class="col-md-9 form-inline felement" data-fieldtype="date_selector">-->
<!--                <span class="fdate_selector d-flex">-->
<!--                    <div class="form-group  fitem">-->
<!--                        <label class="col-form-label sr-only" for="id_expiry_date_day">Day</label>-->
<!--                        <span data-fieldtype="select">-->
<!--                            <select class="custom-select" name="expiry_date_day" id="id_expiry_date_day">-->
<!--                                <option value="">--</option>-->
<!--                                <option value="1">1</option>-->
<!--                                <option value="2">2</option>-->
<!--                                <option value="3">3</option>-->
<!--                                <option value="4">4</option>-->
<!--                                <option value="5">5</option>-->
<!--                                <option value="6">6</option>-->
<!--                                <option value="7">7</option>-->
<!--                                <option value="8">8</option>-->
<!--                                <option value="9">9</option>-->
<!--                                <option value="10">10</option>-->
<!--                                <option value="11">11</option>-->
<!--                                <option value="12">12</option>-->
<!--                                <option value="13">13</option>-->
<!--                                <option value="14">14</option>-->
<!--                                <option value="15">15</option>-->
<!--                                <option value="16">16</option>-->
<!--                                <option value="17">17</option>-->
<!--                                <option value="18">18</option>-->
<!--                                <option value="19">19</option>-->
<!--                                <option value="20">20</option>-->
<!--                                <option value="21">21</option>-->
<!--                                <option value="22">22</option>-->
<!--                                <option value="23">23</option>-->
<!--                                <option value="24">24</option>-->
<!--                                <option value="25">25</option>-->
<!--                                <option value="26">26</option>-->
<!--                                <option value="27">27</option>-->
<!--                                <option value="28">28</option>-->
<!--                                <option value="29">29</option>-->
<!--                                <option value="30">30</option>-->
<!--                                <option value="31">31</option>-->
<!--                            </select>-->
<!--                        </span>-->
<!--                        <div class="form-control-feedback invalid-feedback" id="id_error_expiry_date[day]"></div>-->
<!--                    </div>-->
<!--                    <div class="form-group  fitem  ">-->
<!--                        <label class="col-form-label sr-only" for="id_expiry_date_month">Month</label>-->
<!--                        <span data-fieldtype="select">-->
<!--                            <select class="custom-select" name="expiry_date_month" id="id_expiry_date_month">-->
<!--                                <option value="">----</option>-->
<!--                                <option value="1">January</option>-->
<!--                                <option value="2">February</option>-->
<!--                                <option value="3">March</option>-->
<!--                                <option value="4">April</option>-->
<!--                                <option value="5">May</option>-->
<!--                                <option value="6">June</option>-->
<!--                                <option value="7">July</option>-->
<!--                                <option value="8">August</option>-->
<!--                                <option value="9">September</option>-->
<!--                                <option value="10">October</option>-->
<!--                                <option value="11">November</option>-->
<!--                                <option value="12">December</option>-->
<!--                            </select>-->
<!--                        </span>-->
<!--                        <div class="form-control-feedback invalid-feedback" id="id_error_expiry_date_month"></div>-->
<!--                    </div>-->
<!--                    <div class="form-group  fitem  ">-->
<!--                        <label class="col-form-label sr-only" for="id_expiry_date_year">Year</label>-->
<!--                        <span data-fieldtype="select">-->
<!--                            <select class="custom-select" name="expiry_date_year" id="id_expiry_date_year">-->
<!--                                <option value="">----</option>-->
<!--                                <option value="1900">1900</option>-->
<!--                                <option value="1901">1901</option>-->
<!--                                <option value="1902">1902</option>-->
<!--                                <option value="1903">1903</option>-->
<!--                                <option value="1904">1904</option>-->
<!--                                <option value="1905">1905</option>-->
<!--                                <option value="1906">1906</option>-->
<!--                                <option value="1907">1907</option>-->
<!--                                <option value="1908">1908</option>-->
<!--                                <option value="1909">1909</option>-->
<!--                                <option value="1910">1910</option>-->
<!--                                <option value="1911">1911</option>-->
<!--                                <option value="1912">1912</option>-->
<!--                                <option value="1913">1913</option>-->
<!--                                <option value="1914">1914</option>-->
<!--                                <option value="1915">1915</option>-->
<!--                                <option value="1916">1916</option>-->
<!--                                <option value="1917">1917</option>-->
<!--                                <option value="1918">1918</option>-->
<!--                                <option value="1919">1919</option>-->
<!--                                <option value="1920">1920</option>-->
<!--                                <option value="1921">1921</option>-->
<!--                                <option value="1922">1922</option>-->
<!--                                <option value="1923">1923</option>-->
<!--                                <option value="1924">1924</option>-->
<!--                                <option value="1925">1925</option>-->
<!--                                <option value="1926">1926</option>-->
<!--                                <option value="1927">1927</option>-->
<!--                                <option value="1928">1928</option>-->
<!--                                <option value="1929">1929</option>-->
<!--                                <option value="1930">1930</option>-->
<!--                                <option value="1931">1931</option>-->
<!--                                <option value="1932">1932</option>-->
<!--                                <option value="1933">1933</option>-->
<!--                                <option value="1934">1934</option>-->
<!--                                <option value="1935">1935</option>-->
<!--                                <option value="1936">1936</option>-->
<!--                                <option value="1937">1937</option>-->
<!--                                <option value="1938">1938</option>-->
<!--                                <option value="1939">1939</option>-->
<!--                                <option value="1940">1940</option>-->
<!--                                <option value="1941">1941</option>-->
<!--                                <option value="1942">1942</option>-->
<!--                                <option value="1943">1943</option>-->
<!--                                <option value="1944">1944</option>-->
<!--                                <option value="1945">1945</option>-->
<!--                                <option value="1946">1946</option>-->
<!--                                <option value="1947">1947</option>-->
<!--                                <option value="1948">1948</option>-->
<!--                                <option value="1949">1949</option>-->
<!--                                <option value="1950">1950</option>-->
<!--                                <option value="1951">1951</option>-->
<!--                                <option value="1952">1952</option>-->
<!--                                <option value="1953">1953</option>-->
<!--                                <option value="1954">1954</option>-->
<!--                                <option value="1955">1955</option>-->
<!--                                <option value="1956">1956</option>-->
<!--                                <option value="1957">1957</option>-->
<!--                                <option value="1958">1958</option>-->
<!--                                <option value="1959">1959</option>-->
<!--                                <option value="1960">1960</option>-->
<!--                                <option value="1961">1961</option>-->
<!--                                <option value="1962">1962</option>-->
<!--                                <option value="1963">1963</option>-->
<!--                                <option value="1964">1964</option>-->
<!--                                <option value="1965">1965</option>-->
<!--                                <option value="1966">1966</option>-->
<!--                                <option value="1967">1967</option>-->
<!--                                <option value="1968">1968</option>-->
<!--                                <option value="1969">1969</option>-->
<!--                                <option value="1970">1970</option>-->
<!--                                <option value="1971">1971</option>-->
<!--                                <option value="1972">1972</option>-->
<!--                                <option value="1973">1973</option>-->
<!--                                <option value="1974">1974</option>-->
<!--                                <option value="1975">1975</option>-->
<!--                                <option value="1976">1976</option>-->
<!--                                <option value="1977">1977</option>-->
<!--                                <option value="1978">1978</option>-->
<!--                                <option value="1979">1979</option>-->
<!--                                <option value="1980">1980</option>-->
<!--                                <option value="1981">1981</option>-->
<!--                                <option value="1982">1982</option>-->
<!--                                <option value="1983">1983</option>-->
<!--                                <option value="1984">1984</option>-->
<!--                                <option value="1985">1985</option>-->
<!--                                <option value="1986">1986</option>-->
<!--                                <option value="1987">1987</option>-->
<!--                                <option value="1988">1988</option>-->
<!--                                <option value="1989">1989</option>-->
<!--                                <option value="1990">1990</option>-->
<!--                                <option value="1991">1991</option>-->
<!--                                <option value="1992">1992</option>-->
<!--                                <option value="1993">1993</option>-->
<!--                                <option value="1994">1994</option>-->
<!--                                <option value="1995">1995</option>-->
<!--                                <option value="1996">1996</option>-->
<!--                                <option value="1997">1997</option>-->
<!--                                <option value="1998">1998</option>-->
<!--                                <option value="1999">1999</option>-->
<!--                                <option value="2000">2000</option>-->
<!--                                <option value="2001">2001</option>-->
<!--                                <option value="2002">2002</option>-->
<!--                                <option value="2003">2003</option>-->
<!--                                <option value="2004">2004</option>-->
<!--                                <option value="2005">2005</option>-->
<!--                                <option value="2006">2006</option>-->
<!--                                <option value="2007">2007</option>-->
<!--                                <option value="2008">2008</option>-->
<!--                                <option value="2009">2009</option>-->
<!--                                <option value="2010">2010</option>-->
<!--                                <option value="2011">2011</option>-->
<!--                                <option value="2012">2012</option>-->
<!--                                <option value="2013">2013</option>-->
<!--                                <option value="2014">2014</option>-->
<!--                                <option value="2015">2015</option>-->
<!--                                <option value="2016">2016</option>-->
<!--                                <option value="2017">2017</option>-->
<!--                                <option value="2018">2018</option>-->
<!--                                <option value="2019">2019</option>-->
<!--                                <option value="2020" selected="">2020</option>-->
<!--                                <option value="2021">2021</option>-->
<!--                                <option value="2022">2022</option>-->
<!--                                <option value="2023">2023</option>-->
<!--                                <option value="2024">2024</option>-->
<!--                                <option value="2025">2025</option>-->
<!--                                <option value="2026">2026</option>-->
<!--                                <option value="2027">2027</option>-->
<!--                                <option value="2028">2028</option>-->
<!--                                <option value="2029">2029</option>-->
<!--                                <option value="2030">2030</option>-->
<!--                                <option value="2031">2031</option>-->
<!--                                <option value="2032">2032</option>-->
<!--                                <option value="2033">2033</option>-->
<!--                                <option value="2034">2034</option>-->
<!--                                <option value="2035">2035</option>-->
<!--                                <option value="2036">2036</option>-->
<!--                                <option value="2037">2037</option>-->
<!--                                <option value="2038">2038</option>-->
<!--                                <option value="2039">2039</option>-->
<!--                                <option value="2040">2040</option>-->
<!--                                <option value="2041">2041</option>-->
<!--                                <option value="2042">2042</option>-->
<!--                                <option value="2043">2043</option>-->
<!--                                <option value="2044">2044</option>-->
<!--                                <option value="2045">2045</option>-->
<!--                                <option value="2046">2046</option>-->
<!--                                <option value="2047">2047</option>-->
<!--                                <option value="2048">2048</option>-->
<!--                                <option value="2049">2049</option>-->
<!--                                <option value="2050">2050</option>-->
<!--                            </select>-->
<!--                        </span>-->
<!--                        <div class="form-control-feedback invalid-feedback" id="id_error_expiry_date_year"></div>-->
<!--                    </div>-->
<!--                <a class="visibleifjs" name="certificate_date[calendar]" href="#" id="id_certificate_date_calendar"><i class="icon fa fa-calendar fa-fw " aria-hidden="true" title="Calendar" aria-label="Calendar"></i></a>-->
<!--                </span>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="form-group row  fitem   ">-->
<!--            <div class="col-md-3">-->
<!--                <label class="col-form-label d-inline  id="id_auth"">-->
<!--                    Update Status-->
<!--                </label>-->
<!--            </div>-->
<!--            <div class="col-md-9 form-inline felement" data-fieldtype="selectgroups">-->
<!--                <select class="form-control custom-select " name="update_status" id="id_auth">-->
<!--                        <option value="Booked">Booked</option>-->
<!--                        <option value="Awaiting Certificates">Awaiting Certificates</option>-->
<!--                        <option value="System Status">System Status</option>-->
<!--                </select>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</form>-->
<!---->

<!--<form class="mform">-->
<!--    <div class="form-row">-->
<!--        <div class="form-group col-lg-12 form-group-ele">-->
<!--            <button type="button" class="btn btn-outline-primary" data-action="view-certificate">View Certificate</button>-->
<!--            <button type="button" class="btn btn-outline-success" data-action="download-certificate">Download Certificate</button>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="form-row">-->
<!--        <div class="form-group col-lg-12 form-group-ele">-->
<!--            <button type="button" class="btn btn-outline-info" data-action="edit-certificate">Edit</button>-->
<!--            <button type="button" class="btn btn-outline-danger" data-action="delete-certificate">Delete Certificate</button>-->
<!--            <button type="button" class="btn btn-outline-dark" data-action="readd-certificates">Add Certificate</button>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="form-row">-->
<!--        <div class="form-group col-lg-12 form-group-ele">-->
<!--            <button type="button" class="btn btn-outline-warning" data-action="view-previous-certificates">View previous certificates</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</form>-->

