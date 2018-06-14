<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/judgeLog.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title><?= ($level) ?></title>
</head>
<body>
<nav class="navbar navbar-toggleable-sm bg-light py-0 text-black welcome">
    <a class="navbar-brand"><img height="40vh" width="50vw" src="<?= ($BASE) ?>/views/images/judge.png"> <strong><?= ($judgeinfo['judge_name']) ?></strong> </a>
    <form class="form-inline">
        <a class="nav-item nav-link" href="" style="border-left: 1px solid red; color: red">Sign Out</a>
    </form>
</nav>

        <hr>
        <div class="container-fluid bg-light col-md-9">
            <h3 class="card-title"><small class="text-muted font-weight-light">Name : </small><?= ($level) ?></h3>
            <div class="row">
                <?php foreach (($compLevels?:[]) as $compLevel): ?>
                    <div class="col-md-6 mt-3 mb-3">
                        <div class="card" id="<?= ($compLevel['id']) ?>">
                            <h5 class="card-header bg-dark text-white"><?= ($compLevel['level']) ?></h5>
                            <div class="card-body">
                                <strong style="color: black">Status :
                                    <?php if ($compLevel['active'] == '1'): ?>
                                        <span style="color: green">Active</span>
                                        <?php else: ?><span style="color: #e74c3c">Not Active</span>
                                    <?php endif; ?>
                                </strong>
                                <br>
                                <br>
                                <small>Date Created On : </small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    $(".card").click(function () {
        var selected = this.id;
        selected = selected.split(' ').join('');
        selected = "http://asingh.greenriverdev.com/355/symposium/participant/" +  selected;
        // var selected = "http://gsingh.greenriverdev.com/355/symposium/participant/" +  selected;
        location.href = selected;
    });
</script>
</html>