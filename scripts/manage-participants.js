
$(".edit").hide();
$("#del_warning").hide();

//show edit block on button click
$(".edit-btn").click(function () {
    var btnId = this.id.split("-");
    $("#display-" + btnId[1]).hide();
    $("#input-" + btnId[1]).slideDown("fast");
});

//update field
$(".update-btn").click(function () {
    var btnId = this.id.split("-");

    var data = $('#form-'+btnId[1]).serializeArray();
    data.push({name:'p-id', value:btnId[1]});
    console.log(data);
    $.post(window.location, data, function(response){
        // alert(response);
        success_msg("Updated");
    });
});

//delete participant
var btnId;
$(".del-btn").click(function(){
   btnId = this.id.split("-");
   $("#del_warning").show();
});

// delete participant if yes
$("#confirm-del").click(function(){
    $("#del_warning").hide(150);
    $.post(window.location, {del_id: btnId[1]}, function(response){
        // alert(response);
        success_msg("Participant Deleted");
        $("#display-" + btnId[1]).remove();
        $("#input-" + btnId[1]).remove();
        $("#form-" + btnId[1]).remove();
    });
});

//cancel deleting
$("#cancel-del").click(function () {
    $("#del_warning").hide();
});

//success message for adding manual participants
function success_msg(msg) {
    setTimeout(function() {
        $("#overlay").removeClass("overlay h6 p-3");
        $("#overlay").html("");
        location.reload();
    }, 2000);
    $("#overlay").addClass("overlay h6 p-3");
    $("#overlay").html(msg + " &#10003;");
}

