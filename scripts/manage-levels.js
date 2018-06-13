$(document).ready(function () {
    //hide import from existing levels field
    $("#import-from-levels").hide();
    //hide remove buttons
    $("#rm-pres-btn").hide();
    $("#rm-cont-btn").hide();
    //hide expand criteria btn
    $("#expand-criteria").hide();

    //show existing levels if user want to choose questions from there
    $("#add-oldQues-btn").click(function () {
        //show import from existing level
        $("#import-from-levels").slideDown("fast");
    });

    var questions = [];
    //show imported questions on change event
    $("#select-from").on('change', function () {
        //clear div and questions array on event change
        $("#imported-questions").html(''); questions = [];
        //get level id
        var id = $("#select-from").val();

        if (id != "none") {
            $.post("./levels", {select_from:id, get_criteria:'yes'}, function(result){
                result = JSON.parse(result);

                var question = ""; var weight = ""; var label = ""; var isContent = "";
                //loop over database results we get from server
                for (var i = 0; i < result.length; i++) {
                    label = "Content Question";
                    $.each(result[i], function(key, val) {
                        if (key == "criteria") {
                            question = val;
                        }
                        if (key == "weight") {
                            weight = val;
                        }
                        if (key == "content_ques") {
                            if (val == 0) {
                                label = "Presentation Criteria";
                                isContent = 0;
                            } else
                                isContent = 1;
                        }
                    });

                    //push imported question to array
                    questions.push({ques: question, weigh: weight, isQues: isContent});
                    $("#imported-questions").append("<div class=\"form-group row\">\n" +
                        "                                            <div class=\"col-md-9\">\n" +
                        "                                                <small><label class=\"font-weight-light text-muted\">"+ label +": </label></small>\n" + question +
                        "                                            </div>\n" +
                        "                                            <div class=\"col-md-3\">\n" +
                        "                                                <small><label class=\"font-weight-light text-muted\">Weight: </label></small>\n" + weight +
                        "                                            </div>\n" +
                        "                                        </div>");
                    $("#expand-criteria").show(150);
                    $("#criteria-text").hide();
                }
            });
        }
    });

    //hide show criteria text on down arrow btn click
    $("#expand-criteria").click(function () {
        $("#criteria-text").toggle(150);
        $("#arrow").toggleClass("fa fa-angle-down fa fa-angle-up");
    });

    var contentQuesNumber = 0;
    //add more content question field
    $("#add-cont-ques").click(function(){

        contentQuesNumber++;
        $("#new-cont-ques").append("<div id='cont"+ contentQuesNumber +"' class='row form-group'>\n" +
            "                                        <div class='col-9'>\n" +
            "                                            <input class='form-control' type='text' name='c-ques[]' placeholder='Question: '>\n" +
            "                                        </div>\n" +
            "\n" +
            "                                        <div class='col-3 text-right'>\n" +
            "                                            <input class='form-control' type='text' name='c-weight[]' placeholder='Weight:'>\n" +
            "                                        </div>\n" +
            "                                    </div>");
        $("#rm-cont-btn").fadeIn(150);
    });

    var presentationQuesNum = 0;
    //add more presentation questions field
    $("#add-presentation-ques").click(function(){

        presentationQuesNum++;
        $("#new-p-ques").append("<div id='pres"+ presentationQuesNum +"' class='row form-group'>\n" +
            "                                        <div class='col-9'>\n" +
            "                                            <input class='form-control' type='text' name='p-ques[]' placeholder='Question: '>\n" +
            "                                        </div>\n" +
            "\n" +
            "                                        <div class='col-3 text-right'>\n" +
            "                                            <input class='form-control' type='text' name='p-weight[]' placeholder='Weight:'>\n" +
            "                                        </div>\n" +
            "                                    </div>");
        $("#rm-pres-btn").fadeIn(150);
    });

    //remove presentation question type on remove btn click
    $("#rm-pres-btn").click(function(){
        $('#pres'+presentationQuesNum).remove();

        if(presentationQuesNum > 0) {
            presentationQuesNum--;
        }
        if(presentationQuesNum == 0) {
            $("#rm-pres-btn").fadeOut(150);
        }
    });

    //remove content question type by clicking on remove btn
    $("#rm-cont-btn").click(function(){
        $('#cont'+contentQuesNumber).remove();

        if(contentQuesNumber > 0) {
            contentQuesNumber--;
        }
        if(contentQuesNumber == 0) {
            $("#rm-cont-btn").fadeOut(150);
        }
    });

    //submit level and question data
    $("form").on("submit", function(event){
        event.preventDefault();
        //serialize form data
        var data = $('form').serializeArray();
        data.push({name:'submit', value:'clicked'});

        // send level name and questions data
        $.post("./levels", data, function(response){

            response = JSON.parse(response);
            //check type of response we get from php
            if (jQuery.type(response) == "object") {
                //loop over the object and append the error text
                $.each(response, function( key, value ) {
                    $("#" + key).css("border", value);
                });
            } else {
                //send imported data
                send(response, questions);
                $('form').find("input[type=text]").val("");
                // window.history.back();
            }
        });

        questions = []; $("#imported-questions").html('');
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
    function send(input, data) {
        $.post("./levels", {im_level:input, im_questions:data}, function(response){
            alert(response);
        });
    }

    //Go back to previous page by clicking on back button
    $("#go-back").click(function (event) {
        event.preventDefault();
        window.history.back();
    });
});

