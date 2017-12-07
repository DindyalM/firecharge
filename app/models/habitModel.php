<?php
class HabitModel {
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
    public function create($habit_name, $habit_details="", $user_id) {
        $this->connect();
        
        if($habit_details == "") {
            $stmt = $this->db->prepare('INSERT INTO Habit (Name, User_Id) VALUES (?, ?)');    
            $stmt->bind_param('si', $habit_name, $user_id);
        } else {
            $stmt = $this->db->prepare('INSERT INTO Habit (Name, Description, User_Id) VALUES (?, ?, ?)');
            $stmt->bind_param('ssi', $habit_name, $habit_details, $user_id);
        }
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($this->db->error) {
            echo $this->db->error;
            return false;
        }
        
        return true;
    }
    
        
    //EFFECT: checks the database for a user with the given username
    //        returns false if none found
    public function findById($habit_id) {
        $this->connect();
        
        $stmt = $this->db->prepare("SELECT * FROM Habit WHERE Habit_Id=?");
        $stmt->bind_param('i', $habit_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
  
        
        if($this->db->error) {
            return false;
        }
        
        if($result->num_rows < 1) {
            return false;
        }
        return $result->fetch_array();
    }
    
    public function findByUserId($user_id) {
        $this->connect();
        
        $stmt = $this->db->prepare('SELECT * FROM Habit WHERE User_Id=?');
        $stmt->bind_param('i', intval($user_id));
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);
        
        $arr = array();
        
        foreach($result as $row) {
            array_push($arr, $row);
        }
        
        return $arr;
    }
    
    //EFFECT: checks the database for a user with the given username
    //        returns false if none found
    public function findByUserUsername($username, $max_return=10) {
        $this->connect();
        
        $stmt = $this->db->prepare("SELECT * FROM Habit h INNER JOIN User u ON u.User_Id=h.User_Id WHERE u.Username=?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($this->db->error) {
            return false;
        }
        
        if($result->num_rows < 1) {
            return false;
        }
        
        $row = $result->fetch_array(MYSQLI_ASSOC);
        
        $arr = array();
        
        foreach($result as $row) {
            array_push($arr, $row);
        }
        
        return $arr;
    }
    
    //EFFECTS: deletes a habit
    //REQUIRES:The id of the habit
    //RETURNS: false if a connection error happens
    public function destroy($id){
        $this->connect();
        $stmt = $this->db->prepare("DELETE FROM Habit WHERE Habit_Id='?'");
        $stmt->bind_param('i',$habit_id);
        $stmt->execute();
        if($this->db->error) {
            return false;
        }
        
        return true;
    }
    
    //EFFECTS: updates a habit
    //REQUIRES:The name and description of the habit
    //RETURNS: return false if update fails
    public function update($habit_id, $new_name, $new_description) {
        $this->connect();
        $stmt=$this->db->prepare("UPDATE Habit SET Name=?,Description=? WHERE Habit_Id=?;");
        $stmt->bind_param("ssi", $new_name, $new_description, $habit_id);
        $stmt->execute();

        if($this->db->error) {
            
            return false;
        }
        
        return true;
    }
}
?>