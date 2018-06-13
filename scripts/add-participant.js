    var counter = 0;
    var data = [];

    //hide results initially
    $("#results").hide();

    //display added participants
    $("form").on("submit", function () {
        event.preventDefault();

        //input data
        var first = $("#first_name").val();
        var last = $("#last_name").val();
        var name = first + ' ' + last;
        var dob = $("#dob").val();
        var gender = $('#gender').val();

        //adjust styles
        $("#first-box").removeClass("offset-md-3");
        $("#results").slideDown().delay(200);
        $("#results").addClass("col-md-6 field");

        //add new block
        counter++;
        $("#added-info").append("<div id='added-" + counter + "' class=\"form-group row m-0 border border-primary p-1\">\n" +
            "                    <div class=\"col-4 text-center\">\n" +
            "                        <label class=\"text-muted\"><small>Name: </small></label><br>\n" + name +
            "                    </div>\n" +
            "                    <div class=\"col-4 text-center\">\n" +
            "                        <label class=\"text-muted\"><small>Date of birth: </small></label><br>\n" + dob +
            "                    </div>\n" +
            "                    <div class=\"col-4 text-center\">\n" +
            "                        <label class=\"text-muted\"><small>Gender: </small></label><br>\n" + gender +
            "                    </div>\n" +
            "                </div>");

        //get input field data
        var detail = first + "|" + last + "|" + dob + "|" + gender;
        data.push(detail);

        var form_data = $('form').serializeArray();
        $.post("./add-participant", form_data, function(response){
            // alert(response);
        });

        $("input").val(''); $("#gender").val("none");
    });

    //send all added names to php file
    $("#add-all").click(function(){
        $.post("./add-participant", {data:data}, function(response){
            // alert(response);
            var time = 0;
            for(var i = counter; i > 0; i--) {
                // $("#added-"+i).remove();
                time += 120*i;
                $("#added-"+i).delay(120*i).remove();
            }

            success(time);
            success_msg();
        });
    });

    //remove added participant
    $("#remove").on("click", function () {
        $("#added-"+counter).remove();

        if(counter > 0)
            counter--;
        if(counter <= 0)
        {
            adjustStyles();
        }
    });

    //adjust styles
    function adjustStyles() {
        $("#results").slideUp();
        $("#first-box").addClass("offset-md-3");
        $("#results").removeClass("col-md-6 field");
    }

    function success(time) {
        setTimeout(function() {
            adjustStyles();
        }, time);
    }

    //success message for adding manual participants
    function success_msg() {
        setTimeout(function() {
            $("#overlay").removeClass("overlay h4 p-3 ml-4");
            $("#overlay").html("");
            window.history.back();
            // window.location = "./create";
        }, 2000);
        $("#overlay").addClass("overlay h4 p-3 ml-4");
        $("#overlay").html("Participants Added &#10003;");
    }

    //Go back to previous page by clicking on back button
    $("#go-back").click(function (event) {
        event.preventDefault();
        window.history.back();
    });