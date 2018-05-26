
//create competition
$("form").on("submit", function (event) {
    event.preventDefault();
    var data = $('form').serializeArray();
    console.log(data);
    $.post("./levels", data, function(response){

    });
});

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
            alert(response);
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
        location.reload();
    }, 2000);
    $("#message").addClass("text-success text-center");
    $("#message").html("File successfully uploaded");
}