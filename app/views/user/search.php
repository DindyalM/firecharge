<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/vendor/stylesheets/bootstrap.min.css">
        <title>User</title>
    </head>
    <body>
        <header>
            <?php echo navbar('search'); ?>
            <div class="jumbotron bg-dark">
              <h1 class="display-3">Search</h1>
              <hr class="my-4">
              <p></p>
            </div>
        </header>
        <section id="search-result">
            <?php 
                foreach($user_controller->users as $user ) {
                    echo user_card($user);
                }
            ?>
        </section>
    </body>
</html>