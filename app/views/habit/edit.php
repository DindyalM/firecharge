<html>
    <head>
      <link rel="stylesheet" type="text/css" href="/vendor/stylesheets/bootstrap.min.css">
      <title>Update Habit</title>
    </head>
    <body>
        <header>
            <?php echo navbar(); ?>
            <?php echo alert(true); ?>
        </header>
        <section>
            <div class="jumbotron bg-dark">
              <h1 class="display-6 text-white text-center">Edit Habit</h1>
            </div>
            <div class="container">
                <form method="POST" action="/public/habit.php" id="edit_habit_form">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="new_name" value="<?php echo $habit_controller->habit['Name']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" form="edit_habit_form" name="new_description"><?php echo $habit_controller->habit['Description']; ?></textarea>
                  </div>
                  <input type="hidden" class="form-control" name="habit_id" value="<?php echo $habit_controller->habit['Habit_Id']; ?>">
                  <input type="hidden" class="form-control" name="action" value="update">
                  
                  <div class="form-group">
                    <button type="submit" class="btn btn-dark">Update Habit</button>
                  </div>
                </form>
            </div>
        </section>
    </body>
</html>