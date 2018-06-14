
$(document).ready(function () {

    //on form submit
    $("form").on("submit", function (event) {
        event.preventDefault();

        //serialize form data for ajax request
        var data = $('form').serializeArray();
        data.push({name:'submit', value:'clicked'});

        //send post request to server
        $.post(window.location, data, function (result) {

            if (result.includes(':')) {
                result = JSON.parse(result);
                $.each(result, function (key, val) {
                    if (key == "error-msg") {
                        $("#"+key).html(val);
                    } else {
                        $("#"+key).css("border", val);
                    }
                });
            } else {
                if (result.includes("/"))
                    window.location = result;
            }
        });
    });
});