<?php
    // assets
    define("ROOTPATH", __DIR__ . '/');
    
    // die(realpath(realpath('./')));
    
    define("STYLESHEETS_PATH", './assets/stylesheets/');
    define("JAVASCRIPTS_PATH", './assets/javascripts/');
    define("ASSETS_PATH", './assets/');
    
    // view
    ///public/user.php?page=login
    
    // $path = $_SERVER['REQUEST_URI'];
    // define("*MODELNAME*_*ACTIONNAME*_PATH")
    define("USER_LOGIN_PATH", './user.php?page=login');
    define("USER_CREATE_PATH", './user.php?page=login&action=create');
    define("USER_PROFILE_PATH", './user.php?page=profile');
    define("HABIT_EDIT_PATH","/public/habit.php?page=edit");
    // die($path);
    
    
    // controllers 
    
    // models
    define("USER_PATH",  "./user.php");
    define("HABIT_PATH", "./habit.php");
    
    // urls
?>