
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' type='text/css' href='/vendor/stylesheets/bootstrap.min.css'>
    <title>Habit tracking</title>
</head>
<body>
      <header>
            <?php echo navbar('login'); ?>
            <?php echo alert(true); ?>
                
        </header>
        

<section>
    <div class="container-fluid bg-dark" id="profile-container">
        <div class="col-md-12 bg-danger" id="user-header">

        </div>
        <div class="row flex-nowrap">
            <div class="col col-md-2 offset-sm-1 font-weight-light text-left" id="bio-box">
                <img id="avatar" class="rounded d-block mx-auto" src="https://i.pinimg.com/originals/09/b2/de/09b2deff3d7abfffaa12aed8ee14bbe0.png"/>
                <div id="username_tag" class="text-center">
                  <span class='badge badge-success'>  @<?php echo current_user()['Username']; ?></span>
                </div>

            </div>
            <div class="col col-sm-8">
                <div class="row">
                    <div class="col col-sm-8 offset-1" style="margin-top: 30px;">
                        <div class="bg-light rounded">
                            <h3 class="text-dark text-center">Habit Tracking</h3>
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

                            <div class='col-lg-10 d-inline-block ' id='card-area'>
                                card area
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



