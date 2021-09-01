require(["jquery"],function($) {
    $("#id_idnumber").attr('readonly',"readonly");

    var catStr = $("#catArr").val();
    var catYear = $("#catYear").val();

    var catArr = (JSON.parse(catStr));

    $("#id_category").on("change",function () {


        if($("#id_category").val()!='')
        {
            var sortname = catArr[$("#id_category").val()];
            var id = sortname + "-" + $("#course_id").val() + "-" + catYear;
            $("#id_idnumber").val(id);
        }
        else{
            $("#id_idnumber").val('');
        }

    })

    if($("#id_idnumber").val()==''){
        var sortname = catArr[$("#id_category").val()];
        var id = sortname + "-" + $("#course_id").val() + "-" + catYear;
        $("#id_idnumber").val(id);
    }



    //alert($("#id_idnumber").val());

});
