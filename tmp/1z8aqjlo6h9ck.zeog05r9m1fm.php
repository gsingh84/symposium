<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Add More</title>

    <style>
        .card {
            border-top: 5px solid #A9CCE3;
            border-radius: 0;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-inverse navbar-toggleable nav">
    <div id="icon-bar" class="navbar-nav row">
        <a style="margin-left: 5px;" class="navbar-brand" href="<?= ($BASE) ?>"> <img id="brand-icon" src="<?= ($BASE) ?>/views/images/admin.svg"> <span id="brand-head">Admin</span></a>
    </div>

    <div class="navbar-nav ml-md-auto">
        <a class="nav-item nav-link item" href="./create" style="padding-right: 20px;"><i class="fa fa-file-text"></i> Create Competition</a>
    </div>

    <div id="myContent">
        <div class="navbar-nav ml-md-auto">
            <a class="nav-item nav-link sign-out" href="" style="padding-left: 10px;">Sign out</a>
        </div>
    </div>
</nav><!-- nav bar -->

<div class="container">
    <div class="form-group row">
        <div class="col">
            <div class="mt-2"></div>
            <div class="form-group row">
                <?php foreach (($competitions?:[]) as $competition): ?>
                    <div class="col-lg-4 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><small class="text-muted font-weight-light">Competition: </small><?= ($competition['competition_name']) ?></h5>
                                <p class="card-text"><small class="text-muted font-weight-light">Level: </small><?= ($competition['level']) ?></p>

                                <a href="<?= ($BASE) ?>/create?addMore=yes" class="btn-sm rounded-0 btn-primary font-weight-light"><i class="fa fa-plus"></i> Add More Level</a>
                                <a href="<?= ($BASE) ?>/participants/<?= ($competition['competition_id']) ?>/<?= ($competition['level_id']) ?>" class="btn-sm rounded-0 btn-success font-weight-light"><i class="fa fa-eye"></i> View Participants</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
<script src="//code.jquery.com/jquery.js"></script>
</html>