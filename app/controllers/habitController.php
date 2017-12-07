<?php
class HabitController {
    private $habit_model;
    public function __construct() {
        $this->habit_model = new HabitModel();
    }
    
    public function create() {
        $name = @$_POST['name'];
        $desc = @$_POST['description'];
        $current_user = current_user();
        if(!isset($name) || strlen($name) == 0) {
            set_message("Habit name cannot be blank!", "danger");
            header("Refresh:0");
            exit();
        }
        
        if(!$current_user) {
            set_message("Must be logged in first!","danger");
            header('Location: ' . USER_LOGIN_PATH);
            exit();
        }
        if(strlen($desc) > 250) {
            set_message("Description is too long!", "danger");
            header("Refresh:0");
            exit();
        }
        if(strlen($name) > 55) {
            set_message("Name is too long!", "danger");
            header("Refresh:0");
            exit();
        }
        if($this->habit_model->create($name, $desc, $current_user['User_Id'])) {
            set_message("Succesfully created new habit track!", "success");
            header("Refresh:0");
            exit();
        } 
            
        set_message("Something went wrong!", "danger");
        header("Refresh:0");
        exit();
    }
    
    public function edit() {
        $id = @$_GET['id'];
        
        if(!isset($id)) {
            // todo: 404 page here
            set_message('Habit does not exist!', "danger");
            header('Location: ' . USER_INDEX_PATH);
            exit();
        }
        
        $habit = $this->habit_model->findById($id);
        

        if($habit) {
            if(!$habit['User_Id'] == current_user()['User_Id']) {
                set_message('Cannot edit another user\'s habits', "danger");
                header('Location: ' . USER_INDEX_PATH);
                exit();
            }

            $this->habit = $habit;
            return true;
        }
        
        
        set_message('Habit does not exist!', "danger");
        header('Location: ' . USER_INDEX_PATH);
        
        exit();
    }
    
    //
    public function update(){        
        $habit_id = @$_POST['habit_id'];
        $new_name = @$_POST['new_name'];
        $new_description = @$_POST['new_description'];
        $current_user = current_user();

        if(!isset($new_name)) {
            
            set_message("Name should be present!", "danger"); 
            header("Refresh:0");
            exit();
        }
        
        if(!isset($habit_id)) {
            set_messageset_message("Habit doesn't exist!", "danger");
           // header("/public/user.php?page=index");
            header('Location:'. USER_INDEX_PATH);
            exit();
        }
        
        if(!$current_user) {
            set_message("Must be logged in first!", "danger", true);
            header('Location: ' . USER_INDEX_PATH);
            exit();
        }
       
        if($this->habit_model->update($habit_id, $new_name, $new_description)) {
            set_message("Succesfully Updated habit track!", "success");
            header('Location: ' .USER_INDEX_PATH );
            exit();
        }
    }
    
     //EFFECT: deletes the selected habit

    public function destroy() {
       
        $habit_id = @$_POST['Habit_Id'];
        
        $current_user = current_user();
        
        if(!isset($current_user)) {
            set_message("Must be logged in first!", "danger");
            header("Location: " . USER_PATH);
            exit();
        }
        
        $habit_to_destroy = $this->habit_model->findById($habit_id);
        
        if(!isset($habit_id) || !$habit_to_destroy) {
            set_message("Invalid habit!", "danger");
            header("Location: " . USER_PATH);
            exit();
        }
        
        
        if($habit_to_destroy['User_Id'] != $current_user['User_Id']) {
            set_message("Can't delete other user's habits!", "danger");
            header("Location: " . USER_PATH);
            exit();
        }
        if($this->habit_model->destroy($habit_id)) {
            set_message("Succesfully deleted habit","success");
            //header("Location: /public/user.php?page=index");
            header('Location:'. USER_INDEX_PATH);
            exit();
        }
        else {
            set_message("Something went wrong!","danger");
            //header("Location: /public/user.php?page=index");
            header('Location:'. USER_INDEX_PATH);
            exit();
        }
        
    }
    
    public function show() {
        $id = $_GET['id'];
        
        if(!isset($id)) {
            set_message("Habit does not exist", "danger");
            header("Location: " . USER_PATH);
            exit();
        }
        
        $result = $this->habit_model->findById($id);
        
        $this->habit = $result;
    }
    
    
}
?>


        