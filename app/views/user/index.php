<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo STYLESHEETS_PATH . 'bootstrap.min.css'; ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLESHEETS_PATH . 'style.css' ?>">
        <script src="<?php echo JAVASCRIPTS_PATH . 'signup.js'; ?>"></script>
        <script src="<?php echo JAVASCRIPTS_PATH . 'jquery-3.0.0.min.js'; ?>"></script>
        <title>Home | FireCharge</title>
    </head>
    <body>
        <?php if(!logged_in()) : ?>
        <header>
            <?php echo alert(); ?>
        </header>
        <section>
            <div class="row">
                <div class="col col-md-7 bg-dark h-100" id="intro-div">
                    <div class="col-md-8 offset-1 mt-4">
                      <h1 class="display-6 text-left"><span class="text-danger">FireCharge</span></h1>
                      <h2 class="display-6 text-left">Getting your life back together,<br> one habit at a time.</h2>
                    </div>
                </div>
                <div class="col col-md-5 bg-white">
                    <div class="col col-md-10 offset-1 mt-5">
                        <h2 class="text-dark text-center">Sign Up</h2>
                        <p class="text-center text-dark">Already have an account? <a href=<?php echo USER_LOGIN_PATH; ?>>Click here</a> to log in!</p>
                        <form method="POST" action="<?php echo USER_CREATE_PATH; ?>" onsubmit="return validateInput();">
                            <div class="form-group">
                                <label for="email" class="text-dark">Email address</label>
                                <input id="email" class="form-control" name='email' type='email' placeholder="Enter Email"></input>
                                <small id="email_error" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="username" class="text-dark">Username</label>
                                <input id="username" class="form-control" name='username' type='text' placeholder="Enter Username"></input>
                                <small id="username_error" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-dark">Password</label>
                                <input id="password" class="form-control" name='password' type='password' placeholder="Enter Password"></input>
                                <small id="password_error" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="text-dark">Confirm Password</label>
                                <input id="password_confirmation" class="form-control" name='password_confirmation' type='password' placeholder="Confirm Password"></input>
                                <small id="password_confirmation_error" class="form-text"></small>
                            </div>
                            
                            <input id="submit" class='btn btn-dark mx-auto' type='submit' value="Create a new account"></input>
                        </form>
                    </div>
                </div>
            </div>
        </section>
            
        <?php elseif(logged_in) : ?>
        <nav class="navbar navbar-light justify-content-between">
          <a class="navbar-brand text-light">RightSteps</a>
          <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
          </form>
        </nav>
        <section id="dashboard">
            <div class="row">
                <div class="col col-md-2" style="height: 100%;">
                    <ul class="nav nav-bordered nav-stacked flex-md-column mt-5 text-center">
                        <li class="nav-header">Links</li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Groups</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Habits</a>
                        </li>
                    </ul>
                </div>
                <div class="col col-md-10">
                    <div class="row">
                        <div class="col-md-6 mt-5 offset-1">
                            <div class="dashhead-titles">
                                <h6 class="dashhead-subtitle">Resolutions</h6>
                                <h3 class="dashhead-title">Overview</h3>
                                <a href="#" class="badge badge badge-primary float-right">New Resolution</a>
                            </div>
                            <div class="container border border-primary">
                                <div class="list-group">
                                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                      <h5 class="mb-1">Become an elite level athlete</h5>
                                      <small>21 days ago</small>
                                    </div>
                                    <p class="mb-1">I want to place in the top 3 of my school's swimming tournament.</p></p>
                                    <small></small>
                                    <button type="button" class="btn btn-sm rounded btn-outline-primary">Edit</button>
                                    <button type="button" class="btn btn-sm rounded btn-outline-danger">Delete</button>
                                  </a>
                                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                      <h5 class="mb-1">Spend more time with my family.</h5>
                                      <small class="text-muted">7 days ago</small>
                                    </div>
                                    <p class="mb-1">I've been really busy at school and I want to make it an effort to spend more time with my family.</p>
                                    <small class="text-muted"></small>
                                    <button type="button" class="btn btn-sm rounded btn-outline-primary">Edit</button>
                                    <button type="button" class="btn btn-sm rounded btn-outline-danger">Delete</button>
                                  </a>
                                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                      <h5 class="mb-1">Become a guitar master!</h5>
                                      <small class="text-muted">3 days ago</small>
                                    </div>
                                    <p class="mb-1">I want to be able to play wonderwall at my brother's birthday to impress everyone with my awesome guitar playing skills!</p>
                                    <small class="text-muted"></small>
                                    <button type="button" class="btn btn-sm rounded btn-outline-primary">Edit</button>
                                    <button type="button" class="btn btn-sm rounded btn-outline-danger">Delete</button>
                                  </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col col-md-5" style="margin-top: 10%;">
                            <div class="row mt-5">
                                <div class="col col-md-5">
                                    <div class="border rounded border-primary">
                                        <div class="statcard p-3" style="height: 115px;">
                                          <h3 class="statcard-number text-light text-center">15</h3>
                                          <p class="statcard-desc text-light text-center">Days Tracked</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col col-md-5">
                                    <div class="border rounded border-primary">
                                        <div class="statcard p-3" style="height: 115px;">
                                          <h3 class="statcard-number text-light text-center">151</h3>
                                          <p class="statcard-desc text-light text-center">Profile views</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col col-md-5">
                                    <div class="border rounded border-primary">
                                        <div class="statcard p-3" style="height: 115px;">
                                          <h3 class="statcard-number text-light text-center">3</h3>
                                          <p class="statcard-desc text-light text-center">Groups Joined</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col col-md-5">
                                    <div class="border rounded border-primary">
                                        <div class="statcard p-3" style="height: 115px;">
                                          <h3 class="statcard-number text-light text-center">3</h3>
                                          <p class="statcard-desc text-light text-center">Goals Accomplished</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-5 offset-1">
                            <div class="dashhead-titles">
                                <h6 class="dashhead-subtitle">Accomplish Your Goals</h6>
                                <h3 class="dashhead-title">Today's Work</h3>
                                <a href="#" class="badge badge badge-primary float-right">New Habit</a>
                            </div>
                            <div class="container border border-primary">
                                <div class="list-group">
                                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                      <h4 class="mb-1">Go for a 30 minute run.</h4>
                                      <small>Today</small>
                                    </div>
                                    <!--<p class="mb-1">I want to place in the top 3 of my school's swimming tournament.</p></p>-->
                                    <small>For "Become An Elite Level Athlete" Goal</small>
                                    <br>
                                    <button type="button" class="btn btn-sm rounded btn-outline-primary">Edit</button>
                                    <button type="button" class="btn btn-sm rounded btn-outline-danger">Delete</button>
                                  </a>
                                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                      <h5 class="mb-1">Spend more time with my family.</h5>
                                      <small class="text-muted">7 days ago</small>
                                    </div>
                                    <p class="mb-1">I've been really busy at school and I want to make it an effort to spend more time with my family.</p>
                                    <small class="text-muted"></small>
                                    <button type="button" class="btn btn-sm rounded btn-outline-primary">Edit</button>
                                    <button type="button" class="btn btn-sm rounded btn-outline-danger">Delete</button>
                                  </a>
                                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                      <h5 class="mb-1">Become a guitar master!</h5>
                                      <small class="text-muted">3 days ago</small>
                                    </div>
                                    <p class="mb-1">I want to be able to play wonderwall at my brother's birthday to impress everyone with my awesome guitar playing skills!</p>
                                    <small class="text-muted"></small>
                                    <button type="button" class="btn btn-sm rounded btn-outline-primary">Edit</button>
                                    <button type="button" class="btn btn-sm rounded btn-outline-danger">Delete</button>
                                  </a>
                                </div>
                            </div>
                        </div>
                        <div class="col col-md-10 mt-5 offset-1" style="height: 20%;">
                            <h2 class="text-center">Group Progress</h2>
                            <div class="container bg-light">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        
        <?php endif; ?>
        
    </body>
</html>