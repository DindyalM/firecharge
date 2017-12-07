<?php
class UserController {
    private $user_model;
    private $habit_model;
    private $post_model;
    public function __construct() {
        $this->user_model = new UserModel();
        $this->habit_model = new HabitModel();
        $this->post_model = new PostModel();
    }
    
    // EFFECTS: finds a user from the database with the username
    public function search() {
        $query = @$_GET['search'];
        
        if(!isset($query)) {
            return;
        }
        
        $this->users = $this->user_model->searchByUsername($query);
    }
    
    public function createPost() {
        $current_user = current_user();
        if(!$current_user) {
            flash('Must be logged in to do that!', "danger", true);
            // header('Location: /public/user.php?page=login');
            header('Location: ' . USER_LOGIN_PATH);
            return false;
        }
        
        $user_id = @$_POST['user_id'];
        $text = @$_POST['text'];
        $username = @$_POST['username'];
        
        if(!isset($user_id) || !isset($text)) {
            flash('Something went wrong!', "danger", true);
            header('Location:' . USER_PATH);
            return false;
        }
        
        if($this->post_model->create($user_id, $current_user['User_Id'], $text, $username)) {
            flash('Successfully created post!', "success");
            if(isset($username)) {
                // header('Location: /public/user.php?page=profile&username=' . $username);    
                header('Location: ' . USER_PROFILE_PATH . '&username=' . $username);
            } else {
                header('Location: ' . USER_INDEX_PATH . '&action=posts');    
            }
            
            return true;
        } else {
            flash('Something went wrong!', "danger", true);
            header('Location: ' . USER_PATH); 
            return false;
        }
        
    }
    
    private function createSession($username, $user_id=false) {
        if($user_id) {
            $_SESSION['User'] = array(
                'User_Id' => $user_id,
                'Username' => $username);
            return true;
        }
        $user = $this->user_model->findByUsername($username);
        if($user) {
            $user = $user->fetch_array();
            $_SESSION['User'] = array(
                'User_Id' => $user['User_Id'],
                'Username' => $user['Username']);
            return true;    
        }
        
        return false;
    }
    
    public function findPosts() {
        $user = current_user();
        if(!$user) {
            flash("User must be logged in to do that!", "danger", true);
            header('Location: ' . USER_LOGIN_PATH);
            return false;
        }
        
        $username = $_GET['username'];
        
        if(!isset($username)) {
            $this->posts = $this->post_model->findByUserId(current_user()['User_Id']);    
        }
        else {
            $this->posts = $this->post_model->findByUserUsername($username);
        }
        
        return true;
    }
    
    // EFFECTS: Finds a users habits through their username, if no id provided
    //          returns the current users habits
    public function findHabits() {
        $user = current_user();
        if(!$user) {
            flash("User must be logged in to do that!", "danger", true);
            header('Location: ' . USER_LOGIN_PATH);
            return false;
        }
        
        $username = $_GET['username'];
        
        if(!isset($username)) {
            $this->habits = $this->habit_model->findByUserId(current_user()['User_Id']);
        }
        else {
            $this->habits = $this->habit_model->findByUserUsername($username);
        }
        return true;
    }
    
    public function profile() {
        $username = $_GET['username'];
        if(!isset($username)) {
            header('Location: ' . USER_PROFILE_PATH . '&username=' . current_user()['Username']);
            return false;
        }
        
        $user = $this->user_model->findByUsername($username);
        
        if(!$user) {
            flash("User doesn't exist!", "danger", true);
            header('Location: ' . USER_INDEX_PATH);
            return false;
        }
        
        $this->habits = $this->habit_model->findByUserUsername($username);
        $this->user = $user->fetch_array();
        return true;
    }
    
    // EFFECTS: logs the user in
    // MODIFIES: adds user to current session
    // REQUIRES: username and password to match up
    // RETURNS: user or false if user not found
    public function login() {
        $email = @$_POST['email'];
        $password = @$_POST['password'];
        
        if(!(isset($email) && isset($password))) {
            
            set_message("Fields can't be blank", "danger");
            
            //header('Location: /public/user.php?page=login');
            header('Location:'. USER_LOGIN_PATH);
            exit();
        }
        
        $user = $this->user_model->findByEmail($email);
        
        if(!$user) {
            //header('Location: /public/user.php?page=login');
            header('Location:'. USER_LOGIN_PATH);
            set_message("User doesn't exist!", "danger");
            exit();
        }
        
        if(password_verify($password, $user['Password'])) {
            if($this->createSession($user['Username'], $user['User_Id'])) {
                set_message("Successfully logged in!", "success");
                //header('Location: /public/user.php?page=index');
                header('Location:'. USER_INDEX_PATH);
                exit();
            }
        } else {
            set_message("Password not valid!", "danger", true);
            //header('Location: /public/user.php?page=login');
            header('Location:'. USER_LOGIN_PATH);
            exit();
        }
    }

