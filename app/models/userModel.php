<?php
class UserModel extends Model {
    
    public function __construct() {}

    public function findAll() {
        if($this->connect()) {
            $stmt = $this->db->prepare('SELECT Username FROM User;');
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            return $result;
        }
        
        return false;
    }
    
    // EFFECTS: finds a user from the database with given username
    // REQUIRES: user must exist in the database
    // RETURNS: user or false
    public function findUserByUsername($username) {
        if($this->connect()) {
            $stmt = $this->db->prepare("SELECT * FROM User WHERE Username= ?");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            return $result;
        }
        
       die("Inernal error.");
    }
    
    // EFFECTS: find the username by ID
    // REQUIRES: user with the id must exist in the database
    // RETURNS: user or false
    public function findUserById($id) {
        if($this->connect()) {
            $stmt = $this->db->prepare("SELECT * FROM User WHERE User_Id= ? LIMIT 10");
            
            if($stmt==false){
                die ("false statement");
            }
            
            $stmt->bind_param('s',$id);
            $stmt->execute();
            
            $result = $stmt->get_result();
            return $result->fetch_array();
            
        }
        
        return false;
    }
    
    //EFFECT: checks the database for a user with the given username
    //        returns false if none found
    public function findByUsername($username, $max_return=10) {
        $this->connect();
        
        $stmt = $this->db->prepare("SELECT * FROM User WHERE Username=? LIMIT ?");
        $stmt->bind_param('si', $username, $max_return);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($this->db->error) {
            return false;
        }
        
        if($result->num_rows < 1) {
            return false;
        }
        
        return $result;
    }
    
        //EFFECT: searches a column for a field
    public function searchByUsername($username, $max_return=10) {
        $this->connect();
        
        $like_param = $username ."%";
        
        $stmt = $this->db->prepare("SELECT * FROM User WHERE Username LIKE ? LIMIT ?");
        $stmt->bind_param('si', $like_param, $max_return);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($this->db->error) {
            return false;
        }
        
        if($result->num_rows < 0) {
            return false;
        }
        
        return $result;
    }
    
    
    public function findByEmail($email) {
        $this->connect();
        
        $stmt = $this->db->prepare("SELECT User_Id, Username, Password FROM User WHERE Email=?;");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($result->num_rows < 1) {
            return false;
        }
        
        return $result->fetch_array(MYSQLI_ASSOC);
    }
    
    public function create($email, $username, $password) {
        $this->connect();
        
        if(!$this->isValidUserInfo($email, $username, $password)) return false;
        
        $stmt = $this->db->prepare('INSERT INTO User (Email, Username, Password) VALUES (?, ?, ?);');

        $stmt->bind_param('sss', $email, $username, crypt($password));

        $stmt->execute();
        
        $result = $stmt->get_result();
            
        if($this->db->error) {
            return false;
        }
            
        return true;
    }
    
    public function userExists($email, $username="") {
        $this->connect();
        if($username == "") {
            $stmt = $this->db->prepare("SELECT * FROM User WHERE Email=?;");
            $stmt->bind_param('s', $email);
        } else {
            $stmt = $this->db->prepare("SELECT * FROM User WHERE Email=? OR Username=?;");
            $stmt->bind_param('ss', $email, $username);
        }

        $stmt->execute();

        $result = $stmt->get_result();
        $result->fetch_array(MYSQLI_ASSOC);
        return $result->num_rows > 0;
    }
    
    // EFFECTS: validates the user information
    // REQUIRES: fields must be non empty, password & password_confirm must match
    //           username must be between 3 and 15 characters, 
    //           password must be between 6 and 25 characters,
    // RETURNS: boolean
    private function isValidUserInfo($email, $username, $password) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($username) && !empty($password) && !$this->userExists($email, $username);
    }
    
    // EFFECTS: updates the user with new values
    // REQUIRES: $params is an assoc array and the keys correspond to 
    //           the User table column names, and the value with the
    //           new value
    public function update($user_id, $params){
        $this->connect();
        
        $username = $params['Username'];
        $email = $params['Email'];
        $bio = $params['Bio'];
        
        
        if(isset($username)) {
            $stmt=$this->db->prepare("UPDATE User SET Username = ? WHERE User_Id = ?;");
            $stmt->bind_param("si", $username, $user_id);
            $stmt->execute();
            $stmt->close();
        }
        
        if(isset($email)) {
            $stmt=$this->db->prepare("UPDATE User SET Email = ? WHERE User_Id = ?;");
            $stmt->bind_param("si", $email, $user_id);
            $stmt->execute();
            $stmt->close();
        }
        
        if(isset($bio)) {
            $stmt=$this->db->prepare("UPDATE User SET Bio = ? WHERE User_Id = ?;");
            $stmt->bind_param("si", $bio, $user_id);
            $stmt->execute();
            $stmt->close();
        }

        return true;
    }
    
    public function delete_user ($username){

        if(!connect()){
            return false;
            }
            
           $stmt=$this->db->prepare("DELETE FROM User WHERE Name='?'");
           $stmt->bind_param('s',$username);
           $stmt->execute();
        
    }
    
}
