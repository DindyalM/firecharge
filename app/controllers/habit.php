<?php
    class Habit {
        private $db;

        // EFFECTS: sets $db to the database connection
        // MODIFIES: $db
        // REQUIRES: there must be a database with name in database variable
        // RETURNS: boolean
        private function connect() {
            
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
        
        public function __construct() {}
          
        // EFFECTS: Locates a specific habit and then deletes it
        // MODIFIES: $db
        // REQUIRES: an attribute name
        // RETURNS: boolean  
        public function deleteHabit($habit_name) {
            
        }
        
        
        // EFFECTS: creates a new habit 
        // REQUIRES: validUser must return true
        // RETURNS: 
       
        public function createHabit($habit_name, $habit_details="") {
            if(!$this->connect()) {
                return false;
            }
            
            if($habit_details == "") {
                $stmt = $this->db->prepare('INSERT INTO Habit (Name) VALUES (?)');    
                $stmt->bind_param('s', $habit_name);
            } else {
                $stmt = $this->db->prepare('INSERT INTO Habit (Name, Description) VALUES (? ?)');
                $stmt->bind_param('ss', $habit_name, $habit_details);
            }
            
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            if($this->db->error) {
                return false;
            }
            
            return true;
        }
        
        
        // CRUD
        // CREATE
        // READ
        // UPDATE
        // DESTROY
        
        public function findHabit() {
            $stmt=$this->db->prepare('SELECT * FROM Habit; VALUES (?)');
            $stmt->excute();
        }
    }
?>