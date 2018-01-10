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
            <header>
                <div class="bg-dark jumbotron">
                    <h2 class="text-white text-center">Edit Profile</h2>
                </div>
            </header>
            <div class="container bg-light text-dark" style="width: 75%; margin-bottom: 50px;">
                <form method="POST" action="<?php echo USER_PATH ?>" id="edit_user_form">
                    <div class="form-group">
                        <label for="username" class="text-weight-bold">Username</label>
                        <div class='input-group'>
                            <span class="input-group-addon" id="basic-addon1">@</span>
                            <input type="text" class="form-control" name="username" value="<?php echo $user_controller->user['Username']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bio"  class="text-weight-bold">Bio</label>
                        <textarea type="text" class="form-control" name="bio" placeholder='Tell us about yourself!'><?php echo $user_controller->user['Bio']; ?></textarea>
                    </div>
                    <input type="hidden" class="form-control" name="action" value="update">
                    <input type="submit" class="btn btn-dark" value="Update Account"></input>
                </form>
            </div>
        </section>
    </body>
</html>