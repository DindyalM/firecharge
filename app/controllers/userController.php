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
            
            $this->users = $this->model->searchByUsername($query);
        }
        
        private function createSession($username, $user_id=false) {
            if($user_id) {
                $_SESSION['User'] = array(
                    'User_Id' => $user_id,
                    'Username' => $username);
                return true;
            }
            $user = $this->model->findByUsername($username);
            if($user) {
                $user = $user->fetch_array();
                $_SESSION['User'] = array(
                    'User_Id' => $user['User_Id'],
                    'Username' => $user['Username']);
                return true;    
            }
            
            return false;
        }
        
        // EFFECTS: logs the user in
        // MODIFIES: adds user to current session
        // REQUIRES: username and password to match up
        // RETURNS: user or false if user not found
        public function login() {
            $email = @$_POST['email'];
            $password = @$_POST['password'];
            
            if(!(isset($email) && isset($password))) {
                flash("Fields can't be blank", "danger", true);
                header('Location: /public/user.php?page=login');
                return false;
            }
            
            $user = $this->model->findByEmail($email);
            
            if(!$user) {
                flash("User doesn't exist!", "danger", true);
                header('Location: /public/user.php?page=login');
                return false;
            }
            
            if(password_verify($password, $user['Password'])) {
                if($this->createSession($user['Username'], $user['User_Id'])) {
                    flash("Successfully logged in!", "success");
                    header('Location: /public/user.php?page=index');
                }
            } else {
                flash("Password not valid!", "danger", true);
                header('Location: /public/user.php?page=login');
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
                flash("Uh oh! Something went wrong!", "danger", true);
                return false;
            }
            
            // check if username in use
            if($this->model->findByEmail($email)) {
                flash("Email already in use!", "danger", true);
                header('Location: /public/user.php?page=signup');
                return false;
            } else if($this->model->findByUsername($username)) {
                flash("Username already in use!", "danger", true);
                header('Location: /public/user.php?page=signup');
                return false;
            } 
            
            if($this->model->create($email, $username, $password)) {
                $this->createSession($username);
                flash("Welcome to FireCharge!", "success");
                header('Location: /public/user.php?page=index');
                return true;
            } else {
                header('Location: /public/user.php?page=login');
                flash("Uh oh! Something went wrong with your for submission!", "danger", true);
                return false;
            }

        }
        
        // EFFECTS: unsets the user id from the session
        // REQUIRES: User_Id must be set in the session
        // MODIFIES: Session
        public function logout() {
            unset($_SESSION['User']);
            header( 'Location: /public/user.php?page=index');
        }
    }
?>