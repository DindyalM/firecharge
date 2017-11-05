<?php
    require($_SERVER['DOCUMENT_ROOT'] .'/app/views/layouts/navbar.php');
    require($_SERVER['DOCUMENT_ROOT'] .'/app/views/layouts/alert.php');
    require($_SERVER['DOCUMENT_ROOT'] .'/app/controllers/user_controllers.php');
    
    login();
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/vendor/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./style.css">
        <script src="./login.js"></script>
        <title>User</title>
    </head>
    <body>
        <header>
            <?php echo navbar('login'); ?>
            <?php echo alert(true); ?>
            <h1 class="text-center mt-5">Log in to your account.</h1>
            <p class="text-center">Don't have an account yet? <a href="/app/views/user/signup.php">Click here</a> to sign up!</p>
        </header>
        
        <div class="container bg-light">
            <form method="POST" onsubmit="return validateInput();">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id='email' class='form-control' name='email' type='email' placeholder="Enter Email"></input>
                    <small id="email_error" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" class="form-control" name='password' type='password' placeholder="Enter Password"></input>
                    <small id="password_error" class="form-text"></small>
                </div>
                
                <input class='btn btn-success' type='submit' value="Log In"></input>
            </form>
        </div>
    </body>
</html>