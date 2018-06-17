<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/admin.css">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/levels.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <a id="go-back" href=""><span class="h4">&larr; </span></a>
                    </div>
                </div>
                <hr>

                <div class="inner-box">

                    <?php if (isset($GET['addLevel'])): ?>
                        
                        <form action="#" method="post">
                            <div id="add-level">
                                <div class="row form-group">
                                    <div class="col-md-9">
                                        <label><small>Level name / Book name</small></label>
                                        <input id="level-name" class="form-control font-weight-light" type="text" name="level-name">
                                    </div>

                                    <div class="col-md-3">
                                        <label><small>Time allowed</small></label>
                                        <input id="time-allowed" class="form-control font-weight-light" type="text" name="time-allowed">
                                    </div>
                                </div>

                                <div class='row form-group'>
                                    <div class='col text-center'>
                                        <button id="add-oldQues-btn" type="button" class="btn btn-link btn-block text-info">Import Questions from existing Levels</button>
                                    </div>
                                </div> <!--options to chose from-->

                                <div id="import-from-levels">
                                    <div class="form-group row">
                                        <div class="col">
                                            <small><label class="font-weight-light text-primary">Import from:</label></small>
                                            <select id="select-from" class="form-control text-white bg-secondary font-weight-light">
                                                <option value="none">--Select Level--</option>
                                                <?php foreach (($levels?:[]) as $level): ?>
                                                    <option value="<?= ($level['id']) ?>"><?= ($level['level']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="imported-questions">
                                        <!--<div class="form-group row">-->
                                            <!--<div class="col-md-9">-->
                                                <!--<small><label class="font-weight-light text-muted">Content question</label></small>-->
                                                <!--question-->
                                            <!--</div>-->
                                            <!--<div class="col-md-3">-->
                                                <!--<small><label class="font-weight-light text-muted">Weight</label></small>-->
                                                <!--weight-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    </div>
                                </div> <!--import from existing levels field-->
                                <hr>

                                <div id="expand-criteria">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h4 style="cursor: pointer;"><i id="arrow" class="fa fa-angle-down"></i></h4>
                                        </div>
                                    </div>
                                </div>

                                <div id="criteria-text">
                                    <label><small class="text-muted">Add Content type Questions</small></label>

                                    <div class='row form-group'>
                                        <div class='col-9'>
                                            <input class='form-control' type='text' name='c-ques[]' placeholder='Question: '>
                                        </div>

                                        <div class='col-3 text-right'>
                                            <input class='form-control' type='text' name='c-weight[]' placeholder='Weight:'>
                                        </div>
                                    </div>

                                    <div id="new-cont-ques"></div> <!--Content Question-->
                                    <div class="form-group row">
                                        <div class='col text-right'>
                                            <button id="add-cont-ques" type="button" class='btn btn-link'>Add More</button>
                                            <button id="rm-cont-btn" type="button" class="btn btn-link text-danger btn-link">Remove</button>
                                        </div>
                                    </div> <!--content type question-->

                                    <label><small class="text-muted">Add Presentation Criteria</small></label>

                                    <div class='row form-group'>
                                        <div class='col-9'>
                                            <input class='form-control' type='text' name='p-ques[]' placeholder='Criteria: '>
                                        </div>

                                        <div class='col-3 text-right'>
                                            <input class='form-control' type='text' name='p-weight[]' placeholder='Weight:'>
                                        </div>
                                    </div>

                                    <div id="new-p-ques"></div> <!--Presentation Question-->
                                    <div class="form-group row">
                                        <div class='col text-right'>
                                            <button id='add-presentation-ques' type="button" class='btn btn-link'>Add More</button>
                                            <button id="rm-pres-btn" type="button" class="btn btn-link text-danger btn-link">Remove</button>
                                        </div>
                                    </div> <!--presentation type questions-->
                                </div><!--criteria-->

                                <div id="submit-form">
                                    <div class="form-group row mt-4">
                                        <div class="col">
                                            <button id="submit" type="submit" class="btn btn-outline-success btn-block rounded-0">Create</button>
                                        </div>
                                    </div>
                                </div>

                                <!--<div id="added"></div> &lt;!&ndash;added levels&ndash;&gt;-->

                                <!--<div id="add-rm-block">-->
                                    <!--<div class="form-group row mt-1">-->
                                        <!--<div class="col text-right">-->
                                            <!--<button id="remove-text" class="btn btn-sm bg-danger">Remove</button>-->
                                        <!--</div>-->
                                    <!--</div>-->

                                    <!--<div class="form-group row mt-4">-->
                                        <!--<div class="col">-->
                                            <!--<button id="submit" class="btn btn-outline-success btn-block rounded-0">Submit</button>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</div> &lt;!&ndash;remove/submit button&ndash;&gt;-->
                            </div> <!--add level block-->
                        </form>
                        

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