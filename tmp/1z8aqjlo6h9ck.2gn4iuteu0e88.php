<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/admin.css">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/judge.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Manage Participants</title>

    <style>
        .overlay{
            transition-property: all;
            transition-duration: 0.5s;
            position: fixed;
            margin: auto;
            width: 100%;
            height: 7%;
            z-index: 10;
            background-color: rgba(0,0,0,0.5); /*dim the background*/
        }

        .del-warning{
            transition-property: all;
            transition-duration: 0.5s;
            position: fixed;
            margin: auto;
            opacity: 0.9;
            top: 150px;
            width: 100%;
            height: 20%;
            z-index: 10;
            background-color: #212F3D;
        }
    </style>
</head>

<div id="overlay" class="text-white font-weight-light text-center"></div><!--success message-->

<div id="del_warning" class="font-weight-light del-warning p-3 text-white">
    <div class="form-group row">
        <div class="col text-center">
            <p class="h3 text-center font-weight-light">Are you sure you want to delete this participant?</p>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-3 offset-3 text-right">
            <button id="confirm-del" class="btn btn-block btn-outline-light rounded-0">YES</button>
        </div>
        <div class="col-3">
            <button id="cancel-del" class="btn btn-block btn-outline-light rounded-0">NO</button>
        </div>
    </div>
</div> <!--Delete warning show here-->

<nav class="navbar navbar-inverse navbar-toggleable nav">
    <div id="icon-bar" class="navbar-nav row">
        <a style="margin-left: 5px;" class="navbar-brand" href="<?= ($BASE) ?>"> <img id="brand-icon" src="<?= ($BASE) ?>/views/images/admin.svg"> <span id="brand-head">Admin</span></a>
    </div>

    <!--<div class="navbar-nav ml-md-auto">-->
        <!--<a class="nav-item nav-link item" href="" style="padding-right: 20px;">Check Ranking</a>-->
    <!--</div>-->

    <div id="myContent">
        <div class="navbar-nav ml-md-auto">
            <a class="nav-item nav-link sign-out" href="" style="padding-left: 10px;">Sign out</a>
        </div>
    </div>
</nav><!-- nav bar -->
<body>
<div class="container">
    <div class="form-group row">
        <div class="col-md-8 offset-md-2">
            <div class="form-group">

                <div class="mt-5"> </div>

                <?php foreach (($participants?:[]) as $participant): ?>
                    <div id="display-<?= ($participant['id']) ?>" class="tile">
                        <div class="form-group row m-0 mb-1 border border-info p-2 bg-white">
                            <div class="col-md-2">
                                <small class="text-muted">First name:</small><br>
                                <?= ($participant['first_name'])."
" ?>
                            </div>
                            <div class="col-md-2">
                                <small class="text-muted">Last name:</small><br>
                                <?= ($participant['last_name'])."
" ?>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Birth date:</small><br>
                                <?= ($participant['dob'])."
" ?>
                            </div>
                            <div class="col-md-2">
                                <small class="text-muted">Rank:</small><br>
                                <?= ($participant['rank'])."
" ?>
                            </div>
                            <div class="col-md-3 text-right">
                                <button id="delete-<?= ($participant['id']) ?>" class="btn-sm btn-outline-danger rounded-0 mt-2 del-btn"><i class="fa fa-trash-o"></i> Delete</button>
                                <button id="edit-<?= ($participant['id']) ?>" class="btn-sm btn-outline-primary rounded-0 mt-2 edit-btn"><i class="fa fa-edit"></i> Edit</button>
                            </div>
                        </div>
                    </div><!--participants list-->

                    <form id="form-<?= ($participant['id']) ?>" method="post" action="">
                    <div id="input-<?= ($participant['id']) ?>" class="edit">
                        <div class="form-group row mb-1 border border-info p-2 pl-0 bg-white">
                            <div class="col-md-3">
                                <small class="text-muted">First name:</small><br>
                                <input name="first_name" type="text" class="form-control font-weight-light" value="<?= ($participant['first_name']) ?>">
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Last name:</small><br>
                                <input name="last_name" type="text" class="form-control font-weight-light" value="<?= ($participant['last_name']) ?>">
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Birth date:</small><br>
                                <input name="dob" type="text" class="form-control font-weight-light" value="<?= ($participant['dob']) ?>">
                            </div>

                            <div class="col-md-3 text-right">
                                <button id="update-<?= ($participant['id']) ?>" type="button" class="btn btn-success mt-3 rounded-0 update-btn"><i class="fa fa-refresh"></i> Update</button>
                            </div>
                        </div>
                    </div>
                    </form> <!--edit form-->
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
<script src="<?= ($BASE) ?>/scripts/manage-participants.js"></script>

</html>