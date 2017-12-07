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
        if(!isset($name)) {
            flash("Name should be present!", "danger", true);
            return false;
        }
        
        if(!$current_user) {
            flash("Must be logged in first!");
            header('Location: ' . USER_LOGIN_PATH);
            return false;
        }
        if($this->habit_model->create($name, $desc, $current_user['User_Id'])) {
            flash("Succesfully created new habit track!", "success");
            header('Location: ' . USER_INDEX_PATH);
            return true;
        } 
            
        flash("Something went wrong!", "danger", true);
        header('Location: ' . USER_INDEX_PATH);
        return false;
    }
    
    public function edit() {
        $id = @$_GET['id'];
        
        if(!isset($id)) {
            // todo: 404 page here
            flash('Habit does not exist!', "danger", true);
            header('Location: ' . USER_INDEX_PATH);
            return false;
        }
        
        $habit = $this->habit_model->findById($id);
        

        if($habit) {
            if(!$habit['User_Id'] == current_user()['User_Id']) {
                flash('Cannot edit another user\'s habits', "danger", true);
                header('Location: ' . USER_INDEX_PATH);
                return false;
            }

            $this->habit = $habit;
            return true;
        }
        
        
        flash('Habit does not exist!', "danger", true);
        header('Location: ' . USER_INDEX_PATH);
        
        return false;
        
    }
    
    //
    public function update(){        
        $habit_id = @$_POST['habit_id'];
        $new_name = @$_POST['new_name'];
        $new_description = @$_POST['new_description'];
        $current_user = current_user();

        if(!isset($new_name)) {
            
            flash("Name should be present!", "danger", true); 
            header("Refresh:0");
            return false;
        }
        
        if(!isset($habit_id)) {
            flash("Habit doesn't exist!", "danger", true);
           // header("/public/user.php?page=index");
            header('Location:'. USER_INDEX_PATH);
            return false;
        }
        
        if(!$current_user) {
            flash("Must be logged in first!", "danger", true);
            header('Location: ' . USER_INDEX_PATH);
            return false;
        }
       
        if($this->habit_model->update($habit_id, $new_name, $new_description)) {
            flash("Succesfully Updated habit track!", "success",true );
            header('Location: ' .USER_INDEX_PATH );
            return true;
        }
    }
    
     //EFFECT: deletes the selected habit

    public function destroy() {
       
        $habit_id = @$_POST['Habit_Id'];
        
        $current_user = current_user();
        
        if(!isset($current_user)) {
            flash("Must be logged in first!", "danger",true);
            header("Location: " . USER_PATH);
            return false;
        }
        
        $habit_to_destroy = $this->habit_model->findById($habit_id);
        
        if(!isset($habit_id) || !$habit_to_destroy) {
            flash("Invalid habit!", "danger",true);
            header("Location: " . USER_PATH);
            return false;
        }
        
        
        if($habit_to_destroy['User_Id'] != $current_user['User_Id']) {
            flash("Can't delete other user's habits!", "danger",true);
            header("Location: " . USER_PATH);
            return false;
        }
        if($this->habit_model->destroy($habit_id)) {
            force_flash("Succesfully deleted habit","success");
            //header("Location: /public/user.php?page=index");
            header('Location:'. USER_INDEX_PATH);
            return true;
        }
        else {
            flash("Something went wrong!","danger",true);
            //header("Location: /public/user.php?page=index");
            header('Location:'. USER_INDEX_PATH);
            return true;
        }
        
    }
    
    public function show() {
        $id = $_GET['id'];
        
        if(!isset($id)) {
            flash("Habit does not exist", "danger", true);
            header("Location: " . USER_PATH);
            return false;
        }
        
        $result = $this->habit_model->findById($id);
        
        $this->habit = $result;
        return true;
    }
    
    
}
?>


        