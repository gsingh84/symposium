<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/judge.css">

    <title>Judge</title>
    <style>
        .participant {
            border-top: 5px solid #A9CCE3;
            border-radius: 0;
        }

        /*//kdjkdkkdj*/
        #slider {
            /*top: 40%;*/
            /*left: 40%;*/
            /*width: 20%;*/
        }
        input[type="range"] {
            -webkit-appearance: none;
            margin-top: 20px;
            width: 80%;
            background: transparent;
        }
        input[type="range"]:focus,
        input[type="range"]:active {
            outline: none;
        }
        input[type=range]::-webkit-slider-runnable-track {
            -webkit-appearance: none;
            background: linear-gradient(90deg, orange 0%, darkOrange 33%, orangeRed 66%);
            height: 3px;
            position: relative;
        }
        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            background: transparent;
            height: 25px;
            width: 25px;
            position: relative;
            top: -10px;
            border-radius: 50%;
        }
        .orange input[type="range"]::-webkit-slider-thumb {
            border: 3px solid orange;
        }

        .orange input[type="number"]:hover {
            border-bottom: 1px solid orange;
        }

        .darkOrange input[type="range"]::-webkit-slider-thumb {
            border: 3px solid darkOrange;
        }

        .orangeRed input[type="range"]::-webkit-slider-thumb {
            border: 3px solid orangeRed;
        }


    </style>
</head>
<body>
<div class="">
    <nav class="navbar navbar-toggleable-sm bg-light py-0 text-black welcome">
        <a class="navbar-brand"><img height="40vh" width="50vw" src="/355/symposium/views/images/judge.png"> <strong></strong> </a>
        <form class="form-inline">
            <a class="nav-item nav-link" href="" style="border-left: 1px solid rgb(204,204,255)">Sign Out</a>
        </form>
    </nav>
    <div id="search-bg"></div>
    <div class="container mt-5 tablecon">
        <div class="row">
            <div class="col-md-8 offset-md-2">
            </div>
        </div> <!--search bar-->
    </div>
</div>
<!--judge container-->
<div class="container-fluid col-md-8 mt-5 bg-light p-0 rounded judge participant">
    <div class="container-fluid col-md-11">
        <div class="row">
            <div class="col-md-4">
                <small>Book :</small>
            </div>
            <div class="col-md-4">
                <small>Age Group :</small>
            </div>
            <div class="col-md-4">
                <small>Time :</small>
            </div>
        </div>
    </div>

    <div class="container-fluid col-md-11 mt-3 border">
        <div class="row">
            <div class="col-md-10 orange">
                <input class="" type="range" value="0" min="0" max="100" id="s1" style="width: 100%">
            </div>
            <div class="col-md-1 offset-1">
                <input type="text" id="box" class="form-control">
            </div>
        </div>
    </div>
    <!--<div class="container-fluid col-md-11 mt-3 mb-3 border">-->
    <!--</div>-->
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>

    $("#submit").click(function () {

        location.href = "http://asingh.greenriverdev.com/355/symposium/participant";
    });
</script>

<script>
    var s1 = document.getElementById('s1');
    var  box = document.getElementById('box');

    s1.onchange = function (ev) {
        box.value = s1.value;
    }


    $(function() {

        $("#s1").on("mousemove", function() {
            var input = $(this).val();
            setVal(input, "#s1-val");
            setColor(input);
        });

        $("#s1-val").on("change", function() {
            var input = $(this).val();
            setVal($(this).val(), "#s1");
            setColor(input);
        });

        function setVal (input, target) {
            $(target).val(input);
        }

        function setColor (input) {
            var colors = [
                {min: 0, max: 33, className : "orange"},
                {min: 34, max : 66, className: "darkOrange"},
                {min: 67, max: 100, className: "orangeRed"}
            ]
            var range = $("#slider");
            console.log(range)
            $.each(colors, function(i, c) {
                if (parseInt(input) >= c.min && input < c.max) {
                    range.removeAttr("class");
                    range.addClass(c.className)
                }
            });
        }

    });

</script>


</html>