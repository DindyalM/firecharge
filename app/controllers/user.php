<?php
class User {
    private $db;
    
    public function __construct() {}
        
    private function connect($username, $password) {
        // Check connection
         $db = new PDO("mysql:host=localhost;dbname=database", $username, $password);
         
         if ($db->connect_error)
         {
             return false;
         }
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
    public function create($username, $password, $password_confirm) {
        if(!legalUser($username, $password, $password_confirm)) return false;
        
        // insert new user into database:
        // TODO: SQL CODE
        
        return true;
    }
    
    // TODO: connect to data
    public function login() {
        $this->createSession(1);
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
