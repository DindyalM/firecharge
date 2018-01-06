<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo STYLESHEETS_PATH . 'bootstrap.min.css'; ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo STYLESHEETS_PATH . 'style.css' ?>">
        <script src="<?php echo JAVASCRIPTS_PATH . 'signup.js'; ?>"></script>
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
            <?php echo navbar('home'); ?>
            <?php echo alert(true) ?>
            
            <div class="row flex-nowrap mt-5">
                <div class="col col-lg-3 mt-5">
                    <div class="col col-md-12 offset-7" style="margin-top: 10%;">
                        <div class="col col-md-7">
                            <div class="border rounded border-primary">
                                <div class="statcard p-3" style="height: 115px;">
                                  <h3 class="statcard-number text-light text-center"><?php echo $user_controller->subscriberCount(current_user()['User_Id']); ?></h3>
                                  <p class="statcard-desc text-light text-center">Subscribers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-12 offset-7" style="margin-top: 10%;">
                        <div class="col col-md-7">
                            <div class="border rounded border-primary">
                                <div class="statcard p-3" style="height: 115px;">
                                  <h3 class="statcard-number text-light text-center"><?php echo $user_controller->subscriptionCount(current_user()['User_Id']); ?></h3>
                                  <p class="statcard-desc text-light text-center">Subscriptions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-sm-8">
                    <!--<div class="row">-->
                    <!--    <div class="col col-sm-8 offset-1" style="margin-top: 30px;">-->
                    <!--        <div class="bg-light rounded">-->
                    <!--            <h3 class="text-dark text-center">Timeline</h3>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="row">
                        <div class="col col-sm-8 offset-1 ">
                            <div class="dashhead-titles">
                                <h6 class="dashhead-subtitle">Subscriptions</h6>
                                <h3 class="dashhead-title">Activity Overview</h3>
                            </div>
                            <div class="card p-2">
                                <!--<div class="card-body mr-2 ml-2">-->
                                <!--    <h4 class=" mt-2 mb-0 text-primary text-center ">Subscription Activity</h4>-->
                                <!--</div>-->
                                <?php
                                    // subscription_timeline($user_controller->subscriptionHabits);
                                    switch($_GET['action']) {
                                        case 'subscription_habits':
                                            echo var_dump($user_controller->subscriptionHabits);
                                        default:
                                            echo subscription_timeline($user_controller->subscriptionPosts, false, current_user()['Username']);
                                    }
                                    
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </body>
</html>