<?php
    
    function handleSignupRequest() {
        session_start();
        switch($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $email = @$_POST['email'];
                $username = @$_POST['username'];
                $password = @$_POST['password'];
                $password_confirmation = @$_POST['password_confirmation'];
                
                if(isset($email) && isset($username) && isset($password) && isset($password_confirmation)) {
                    $user = new User();
                    if($user->create($email, $username, $password, $password_confirmation)) {
                        $_SESSION['flash'] = 'Successfully signed up!';
                        $_SESSION['flash-type'] = 'success';
                        header("Location: /app/views/home/index.php");
                    }
                }
                break;
            case 'GET':
                break;
            default:
                break;
        }
    }
    
?>