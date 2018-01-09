<?php 
    abstract class Model {
        protected $db;
        
        // EFFECTS: sets $db to the database connection
        // MODIFIES: $db
        // REQUIRES: there must be a database with name in database variable
        // RETURNS: boolean
        protected function connect() {
            if(isset($db)) {
                return true;
            }
            
            $servername = SERVER_NAME;
            $username = USERNAME;
            $password = PASSWORD;
            $database = DATABASE;
            $dbport = DB_PORT;
             
            // Create connection
            $this->db = new mysqli($servername, $username, $password, $database, (int) $dbport);
    
            // Check connection
            if ($this->db->connect_error) {
                return false;
            }
            
            return true;
        }
    }
?>