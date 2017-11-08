<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/vendor/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./signup.css">
        <title>User</title>
    </head>
    <body>
        <header>
            <?php echo navbar('search'); ?>
            <div class="jumbotron bg-info">
              <h1 class="display-3">Search</h1>
              <hr class="my-4">
              <p></p>
            </div>
        </header>
        <section id="search-result">
            <?php 
                foreach($user_controller->users as $user ) {
                    echo card($user['Username']);
                }
            ?>
        </section>
    </body>
</html>