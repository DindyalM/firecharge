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
        

        
        
        // EFFECTS: creates a new habit 
        // REQUIRES: TODO
        // RETURNS: boolean
        public function create($habit_name, $habit_details="") {
            if(!$this->connect() || strlen($habit_name) < 6) {
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
                echo $this->db->error;
                return false;
            }
            
            return true;
        }
        
        
        public function read() {
            if(!$this->connect()) {
                return false;
            }
            
            $stmt=$this->db->prepare('SELECT * FROM Habit;');
            
            $stmt->execute();
            
            $result = $stmt->get_result();
            $row = $result->fetch_array(MYSQLI_ASSOC);
            
            $arr = array();
            
            foreach($result as $row) {
                array_push($arr, $row);
            }
            
            
            return $arr;
        }
        
        //EFFECTS: deletes a habit
        //REQUIRES:The name of the habit
        //RETURNS: false if a connection error happens
        public function delete_habit($habit_name){
            if(!connect()){
                return false;
            }
           $stmt=$this->db->prepare("DELETE FROM Habit WHERE Name='?'");
           $stmt->bind_param('s',$habit_name);
           $stmt->execute();
        }
        
        //EFFECTS: updates a habit
        //REQUIRES:The name and description of the habit
        //RETURNS: false if a connection error happens
        public function update_habit($name,$description,$Habit_Id){
            if(!connect()){
                return false;
                
            }
            $stmt=$this->db->prepare("UPDATE Habit SET Name='?',Description='?' WHERE Habit_Id=?;");
            $stmt->bind_param("sss",$name,$description,$Habit_Id);
            $stmt->execute();
        }
        
    }
    
    
?>