<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/admin.css">
    <title>Admin</title>
</head>
<body>
<nav class="navbar navbar-inverse navbar-toggleable nav">
    <div id="icon-bar" class="navbar-nav row">
        <a style="margin-left: 5px;" class="navbar-brand" href=""> <img id="brand-icon" src="<?= ($BASE) ?>/views/images/admin.svg"> <span id="brand-head">Admin</span></a>
    </div>

    <div class="navbar-nav ml-md-auto">
        <a class="nav-item nav-link item" href="" style="padding-right: 20px;">Check Ranking</a>
    </div>

    <div id="myContent">
        <div class="navbar-nav ml-md-auto">
            <a class="nav-item nav-link sign-out" href="" style="padding-left: 10px;">Sign out</a>
        </div>
    </div>
</nav><!-- nav bar -->

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="box">
                <div class="row m-1 mt-3">
                    <div class="col">
                        <p class="h5 font-weight-light">Management System</p>
                        <hr>
                    </div>
                </div>

                <div class="inner-box">
                    <div class="form-group row">
                        <div class="col">
                            <a href="<?= ($BASE) ?>/create"><button class="btn btn-lg btn-block font-weight-light p-4 btn-primary">Create Competition</button></a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <a href="<?= ($BASE) ?>/add-more"><button class="btn btn-lg btn-block font-weight-light p-4 btn-dark">Add More Levels to Competition</button></a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <a href="<?= ($BASE) ?>/participants"><button class="btn btn-lg btn-block font-weight-light p-4 btn-secondary">Manage Participants</button></a>
                        </div>
                    </div>
                </div>
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