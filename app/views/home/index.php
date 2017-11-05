<?php
    // require($_SERVER['DOCUMENT_ROOT'] .'/views/layouts/navbar.php');
    // require($_SERVER['DOCUMENT_ROOT'] .'/views/layouts/alert.php');
    // require($_SERVER['DOCUMENT_ROOT'] .'/controllers/user.php');

    // $user = new User();
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/vendor/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./signup.css">
        <title>User</title>
    </head>
    <body>
        <header>
            /* <?php echo navbar('home', $user->isLoggedIn()); ?>
            <?php echo alert() ?> */
            <div class="jumbotron bg-info">
              <h1 class="display-3">Hello, world!</h1>
              <p class="lead">Create a new account with us!</p>
              <hr class="my-4">
              <p>Creating new habits is just a click away.</p>
              <p class="lead">
                <a class="btn btn-light btn-lg" href="#" role="button">Learn more</a>
              </p>
            </div>
        </header>
    </body>
</html>