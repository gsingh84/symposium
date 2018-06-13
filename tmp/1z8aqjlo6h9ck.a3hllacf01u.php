<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/admin.css">
    <title>Manage Levels</title>

    <style>
        body{
            background: linear-gradient(to top left, #16a085,#95a5a6);
            height: 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
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
                            <a id="go-back" href="<?= ($BASE) ?>/levels"><span class="h4">&larr; </span></a>
                        </div>
                    </div>
                    <hr>

                    <div class="inner-box">
                        <div class="form-group row m-0">
                            <div class="col-8">
                                <p class="h6 font-weight-light">Criteria type:</p>
                            </div>
                            <div class="col-4 text-right">
                                <button class="btn rounded-0 btn-outline-primary">Edit</button>
                            </div>
                        </div>

                        <?php foreach (($criteria?:[]) as $text): ?>
                            <div class="level-block form-group row m-0 mt-2 border border-secondary p-2 pt-3 mb-2">
                                <div class="col">
                                    <p class="h5 font-weight-light"><?= ($text['criteria']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>