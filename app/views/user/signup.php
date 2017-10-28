<?php
    require($_SERVER['DOCUMENT_ROOT'] .'/app/views/layouts/navbar.php');
    require($_SERVER['DOCUMENT_ROOT'] .'/app/controllers/user.php');
    
    switch($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $username = @$_POST['username'];
            $password=  @$_POST['password'];
            if(isset($username) && isset($password)) {
                $user = new User();
                if($user->create($username, $password)) {
                    foreach($user->findAll() as $row) {
                        echo $row['Username'] . "<br>";
                    }
                }
                else {
                    echo "Didn't create. :(";
                }
            }
            break;
        case 'GET':
            echo "ay";
            break;
    }
    // echo "hello";
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/vendor/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./style.css">
        <title>User</title>
    </head>
    <body>
        <header>
            <?php echo navbar('signup'); ?>
            <h1 class="text-center mt-5">Create a new account.</h1>
            <p class="text-center">Already have an account? <a href="/app/views/user/login.php">Click here</a> to log in!</p>
        </header>
        
        <div class="container bg-light">
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input class="form-control" name='email' type='email' placeholder="Email"></input>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" name='username' type='text' placeholder="Username"></input>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" name='password' type='password' placeholder="Password"></input>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input class="form-control" name='password_confirmation' type='password' placeholder="Confirm Password"></input>
                </div>
                
                <input class='btn btn-success' type='submit' value="Create a new account"></input>
            </form>
        </div>
    </body>
</html>