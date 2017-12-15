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
    
    public function destroyPost() {
        $current_user = current_user();
        $user_id = @$_POST['user_id'];
        $post_id = @$_POST['post_id'];
        $profile_username = @$_POST['username'];
        
        if(!isset($user_id) || !isset($post_id)) {
            set_message('Something went wrong!', "danger");
            header('Location:' . USER_PATH);
            exit();
        }
        
        if($user_id != $current_user['User_Id']) {
            set_message('Can\'t delete another user\'s post!', "danger");
            header('Location:' . USER_PATH);
            exit();
        }
        
        if($this->post_model->destroy($post_id)) {
            set_message('Successfully removed post!', "success");
            if($profile_username == $current_user['Username']) {
                header('Location: ' . USER_PROFILE_PATH . '&username=' . $current_user['Username'] . '&action=posts');
                exit();
            } else {
                if(isset($profile_username)) {
                    header('Location: ' . USER_PROFILE_PATH . '&username=' . $profile_username . '&action=posts');
                } else {
                    header('Location: ' . USER_PROFILE_PATH);
                }
                exit();
            }
        } else {
            set_message('Something went wrong! Could not delete that post. :(', "danger");
            header('Location:' . USER_PATH);
            exit();
        }
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
            set_message('Something went wrong!', "danger");
            header('Location:' . USER_PATH);
            exit();
        }
        
        if($this->post_model->create($user_id, $current_user['User_Id'], $text, $username)) {
            set_message('Successfully created post!', "success");
            
            if($user_id == $current_user['User_Id']) {
                header('Location: ' . USER_PROFILE_PATH . '&username=' . $current_user['Username'] . '&action=posts');
                exit();
            } else {
                header('Location: ' . USER_PROFILE_PATH . '&username=' . $username . '&action=posts');
                exit();
            }
            
            exit();
        } else {
            set_message('Something went wrong!', "danger", true);
            header('Location: ' . USER_PATH); 
            exit();
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
            set_message("User must be logged in to do that!", "danger");
            header('Location: ' . USER_LOGIN_PATH);
            exit();
        }
        
        $username = $_GET['username'];
        
        if(!isset($username)) {
            $this->posts = $this->post_model->findByUserUsername(current_user()['Username']);
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
            set_message("User must be logged in to do that!", "danger");
            header('Location: ' . USER_LOGIN_PATH);
            exit();
        }
        
        $username = @$_GET['username'];
        
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
            exit();
        }
        
        $user = $this->user_model->findByUsername($username);
        
        if(!$user) {
            set_message("User doesn't exist!", "danger", true);
            header('Location: ' . USER_INDEX_PATH);
            exit();
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
            set_message("Password not valid!", "danger");
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
            set_message("Uh oh! Something went wrong!", "danger");
            exit();
        }
        
        // check if username in use
        if($this->user_model->findByEmail($email)) {
            set_message("Email already in use!", "danger");
            header('Location:'. USER_PATH);
            exit();
        } else if($this->user_model->findByUsername($username)) {
            set_message("Username already in use!", "danger");
            header('Location:'. USER_PATH);
            exit();
        } 
        
        if($this->user_model->create($email, $username, $password)) {
            $this->createSession($username);
            set_message("Welcome to FireCharge!", "success");
            header('Location:'. USER_INDEX_PATH);
            exit();
        } else {
            header('Location:'. USER_LOGIN_PATH);
            set_message("Uh oh! Something went wrong with your for submission!", "danger");
            exit();
        }

    }
    //the user model returns something different then expected
    //use at your own risk
    // EFFECTS:
    public function edit(){  
         
        if(!logged_in()){//simplify? 
            set_message("Must be logged in first!", "danger");
            //header("Location: /public/user.php?page=login");
            header('Location:'. USER_LOGIN_PATH);

            exit();
        }
                
        $id = @$_GET['id'];
        $current_user=current_user()['User_Id'];
        
        
        if($id != $current_user){
            
            set_message('Error!', "danger"); 
            //header('Location: /public/user.php?page=index');
            header('Location:'. USER_INDEX_PATH);
            exit(); 
        }
        
        if(!isset($id)) {
            set_message('User does not exist!', "danger");
            //header('Location: /public/user.php?page=index');
            header('Location:'. USER_INDEX_PATH);
            exit();
        }
        
        $user = $this->user_model->findUserById($id);
        
        
        if($user) {
            $this->user = $user;
            return true;
        }
       
        set_message('user does not exist!', "danger");
        //header('Location: /public/user.php?page=index');
        header('Location:'. USER_INDEX_PATH);
        exit();
    }
    
    
    //testing do not use
    public function update() {
        $new_username = $_POST['new_username'];
        $new_email = $_POST['new_email'];
        $new_bio = $_POST['new_bio'];
        $new_password = $_POST['new_password'];
        $current_user = current_user();
        $user_id = $current_user['User_Id'];
        
       die(var_dump($current_user));
       
        if($new_username == ""){
            set_message("Username cannot be blank!", "danger");
            header('Location:'. USER_EDIT_PATH."&id=".$user_id);
            exit(); 
        }
        
        if($new_email == "") {
            set_message("Email cannot be blank!", "danger");
            header('Location:'. USER_EDIT_PATH."&id=".$user_id);
            exit(); 
         }
        
        if($new_password == "") {
            set_message("Password cannot be blank!", "danger");
            header('Location:'. USER_EDIT_PATH."&id=".$user_id);
            exit();
        }
        
        if(!$current_user) {
            set_message("Must be logged in first!", "danger");
            header('Location: ' . USER_LOGIN_PATH);
            exit();
        }
   
        if($this->user_model->update($new_username,$new_password,$new_email,$new_bio,$user_id)) {
            set_message("Succesfully Updated Account!", "success");
            header('Location: ' . USER_PROFILE_PATH);
            exit();
        }
        
        set_message("Something Went Wrong", "danger");
        header('Location: ' . USER_EDIT_PATH);
        exit();
    }
   
    // EFFECTS: unsets the user id from the session
    // REQUIRES: User_Id must be set in the session
    // MODIFIES: Session
    public function logout() {
        unset($_SESSION['User']);
        header('Location:'. USER_INDEX_PATH);
        exit();
    }
}
?>