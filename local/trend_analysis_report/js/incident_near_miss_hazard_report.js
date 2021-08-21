require(['jquery','core/ajax'],function($,ajax) {
    pull_data();
    $("#incident_near_miss_hazard_report").on( "click", function() {
        pull_data()
    });


    // var promises = ajax.call([
    //     { methodname: 'core_get_string', args: { component: 'mod_wiki', stringid: 'pluginname' } },
    //     { methodname: 'core_get_string', args: { component: 'mod_wiki', stringid: 'changerate' } }
    // ]);
    //
    // promises[0].done(function(response) {
    //     console.log('mod_wiki/pluginname is' + response);
    // }).fail(function(ex) {
    //     // do something with the exception
    // });
    //
    // promises[1].done(function(response) {
    //     console.log('mod_wiki/changerate is' + response);
    // }).fail(function(ex) {
    //     // do something with the exception
    // });
});

function pull_data() {
    $.ajax({
        type: "POST",
        url: "/local/trend_analysis_report/incident_near_miss_hazard_report_data.php",
        data: $(".mform").serialize(),
        success: function(data){
            $('#ajax_content').html(data);
            jQuery.noConflict();

            $('.list-incident').DataTable({
                "destroy": true,
                "searching": false,
                "columnDefs" : [{"targets":0, "type":"date-eu"}]
            });

            $('#dwn_incident_near_miss_hazard_report_csv').on("click", function (e) {
                window.onbeforeunload = null;
                e.preventDefault();
                document.location.href = '/local/trend_analysis_report/incident_near_miss_hazard_report_csv.php';
            });
        }

    });
}
