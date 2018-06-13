<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/admin.css">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/levels.css">
    <title>Manage Levels</title>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="box bg-white">
                <div class="row m-1 mt-3">
                    <div class="col-8">
                        <p class="h5 font-weight-light">Manage Levels</p>
                    </div>
                    <div class="col-4 text-right">
                        <a id="go-back" href="<?= ($BASE) ?>/create"><span class="h4">&larr; </span></a>
                    </div>
                </div>
                <hr>

                <div class="inner-box">

                    <?php if (isset($GET['addLevel'])): ?>
                        
                            <div id="add-level">
                                <div class="row form-group">
                                    <div class="col">
                                        <label><small>Level name</small></label>
                                        <input id="level-name" class="form-control" type="text" name="level-name">
                                    </div>
                                </div>

                                <div id="criteria-text">
                                    <div class='row form-group'>
                                        <div class='col-9'>
                                            <input id='cret-type' class='form-control' type='text' name='level-type' placeholder='Criteria type'>
                                        </div>
                                        <div class='col-3 text-right'>
                                            <button id='confirm' class='btn btn-warning rounded-0'>Add</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="added"></div> <!--added levels-->

                                <div id="add-rm-block">
                                    <div class="form-group row mt-1">
                                        <div class="col text-right">
                                            <button id="remove-text" class="btn btn-sm bg-danger">Remove</button>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-4">
                                        <div class="col">
                                            <button id="submit" class="btn btn-outline-success btn-block rounded-0">Submit</button>
                                        </div>
                                    </div>
                                </div> <!--remove/submit button-->
                            </div> <!--add level block-->
                        

                        <?php else: ?>
                            <div id="display-level">

                                <?php foreach (($levels?:[]) as $level): ?>
                                    <?php if ($level['active'] == 1): ?>
                                        
                                            <a class="level-link" href="<?= ($BASE) ?>/levels/<?= ($level['id']) ?>"><div  class="level-block form-group row m-0 border border-secondary p-2 pt-3 mb-2">
                                                <div class="col-6">
                                                    <p class="h5 font-weight-light"><?= ($level['level']) ?></p>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <button id="disable-<?= ($level['id']) ?>" class="btn-sm rounded-0 btn-outline-danger">Disable</button>
                                                </div>
                                            </div></a>
                                        

                                        <?php else: ?>
                                            <a class="level-link" href="<?= ($BASE) ?>/levels/<?= ($level['id']) ?>"><div class="level-block form-group row m-0 border border-mute p-2 pt-3 mb-2">
                                                <div class="col-6">
                                                    <p class="h5 font-weight-light text-muted"><?= ($level['level']) ?></p>
                                                </div>
                                                <div class="col-6 text-right text-muted">
                                                    <button id="enable-<?= ($level['id']) ?>" class="btn-sm rounded-0 btn-outline-success">Enable</button>
                                                </div>
                                            </div></a>
                                        
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </div> <!--display levels-->
                        
                    <?php endif; ?>

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
<script src="<?= ($BASE) ?>/scripts/manage-levels.js"></script>
</html>