require(['jquery'], function($) {
    pull_data();
    $("#searchqualifications").on( "click", function() {
        pull_data();
    });

});

function pull_data() {
    jQuery.noConflict();
    $("#id_certificate_type").chosen({width: "400px",height:"100px"});
    $.ajax({
        type: "POST",
        url: "/local/training_matrix/searchqualifications_data.php",
        data: $(".mform").serialize(),
        success: function(data){
            $('#ajax_content').html(data);
            jQuery.noConflict();
            // $('.managecertificates').DataTable({
            //     "destroy": true,
            //     "searching": false,
            //     "columnDefs" : [{"targets":9, "orderable": false}]
            // });
        }

    });
}


