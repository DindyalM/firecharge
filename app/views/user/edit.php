<html>
    <head>
     <link rel="stylesheet" type="text/css" href="<?php echo STYLESHEETS_PATH . 'bootstrap.min.css'; ?>">
     <!--<link rel="stylesheet" type="text/css" href="<//php echo STYLESHEETS_PATH . 'style.css' ?>"> this makes page gray-->
    <title>Update User</title>
    </head>
    <body >
        <header>
            <?php echo navbar(); ?>
            <?php echo alert(true); ?>
        </header>
        <section>
          <div class=" bg-dark p-3">
            <h2 class="col-12  text-white text-center">Edit My Profile</h2>
          </div>
         
         <div class='row mt-4 p-2 ml-3'>
           
           <div class ='col-3'>
               <div class='card border-0 text-white'>
                  
                      <img id="avatar" class="rounded d-block card-img-top" src="https://i.pinimg.com/originals/09/b2/de/09b2deff3d7abfffaa12aed8ee14bbe0.png"/>    
                        <div id="username_tag" class="text-center card-body">
                          <a class='card-link ' href="<?php echo USER_PROFILE_PATH; ?>">@<?php echo $user_controller->user['Username']; ?></a>
                       </div>
                  </div>
                  
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                       <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-detail" aria-selected="true">Details about you</a>
                         <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-contact" aria-selected="false">Contact and Basic info</a>
                           <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-account" aria-selected="false">Account Preferences</a>
                             <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                              </div>
                       </div>
                          <div class='col-5'>
                                    <form method="POST" action="<?php echo USER_PATH ?>" id="edit_user_form">
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
                                                       </div>
                                                  </div>
              </section>
          </body>
</html>