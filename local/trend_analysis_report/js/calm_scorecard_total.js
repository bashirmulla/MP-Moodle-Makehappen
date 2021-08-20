require(["jquery"],function($) {
    pull_data('');
    $('.cur_year a.dropdown-item').on('click', function(){
        pull_data($(this).text());
        $('#dropdownMenuButton').text($(this).text());
        $('.cur_year a.dropdown-item').removeClass('active');
        $(this).addClass('active');
    });
});

function pull_data(year) {
if(year=='') year = $('#default_year').val();
    $.ajax({
        type: "POST",
        dataType : 'html',
        url: "/local/trend_analysis_report/calm_scorecard_total_data.php",
        data: {year:year},
        success: function(data){
            $('#ajax_content').html(data);
            $('#dwn_calm_scorecard_total_pdf').on("click", function (e) {
                window.onbeforeunload = null;
                e.preventDefault();
                document.location.href = '/local/trend_analysis_report/calm_scorecard_total_pdf.php';
            });
        }

    });
}