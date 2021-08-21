require(["jquery"],function($) {
    pull_data();
    $("#toolbox_talks_by_category").on( "click", function() {
        pull_data();
    });
});

function pull_data() {
    $.ajax({
        type: "POST",
        dataType : 'html',
        url: "/local/trend_analysis_report/toolbox_talks_by_category_data.php",
        data: $(".mform").serialize(),
        success: function(data){
            console.log(data);
            $('#ajax_content').html(data);
            $('#dwn_toolbox_talks_by_category_csv').on("click", function (e) {
                window.onbeforeunload = null;
                e.preventDefault();
                document.location.href = '/local/trend_analysis_report/toolbox_talks_by_category_csv.php';
            });
        }

    });
}
