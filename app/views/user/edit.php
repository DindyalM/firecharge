<html>
    <head>
     <link rel="stylesheet" type="text/css" href="<?php echo STYLESHEETS_PATH . 'bootstrap.min.css'; ?>">
     <!--<link rel="stylesheet" type="text/css" href="<//php echo STYLESHEETS_PATH . 'style.css' ?>"> this makes page gray-->
    <title>Update User</title>
    </head>
    <body>
        <header>
            <?php echo navbar(); ?>
            <?php echo alert(true); ?>
        </header>
        <section>
            <div class=" bg-danger">
              <h1 class="col-md-12 text-white text-center">Edit My Profile</h1>
            </div>
           <!-- <div class="container">   -->
           <div class='row'>
               <div class='col-3 col-md-2 offset-sm-1'>
      <!--   <div class="col col-md-2 offset-sm-1 font-weight-light text-left" id="bio-box"> -->
                        <img id="avatar" class="rounded d-block mx-auto" src="https://i.pinimg.com/originals/09/b2/de/09b2deff3d7abfffaa12aed8ee14bbe0.png"/>    
                        <div id="username_tag" class="text-center">
                          <!--  <div class="row">   -->
                          <!--      <div class="col-md-4 offset-3">   -->
                                    <a href="<?php echo USER_PROFILE_PATH; ?>">@<?php echo $user_controller->user['Username']; ?></a>
                                </div>
                           
                 
                 </div>
                        <form method="POST" action="<?php echo USER_PATH ?>" id="edit_user_form" class='col-6'>
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
                            <textarea type="text" class="form-control" form="edit_user_form" name="new_bio" placeholder='enter bio'><?php echo $user_controller->user['Bio']; ?></textarea>
                          </div>
                          <input type="hidden" class="form-control" name="action" value="update">
                          <div class="form-group">
                            <button type="submit" class="btn btn-dark">Update Account</button>
                          </div>
                        </form>
                <div class='col-3'></div>
            </div>
        </section>
    </body>
</html>