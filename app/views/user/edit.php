<html>
    <head>
    <link rel="stylesheet" type="text/css" href="/vendor/stylesheets/bootstrap.min.css">
    <title>Update User</title>
    </head>
    <body>
        <header>
            <?php echo navbar(); ?>
        </header>
        <section>
            <div class="jumbotron bg-dark">
              <h1 class="display-6 text-white text-center">Edit User</h1>
            </div>
            <div class="container">
                <form method="POST" action="/public/habit.php" id="edit_user_form">
                  <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" class="form-control" name="new_username" value="<?php ?>">
                  </div>
                  <div class="form-group">
                    <label for="description">Password</label>
                    <input type="text" class="form-control" name="new_password" value="<?php ?>">
                  </div>
                  <div class="form-group">
                    <label for="description">Confirm Password</label>
                    <input type="text" class="form-control" name="new_confrim_password" value="<?php ?>">
                  </div>
                  <div class="form-group">
                    <label for="description">Email</label>
                    <input type="text" class="form-control" name="new_email" value="<?php ?>">
                  </div>
                  <div class="form-group">
                    <label for="description">Bio</label>
                    <textarea type="text" class="form-control" form="edit_user_form" name="new_bio"><?php  ?></textarea>
                  </div>
                  <input type="hidden" class="form-control" name="habit_id" value="<?php echo $habit_controller->habit['Habit_Id']; ?>">
                  <input type="hidden" class="form-control" name="action" value="update">
                  <div class="form-group">
                    <button type="submit" class="btn btn-dark">Update Account</button>
                  </div>
                </form>
            </div>
        </section>
    </body>
</html>