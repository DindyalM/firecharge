
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" type="text/css" href="<?php echo STYLESHEETS_PATH . 'bootstrap.min.css'; ?>">
    <title>Habit tracking</title>
</head>
<body>
    <header>
            <?php echo navbar('login'); ?>
            <?php echo alert(); ?>
    </header>
    <section>
        <header>
            <div class="jumbotron bg-dark"></div>
        </header>
        <div class="row">
            <div class="offset-1 col-md-4">
                <div class="card">
                  <h4 class="card-header">Habit Information</h4>
                  <div class="card-body">
                    <h4 class="card-title"><?php echo $habit_controller->habit['Name']; ?></h4>
                    <p class="card-text"><?php echo $habit_controller->habit['Description']; ?></p>
                    <a href="<?php HABIT_EDIT_PATH . '&id=' . $habit_controller->habit['Habit_Id']; ?>" class="btn btn-dark">Update</a>
                    <a href="<?php HABIT_DELETE_PATH . '&id=' . $habit_controller->habit['Habit_Id']; ?>" class="btn btn-danger">Delete</a>
                  </div>
                </div>
                <h3 class="text-center"></h3>
                <p class="text-center"></p>
            </div>
            <div class="col-md-6">
                <figure class="figure">
                  <img style="background-color: gray; height: 200px; width: 600px;" src="" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                  <figcaption class="figure-caption">A caption for the above image.</figcaption>
                </figure>
            </div>
        </div>
    </section>


</body>
</html>



