<?php 
    abstract class Model {
        protected $db;
        
        // EFFECTS: sets $db to the database connection
        // MODIFIES: $db
        // REQUIRES: there must be a database with name in database variable
        // RETURNS: boolean
        protected function connect() {
            
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
    }
?>