    // EFFECTS: creates a new user
    // REQUIRES: validUser must return true
    // RETURNS boolean if user created else false
    public function create() {
        $email = @$_POST['email'];
        $username = @$_POST['username'];
        $password = @$_POST['password'];
        
        if(!isset($email) || !isset($password) || !isset($username)) {
            flash("Uh oh! Something went wrong!", "danger", true);
            return false;
        }
        
        // check if username in use
        if($this->user_model->findByEmail($email)) {
            flash("Email already in use!", "danger", true);
            //header('Location: /public/user.php?page=signup');
            header('Location:'. USER_SIGNUP_PATH);
            return false;
        } else if($this->user_model->findByUsername($username)) {
            flash("Username already in use!", "danger", true);
            //header('Location: /public/user.php?page=signup');
            header('Location:'. USER_SIGNUP_PATH);
            return false;
        } 
        
        if($this->user_model->create($email, $username, $password)) {
            $this->createSession($username);
            flash("Welcome to FireCharge!", "success");
            //header('Location: /public/user.php?page=index');
            header('Location:'. USER_INDEX_PATH);
            return true;
        } else {
           // header('Location: /public/user.php?page=login');
            header('Location:'. USER_LOGIN_PATH);
            flash("Uh oh! Something went wrong with your for submission!", "danger", true);
            return false;
        }

    }
        //the user model returns something different then expected
        //use at your own risk
     public function edit(){  
         
        if(!logged_in()){//simplify? 
            flash("Must be logged in first!", "danger", true);
            //header("Location: /public/user.php?page=login");
            header('Location:'. USER_LOGIN_PATH);

            return false;
        }
                
        $id = @$_GET['id'];
        $current_user=current_user()['User_Id'];
        
        
        if($id != $current_user){
            
            flash('Error!', "danger", true); 
            //header('Location: /public/user.php?page=index');
            header('Location:'. USER_INDEX_PATH);
            return false; 
        }
        
        if(!isset($id)) {
            flash('User does not exist!', "danger", true);
            //header('Location: /public/user.php?page=index');
            header('Location:'. USER_INDEX_PATH);
            return false;
        }
        
        $user = $this->user_model->findUserById($id);
        
        
        if($user) {
            $this->user = $user;
            return true;
        }
       
        flash('user does not exist!', "danger", true);
        //header('Location: /public/user.php?page=index');
        header('Location:'. USER_INDEX_PATH);
        return false;
    }
    
    //testing do not use
    public function update() {
        $new_username = $_POST['new_username'];
        $new_email = $_POST['new_email'];
        $new_bio = $_POST['new_bio'];
        $new_password = $_POST['new_password'];
        $current_user = current_user();
        $user_id = $current_user['User_Id'];
         
       
        if($new_username == ""){
            flash("Username cannot be blank!", "danger", true);
           // header("Location: /public/user.php?page=edit&id=$user_id");
            header('Location:'. USER_EDIT_PATH."&id=".$user_id);
            return false; 
        }
        
        if($new_email == "") {
            flash("Email cannot be blank!", "danger", true);
            //header("Location: /public/user.php?page=edit&id=$user_id");
            header('Location:'. USER_EDIT_PATH."&id=".$user_id);
            return false; 
         }
        
        if($new_password == "") {
            flash("Password cannot be blank!", "danger", true);
           // header("Location: /public/user.php?page=edit&id=$user_id");
           header('Location:'. USER_EDIT_PATH."&id=".$user_id);
            return false;
        }
        
        if(!$current_user) {
            flash("Must be logged in first!", "danger", true);
            //header('Location: /public/user.php?page=login');
            header('Location: ' . USER_LOGIN_PATH);
            return false;
        }
   
      if($this->user_model->update($new_username,$new_password,$new_email,$new_bio,$user_id)){
            flash("Succesfully Updated Account!", "success",true);
            //header('Location: /public/user.php?page=profile');
            header('Location: ' . USER_PROFILE_PATH);
            return true;
        }
        
       // die("model returns false");
        flash("Something Went Wrong", "success",true);
       // header('Location: /public/user.php?page=edit');
        header('Location: ' . USER_EDIT_PATH);
        return false;
    }
   
    // EFFECTS: unsets the user id from the session
    // REQUIRES: User_Id must be set in the session
    // MODIFIES: Session
    public function logout() {
        unset($_SESSION['User']);
        //header( 'Location: /public/user.php?page=index');
        header('Location:'. USER_INDEX_PATH);
    }
}
?>