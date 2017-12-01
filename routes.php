<?php
    // assets
    define("ROOTPATH", __DIR__ . '/');
    
    // die(realpath(realpath('./')));
    
    define("STYLESHEETS_PATH", './assets/stylesheets/');
    define("JAVASCRIPTS_PATH", './assets/javascripts/');
    define("ASSETS_PATH", './assets/');
    
    // view
    define("USER_LOGIN_PATH", './user.php?page=login');
    define("USER_CREATE_PATH", './user.php?page=login&action=create');
    define("USER_PROFILE_PATH", './user.php?page=profile');
    define("USER_EDIT_PATH", "/public/user.php?page=edit");
    define("HABIT_EDIT_PATH","/public/habit.php?page=edit");
    
    
    // controllers 
    
    // models
    define("USER_PATH",  "./user.php");
    define("HABIT_PATH", "./habit.php");
    
    // urls
?>