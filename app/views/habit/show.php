
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' type='text/css' href='/vendor/stylesheets/bootstrap.min.css'>
    <title>Show habit</title>
</head>
<body>
      <header>
            <?php echo navbar(); ?>
            <div class="jumbotron bg-info">
              <h1 class="display-3">Habit</h1>
              <hr class="my-4">
            </div>
        </header>
        
        <section class='show'>
                 <div class="col col-md-2 offset-sm-1 font-weight-light text-left" id="bio-box">
                        <img id="avatar" class="rounded d-block mx-auto" src="https://i.pinimg.com/originals/09/b2/de/09b2deff3d7abfffaa12aed8ee14bbe0.png"/>    
                        <div id="username_tag" class="text-center">
                            @<?php echo current_user()['Username']; ?>
                          </div>
                    
                </div>
                
                <div class='' id='card-area'>
                    
                </div>
    
        </section>
</body>
</html>



