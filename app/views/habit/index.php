<?php 
    require($_SERVER['DOCUMENT_ROOT'] .'/app/controllers/habit.php');
    require($_SERVER['DOCUMENT_ROOT'] .'/app/views/layouts/navbar.php');
    require($_SERVER['DOCUMENT_ROOT'] .'/app/views/layouts/alert.php');
    require($_SERVER['DOCUMENT_ROOT'] .'/app/views/layouts/card.php');
    
    $habit = new Habit();
    // $habit->create("Run");
    
    
    // echo var_dump($habit->find());
    
?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="/vendor/stylesheets/bootstrap.min.css">
    <title>Habit</title>
    </head>
    <body>
        <header>
            <?php echo navbar(); ?>
            <div class="jumbotron bg-info">
              <h1 class="display-3">Habit</h1>
              <hr class="my-4">
            </div>
        </header>
        <section id="habits">
            <?php
                echo '<div class="card-deck">';
                foreach($habit->find() as $row) {
                    $name = $row['Name'];
                    $description = $row['Description'];
                    echo '<div class="col-sm-3">' . habit_card($row) . "</div>";
                }
                echo '</div>';
                
            ?>
        </section>
    </body>
</html>