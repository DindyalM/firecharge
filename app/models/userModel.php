<?php
class UserModel {
    
    private $db;
    
    public function __construct() {}
    
    // EFFECTS: sets $db to the database connection
    // MODIFIES: $db
    // REQUIRES: there must be a database with name in database variable
    // RETURNS: boolean
    // EXCEPTION: Throws an exception when it fails to connect to the database
    private function connect() {
        // Check connection
        $servername = getenv('IP');
        $username = getenv('C9_USER');
        $password = "";
        $database = "dev";
        $dbport = 3306;
         
        // Create connection
        $this->db = new mysqli($servername, $username, $password, $database, $dbport);

        // Check connection
        if ($this->db->connect_error) {
            throw new Exception($this->db->connect_error);
        }
        
        return true;
    }
    
    // EFFECTS: 
    // MODIFIES: $_SESSION['user_id']
    private function createSession($id) {
        session_start();
        $_SESSION['User_Id'] = $id;
    }

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

    // EFFECTS: removes the user from the session
    // MODIFIES: $_SESSION['user_id']
    // RETURNS: boolean
    public function logout() {
        session_start();
        unset($_SESSION['User_Id']);
    }
    
    // EFFECTS: validates the user information
    // REQUIRES: fields must be non empty, password & password_confirm must match
    //           username must be between 3 and 15 characters, 
    //           password must be between 6 and 25 characters,
    // RETURNS: boolean
    private function isValidUserInfo($email, $username, $password) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($username) && !empty($password) && !$this->userExists($email, $username);
    }
    
    // dont use this function unless you're willing to make it actually work
    // use at your own risk
    public function update($new_username,$new_password,$new_email,$new_bio,$user_id){
        
        if(!$this->connect()){
            return false;
            
        }
      
      
        $user=$_SESSION["User"];
       
        
         die(var_dump($_SESSION));
        
        // if they change there email or username or both we need to make sure that they do not put the same data as another user
        // if they dont change anything then there should be no need to check if the info is valid. 
        //checks
        switch ($variable) {
            case (($new_username != $user["Username"]) && ($new_email != $user["email"])): 
                
                if(!$this->isValidUserInfo($new_email, $new_username, $new_password)){
                    return false;
                }
                
                break;
            case (($new_username == $user["Username"]) && ($new_email != $user["email"])): //they want to keep this username but change there email
            
                if(!$this->isValidUserInfo($new_email, $new_username, $new_password)){
                    return false;
                }
                
                break;
            case(($new_username != $user["Username"]) && ($new_email == $user["email"])); //they want to keep there email but change there user name
            
                if(!$this->isValidUserInfo($new_email, $new_username, $new_password)){
                        return false;
                    }
                    
                break;
            default:
                break;
        }

        if(true){ //if the username is different
        //CAN NOT ADD A NEW USER IF THEY KEEP ALL THERE INFO
        //THE FUNCITON isValidUserInfo returns false
        //IF THEY KEEP THE INFO THE SAME DO WE NEED TO STIL VALIDATE IT ?
        // WHAT IF THEY ONLY CHANGE ONE THING

            $stmt=$this->db->prepare("UPDATE User SET Username=? WHERE User_Id=?;");
            $stmt->bind_param("si",$new_username,$user_id);
            $stmt->execute();
            

        }
        
        
        
        
    //     if(false===$stmt){
    //         die('prepare() failed: ' . htmlspecialchars($mysqli->error));

    //     }
        
    //   $test = $stmt->bind_param("ssssi",$new_username,crypt($new_password),$new_email,$new_bio,$user_id);
        
    //     if(false===$test){
    //         die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    //     }
        
    //     $test = $stmt->execute();
        
    //     if($test===false){
    //          die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    //     }
        
        
    //     $stmt->close();
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
