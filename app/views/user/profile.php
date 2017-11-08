<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/vendor/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/app/assets/stylesheets/profile.css">
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
                        <p id="username_tag" class="text-center">@<?php echo current_user()['Username']; ?></p>
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
                                      <button class="btn btn-link text-danger">Habits</button>
                                    <button class="btn btn-link text-danger">Activity</button>
                                    <button class="btn btn-link text-danger">Friends</button>
                                    <button class="btn btn-link text-danger">Likes</button>
                                                            
                                  </div>
                                  
                                  <div id="timeline">
                                    <?php echo post(); ?>
                                  </div>
                                  
                                  <div class="card-footer text-muted text-center">
                                    <a href="#" class="">Load More</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>