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
    
    public function edit() {
        $id = @$_GET['id'];
        
        if(!isset($id)) {
            // todo: 404 page here
                    
            flash('Habit does not exist!', "danger", true);
            header('Location: /public/user.php?page=index');
            return false;
        }
        
        $habit = $this->habit_model->findById($id);
        
        if($habit) {
            $this->habit = $habit;
            return true;
        }
        
        flash('Habit does not exist!', "danger", true);
        header('Location: /public/user.php?page=index');
        
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
            header("/public/user.php?page=index");
            return false;
        }
        
        if(!$current_user) {
            flash("Must be logged in first!", "danger", true);
            header('Location: /public/user.php?page=login');
            return false;
        }
        
        if($this->habit_model->update($habit_id, $new_name, $new_description)) {
            flash("Succesfully Updated habit track!", "success");
            header('Location: /public/user.php?page=index');
            return true;
        } 
    }
}
?>