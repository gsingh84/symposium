<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Create Competition</title>
</head>
<body>
<div id="overlay" class="text-white font-weight-light text-center"></div><!--success message-->

<nav class="navbar navbar-inverse navbar-toggleable nav">
    <div id="icon-bar" class="navbar-nav row">
        <a style="margin-left: 5px;" class="navbar-brand" href="<?= ($BASE) ?>"> <img id="brand-icon" src="<?= ($BASE) ?>/views/images/admin.svg"> <span id="brand-head">Admin</span></a>
    </div>

    <div id="myContent">
        <div class="navbar-nav ml-md-auto">
            <a class="nav-item nav-link sign-out" href="" style="padding-left: 10px;">Sign out</a>
        </div>
    </div>
</nav><!-- nav bar -->

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-content rounded-0">
            <div style="background-color: white; border-bottom: 3px solid #EDBB99;" class="modal-header rounded-0">
                <h5 class="modal-title font-weight-light mt-0" id="exampleModalLabel">Import File: <small class="text-muted font-weight-light">.xls, .xlsx<a href="<?= ($BASE) ?>/models/reader/data.xlsx">(Sample format here)</a></small></h5>
                <button id="close-modal" type="button" class="close font-weight-light" data-dismiss="modal" aria-label="Close">
                    X
                </button>
            </div> <!--modal header-->

            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                    <div class="col-4 text-right">
                        <button id="upload" class="btn btn-sm btn-outline-success rounded-0">Upload</button>
                    </div>
                </div>
                <div class="row text-center ml-0">
                    <span id="message"></span>
                </div>
                <hr>
                <div id="list-head" class="row mb-1">
                    <div class="col-md-6">
                        <p class="h4 font-weight-light">Participants</p>
                    </div>
                    <div class="col-md-3">
                        <button id="cancel-import" class="btn btn-block btn-warning">Cancel</button>
                    </div>
                    <div class="col-md-3">
                        <button id="import" class="btn btn-block btn-primary">Add All</button>
                    </div>
                </div>

                <div id="display-list">

                </div> <!--display fetched participants list here-->
            </div>
        </div>
    </div>
</div> <!--import participant model-->

<div class="container">
<form action="" method="post">
    <div class="row">
        <div class="col">
            <div class="form-group row">
                <div class="col-md-6 offset-md-3 mt-2">
                        <span class="font-wright-light text-danger float-right"><small id="comp-name"></small></span>
                        <input name="comp-name" type="text" class="form-control font-weight-light border border-primary"
                               <?php if (isset($GET['addMore'])): ?>
                                    id='<?= ($GET['id']) ?>' value="<?= ($GET['addMore']) ?>" disabled
                                   <?php else: ?> value="<?= (@$_SESSION['form']['comp-name']) ?>" 
                               <?php endif; ?>
                        placeholder="Enter name of the competition">
                </div>
            </div> <!--competition name-->

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="box mt-0 bg-white">
                        <div class="inner-box">
                            <div class="form-group row">
                                <div class="col">
                                    <small><label class="font-weight-light text-primary">Select level for competition</label></small>
                                    <span class="font-wright-light text-danger float-right"><small id="selected-level"></small></span>
                                    <select id="select-level" name="selected-level" class="form-control text-white bg-secondary font-weight-light">
                                        <option value="none">--Select Level--</option>
                                        <?php foreach (($levels?:[]) as $level): ?>
                                            <?php if ($level['active'] == 1): ?>
                                                <option value="<?= ($level['id']) ?>"
                                                    <?php if (@$_SESSION['form']['selected-level'] == $level['id']): ?>selected<?php endif; ?> ><?= ($level['level'])."
" ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col text-right">
                                    <a href="<?= ($BASE) ?>/levels?addLevel=yes"><button type="button" class="btn btn-sm btn-outline-success rounded-0 next-page"><i class="fa fa-external-link-square"></i> Add Level</button></a>
                                    <a href="<?= ($BASE) ?>/levels"><button id="manage-level" type="button" class="btn btn-sm btn-outline-primary rounded-0 next-page"><i class="fa fa-external-link"></i> Manage Levels</button></a>
                                </div>
                            </div> <!--select levels-->

                            <div class="form-group row">
                                <div class="col">
                                    <small><label class="font-weight-light text-primary">Select judges for competition</label></small>
                                    <span class="font-wright-light text-danger float-right"><small id="judges"></small></span>
                                    <hr class="mt-0">
                                    <div class="row">
                                        <?php foreach (($judges?:[]) as $judge): ?>
                                            <div class="col-md-4">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input name="judges[]" class="form-check-input" type="checkbox" value="<?= ($judge['id']) ?>"
                                                        <?php foreach ((@$_SESSION['form']['judges']?:[]) as $selected): ?>
                                                            <?php if ($judge['id'] == $selected): ?>checked<?php endif; ?>
                                                        <?php endforeach; ?>> <?= ($judge['judge_name'])."
" ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col text-right">
                                    <a href="<?= ($BASE) ?>/judges"><button type="button" class="btn btn-sm btn-outline-primary rounded-0 next-page"><i class="fa fa-external-link"></i> Manage Judges</button></a>
                                </div>
                            </div> <!--select judges-->

                            <div class="form-group row">
                                <div class="col">
                                    <span class="font-wright-light text-danger float-right"><small id="add-participant"></small></span>
                                    <a href="<?= ($BASE) ?>/add-participant"><button type="button" class="btn btn-success btn-block font-weight-light next-page"><i class="fa fa-group"></i> Add participants manually</button></a>
                                </div>
                            </div> <!--add participant manually-->
                            <div class="form-group row">
                                <div class="col">
                                    <button type="button" class="btn btn-success btn-block font-weight-light" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-file-excel-o"></i> Add participants from excel</button>
                                </div>
                            </div> <!--import participant-->
                                <hr>
                            <div class="form-group row mt-4">
                                <div class="col text-right">
                                    <button type="submit" id="create" class="btn btn-outline-primary btn-block font-weight-bold">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
<script src="//code.jquery.com/jquery.js"></script>
<script src="<?= ($BASE) ?>/scripts/admin.js"></script>
</html>