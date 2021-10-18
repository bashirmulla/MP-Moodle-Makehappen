var JSLoad = true;
var c_update_status = '';
var att_day = '';
var att_month = '';
var att_year = '';

require(['jquery'], function($) {
    pull_data();



    $("#managecertificates").on( "click", function() {
        pull_data();
    });


    $(".status_btn").on( "click", function(e) {
        //if(this.value==6) this.value='';
        $("#menustatus").val(this.value);
        pull_data();
    });

    $(".modal-dialog").on('hidden.bs.modal', function () {
        alert(111)
        $(this).data('bs.modal', null);
    });


});

function pull_data() {
    $.ajax({
        type: "POST",
        url: "/local/training_matrix/managecertificates_data.php",
        data: $(".mform").serialize(),
        success: function(data) {
            $('#ajax_content').html(data);
            jQuery.noConflict();

            $('.trainingmatrixtbl').DataTable( {
                deferRender:    true,

                paging: true
            } );

            $("#trainingmatrixtbl").css("width","100% !important");

            if (readonly != '1') {
                $('td').removeClass('view-certificate');
                $('td').removeClass('upload-certificate');
            }
            // $('.managecertificates').DataTable({
            //     "destroy": true,
            //     "searching": false,
            //     "columnDefs" : [{"targets":9, "orderable": false}]
            // });

            $('#dwn_managecertificates_csv').on("click", function (e) {
                window.onbeforeunload = null;
                e.preventDefault();
                document.location.href = '/local/training_matrix/managecertificates_csv.php';
            });

            $('#dwn_managecertificates_pdf').on("click", function (e) {
                window.onbeforeunload = null;
                e.preventDefault();
                document.location.href = '/local/training_matrix/managecertificates_pdf.php';
            });

            if (JSLoad) {

                JSLoad = false;
                require(['jquery', 'core/modal_factory', 'core/notification', 'core/modal_events', 'core/templates'], function ($, ModalFactory, notification, ModalEvents, Templates) {
                    var SELECTORS = {
                        VIEW_CERTIFICATE_LINK: '[data-action="view-certificate"]',
                        DOWNLOAD_CERTIFICATE_LINK: '[data-action="download-certificate"]',
                        EDIT_CERTIFICATE_LINK: '[data-action="edit-certificate"]',
                        DELETE_CERTIFICATE_LINK: '[data-action="delete-certificate"]',
                        VIEW_PREVIOUS_CERTIFICATES_LINK: '[data-action="view-previous-certificates"]',
                        READD_CERTIFICATE_LINK: '[data-action="readd-certificates"]'
                    };

                    var modal_addform = '<form autocomplete="off" method="post" accept-charset="utf-8" id="mformCertificate" class="mform" enctype="multipart/form-data">\n' +
                        '    <div class="fcontainer clearfix">\n' +
                        '        <div class="form-group row fitem ">\n' +
                        '        <input name="mformType" type="hidden" value="add">\n' +
                        '            <div class="col-md-3">\n' +
                        '                <label class="col-form-label d-inline " for="id_copy_of_certificate">\n' +
                        '                    Copy of Certificate\n' +
                        '                </label>\n' +
                        '            </div>\n' +
                        '            <div class="col-md-9 form-inline felement" data-fieldtype="file">\n' +
                        '                <input accept=".pdf, .jpg, .jpeg" maxlength="200" size="40" name="copy_of_certificate" type="file" id="id_copy_of_certificate">\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="form-group row fitem for-no-expiration">\n' +
                        '            <div class="col-md-3">\n' +
                        '                <label class="col-form-label d-inline " for="id_expiry_date">\n' +
                        '                    Expiry Date\n' +
                        '                </label>\n' +
                        '            </div>\n' +
                        '            <div  class="col-md-9 form-inline felement" data-fieldtype="date_selector">\n' +
                        '                <span class="fdate_selector d-flex">\n' +
                        '                    <div class="form-group  fitem">\n' +
                        '                        <label class="col-form-label sr-only" for="id_expiry_date_day">Day</label>\n' +
                        '                        <span data-fieldtype="select">\n' +
                        '                            <select class="custom-select" name="expiry_date_day" id="id_expiry_date_day">\n' +
                        '                                <option value="">--</option>\n' +
                        '                                <option value="1">1</option>\n' +
                        '                                <option value="2">2</option>\n' +
                        '                                <option value="3">3</option>\n' +
                        '                                <option value="4">4</option>\n' +
                        '                                <option value="5">5</option>\n' +
                        '                                <option value="6">6</option>\n' +
                        '                                <option value="7">7</option>\n' +
                        '                                <option value="8">8</option>\n' +
                        '                                <option value="9">9</option>\n' +
                        '                                <option value="10">10</option>\n' +
                        '                                <option value="11">11</option>\n' +
                        '                                <option value="12">12</option>\n' +
                        '                                <option value="13">13</option>\n' +
                        '                                <option value="14">14</option>\n' +
                        '                                <option value="15">15</option>\n' +
                        '                                <option value="16">16</option>\n' +
                        '                                <option value="17">17</option>\n' +
                        '                                <option value="18">18</option>\n' +
                        '                                <option value="19">19</option>\n' +
                        '                                <option value="20">20</option>\n' +
                        '                                <option value="21">21</option>\n' +
                        '                                <option value="22">22</option>\n' +
                        '                                <option value="23">23</option>\n' +
                        '                                <option value="24">24</option>\n' +
                        '                                <option value="25">25</option>\n' +
                        '                                <option value="26">26</option>\n' +
                        '                                <option value="27">27</option>\n' +
                        '                                <option value="28">28</option>\n' +
                        '                                <option value="29">29</option>\n' +
                        '                                <option value="30">30</option>\n' +
                        '                                <option value="31">31</option>\n' +
                        '                            </select>\n' +
                        '                        </span>\n' +
                        '                        <div class="form-control-feedback invalid-feedback" id="id_error_expiry_date[day]"></div>\n' +
                        '                    </div>\n' +
                        '                    <div class="form-group  fitem  ">\n' +
                        '                        <label class="col-form-label sr-only" for="id_expiry_date_month">Month</label>\n' +
                        '                        <span data-fieldtype="select">\n' +
                        '                            <select class="custom-select" name="expiry_date_month" id="id_expiry_date_month">\n' +
                        '                                <option value="">----</option>\n' +
                        '                                <option value="1">January</option>\n' +
                        '                                <option value="2">February</option>\n' +
                        '                                <option value="3">March</option>\n' +
                        '                                <option value="4">April</option>\n' +
                        '                                <option value="5">May</option>\n' +
                        '                                <option value="6">June</option>\n' +
                        '                                <option value="7">July</option>\n' +
                        '                                <option value="8">August</option>\n' +
                        '                                <option value="9">September</option>\n' +
                        '                                <option value="10">October</option>\n' +
                        '                                <option value="11">November</option>\n' +
                        '                                <option value="12">December</option>\n' +
                        '                            </select>\n' +
                        '                        </span>\n' +
                        '                        <div class="form-control-feedback invalid-feedback" id="id_error_expiry_date_month"></div>\n' +
                        '                    </div>\n' +
                        '                    <div class="form-group  fitem  ">\n' +
                        '                        <label class="col-form-label sr-only" for="id_expiry_date_year">Year</label>\n' +
                        '                        <span data-fieldtype="select">\n' +
                        '                            <select class="custom-select" name="expiry_date_year" id="id_expiry_date_year">\n' +
                        '                                <option value="">----</option>\n' +
                        '                                <option value="1980">1980</option>\n' +
                        '                                <option value="1981">1981</option>\n' +
                        '                                <option value="1982">1982</option>\n' +
                        '                                <option value="1983">1983</option>\n' +
                        '                                <option value="1984">1984</option>\n' +
                        '                                <option value="1985">1985</option>\n' +
                        '                                <option value="1986">1986</option>\n' +
                        '                                <option value="1987">1987</option>\n' +
                        '                                <option value="1988">1988</option>\n' +
                        '                                <option value="1989">1989</option>\n' +
                        '                                <option value="1990">1990</option>\n' +
                        '                                <option value="1991">1991</option>\n' +
                        '                                <option value="1992">1992</option>\n' +
                        '                                <option value="1993">1993</option>\n' +
                        '                                <option value="1994">1994</option>\n' +
                        '                                <option value="1995">1995</option>\n' +
                        '                                <option value="1996">1996</option>\n' +
                        '                                <option value="1997">1997</option>\n' +
                        '                                <option value="1998">1998</option>\n' +
                        '                                <option value="1999">1999</option>\n' +
                        '                                <option value="2000">2000</option>\n' +
                        '                                <option value="2001">2001</option>\n' +
                        '                                <option value="2002">2002</option>\n' +
                        '                                <option value="2003">2003</option>\n' +
                        '                                <option value="2004">2004</option>\n' +
                        '                                <option value="2005">2005</option>\n' +
                        '                                <option value="2006">2006</option>\n' +
                        '                                <option value="2007">2007</option>\n' +
                        '                                <option value="2008">2008</option>\n' +
                        '                                <option value="2009">2009</option>\n' +
                        '                                <option value="2010">2010</option>\n' +
                        '                                <option value="2011">2011</option>\n' +
                        '                                <option value="2012">2012</option>\n' +
                        '                                <option value="2013">2013</option>\n' +
                        '                                <option value="2014">2014</option>\n' +
                        '                                <option value="2015">2015</option>\n' +
                        '                                <option value="2016">2016</option>\n' +
                        '                                <option value="2017">2017</option>\n' +
                        '                                <option value="2018">2018</option>\n' +
                        '                                <option value="2019">2019</option>\n' +
                        '                                <option value="2020">2020</option>\n' +
                        '                                <option value="2021">2021</option>\n' +
                        '                                <option value="2022">2022</option>\n' +
                        '                                <option value="2023">2023</option>\n' +
                        '                                <option value="2024">2024</option>\n' +
                        '                                <option value="2025">2025</option>\n' +
                        '                                <option value="2026">2026</option>\n' +
                        '                                <option value="2027">2027</option>\n' +
                        '                                <option value="2028">2028</option>\n' +
                        '                                <option value="2029">2029</option>\n' +
                        '                                <option value="2030">2030</option>\n' +
                        '                                <option value="2031">2031</option>\n' +
                        '                                <option value="2032">2032</option>\n' +
                        '                                <option value="2033">2033</option>\n' +
                        '                                <option value="2034">2034</option>\n' +
                        '                                <option value="2035">2035</option>\n' +
                        '                                <option value="2036">2036</option>\n' +
                        '                                <option value="2037">2037</option>\n' +
                        '                                <option value="2038">2038</option>\n' +
                        '                                <option value="2039">2039</option>\n' +
                        '                                <option value="2040">2040</option>\n' +
                        '                            </select>\n' +
                        '                        </span>\n' +
                        '                        <div class="form-control-feedback invalid-feedback" id="id_error_expiry_date_year"></div>\n' +
                        '                    </div>\n' +
                        '                </span>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="form-group row  fitem   ">\n' +
                        '            <div class="col-md-3">\n' +
                        '                <label class="col-form-label d-inline  id="id_auth"">\n' +
                        '                    Update Status\n' +
                        '                </label>\n' +
                        '            </div>\n' +
                        '            <div class="col-md-9 form-inline felement" data-fieldtype="selectgroups">\n' +
                        '                <select class="form-control custom-select " name="update_status" onchange="showhideAttended(this)" id="update_status" required>\n' +
                        '                        <option value="">--SELECT--</option>\n' +
                        '                        <option value="3">Booked</option>\n' +
                        '                        <option value="4">Awaiting Certificates</option>\n' +
                        '                        <option value="7">System Status</option>\n' +
                        '                        <option value="8">Refresher Training not Required</option>\n' +
                        '                </select>\n' +
                        '             </div>\n' +
                        '         </div>\n' +
                        '<script language="JavaScript"> function showhideAttended(thisfield) { c_update_status=thisfield.value; if(thisfield.value==4)  $(".for-attended-date").show(); else $(".for-attended-date").hide();}</script>'+
                        '        <div class="form-group row fitem for-attended-date" style="display:none">\n' +
                        '            <div class="col-md-3">\n' +
                        '                <label class="col-form-label d-inline " for="id_attended_date">\n' +
                        '                    Attended Date\n' +
                        '                </label>\n' +
                        '            </div>\n' +
                        '            <div  class="col-md-9 form-inline felement" data-fieldtype="date_selector2" >\n' +
                        '                <span class="fdate_selector d-flex">\n' +
                        '                    <div class="form-group  fitem">\n' +
                        '                        <label class="col-form-label sr-only" for="id_attended_date_day">Day</label>\n' +
                        '                        <span data-fieldtype="select">\n' +
                        '                            <select class="custom-select" name="attended_date_day" id="id_attended_date_day">\n' +
                        '                                <option value="">--</option>\n' +
                        '                                <option value="1">1</option>\n' +
                        '                                <option value="2">2</option>\n' +
                        '                                <option value="3">3</option>\n' +
                        '                                <option value="4">4</option>\n' +
                        '                                <option value="5">5</option>\n' +
                        '                                <option value="6">6</option>\n' +
                        '                                <option value="7">7</option>\n' +
                        '                                <option value="8">8</option>\n' +
                        '                                <option value="9">9</option>\n' +
                        '                                <option value="10">10</option>\n' +
                        '                                <option value="11">11</option>\n' +
                        '                                <option value="12">12</option>\n' +
                        '                                <option value="13">13</option>\n' +
                        '                                <option value="14">14</option>\n' +
                        '                                <option value="15">15</option>\n' +
                        '                                <option value="16">16</option>\n' +
                        '                                <option value="17">17</option>\n' +
                        '                                <option value="18">18</option>\n' +
                        '                                <option value="19">19</option>\n' +
                        '                                <option value="20">20</option>\n' +
                        '                                <option value="21">21</option>\n' +
                        '                                <option value="22">22</option>\n' +
                        '                                <option value="23">23</option>\n' +
                        '                                <option value="24">24</option>\n' +
                        '                                <option value="25">25</option>\n' +
                        '                                <option value="26">26</option>\n' +
                        '                                <option value="27">27</option>\n' +
                        '                                <option value="28">28</option>\n' +
                        '                                <option value="29">29</option>\n' +
                        '                                <option value="30">30</option>\n' +
                        '                                <option value="31">31</option>\n' +
                        '                            </select>\n' +
                        '                        </span>\n' +
                        '                        <div class="form-control-feedback invalid-feedback" id="id_error_attended_date[day]"></div>\n' +
                        '                    </div>\n' +
                        '                    <div class="form-group  fitem  ">\n' +
                        '                        <label class="col-form-label sr-only" for="id_attended_date_month">Month</label>\n' +
                        '                        <span data-fieldtype="select">\n' +
                        '                            <select class="custom-select" name="attended_date_month" id="id_attended_date_month">\n' +
                        '                                <option value="">----</option>\n' +
                        '                                <option value="1">January</option>\n' +
                        '                                <option value="2">February</option>\n' +
                        '                                <option value="3">March</option>\n' +
                        '                                <option value="4">April</option>\n' +
                        '                                <option value="5">May</option>\n' +
                        '                                <option value="6">June</option>\n' +
                        '                                <option value="7">July</option>\n' +
                        '                                <option value="8">August</option>\n' +
                        '                                <option value="9">September</option>\n' +
                        '                                <option value="10">October</option>\n' +
                        '                                <option value="11">November</option>\n' +
                        '                                <option value="12">December</option>\n' +
                        '                            </select>\n' +
                        '                        </span>\n' +
                        '                        <div class="form-control-feedback invalid-feedback" id="id_error_attended_date_month"></div>\n' +
                        '                    </div>\n' +
                        '                    <div class="form-group  fitem  ">\n' +
                        '                        <label class="col-form-label sr-only" for="id_attended_date_year">Year</label>\n' +
                        '                        <span data-fieldtype="select">\n' +
                        '                            <select class="custom-select" name="attended_date_year" id="id_attended_date_year">\n' +
                        '                                <option value="">----</option>\n' +
                        '                                <option value="1980">1980</option>\n' +
                        '                                <option value="1981">1981</option>\n' +
                        '                                <option value="1982">1982</option>\n' +
                        '                                <option value="1983">1983</option>\n' +
                        '                                <option value="1984">1984</option>\n' +
                        '                                <option value="1985">1985</option>\n' +
                        '                                <option value="1986">1986</option>\n' +
                        '                                <option value="1987">1987</option>\n' +
                        '                                <option value="1988">1988</option>\n' +
                        '                                <option value="1989">1989</option>\n' +
                        '                                <option value="1990">1990</option>\n' +
                        '                                <option value="1991">1991</option>\n' +
                        '                                <option value="1992">1992</option>\n' +
                        '                                <option value="1993">1993</option>\n' +
                        '                                <option value="1994">1994</option>\n' +
                        '                                <option value="1995">1995</option>\n' +
                        '                                <option value="1996">1996</option>\n' +
                        '                                <option value="1997">1997</option>\n' +
                        '                                <option value="1998">1998</option>\n' +
                        '                                <option value="1999">1999</option>\n' +
                        '                                <option value="2000">2000</option>\n' +
                        '                                <option value="2001">2001</option>\n' +
                        '                                <option value="2002">2002</option>\n' +
                        '                                <option value="2003">2003</option>\n' +
                        '                                <option value="2004">2004</option>\n' +
                        '                                <option value="2005">2005</option>\n' +
                        '                                <option value="2006">2006</option>\n' +
                        '                                <option value="2007">2007</option>\n' +
                        '                                <option value="2008">2008</option>\n' +
                        '                                <option value="2009">2009</option>\n' +
                        '                                <option value="2010">2010</option>\n' +
                        '                                <option value="2011">2011</option>\n' +
                        '                                <option value="2012">2012</option>\n' +
                        '                                <option value="2013">2013</option>\n' +
                        '                                <option value="2014">2014</option>\n' +
                        '                                <option value="2015">2015</option>\n' +
                        '                                <option value="2016">2016</option>\n' +
                        '                                <option value="2017">2017</option>\n' +
                        '                                <option value="2018">2018</option>\n' +
                        '                                <option value="2019">2019</option>\n' +
                        '                                <option value="2020">2020</option>\n' +
                        '                                <option value="2021">2021</option>\n' +
                        '                                <option value="2022">2022</option>\n' +
                        '                                <option value="2023">2023</option>\n' +
                        '                                <option value="2024">2024</option>\n' +
                        '                                <option value="2025">2025</option>\n' +
                        '                                <option value="2026">2026</option>\n' +
                        '                                <option value="2027">2027</option>\n' +
                        '                                <option value="2028">2028</option>\n' +
                        '                                <option value="2029">2029</option>\n' +
                        '                                <option value="2030">2030</option>\n' +
                        '                                <option value="2031">2031</option>\n' +
                        '                                <option value="2032">2032</option>\n' +
                        '                                <option value="2033">2033</option>\n' +
                        '                                <option value="2034">2034</option>\n' +
                        '                                <option value="2035">2035</option>\n' +
                        '                                <option value="2036">2036</option>\n' +
                        '                                <option value="2037">2037</option>\n' +
                        '                                <option value="2038">2038</option>\n' +
                        '                                <option value="2039">2039</option>\n' +
                        '                                <option value="2040">2040</option>\n' +
                        '                            </select>\n' +
                        '                        </span>\n' +
                        '                        <div class="form-control-feedback invalid-feedback" id="id_error_attended_date_year"></div>\n' +
                        '                    </div>\n' +
                        '                </span>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '    </div>\n' +
                        '</form>';

                    var modal_optionsform = '' +
                        '<form class="mform">\n' +
                        '    <div class="form-row">\n' +
                        '        <div class="form-group col-lg-12 form-group-ele">\n' +
                        '            <button type="button" class="btn btn-outline-primary" data-action="view-certificate">View Certificate</button>\n' +
                        '            <button type="button" class="btn btn-outline-success" data-action="download-certificate">Download Certificate</button>\n' +
                        '        </div>\n' +
                        '    </div>\n' +
                        '    <div class="form-row">\n' +
                        '        <div class="form-group col-lg-12 form-group-ele">\n' +
                        '            <button type="button" class="btn btn-outline-info" data-action="edit-certificate">Edit</button>\n' +
                        '            <button type="button" class="btn btn-outline-danger" data-action="delete-certificate">Delete Certificate</button>\n' +
                        '            <button type="button" class="btn btn-outline-dark" data-action="readd-certificates">Add Certificate</button>\n' +
                        '        </div>\n' +
                        '    </div>\n' +
                        '    <div class="form-row">\n' +
                        '        <div class="form-group col-lg-12 form-group-ele">\n' +
                        '            <button type="button" class="btn btn-outline-warning" data-action="view-previous-certificates">View previous certificates</button>\n' +
                        '        </div>\n' +
                        '    </div>\n' +
                        '</form>';

                    $(document).on('click', '.upload-certificate', function (e) {
                        var clickedLink = $(e.currentTarget);
                        var hasClass = clickedLink.hasClass('upload-certificate');
                        // console.log('hasClass: ' + hasClass);

                        ModalFactory.create({
                            type: ModalFactory.types.SAVE_CANCEL,
                            title: 'Add Certificates',
                            body: modal_addform,
                        }).then(function (modal) {

                            $('#mformCertificate').trigger('reset');
                            modal.setSaveButtonText('Save');


                            var certificate_expire = clickedLink.data('cerexp');

                            var root = modal.getRoot();
                            root.on(ModalEvents.save, function () {
                                // var elementid = clickedLink.data('id');
                                if (c_update_status == '' || c_update_status==0) {
                                    notification.alert('Required', 'Update status is required');
                                    return false;
                                }

                                if (c_update_status == 4 &&(att_day == '' || att_month == '' || att_year =='')) {
                                    notification.alert('Required', 'Attended date is required');
                                    return false;
                                }
                                // Do something
                                var getForm = modal.getBody().find('form');
                                // var formData = getForm.serialize();
                                // console.log('formData: '+formData);

                                var form = getForm.get(0);
                                // console.log(form);
                                var formData = new FormData(form);
                                formData.append('certificate_user_id', clickedLink.data('cerusr'));
                                formData.append('certificate_types_id', clickedLink.data('certype'));
                                formData.append('certificate_expire', certificate_expire);

                                // +'&certificate_user_id='+clickedLink.data('cerusr')+'&certificate_types_id='+clickedLink.data('certype')
                                $.ajax({
                                    url: '/local/training_matrix/managecertificatesadd_data.php',
                                    type: 'post',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    dataType: 'json',
                                    success: function (response) {
                                        console.log('response: ' + response.expiry_date_view_format);
                                        if (response != 0) {
                                            clickedLink.removeClass('upload-certificate');
                                            clickedLink.addClass('view-certificate');

                                            clickedLink.removeClass("training-not-required no-action-requrired na expired-notheld expiring booked awaiting-certificate");
                                            clickedLink.text(response.txt);
                                            clickedLink.addClass(response.color_class);
                                            clickedLink.prop("title","");
                                            if(response.attended_date_view_format!='')
                                                clickedLink.prop("title","Course Attended Date: "+response.attended_date_view_format);

                                        } else {
                                            notification.alert('file not uploaded!', 'Ok');
                                        }
                                        modal.destroy();
                                    },
                                });
                            });

                            root.on(ModalEvents.cancel, function() {
                                modal.destroy();
                            });
                            if (hasClass) {
                                modal.show();
                                if (certificate_expire == 'No') {
                                    $('.for-no-expiration').hide();
                                }
                                $("#id_attended_date_day").on("change",function () {
                                    att_day = this.value;
                                })
                                $("#id_attended_date_month").on("change",function () {
                                    att_month = this.value;
                                })
                                $("#id_attended_date_year").on("change",function () {
                                    att_year = this.value;
                                })

                            }
                        });
                    });

                    $(document).on('click', '.view-certificate', function (e) {
                        e.preventDefault();
                        var clickedLink = $(e.currentTarget);
                        // console.log(clickedLink);
                        var hasClass = clickedLink.hasClass('view-certificate');
                        ModalFactory.create({
                            type: ModalFactory.types.DEFAULT,
                            title: 'Options',
                            body: modal_optionsform,
                        }).then(function (modal) {
                            if (hasClass) {
                                modal.show();
                            } else {
                                modal.destroy();
                            }
                            var modal_view_certificate = '' +
                                '<form class="mform">\n' +
                                '    <div class="form-row">\n' +
                                '        <div class="form-group col-lg-12 form-group-ele view_certificate"></div>\n' +
                                '    </div>\n' +
                                '</form>';
                            var trigger = $(SELECTORS.VIEW_CERTIFICATE_LINK);
                            trigger.on('click', function () {
                                $('#mformCertificate').trigger('reset');
                                modal.destroy();
                                ModalFactory.create({
                                    type: ModalFactory.types.DEFAULT,
                                    title: 'View Certificate',
                                    body: modal_view_certificate,
                                }).then(function (modal) {
                                    modal.show();
                                    var obj = {
                                        options: 'view_certificate',
                                        certificate_user_id: clickedLink.data('cerusr'),
                                        certificate_types_id: clickedLink.data('certype')
                                    };
                                    c_update_status = '';
                                    att_day = '';
                                    att_month = '';
                                    att_year = '';
                                    pull_managecertificatesoptions_data(obj, '.view_certificate');
                                });
                            }.bind(this));
                            var modal_download_certificate = '' +
                                '<form class="mform">\n' +
                                '    <div class="form-row">\n' +
                                '        <div class="form-group col-lg-12 form-group-ele download_certificate"></div>\n' +
                                '    </div>\n' +
                                '</form>';
                            var trigger = $(SELECTORS.DOWNLOAD_CERTIFICATE_LINK);
                            trigger.on('click', function () {

                                $.ajax({
                                    type: "POST",
                                    url: "/local/training_matrix/managecertificatesoptions_data.php",
                                    data: {
                                        options: 'download_certificate',
                                        certificate_user_id: clickedLink.data('cerusr'),
                                        certificate_types_id: clickedLink.data('certype')
                                    },
                                    dataType: 'json',
                                    success: function (data) {
                                        if (data.options == 'download_certificate' && data.html != "nofile") {
                                            modal.hide();
                                            modal.destroy();
                                            var a = document.createElement('a');
                                            a.href = data.html;
                                            a.download = data.html.split('/').pop();
                                            document.body.appendChild(a);
                                            a.click();
                                            document.body.removeChild(a);

                                        }
                                    }

                                });
                            }.bind(this));

                            var trigger = $(SELECTORS.EDIT_CERTIFICATE_LINK);
                            trigger.on('click', function () {
                                modal.destroy();
                                var hasClass = clickedLink.hasClass('view-certificate');
                                //console.log('hasClass: ' + hasClass);
                                ModalFactory.create({
                                    type: ModalFactory.types.SAVE_CANCEL,
                                    title: 'Edit Certificates',
                                    body: modal_addform,
                                }).then(function (modal) {
                                    $('#mformCertificate').trigger('reset');
                                    modal.setSaveButtonText('Save');
                                    var certificate_expire = clickedLink.data('cerexp');
                                    var root = modal.getRoot();
                                    root.on(ModalEvents.save, function () {
                                        // var elementid = clickedLink.data('id');
                                        if (c_update_status == '' || c_update_status==0) {
                                            notification.alert('Required', 'Update status is required');
                                            return false;
                                        }

                                        if (c_update_status == 4 &&(att_day == '' || att_month == '' || att_year =='')) {
                                            notification.alert('Required', 'Attended date is required');
                                            return false;
                                        }

                                        // Do something
                                        var getForm = modal.getBody().find('form');
                                        // var formData = getForm.serialize();
                                        // console.log('formData: '+formData);

                                        var form = getForm.get(0);
                                        // console.log(form);
                                        var formData = new FormData(form);
                                        formData.append('certificate_user_id', clickedLink.data('cerusr'));
                                        formData.append('certificate_types_id', clickedLink.data('certype'));
                                        formData.append('certificate_expire', certificate_expire);
                                        // +'&certificate_user_id='+clickedLink.data('cerusr')+'&certificate_types_id='+clickedLink.data('certype')
                                        $.ajax({
                                            url: '/local/training_matrix/managecertificatesadd_data.php',
                                            type: 'post',
                                            data: formData,
                                            processData: false,
                                            contentType: false,
                                            dataType: 'json',
                                            success: function (response) {

                                                if (response != 0) {
                                                    clickedLink.removeClass("training-not-required no-action-requrired na expired-notheld expiring booked awaiting-certificate");
                                                    clickedLink.removeClass('upload-certificate');
                                                    clickedLink.addClass('view-certificate');
                                                    clickedLink.text(response.txt);
                                                    clickedLink.addClass(response.color_class);
                                                    clickedLink.prop("title","");
                                                    if(response.attended_date_view_format!='')
                                                        clickedLink.prop("title","Course Attended Date: "+response.attended_date_view_format);

                                                } else {
                                                    notification.alert('file not uploaded!', 'Ok');
                                                }
                                                modal.destroy();
                                            },
                                        });
                                    });

                                    root.on(ModalEvents.cancel, function() {
                                        modal.destroy();
                                    });
                                    if (hasClass) {
                                        modal.show();
                                        if (certificate_expire == 'No') {
                                            $('.for-no-expiration').hide();
                                        }

                                        $("#id_attended_date_day").on("change",function () {
                                            att_day = this.value;
                                        })
                                        $("#id_attended_date_month").on("change",function () {
                                            att_month = this.value;
                                        })
                                        $("#id_attended_date_year").on("change",function () {
                                            att_year = this.value;
                                        })


                                        $("input[name='mformType']").val('edit');
                                        var obj = {
                                            options: 'edit_certificate',
                                            certificate_user_id: clickedLink.data('cerusr'),
                                            certificate_types_id: clickedLink.data('certype')
                                        };
                                        pull_managecertificatesoptions_data(obj, '');
                                    } else {
                                        modal.destroy();
                                    }
                                });
                            }.bind(this));
                            var trigger = $(SELECTORS.DELETE_CERTIFICATE_LINK);
                            trigger.on('click', function () {
                                modal.hide();
                                $.ajax({
                                    type: "POST",
                                    url: "/local/training_matrix/managecertificatesoptions_data.php",
                                    data: {
                                        options: 'delete_certificate',
                                        certificate_user_id: clickedLink.data('cerusr'),
                                        certificate_types_id: clickedLink.data('certype')
                                    },
                                    dataType: 'json',
                                    success: function (data) {
                                        //console.log(data);
                                        modal.destroy();
                                        if (data.options == 'delete_certificate') {
                                            clickedLink.removeClass("training-not-required no-action-requrired expired-notheld expiring booked awaiting-certificate").addClass("na");
                                            clickedLink.text('N/A');
                                            clickedLink.removeClass('view-certificate');
                                            clickedLink.addClass('upload-certificate');
                                            clickedLink.prop("title",'');

                                            c_update_status = '';
                                            att_day = '';
                                            att_month = '';
                                            att_year = '';

                                            notification.alert('Notification', 'Certificate has been deleted successfully');
                                        }
                                        else{
                                            notification.alert('Notification', 'Sorry, No certificate found');
                                        }
                                    }

                                });

                            }.bind(this));
                            var modal_view_previous_certificate = '' +
                                '<form class="mform">\n' +
                                '    <div class="form-row">\n' +
                                '        <div class="form-group col-lg-12 form-group-ele view_previous_certificates"></div>\n' +
                                '    </div>\n' +
                                '</form>';
                            var trigger = $(SELECTORS.VIEW_PREVIOUS_CERTIFICATES_LINK);
                            trigger.on('click', function () {
                                $('#mformCertificate').trigger('reset');
                                modal.destroy();
                                ModalFactory.create({
                                    type: ModalFactory.types.DEFAULT,
                                    title: 'View Previous Certificate',
                                    body: modal_view_previous_certificate,
                                }).then(function (modal) {
                                    modal.show();
                                    var obj = {
                                        options: 'view_previous_certificates',
                                        certificate_user_id: clickedLink.data('cerusr'),
                                        certificate_types_id: clickedLink.data('certype')
                                    };
                                    pull_managecertificatesoptions_data(obj, '.view_previous_certificates');
                                });
                            }.bind(this));

                            var trigger = $(SELECTORS.READD_CERTIFICATE_LINK);
                            trigger.on('click', function () {
                                modal.destroy();
                                var hasClass = clickedLink.hasClass('view-certificate');
                                //console.log('hasClass: ' + hasClass);
                                ModalFactory.create({
                                    type: ModalFactory.types.SAVE_CANCEL,
                                    title: 'Add Certificates',
                                    body: modal_addform,
                                }).then(function (modal) {
                                    modal.setSaveButtonText('Save');
                                    var certificate_expire = clickedLink.data('cerexp');
                                    var root = modal.getRoot();
                                    root.on(ModalEvents.save, function () {
                                        // var elementid = clickedLink.data('id');
                                        // Do something
                                        var getForm = modal.getBody().find('form');
                                        // var formData = getForm.serialize();
                                        // console.log('formData: '+formData);

                                        if (c_update_status == '' || c_update_status==0) {
                                            notification.alert('Required', 'Update status is required');
                                            return false;
                                        }

                                        if (c_update_status == 4 &&(att_day == '' || att_month == '' || att_year =='')) {
                                            notification.alert('Required', 'Attended date is required');
                                            return false;
                                        }

                                        var form = getForm.get(0);
                                        // console.log(form);
                                        var formData = new FormData(form);
                                        formData.append('certificate_user_id', clickedLink.data('cerusr'));
                                        formData.append('certificate_types_id', clickedLink.data('certype'));
                                        formData.append('certificate_expire', certificate_expire);
                                        // +'&certificate_user_id='+clickedLink.data('cerusr')+'&certificate_types_id='+clickedLink.data('certype')
                                        $.ajax({
                                            url: '/local/training_matrix/managecertificatesadd_data.php',
                                            type: 'post',
                                            data: formData,
                                            processData: false,
                                            contentType: false,
                                            dataType: 'json',
                                            success: function (response) {
                                                //console.log('response: ' + response);
                                                if (response != 0) {
                                                    clickedLink.removeClass("training-not-required no-action-requrired na expired-notheld expiring booked awaiting-certificate");
                                                    clickedLink.text(response.txt);
                                                    clickedLink.addClass(response.color_class);
                                                } else {
                                                    notification.alert('file not uploaded!', 'Ok');
                                                }
                                                modal.destroy();
                                            },
                                        });
                                    });
                                    root.on(ModalEvents.cancel, function() {
                                        modal.destroy();
                                    });
                                    if (hasClass) {
                                        modal.show();
                                        $("input[name='mformType']").val('re-add');
                                        if (certificate_expire == 'No') {
                                            $('.for-no-expiration').hide();
                                        }

                                        $("#id_attended_date_day").on("change",function () {
                                            att_day = this.value;
                                        })
                                        $("#id_attended_date_month").on("change",function () {
                                            att_month = this.value;
                                        })
                                        $("#id_attended_date_year").on("change",function () {
                                            att_year = this.value;
                                        })

                                    }
                                    else{
                                        modal.destroy();
                                    }
                                });
                            }.bind(this));
                        });
                    });

                });

            }
        }

    });
}

function pull_managecertificatesoptions_data(params_obj,containar) {
    $.ajax({
        type: "POST",
        url: "/local/training_matrix/managecertificatesoptions_data.php",
        data: params_obj,
        dataType: 'json',
        success: function(data){
            if(data.options=='edit_certificate'){
                $("select[name='expiry_date_day']").val(data.expiry_date_day).attr("selected", "selected");
                $("select[name='expiry_date_month']").val(data.expiry_date_month).attr("selected", "selected");
                $("select[name='expiry_date_year']").val(data.expiry_date_year).attr("selected", "selected");
                $("select[name='update_status']").val(data.update_status).attr("selected", "selected");

                $("select[name='attended_date_day']").val(data.attended_date_day).attr("selected", "selected");
                $("select[name='attended_date_month']").val(data.attended_date_month).attr("selected", "selected");
                $("select[name='attended_date_year']").val(data.attended_date_year).attr("selected", "selected");

                if( data.update_status==4){
                    $('.for-attended-date').show();
                }

                c_update_status = data.update_status;
                att_day         = data.attended_date_day;
                att_month       = data.attended_date_month;
                att_year        = data.attended_date_year;
            }
            else{
                $(containar).html(data.html);
            }
        }

    });
}


