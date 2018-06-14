<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= ($BASE) ?>/views/styles/sign-in.css">
    <title>Sign In</title>

</head>
<body>
    <div class="container">
        <div class="form-group row">
            <div class="col-md-6 offset-md-3">
                <div class="box">
                    <div class="form-group row">
                        <div class="col">
                            <h4 class="text-success">Symposium <i class="fa fa-group"></i></h4>
                            <h5 class="font-weight-light">Sign in</h5>
                        </div>
                    </div>
                    <form action="" method="post">
                        <div class="form-group row">
                            <div class="col">
                                <label><small id="error-msg" class="text-danger"></small></label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <label><small class="text-primary">Username</small></label>
                                <input id="username" type="text" name="username" class="font-weight-light">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label><small class="text-primary">Password</small></label>
                                <input id="password" type="password" name="password" class="font-weight-light">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <button type="submit" class="btn font-weight-light btn-primary float-right">SIGN IN</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="//code.jquery.com/jquery.js"></script>
<script src="<?= ($BASE) ?>/scripts/sign-in.js"></script>
</body>
</html>