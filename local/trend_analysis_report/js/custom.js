require(["jquery"],function($) {

    $('#accident_link').on('click', function(e) {
        window.onbeforeunload = null;
        e.preventDefault();
        window.location = '/local/mp_report/index.php?cmd=form1';
    });

    $('#incident_link').on('click', function(e) {
        window.onbeforeunload = null;
        e.preventDefault();
        window.location = '/local/mp_report/index.php?cmd=form2';
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
    $("#id_RIDDOR_subcategory").children('option').hide();
    //$("#id_RIDDOR_subcategory").prop("disabled", true);

    $("#id_s_mgt_rpt_riddor_event_clf").change(function () {
        $("#id_RIDDOR_subcategory").val("");
        $("#id_RIDDOR_subcategory").children('option').hide();

        var riddor_id = $(this).val();
        if(riddor_id==20 || riddor_id==17 || riddor_id==21) {
            $("#id_RIDDOR_subcategory").prop("disabled", false);
        }
        else{
            $("#id_RIDDOR_subcategory").prop("disabled", true);
        }
        $('#id_RIDDOR_subcategory > option').each(function() {

            if(riddor_id==20 && $(this).val()>80 && $(this).val()<87) {
                $("#id_RIDDOR_subcategory").children("option[value^=" + $(this).val() + "]").show();
            }
            else if(riddor_id==17 && $(this).val()>93 && $(this).val()<102) {
                $("#id_RIDDOR_subcategory").children("option[value^=" + $(this).val() + "]").show();
            }
            else if(riddor_id==21 && $(this).val()>101 && $(this).val()<119) {
                $("#id_RIDDOR_subcategory").children("option[value^=" + $(this).val() + "]").show();
            }

            //alert($(this).text() + ' ' + $(this).val());
        });

    });

    //$(".fancybox").fancybox();

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
