require(['jquery', 'core/modal_factory', 'core/notification', 'core/modal_events', 'core/templates','core/str'], function ($, ModalFactory, notification, ModalEvents, Templates,str) {


    $(document).on('click', '#del_riddor_file', function (e) {

        var clickedLink = $(e.currentTarget);
        var id          = clickedLink.data("id");

        str.get_strings([
            {key: 'delete'},
            {key: 'confirmdeletedata', component: 'accident_report'},
            {key: 'yes'},
            {key: 'no'},
        ]).done(function(s) {
                notification.confirm(s[0], "Are you sure, want to delete this  RIDDOR files?", s[2], s[3], function() {

                    $.ajax({
                        url: '/local/accident_report/h_s_data.php?cmd=del_riddor_file&id='+id,
                        type: 'post',
                        data: "",
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function (response) {
                            if (response != "") {
                                notification.alert('Success', 'File has been deleted');
                                $(".riddor_file_td").find('a[data-id='+id+']').each(function(){
                                    $(this).parents("tr").remove();

                                });

                            } else {
                                notification.alert('Error','Unable to delete the file');
                            }

                        },
                    });
                });
            }
        );



    });

    $(document).on('change', '#riddor_file', function (e) {
        var clickedLink = $(e.currentTarget);
        var formData = new FormData();
        formData.append('upload_file', $('#riddor_file')[0].files[0]);
        formData.append('accident_id', clickedLink.data('accid'));
        if($('#riddor_file')[0].files[0]) {
            $.ajax({
                url: '/local/accident_report/h_s_data.php',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'text',
                success: function (response) {
                    if (response != "") {
                        notification.alert('Success', 'file has been uploaded successfully');
                        $('.riddor_file_td tr:last').after(response);
                        $('#riddor_file').val("");
                        //location.reload();

                    } else {
                        notification.alert('Error', 'file not uploaded!');
                    }

                },
            });
        }
        else{

        }
    });

    $(document).on('click', '#id_riddor_files', function (e) {

        var modal_addform = '<form autocomplete="off" method="post" accept-charset="utf-8" id="riddorfiles" class="mform" enctype="multipart/form-data">\n' +
            '    <div class="fcontainer clearfix">\n' +
            '        <div class="form-group row fitem ">\n' +
            '            <div class="col-md-3">\n' +
            '                <label class="col-form-label d-inline " for="id_file_name">\n' +
            '                    File Name \n' +
            '                </label>\n' +
            '            </div>\n' +
            '            <div class="col-md-9 form-inline felement" data-fieldtype="file">\n' +
            '                <input  type="text" name="file_name" id="id_file_name">\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="form-group row fitem ">\n' +
            '            <input name="mformType" type="hidden" value="add">\n' +
            '            <div class="col-md-3">\n' +
            '                <label class="col-form-label d-inline " for="id_upload_file">\n' +
            '                    Upload File \n' +
            '                </label>\n' +
            '            </div>\n' +
            '            <div class="col-md-9 form-inline felement" data-fieldtype="file">\n' +
            '                <input accept=".pdf, .jpg, .jpeg" maxlength="200" size="40" name="upload_file" type="file" id="id_upload_file">\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</form>';
        var clickedLink = $(e.currentTarget);
        // console.log('hasClass: ' + hasClass);

        ModalFactory.create({
            type: ModalFactory.types.SAVE_CANCEL,
            title: 'Add RIDDOR files',
            body: modal_addform,
        }).then(function (modal) {

            $('#riddorfiles').trigger('reset');
            modal.setSaveButtonText('Save');

            var root = modal.getRoot();
            root.on(ModalEvents.save, function () {

                // Do something
                var getForm = modal.getBody().find('form');


                var form = getForm.get(0);
                // console.log(form);
                var formData = new FormData(form);
                formData.append('accident_id', clickedLink.data('accid'));
                // +'&certificate_user_id='+clickedLink.data('cerusr')+'&certificate_types_id='+clickedLink.data('certype')
                $.ajax({
                    url: '/local/accident_report/h_s_data.php',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (response) {
                        console.log('response: ' + response.expiry_date_view_format);
                        if (response != "") {
                            notification.alert('file has been uploaded successfully', 'OK');

                        } else {
                            notification.alert('file not uploaded!', 'OK');
                        }
                        modal.destroy();
                    },
                });
            });

            root.on(ModalEvents.cancel, function() {
                modal.destroy();
            });

            modal.show();

        });
    });

    $('#accident_link').on('click', function() {
        window.location = '/local/accident_report/index.php?cmd=form1';
    });

    $('#incident_link').on('click', function() {
        window.location = '/local/accident_report/index.php?cmd=form2';
    });

    $('#add').on('click', function() {


        this.submit();
    });

    $('#id_lost_time_No').on('click', function() {
        $('#lost_time_days').val("");
    });
    $('#id_report_to_client').on('change', function() {
        $('#id_report_priority').val("");
    });


    $("#categorisation").on("change", function () {
        $('#vehicle').val("");
        $('#equipment').val("");
        $('#environment').val("");
        $('#attack').val("");
    });

    $("#id_correct_report_category").on("change", function () {
        $('#categorisation').val("");
        $('#vehicle').val("");
        $('#equipment').val("");
        $('#environment').val("");
        $('#attack').val("");

        $("#vehicle").prop("disabled", true);
        $("#equipment").prop("disabled", true);
        $("#environment").prop("disabled", true);
        $("#attack").prop("disabled", true);
    });
    //$("#id_riddor_subcategory").children('option').hide();
    //$("#id_riddor_subcategory").prop("disabled", true);

    $("#id_s_mgt_rpt_2508_completed").on("change",function() {

        if(this.value!=1){

            $("#id_s_mgt_rpt_riddor_event_clf").val("");
            $("#id_riddor_subcategory").val("");
            $("#riddor_file_div").hide();
            $("#riddor_file_table").hide();
        }else{

            var rpt_2508  = $("#id_s_mgt_rpt_2508_completed").val();
            var riddor_id = $("#id_s_mgt_rpt_riddor_event_clf").val();
            if(riddor_id=='' && rpt_2508!='Yes'){
                $("#riddor_file_div").hide();
                $("#riddor_file_table").hide();
            }
            else{
                $("#riddor_file_div").show();
                $("#riddor_file_table").show();
            }

        }
    })


    var rpt_2508  = $("#id_s_mgt_rpt_2508_completed").val();
    var riddor_id = $("#id_s_mgt_rpt_riddor_event_clf").val();
    if(riddor_id=='' && rpt_2508!='Yes'){
        $("#riddor_file_div").hide();
        $("#riddor_file_table").hide();
    }
    else{
        $("#riddor_file_div").show();
        $("#riddor_file_table").show();
    }

    $("#id_s_mgt_rpt_riddor_event_clf").change(function () {
        $("#id_riddor_subcategory").val("");

        $("#id_riddor_subcategory").children('option').hide();

        var riddor_id = $(this).val();

        if(riddor_id==''){
            $("#riddor_file_div").hide();
            $("#riddor_file_table").hide();
        }
        else{
            $("#riddor_file_div").show();
            $("#riddor_file_table").show();
        }

        if(riddor_id==20 || riddor_id==17 || riddor_id==21) {
            $("#id_riddor_subcategory").prop("disabled", false);
        }
        else{
            $("#id_riddor_subcategory").prop("disabled", true);
        }
        $('#id_riddor_subcategory > option').each(function() {

            if(riddor_id==20 && $(this).val()>80 && $(this).val()<87) {
                $("#id_riddor_subcategory").children("option[value^=" + $(this).val() + "]").show();
            }
            else if(riddor_id==17 && $(this).val()>93 && $(this).val()<102) {
                $("#id_riddor_subcategory").children("option[value^=" + $(this).val() + "]").show();
            }
            else if(riddor_id==21 && $(this).val()>101 && $(this).val()<119) {
                $("#id_riddor_subcategory").children("option[value^=" + $(this).val() + "]").show();
            }

            //alert($(this).text() + ' ' + $(this).val());
        });

    });

    $("#mform1").submit(function (e) {

        //stop submitting the form to see the disabled button effect
        e.preventDefault();
        //disable the submit button
        $("#save").attr("disabled", true);
        this.submit();
    });

    //$(".fancybox").fancybox();
    $('#item-confirm').on('click', function(e) {
        var id = $("input[name='id']").val();
        var cmd = $("input[name='cmd']").val();
        $("input[name='read_only']").val(1);



        // alert(cmd);
        if (confirm('This will finalise the report. Please confirm you wish to continue?')) {
            $("#item-confirm").attr("disabled", true);
            this.submit();
        } else {
            return false;
        }
        // var clickedLink = $(e.currentTarget);
        // ModalFactory.create({
        //     type: ModalFactory.types.SAVE_CANCEL,
        //     title: 'Delete item',
        //     body: 'Do you really want to delete?',
        // })
        //     .then(function(modal) {
        //         modal.setSaveButtonText('Delete');
        //         var root = modal.getRoot();
        //         root.on(ModalEvents.save, function() {
        //             var elementid = clickedLink.data('id');
        //             // Do something to delete item
        //         });
        //         modal.show();
        //     });
    });

});


function disable_witnesses(thisfield) {

    if(thisfield==1){

        if($('#witnesses_name').val()=='') {
            $('#witnesses_name').attr("required", "true");
            $('#witnesses_name').addClass("is-invalid");
        }

        if($('#witnesses_name').val()=='') {
            $('#witnesses_address').attr("required", "true");
            $('#witnesses_address').addClass("is-invalid");
        }

        if($('#witnesses_phone_number').val()=='') {
            $('#witnesses_phone_number').attr("required", "true");
            $('#witnesses_phone_number').addClass("is-invalid");
        }

        if($('#witnesses_report_details').val()=='') {
            $('#witnesses_report_details').attr("required", "true");
            $('#witnesses_report_details').addClass("is-invalid");
        }
    }
    else{
        $('#witnesses_name').val('');
        $('#witnesses_name').removeClass("is-invalid");

        $('#witnesses_address').val('');
        $('#witnesses_address').removeClass("is-invalid");

        $('#witnesses_phone_number').val('');
        $('#witnesses_phone_number').removeClass("is-invalid");

        $('#witnesses_report_details').val('');
        $('#witnesses_report_details').removeClass("is-invalid");
    }
}


