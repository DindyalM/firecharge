<?php
class PostModel extends Model {
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
        
        $result = stmt_to_assoc($stmt);
        
        if($this->db->error) {
            return false;
        }
        
        if(count($result) < 1) {
            return false;
        }
        
        return $result;
    }
    
    public function findByUserId($user_id) {
        $this->connect();
        
        $stmt = $this->db->prepare("SELECT * FROM Post p INNER JOIN User u ON u.User_Id=p.User_Id WHERE u.User_Id=?");
        $stmt->bind_param('i', intval($user_id));
        
        $stmt->execute();
        
        return stmt_to_assoc($stmt);
    }
    
    //EFFECT: checks the database for a user with the given username
    //        returns false if none found
    // this function doesn't work, note to future self: good fukin luk 
    // TODO
    public function findByUserUsername($username) {
        $this->connect();
        
        $user = $this->user_model->findByUsername($username, 1);
        $user_id = $user['User_Id'];
        
        $stmt = $this->db->prepare("SELECT * FROM User u
                                        INNER JOIN Post p ON u.User_Id=p.Poster_Id
                                        WHERE p.User_Id=?");

        $stmt->bind_param('s', $user_id);
        $stmt->execute();
        
        return array_reverse(stmt_to_assoc($stmt));
    }
    
    //EFFECTS: deletes a habit
    //REQUIRES:The name of the habit
    //RETURNS: false if a connection error happens
    public function destroy($post_id){
        $this->connect();
        $stmt=$this->db->prepare("DELETE FROM Post WHERE Post_Id=?");
        $stmt->bind_param('s',$post_id);
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