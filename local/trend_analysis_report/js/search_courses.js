require(["jquery"],function($) {
    pull_data();
    $("#search_courses").on( "click", function(e) {
        window.onbeforeunload = null;
        e.preventDefault();
        pull_data();
    });

    $("#course_category").on( "change", function() {
        var retval = [];
        $('option:selected', $(this)).each(function() {
            retval.push($(this).val());
        });
        pull_course_subcategory_data(retval);
    });
});

function pull_data() {
    $.ajax({
        type: "POST",
        url: "/local/trend_analysis_report/search_courses_data.php",
        data: $("#mform1").serialize(),
        success: function(data){
            $('#ajax_content').html(data);
            jQuery.noConflict();
            $('.list-courses').DataTable({
                "destroy": true,
                "searching": false,
                "columnDefs" : [{"targets":4, "type":"date-eu"}]
            });
        }

    });
}

function pull_course_subcategory_data(vals) {
    $.ajax({
        type: "POST",
        url: "/local/trend_analysis_report/search_courses_subcategories_data.php",
        data: {category:vals},
        success: function(data){
            $('#course_subcategory').html(data);
        }

    });
}