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
            <div class=" bg-dark p-2">
              <h1 class="col-12  text-white text-center">Edit My Profile</h1>
            </div>
           <!-- <div class="container">   -->
           <div class='row mt-4 p-2 ml-3'>
               <div class='col-3 '>
      <!--   <div class="col col-md-2 offset-sm-1 font-weight-light text-left" id="bio-box"> -->
                        <img id="avatar" class="rounded d-block" src="https://i.pinimg.com/originals/09/b2/de/09b2deff3d7abfffaa12aed8ee14bbe0.png"/>    
                        <div id="username_tag" class="text-center">
                          <!--  <div class="row">   -->
                          <!--      <div class="col-md-4 offset-3">   -->
                                    <a href="<?php echo USER_PROFILE_PATH; ?>">@<?php echo $user_controller->user['Username']; ?></a>
                                </div>
                               <div> 
                                      <h1>Navigation area</h1>
                                        personal<br/>account<br/>application preferences
                                     </div>
                 
                 </div>

                        <form method="POST" action="<?php echo USER_PATH ?>" id="edit_user_form" class='col-5 bg-faded'>
                          <div class="form-group">
                            
                            <label for="name" class="text-weight-bold">Username</label>
                                <div class='input-group'>
                                  <span class="input-group-addon" id="basic-addon1">@</span>
                                   <input type="text" class="form-control" name="new_username" value="<?php echo $user_controller->user['Username']; ?>">
                                  </div>
                          </div>
                          <div class="form-group">
                            <label for="description" class="text-weight-bold">Password</label>
                            <input type="password" class="form-control" name="new_password">
                          </div>
                          <div class="form-group">
                            <label for="description" class="text-weight-bold">Confirm Password</label>
                            <input type="password" class="form-control" name="new_confrim_password">
                          </div>
                          <div class="form-group">
                            <label for="description" class="text-weight-bold">Email</label>
                            <input type="text" class="form-control" name="new_email" value="<?php echo $user_controller->user['Email']; ?>">
                          </div>
                          <div class="form-group">
                            <label for="description"  class="text-weight-bold">Bio</label>
                            <textarea type="text" class="form-control" form="edit_user_form" name="new_bio" placeholder='enter bio'><?php echo $user_controller->user['Bio']; ?></textarea>
                          </div>
                          <input type="hidden" class="form-control" name="action" value="update">
                          <div class="form-group">
                            <button type="submit" class="btn btn-success">Update Account</button>
                          </div>
                        </form>
                     <div class='col-3'>
                        </div>

            </div>
        </section>
    </body>
</html>