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
            header('Location: /public/user.php?page=login');
            return false;
        }
        if($this->habit_model->create($name, $desc, $current_user['User_Id'])) {
            flash("Succesfully created new habit track!", "success");
            header('Location: /public/user.php?page=index');
            return true;
        } 
            
        flash("Something went wrong!", "danger", true);
        header('Location: /public/user.php?page=index');
        return false;
    }
    public function update(){
        
        $new_name = @$_POST['new_name'];
        $new_desc = @$_POST['new_description'];
        $current_user = current_user();
        
         if(!isset($name)) {
            flash("Name should be present!", "danger", true);
            return false;
        }
        
        if(!$current_user) {
            flash("Must be logged in first!", "danger", true);
            header('Location: /public/user.php?page=login');
            return false;
        }
        if($this->habit_model->update($new_name, $new_description, $current_user['User_Id'])) {
            flash("Succesfully Updated habit track!", "success");
            header('Location: /public/user.php?page=index');
            return true;
        } 
    }
}
?>