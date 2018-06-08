
    //hide add level field initially
    $("#remove-text").hide();
    $("#add-rm-block").hide();

    var levelId = 0;
    var criterias = [];
    //confirm criteria
    $("#confirm").click(function(){
        var val = $("#cret-type").val();
        if(val.length > 0) {
            $("#remove-text").slideDown("fast");
            criterias.push(val);
            levelId++;
            $("#added").append("<div id='level-id"+levelId+"' class='row m-0 pt-1 border border-secondary p-1'>\n" +
                "    <div class='col'>\n" +
                "        <p class='h-6'>"+val+"</p>\n" +
                "    </div>\n" +
                "</div>");
            $("#add-rm-block").fadeIn(150);
        }

        $("#cret-type").val('');
    });

    //remove level criteria
    $("#remove-text").click(function(){
        $('#level-id'+levelId).remove();

        if(levelId > 0) {
            levelId--;
            criterias.splice(criterias.length - 1, 1);
        }
        if(levelId == 0) {
            $("#add-rm-block").fadeOut(150);
            criterias = [];
        }
    });

    //submit data
    $("#submit").click(function(){
        sendLevelName($("#level-name").val(), criterias);
        $("#add-rm-block").hide();
        $("#level-name").val('')
        $("#added").html('');
        criterias = [];
        window.location = "./create";
    });

    //disable level
    $("a").find("button").click(function (event) {
        //stop redirecting to next page
        event.preventDefault();

        //set id
        var btnId = this.id.split("-");
        var id = btnId[1]; var active;
        if(btnId[0] == "disable") {
            active = 0;
        } else {
            active = 1;
        }

        //send disable or enable flag to php
        $.post("./levels", {level_id:id, active:active}, function(response){
            location.reload(true);
        });
    });

    //send array of data to php file
    function sendData(data) {
        $.ajax({
            type: "POST",
            url: "./levels",
            data: { data : data},
            success: function(response) {
                alert(response);
            }
        });
    }

    //send single input and array of data to php file
    function sendLevelName(input, data) {
        $.post("./levels", {input:input, data:data}, function(response){
            // alert(response);
        });
    }

