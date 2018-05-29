
//create competition
$("form").on("submit", function (event) {
    event.preventDefault();
    var data = $('form').serializeArray();
    data.push({name:'submit', value:'clicked'});

    $.post(window.location, data, function(response){
        // alert(response);
        var comp_id = response;
        success_msg("Competition Created");
        if($("#fileToUpload").val()) {
            readFile(comp_id);
        }
    });

    // $.post("./levels", data, function(response){
    //
    // });
});

//read uploaded excel file
function readFile(comp_id) {
    $.post("./models/readExcel.php",
        {comp_id:comp_id, level_id: $("#select-level").val()},
        function(response){
            // alert(response);
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
            } else {
                $("#message").addClass("text-danger text-center");
                $("#message").html(response);
            }
        }
    });
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
        $("#overlay").removeClass("overlay h3 p-3 pt-4 ml-5");
        $("#overlay").html("");
        window.location.href = "./";
    }, 2000);
    $("#overlay").addClass("overlay h3 p-3 pt-4 ml-5");
    $("#overlay").html(msg + " &#10003;");
}