
//Hide fields
$("#list-head").hide();

//create competition
$("form").on("submit", function (event) {
    event.preventDefault();
    var msg = "Competition Created";
    //serialize form data
    var data = $('form').serializeArray();
    data.push({name:'submit', value:'clicked'});

    //push form entry if admin adding data from excel
    if($("#fileToUpload").val()) {
        data.push({name:'add-excel', value:'clicked'});
    }
    if ($("input[name=comp-name]").attr('id')) {
        msg = "Level Successfully Added";
        data.push({name:'comp-name', value:$("input[name=comp-name]").attr('id')});
    }

    //send from data using post method to the current route
    $.post(window.location, data, function(response){
        //convert data into json form for accessing the php array
        response = JSON.parse(response);
        console.log(jQuery.type(response));


        //check type of response we get from php
        if (jQuery.type(response) == "object") {
            //loop over the object and append the error text
            $.each(response, function( key, value ) {
                // console.log( key + ": " + value );
                $("#" + key).html(value);
            });
        } else {
            //read the excel if user selected. if not that means admin
            //adding participants manually
            if ($("#fileToUpload").val()) {
                var comp_id = response;
                if($("#fileToUpload").val()) {
                    readFile(comp_id);
                }
            }
            //show success message
            success_msg(msg);
        }
    });
});

//read uploaded excel file
function readFile(comp_id) {
    $.post("./models/readExcel.php",
        {comp_id:comp_id, level_id: $("#select-level").val()},
        function(response){
            console.log(response);
            // alert(response);
            if (comp_id < 0)
                showParticipantList(response); //show the list of participants
    });
}

//upload file on click
$("#upload").click(function(evt){
    evt.preventDefault();

    var file_data = $("#fileToUpload").prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('upload', 'clicked');

    //send ajax request
    $.ajax({
        url: './models/uploadFile.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(response){
            // alert(response);
            $("#message").removeClass();
            if(response == "success") {
                success();
                //send negative value to php to know user have not yet clicked on create btn
                readFile(-1);
            } else {
                $("#message").addClass("text-danger text-center");
                $("#message").html(response);
            }
        }
    });
});

//method that show list of participants
function showParticipantList(data) {
    $("#display-list").html('');
    data = JSON.parse(data);

    var participant = [];
    $("#list-head").slideDown("fast");

    for (var i = 0; i < data.length; i++) {
        if (data[i] != "||") {
            participant.push(data[i]);

            if (participant.length >= 4) {
                $("#display-list").append("<div class=\"form-group row border border-gray bg-light\">\n" +
                    "                        <div class=\"col-md-4\">\n" +
                    "                            <label><small>Name:</small></label>\n" +
                    "                            \n" + participant[0] +" "+ participant[1] +
                    "                        </div>\n" +
                    "                        <div class=\"col-md-4\">\n" +
                    "                            <label><small>Birth Date:</small></label>\n" +
                    "                            \n" + participant[2] +
                    "                        </div>\n" +
                    "                        <div class=\"col-md-4\">\n" +
                    "                            <label><small>Gender:</small></label>\n" +
                    "                            \n" + participant[3] +
                    "                        </div>\n" +
                    "                    </div>");
                participant = [];
            }
        }
    }
}

//send all data to current route for make the form sticky
$(".next-page").click(function () {
    var data = $('form').serializeArray();
    data.push({name:'next', value:'clicked'});
    //send data to php at current page route
    $.post(window.location, data, function(response){
        // alert(response);
    });
});

//close modal after clicking on import button
$("#import").click(function () {
    $("#close-modal").click();
});

//remove selected file and the data that read from excel file
$("#cancel-import").click(function () {
    $("#list-head").hide();
    $("#display-list").html('');
    $("#fileToUpload").val("");
    $("#message").html('');
});

//show success message
function success() {
    setTimeout(function() {
        // location.reload();
    }, 2000);
    $("#message").addClass("text-success text-center");
    $("#message").html("File successfully uploaded");
}

//success message for adding manual participants
function success_msg(msg) {
    setTimeout(function() {
        $("#overlay").removeClass("overlay h6 p-3");
        $("#overlay").html("");
        window.location.href = "./";
    }, 2000);
    $("#overlay").addClass("overlay h6 p-3");
    $("#overlay").html(msg + " &#10003;");
}

