<?php
    require($_SERVER['DOCUMENT_ROOT'] .'/app/views/layouts/navbar.php');
    
    switch($_SERVER['REQUEST_METHOD']) {
        case 'POST':
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
        </header>
        
        <div class="container bg-light">
            <form>
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