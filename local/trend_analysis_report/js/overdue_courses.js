require(["jquery"],function($) {
    pull_data();
    $("#overdue_courses").on( "click", function() {
        pull_data();
    });

    // $("#course_category").on( "change", function() {
    //     var retval = [];
    //     $('option:selected', $(this)).each(function() {
    //         retval.push($(this).val());
    //     });
    //     pull_course_subcategory_data(retval);
    // });

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
        url: "/local/trend_analysis_report/overdue_courses_data.php",
        data: $("#mform1").serialize(),
        success: function(data){
            $('#ajax_content').html(data);
            jQuery.noConflict();
            $('.overdue-courses').DataTable({
                "destroy": true,
                "searching": false,
                "columnDefs" : [{"targets":1, "type":"date-eu"}]
            });

            $('#dwn_overdue_courses_csv').on("click", function (e) {
                window.onbeforeunload = null;
                e.preventDefault();
                document.location.href = '/local/trend_analysis_report/overdue_courses_csv.php';
            });
        }

    });
}

// function pull_course_subcategory_data(vals) {
//     $.ajax({
//         type: "POST",
//         url: "/local/trend_analysis_report/search_courses_subcategories_data.php",
//         data: {category:vals},
//         success: function(data){
//             $('#course_subcategory').html(data);
//         }
//
//     });
// }