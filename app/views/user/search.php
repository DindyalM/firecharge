<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo STYLESHEETS_PATH . 'bootstrap.min.css' ?>">
        <title>Search</title>
    </head>
    <body>
        <header>
            <?php echo navbar('search'); ?>
            <div class="bg-dark">
              <h1 class="p-3 text-center  text-white ">Search results</h1>
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