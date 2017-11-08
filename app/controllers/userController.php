<?php
    class UserController {
        private $model;
        
        public function __construct() {
            $this->model = new UserModel();
        }
        
        // EFFECTS: finds a user from the database with the username
        public function search() {
            $query = @$_GET['search'];
            
            if(!isset($query)) {
                return;
            }
            
            $this->users = $this->model->findByUsername($query);
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
        
        // EFFECTS: unsets the user id from the session
        // REQUIRES: User_Id must be set in the session
        // MODIFIES: Session
        public function logout() {
            unset($_SESSION['User_Id']);
            header( 'Location: /public/index.php');
        }
    }
?>