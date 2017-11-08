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
            $email = @$_POST['email'];
            $password = @$_POST['password'];
            
            if(!(isset($email) && isset($password))) {
                return false;
            }
            
            $user = $this->model->findByEmail($email);
            
            if(!$user) {
                return false;
            }
            
            if(password_verify($password, $user['Password'])) {
                $_SESSION['User_Id'] = $user['User_Id'];
                header('Location: /public/index.php');
                echo "SUCCESS";
            } else {
                echo "DOESN'T WORK";
                // flash("Invalid password.", "danger", true);
            }
        }
    
        // EFFECTS: creates a new user
        // REQUIRES: validUser must return true
        // RETURNS boolean if user created else false
        public function create() {
            $email = @$_POST['email'];
            $username = @$_POST['username'];
            $password = @$_POST['password'];
            
            if(!isset($email) || !isset($password) || !isset($username)) {
                echo "failure in data";
                return false;
            }
            
            if($this->model->create($email, $username, $password)) {
                header('Location: /public/user.php?page=login');
                echo "SUCCESS";
            } else {
                header('Location: /public/user.php?page=login');
                echo "FAILURE";
            }

        }
        
        public function logout() {
            unset($_SESSION['User_Id']);
            header( 'Location: /public/index.php');
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
    

    
?>