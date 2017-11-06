<?php
    class UserController {
        private $model;
        
        public function __construct() {
            $this->model = new UserModel();
        }
        
        // EFFECTS: logs the user in
        // MODIFIES: adds user to current session
        // REQUIRES: username and password to match up
        // RETURNS: user or false if user not found
        public function login() {
            // $email = @$_POST['email'];
            // $password = @$_POST['password'];
            
            // if(!(isset($email) && isset($password))) {
            //     return false;
            // }    
            
            $user = $this->model->findByEmail("strike@gmail.com");
            
            if(!$user) {
                return false;
            }
            
            
            
            if($this->model->passwordMatchesEmail("strike@gmail.com", "strike123")) {
                echo "WORKS";
                // $this->createSession($user['User_Id']);
            } else {
                echo "DOESN'T WORK";
                // flash("Invalid password.", "danger", true);
            }
        }

    }
    
    // function signup() {
    //     session_start();
    //     switch($_SERVER['REQUEST_METHOD']) {
    //         case 'POST':
    //             $email = @$_POST['email'];
    //             $username = @$_POST['username'];
    //             $password = @$_POST['password'];
    //             $password_confirmation = @$_POST['password_confirmation'];
                
    //             if(isset($email) && isset($username) && isset($password) && isset($password_confirmation)) {
    //                 $user = new User();
    //                 if($user->create($email, $username, $password, $password_confirmation)) {
    //                     $_SESSION['flash'] = 'Successfully signed up!';
    //                     $_SESSION['flash-type'] = 'success';
    //                     header("Location: /app/views/home/index.php");
    //                 }
    //             }
    //             break;
    //         case 'GET':
    //             break;
    //         default:
    //             break;
    //     }
    // }
    
    function logout() {
        session_start();
        unset($_SESSION['User_Id']);
        header( 'Location: /app/views/home/index.php');
    }
    
?>