require(["jquery"],function($) {
    pull_data();
    $("#search_courses").on( "click", function() {
        pull_data();
    });

    $("#enable_date").on("click",function () {

        if(this.checked){
            $("#id_date_from_day").removeAttr('disabled');
            $("#id_date_from_month").removeAttr('disabled');
            $("#id_date_from_year").removeAttr('disabled');

            $("#id_date_to_day").removeAttr('disabled');
            $("#id_date_to_month").removeAttr('disabled');
            $("#id_date_to_year").removeAttr('disabled');
            $("#id_date_from_calendar").removeAttr('disabled');
        }
        else{
            $("#id_date_from_day").attr('disabled','disabled');
            $("#id_date_from_month").attr('disabled','disabled');
            $("#id_date_from_year").attr('disabled','disabled');

            $("#id_date_to_day").attr('disabled','disabled');
            $("#id_date_to_month").attr('disabled','disabled');
            $("#id_date_to_year").attr('disabled','disabled');
            $("#id_date_from_calendar").attr('disabled','disabled');
        }
    });
});

function pull_data() {
    $.ajax({
        type: "POST",
        url: "/local/trend_analysis_report/course_completion_data.php",
        data: $(".mform").serialize(),
        success: function(data){
            $('#ajax_content').html(data);
            jQuery.noConflict();
            $('.list-courses').DataTable({
                "destroy": true,
                "searching": false
            });

            $('#dwn_course_completion_csv').on("click", function (e) {
                window.onbeforeunload = null;
                e.preventDefault();
                document.location.href = '/local/trend_analysis_report/course_completion_csv.php';
            });
        }

    });
}
