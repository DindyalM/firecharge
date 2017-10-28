<?php
    require($_SERVER['DOCUMENT_ROOT'] .'/app/views/layouts/navbar.php');
    require($_SERVER['DOCUMENT_ROOT'] .'/app/controllers/user.php');
    require($_SERVER['DOCUMENT_ROOT'] .'/app/controllers/user_controllers.php');
    require($_SERVER['DOCUMENT_ROOT'] .'/app/views/layouts/alert.php');
    
    handleSignupRequest();
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/vendor/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./style.css">
        <script src='./signup.js'></script>
        <title>User</title>
    </head>
    <body>
        <header>
            <?php echo navbar('signup'); ?>
            <?php echo alert(true); ?>
            <h1 class="text-center mt-5">Create a new account.</h1>
            <p class="text-center">Already have an account? <a href="/app/views/user/login.php">Click here</a> to log in!</p>
        </header>
        
        <div class="container bg-light">
            <form method="POST" onsubmit="return validateInput();">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" class="form-control" name='email' type='email' placeholder="Enter Email"></input>
                    <small id="email_error" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" class="form-control" name='username' type='text' placeholder="Enter Username"></input>
                    <small id="username_error" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" class="form-control" name='password' type='password' placeholder="Enter Password"></input>
                    <small id="password_error" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" class="form-control" name='password_confirmation' type='password' placeholder="Confirm Password"></input>
                    <small id="password_confirmation_error" class="form-text"></small>
                </div>
                
                <input id="submit" class='btn btn-success' type='submit' value="Create a new account"></input>
            </form>
        </div>
    </body>
</html>