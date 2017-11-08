<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/vendor/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/app/assets/stylesheets/style.css">
        <title>User</title>
    </head>
    <body>
        <header>
            <?php echo navbar('home'); ?>
            <?php echo alert() ?>
            <?php if(!logged_in()) : ?>
                <div class="col-md-8 offset-1">
                  <h1 class="display-3">Hello, world!</h1>
                  <p class="lead">Create a new account with us!</p>
                  <hr class="my-4">
                  <p>Creating new habits is just a click away.</p>
                  <p class="lead">
                    <a class="btn btn-light btn-lg" href="/public/user.php?page=signup" role="button">Sign Up</a>
                  </p>
                <!--</div>-->
            <?php elseif(logged_in) : ?>
                
                <div class="jumbotron bg-dark">
                  <h1 class="display-3" style="color: white;">Hello, <?php echo current_user()['Username']; ?></h1>
                  <hr class="my-4">
                </div>
            <?php endif; ?>
        </header>
    </body>
</html>