<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/public/assets/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/public/assets/stylesheets/profile.css">
        <script src="./login.js"></script>
        <title>User</title>
    </head>
    <body>
        <header>
            <?php echo navbar('login'); ?>
            <?php echo alert(true); ?>
        </header>
        
        <section id="profile">
            <div class="container-fluid bg-dark" id="profile-container">
                <div id="user-header" class="col-md-12 bg-danger">
                    
                </div>
                <div class="row flex-nowrap">
                    <div class="col col-md-2 offset-sm-1 font-weight-light text-left" id="bio-box">
                        <img id="avatar" class="rounded d-block mx-auto" src="https://i.pinimg.com/originals/09/b2/de/09b2deff3d7abfffaa12aed8ee14bbe0.png"/>    
                        <div id="username_tag" class="text-center">
                            <div class="row">
                                <div class="col-md-4 offset-3">
                                    <a href="<?php echo USER_PROFILE_PATH; ?>">@<?php echo $user_controller->user['Username']; ?></a>
                                </div>
                                <div class="col-md-2 offset-1">
                                    <?php 
                                        if(current_user()['User_Id'] == $user_controller->user['User_Id']) {
                                            echo '<a class="btn btn-link-danger" href="' . USER_EDIT_PATH .'&id=' . $user_controller->user['User_Id'] . '">Edit</a>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <p>Lorem ipsum dolor sit amet, ut prima doming patrioque has, per at esse inermis. Commodo neglegentur sed ad, dictas nonumes delectus te nam. Ea mea dico etiam.</p>
                    </div>
                    <div class="col col-sm-8">
                        <div class="row">
                            <div class="col col-sm-8 offset-1" style="margin-top: 30px;">
                                <div class="bg-light rounded">
                                    <h3 class="text-dark text-center">Timeline</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-sm-8 offset-1">
                                <div class="card">
                                    <div class="card-body">
                                      <form style="display: inline;">
                                        <input type="hidden" name="page" value="profile">
                                        <input type="hidden" name="username" value="<?php echo $user_controller->user['Username']; ?>">
                                        <input type="submit" class="btn btn-link text-danger" value="Habits"></input>
                                      </form>
                                      <form style="display: inline;">
                                        <input type="hidden" name="page" value="profile">
                                        <input type="hidden" name="action" value="posts">
                                        <input type="hidden" name="username" value="<?php echo $user_controller->user['Username']; ?>">
                                        <input type="submit" class="btn btn-link text-danger" value="Posts"></input>
                                      </form>
                                      <button class="btn btn-link text-danger">Friends</button>
                                      <button class="btn btn-link text-danger">Likes</button>
                                    </div>
                                        <?php
                                            switch($_GET['action']) {
                                                case 'posts':
                                                    echo post_timeline($user_controller->posts, $user_controller->user);
                                                    break;
                                                default:
                                                    echo habit_timeline($user_controller->habits);
                                                    break;
                                            }
                                        ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>