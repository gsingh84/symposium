<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/judge.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Judge</title>
    <style>
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
</div>

<!--judge container-->
<div class="container mt-5 bg-light p-0 rounded judge">
    <nav class="navbar navbar-toggleable-sm bg-dark py-1 text-white">
        <a class="navbar-brand py-0"><?= ($participant['first_name']) ?> <?= ($participant['last_name']) ?></a>
        <form class="form-inline">
            <button class="btn btn-sm btn-outline-danger my-2 my-sm-0" type="">Go back</button>
        </form>
    </nav>
    <div class="col-md-12">
            <div class="col-md-12 bg-light rounded">
                <div class="col-md-12 p-2">
                    <div class="row border pl-2">
                        <div class="col-md-4">
                            <span class="font-weight-bold">LEVEL/ BOOK: <?= ($leveldetails['level']) ?></span>
                        </div>
                        <div class="col-md-4">
                            <span class="font-weight-bold">Age Group: </span>
                        </div>
                        <div class="col-md-4">
                            <span class="font-weight-bold" id="countdowntime">Time Allowed: <?= ($leveldetails['time_allow']) ?> minutes</span>
                            <p id="time">
                                <?= ($leveldetails['time_allow'])."
" ?>
                            </p>
                        </div>
                    </div>
                </div>
                <form action="#" method="post">
                    <div class="container col-md-12 border">
                        <h3>Content Questions</h3>
                        <div id="content-sliders">

                            <?php foreach (($criteria?:[]) as $cri): ?>
                                <?php if ($cri['content_ques'] == '1'): ?>
                                <div class="py-0 range-slider mb-2">
                                    <div>
                                        <label><?= ($cri['criteria']) ?> <small style="color: lightslategray">(Max marks <?= ($cri['weight']) ?>)</small></label>
                                    </div>
                                    <div>
                                        <?php foreach (($scores?:[]) as $score): ?>
                                            <?php if ($score['criteria_id'] == $cri['id']): ?>
                                                
                                                    <input name="<?= ($cri['criteria']) ?>" class="range-slider__range" type="range" min="0" step="1" value="<?= ($score['score']) ?>" max="<?= ($cri['weight']) ?>">
                                                    <span class="range-slider__value">&nbsp;</span>
                                                
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2 border">
                        <h3>Presentation</h3>
                        <div class="col-sm-12">
                            <?php foreach (($criteria?:[]) as $cri): ?>
                                <?php if ($cri['content_ques'] == '0'): ?>
                                    <div class="row py-0 range-slider mb-2">
                                        <label class="col-sm-3 pl-1 m-0"><?= ($cri['criteria']) ?> <small style="color: lightslategray">(Max marks <?= ($cri['weight']) ?>)</small></label>
                                        <div class="col-md-9">
                                            <?php foreach (($scores?:[]) as $score): ?>
                                                <?php if ($score['criteria_id'] == $cri['id']): ?>
                                                    
                                                        <input name="<?= ($cri['criteria']) ?>" class="range-slider__range" type="range" min="0" step="1" value="<?= ($score['score']) ?>" max="<?= ($cri['weight']) ?>">
                                                        <span class="range-slider__value">&nbsp;</span>
                                                    
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="border mt-2 pb-3">
                        <div class="col-md-12 mt-2">
                            <h4>Comments :</h4>
                            <textarea class="form-control" rows="4" name="comments"><?= ($participant['comments']) ?></textarea>
                        </div>
                    </div>
                    <div col-md-12>
                        <button class="btn btn-primary col-md-2 float-right mt-3 mb-2" id="submit" type="submit" name="submit">Save Scores</button>
                    </div>
                </form>
            </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    $('#time').hide();
    $("#submit").click(function () {
        location.href = "http://asingh.greenriverdev.com/355/symposium/participant";
    });
</script>

<script>
    var rangeSlider = function(){
        var slider = $('.range-slider'),
            range = $('.range-slider__range'),
            value = $('.range-slider__value');
        slider.each(function(){
            value.each(function(){
                var value = $(this).prev().attr('value');
                $(this).html(value);
            });
            range.on('input', function(){
                $(this).next(value).html(this.value);
            });
        });
    };
    rangeSlider();
</script>

<script type="text/javascript">
    var timeleft = document.getElementById("countdowntimer");
    var downloadTimer = setInterval(function(){
        timeleft--;
        document.getElementById("countdowntimer").textContent = timeleft;
        if(timeleft <= 0)
            clearInterval(downloadTimer);
    },1000);
</script>


</html>