require(["jquery"],function($) {
    pull_data();
    $("#accident_report").on( "click", function() {
        pull_data();
    });
});

function pull_data() {
    $.ajax({
        type: "POST",
        url: "/local/trend_analysis_report/accident_report_data.php",
        data: $(".mform").serialize(),
        success: function(data){




            $('#ajax_content').html(data);

            jQuery.noConflict();

            $('#dwn_accident_report_csv').on("click", function (e) {
                window.onbeforeunload = null;
                e.preventDefault();
                document.location.href = '/local/trend_analysis_report/accident_report_csv.php';
            });

            $('.c8').attr('title', 'RIDDOR event classification');
            $('.c8').attr('data-toggle','tooltip');
            $('.c10').attr('title', 'Medical Treatment over first aid');
            $('.c10').attr('data-toggle','tooltip');

            jQuery('[data-toggle="tooltip"]').tooltip();

            $('.list-accident').DataTable({
                "destroy": true,
                "searching": false,
                "columnDefs" : [{"targets":0, "type":"date-eu"}]
            });

        }

    });
}


