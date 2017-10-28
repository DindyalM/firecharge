<?php
class User {
    private $db;
    
    public function __construct() {}
    
    // MODIFIES: $db
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
    
    public function createSession($id) {
        session_start();
        $_SESSION['user_id'] = $id;
    }
    
    public function current_user() {
        session_start();
        if(isset($_SESSION['user_id'])) return $_SESSION['user_id'];
        return false;
    }

    
    // EFFECTS: creates a new user
    // REQUIRES: username must not be blank, password and password_confirm must match
    public function create($username, $password) {
        if($this->connect()) {
            $stmt = $this->db->prepare('INSERT INTO User (Username, Password) VALUES (?, ?)');

            $stmt->bind_param('ss', $username, $password);
         

            $stmt->execute();
            
            $result = $stmt->get_result();
            echo var_dump($this->db->error);
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
    
    // TODO: connect to data
    public function login($username, $password) {
        
        $hash = $findHashByUsername($username);
        if(password_verify($password, $hash)) {
            $user = findUserByUsername($username);
            $this->createSession($user->getId());
        }
    }
    
    public function logout() {
        session_start();
        session_destroy();
    }
    
    private function legalUser($username, $password, $password_confirm) {
        return empty($username) || empty($password) || empty($password_confirm) || $password_confirm !== $password;
    }
    
    public function search($query) {
        return [];
    }
}
