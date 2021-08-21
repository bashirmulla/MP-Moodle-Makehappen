require(["jquery"],function($) {
    pull_data();
    $("#accident_incident_near_miss_hazard_analysis").on( "click", function(e) {
        window.onbeforeunload = null;
        e.preventDefault();
        pull_data();
    });
});

function pull_data() {
    $.ajax({
        type: "POST",
        dataType : 'html',
        url: "/local/trend_analysis_report/accident_incident_near_miss_hazard_analysis_data.php",
        data: $(".mform").serialize(),
        success: function(data){
            $('#ajax_content').html(data);
        }

    });
}
