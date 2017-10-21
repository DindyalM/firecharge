<?php
class User {
private $userName; 
private $password;
private $password_confirm;


    function__construct($userName,$password,$password_confirm)
    {
        $this->userName=$userName;
        $this->password=$password;
        $this->password_confrim=$password_confirm;
    }
    
    // EFFECTS: creates a new user
    // REQUIRES: username must not be blank, password and password_confirm must match
    public function create(username, password, password_confirm) {
        if(!legalUser(username, password, password_confirm)) return false;
        
        // insert new user into database:
        // TODO: SQL CODE
        
        return true;
    }
    
    private function legalUser(username, password, password_confirm) {
        return empty(username) || empty(password) || empty(password_confirm) || password_confirm !== password;
    }
}
