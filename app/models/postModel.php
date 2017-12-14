<?php
class PostModel {
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
    
    public function __construct() {
        $this->user_model = new UserModel();
    }
    
    // EFFECTS: creates a new habit 
    // REQUIRES: TODO
    // RETURNS: boolean
    public function create($user_id, $poster_id, $text) {
        $this->connect();
        
        $stmt = $this->db->prepare('INSERT INTO Post (User_Id, Poster_Id, Text) VALUES (?, ?, ?)');    
        $stmt->bind_param('iis', $user_id, $poster_id, $text);
        
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($this->db->error) {
            return false;
        }
        
        return true;
    }
    
        
    //EFFECT: checks the database for a user with the given username
    //        returns false if none found
    private function findById($habit_id) {
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
        
        $stmt = $this->db->prepare("SELECT * FROM Post p INNER JOIN User u ON u.User_Id=p.User_Id WHERE u.User_Id=?");
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
    // this function doesn't work, note to future self: good fukin luk 
    // TODO
    public function findByUserUsername($username) {
        $this->connect();
        
        $user = $this->user_model->findByUsername($username, 1)->fetch_array();
        $user_id = $user['User_Id'];
        
        $stmt = $this->db->prepare("SELECT * FROM User u
                                        INNER JOIN Post p ON u.User_Id=p.Poster_Id
                                        WHERE p.User_Id=?");

        $stmt->bind_param('s', $user_id);
        $stmt->execute();
        $result1 = $stmt->get_result();
        
        
        $arr = [];
        
        foreach($result1 as $row) {
            
            array_push($arr, $row);
        }
        
        return array_reverse($arr);
    }
    
    //EFFECTS: deletes a habit
    //REQUIRES:The name of the habit
    //RETURNS: false if a connection error happens
    public function destroy($habit_name){
        if(!connect()){
            return false;
        }
       $stmt=$this->db->prepare("DELETE FROM Habit WHERE Name='?'");
       $stmt->bind_param('s',$habit_name);
       $stmt->execute();
    }
    
    //EFFECTS: updates a habit
    //REQUIRES:The name and description of the habit
    //RETURNS: return false if update fails
    public function update($habit_id, $new_name, $new_description) {
        $this->connect();
        
        $stmt = $this->db->prepare("UPDATE Habit SET Name=?,Description=? WHERE Habit_Id=?;");
        $stmt->bind_param("ssi", $new_name, $new_description, $habit_id);
        $stmt->execute();
        
        if($this->db->error) {
            return false;
        }
        
        return true;
    }
}
?>