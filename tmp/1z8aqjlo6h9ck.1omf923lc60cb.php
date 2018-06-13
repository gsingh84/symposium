<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/add-participant.css">
    <title>Add Participant</title>
</head>
<body>
<div id="top-box">

</div>
<div class="container">
    <form action="" method="post">
        <div class="form-group row">
            <div id="first-box" class="col-md-6 offset-md-3 field">

                    <div class="row m-0">
                        <div id='overlay' class="col text-white font-weight-light text-center">
                        </div>
                    </div> <!--success message-->

                <div class="row">
                    <div class="col-8">
                        <legend class="font-weight-light h5">Participant information</legend>
                    </div>
                    <div class="col-4 text-right">
                        <a href="<?= ($BASE) ?>/create"><span class="h4">&larr; </span></a>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label><small>First name</small></label>
                        <input id="first_name" name="first_name" type="text" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label><small>Last name</small></label>
                        <input id="last_name" name="last_name" type="text" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label><small>Birth Date</small></label>
                        <input id="dob" name="dob" type="text" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="mr-sm-2"><small>Gender</small></label>

                        <!--<div class="row">-->
                            <!--<div class="col-md-4">-->
                                <!--<input class="gender" type="radio" name="gender" value="Male"> Male-->
                            <!--</div>-->
                            <!--<div class="col-md-6">-->
                                <!--<input class="gender" type="radio" name="gender" value="Female"> Female-->
                            <!--</div>-->
                        <!--</div>-->

                        <select name="gender" id="gender" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                            <option value="none" selected>Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <hr>

                <div class="form-group row">
                    <div class="col text-right">
                        <button id="submit" type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </div>
            </div>

            <div id="results" class="font-weight-light">
                <div id="added-info"></div>
                <!--<div class="form-group row m-0 border border-primary p-1">-->
                    <!--<div class="col-4 text-center">-->
                        <!--<label class="text-muted"><small>Name: </small></label>-->
                    <!--</div>-->
                    <!--<div class="col-4 text-center">-->
                        <!--<label class="text-muted"><small>Date of birth: </small></label>-->
                    <!--</div>-->
                    <!--<div class="col-3 text-center">-->
                        <!--<label class="text-muted"><small>Gender: </small></label>-->
                    <!--</div>-->
                    <!--<div class="col-1 text-center text-danger">-->
                        <!--X-->
                    <!--</div>-->
                <!--</div>-->
                <div class="row">
                    <div class="col text-right mt-1">
                        <button id="remove" type="button" class="btn-sm btn-danger">Remove</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-right mt-1">
                        <button id="add-all" type="button" class="btn-sm btn-outline-info btn-block">Add All</button>
                    </div>
                </div>
            </div><!--show added participants-->

        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
<script src="//code.jquery.com/jquery.js"></script>
<script src="<?= ($BASE) ?>/scripts/add-participant.js"></script>
</html>