<?php

require($_SERVER['DOCUMENT_ROOT'] . '/app/controllers/helpers.php');

class User {
    private $db;
    
    public function __construct() {}
    
    // EFFECTS: sets $db to the database connection
    // MODIFIES: $db
    // REQUIRES: there must be a database with name in database variable
    // RETURNS: boolean
    private function connect() {
        // Check connection
        $servername = getenv('IP');
        $username = getenv('C9_USER');
        $password = "";
        $database = "dev";
        $dbport = 3306;
         
        // Create connection
        $this->db = new mysqli($servername, $username, $password, $database, $dbport);

        // Check connection
        if ($this->db->connect_error) {
            return false;
        }
        
        return true;
    }
    
    // EFFECTS: 
    // MODIFIES: $_SESSION['user_id']
    private function createSession($id) {
        session_start();
        $_SESSION['User_Id'] = $id;
    }
    
    // EFFECTS: gets the user that's logged in from the session
    // REQUIRES: user_id must be set in the session
    // RETURNS: user or false
    public function current_user() {
        session_start();
        if(isset($_SESSION['User_Id'])) return $_SESSION['User_Id'];
        return false;
    }

    
    // EFFECTS: creates a new user
    // REQUIRES: validUser must return true
    // RETURNS boolean if user created else false
    public function create($email, $username, $password, $password_confirmation) {
        if(!($this->validUser($email, $username, $password, $password_confirmation))) {
            return false;   
        }
        
        if($this->connect()) {
            $stmt = $this->db->prepare('INSERT INTO User (Email, Username, Password) VALUES (?, ?, ?)');

            $stmt->bind_param('sss', $email, $username, crypt($password));

            $stmt->execute();
            
            $result = $stmt->get_result();
            
            if($this->db->error) {
                fputs(STDOUT, $this->db->error);
                return false;
            }
            
            return true;
        }
        
        return false;
    }
    
    public function findAll() {
        if($this->connect()) {
            $stmt = $this->db->prepare('SELECT Username FROM User;');
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            return $result;
        }
        
        return false;
    }
    
    // EFFECTS: finds a user from the database with given username
    // REQUIRES: user must exist in the database
    // RETURNS: user or false
    public function findUserByUsername($username) {
        if($this->connect()) {
            $stmt = $this->db->prepare("SELECT * FROM User WHERE Username= ?");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            return $result;
        }
        
       die("Inernal error.");
    }
    
    // EFFECTS: find the username by ID
    // REQUIRES: user with the id must exist in the database
    // RETURNS: user or false
    public function findUserById($id) {
        if($this->connect()) {
            $stmt = $this->db->prepare("SELECT * FROM USER WHERE User_Id=?");
            $stmt->bind_param('s',$id);
            $stmt->execute();
            
            $result = $stmt->get_result();
            return $result;
        }
        
        return false;
    }
    
    // EFFECTS: logs the user in
    // MODIFIES: addds user to current session
    // REQUIRES: username and password to match up
    // RETURNS: user or false if user not found
    public function login($email, $password) {
        if($this->connect()) {
            $stmt = $this->db->prepare("SELECT * FROM User WHERE Email=?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            if($result->num_rows === 0) {
                flash("No account with that email.", "danger", true);
                return false;
            }
            
            $result_arr = $result->fetch_array();
            
            if(password_verify($password, $result_arr['Password'])) {
                $this->createSession($result_arr['User_Id']);
                return true;
            } else {
                flash("Invalid password.", "danger", true);
                return false;
            }
        }
        // $hash = $findHashByUsername($username);
        // if(password_verify($password, $hash)) {
            // $user = findUserByUsername($username);
            // $this->createSession($user->getId());
        // }
    }
    
    public function isLoggedIn() {
        session_start();
        return isset($_SESSION['User_Id']);
    }
    
    // EFFECTS: removes the user from the session
    // MODIFIES: $_SESSION['user_id']
    // RETURNS: boolean
    public function logout() {
        session_start();
        unset($_SESSION['User_Id']);
    }
    
    // EFFECTS: validates the user information
    // REQUIRES: fields must be non empty, password & password_confirm must match
    //           username must be between 3 and 15 characters, 
    //           password must be between 6 and 25 function,
    // RETURNS: boolean
    private function validUser($email, $username, $password, $password_confirm) {
        if($this->connect()) {
            $stmt = $this->db->prepare('SELECT User_Id FROM User WHERE Username=?');
            $stmt->bind_param('s', $username);
            $stmt->execute();
            
            if(!($stmt->get_result()->num_rows === 0)) {
                flash("User already exists.", "danger", true);
                return false;
            }
            
            $stmt = $this->db->prepare('SELECT Email FROM User WHERE Email=?');
            $stmt->bind_param('s', $email);
            $stmt->execute();

            if(!($stmt->get_result()->num_rows === 0)) {
                flash("Email already in use.", "danger", true);
                return false;
            }
        }
        
        return filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email) && !empty($username) && !empty($password) &&
        !empty($password_confirm) && $password_confirm === $password;
    }
    
    // EFFECTS: searches for a query in the database
    public function search($query) {
        return [];
    }
}
