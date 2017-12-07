<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo STYLESHEETS_PATH . 'bootstrap.min.css'; ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLESHEETS_PATH . 'style.css' ?>">
        <script src="<?php echo JAVASCRIPTS_PATH . 'login.js'; ?>"></script>
        <title>User</title>
    </head>
    <body>
        <header>
            <?php echo navbar('login'); ?>
            <?php echo alert($user_controller); ?>
            <h1 class="text-center mt-5">Log in to your account.</h1>
            <p class="text-center">Don't have an account yet? <a href="<?php echo USER_SIGNUP_PATH; ?>">Click here</a> to sign up!</p>
        </header>
        
        <div class="container bg-light">
            <form method="POST" onsubmit="return validateInput();">
                <div class="form-group">
                    <label for="email" class="text-dark">Email address</label>
                    <input id='email' class='form-control' name='email' type='email' placeholder="Enter Email"></input>
                    <small id="email_error" class="form-text"></small>
                </div>
                <input name="action" value="login" type="hidden">
                <div class="form-group">
                    <label for="password" class="text-dark">Password</label>
                    <input id="password" class="form-control" name='password' type='password' placeholder="Enter Password"></input>
                    <small id="password_error" class="form-text"></small>
                </div>
                
                <input class='btn btn-success' type='submit' value="Log In"></input>
            </form>
        </div>
    </body>
</html>