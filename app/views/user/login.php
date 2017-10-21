<?php
    require($_SERVER['DOCUMENT_ROOT'] .'/app/views/layouts/navbar.php');
    require($_SERVER['DOCUMENT_ROOT'] .'/app/controllers/user.php');
    $user = new User();
    switch($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $user->login("andrew", "123", "123");
            header( 'Location: /app/views/home/index.php');
            break;
        case 'GET':
            break;
        default:
            break;
    }
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/app/vendor/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./style.css">
        <title>User</title>
    </head>
    <body>
        <header>
            <?php echo navbar('login'); ?>
            <h1 class="text-center mt-5">Log in to your account.</h1>
            <p class="text-center">Don't have an account yet? <a href="/app/views/user/signup.php">Click here</a> to sign up!</p>
        </header>
        
        <div class="container bg-light">
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input class="form-control" name='email' type='email' placeholder="Email"></input>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" name='password' type='password' placeholder="Password"></input>
                </div>
                
                <input class='btn btn-success' type='submit' value="Log In"></input>
            </form>
        </div>
    </body>
</html>