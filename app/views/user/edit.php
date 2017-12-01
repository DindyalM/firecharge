<html>
    <head>
     <link rel="stylesheet" type="text/css" href="<?php echo STYLESHEETS_PATH . 'bootstrap.min.css'; ?>">
     <link rel="stylesheet" type="text/css" href="<?php echo STYLESHEETS_PATH . 'style.css' ?>">
    <title>Update User</title>
    </head>
    <body>
        <header>
            <?php echo navbar(); ?>
            <?php echo alert(true); ?>
        </header>
        <section>
            <div class="jumbotron bg-dark">
              <h1 class="display-6 text-white text-center">Edit User Profile</h1>
            </div>
            <div class="container">
                <form method="POST" action="<?php echo USER_PATH ?>" id="edit_user_form">
                  <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" class="form-control" name="new_username" value="<?php echo $user_controller->user['Username']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="description">Password</label>
                    <input type="text" class="form-control" name="new_password">
                  </div>
                  <div class="form-group">
                    <label for="description">Confirm Password</label>
                    <input type="text" class="form-control" name="new_confrim_password">
                  </div>
                  <div class="form-group">
                    <label for="description">Email</label>
                    <input type="text" class="form-control" name="new_email" value="<?php echo $user_controller->user['Email']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="description">Bio</label>
                    <textarea type="text" class="form-control" form="edit_user_form" name="new_bio"><?php echo $user_controller->user['Bio']; ?></textarea>
                  </div>
                  <input type="hidden" class="form-control" name="action" value="update">
                  <div class="form-group">
                    <button type="submit" class="btn btn-dark">Update Account</button>
                  </div>
                </form>
            </div>
        </section>
    </body>
</html>