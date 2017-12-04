<?php
    // assets
    define("ROOTPATH", __DIR__ . '/');
    
    // die(realpath(realpath('./')));
    
    define("STYLESHEETS_PATH", './assets/stylesheets/');
    define("JAVASCRIPTS_PATH", './assets/javascripts/');
    define("ASSETS_PATH", './assets/');
    
    // view
    // user
    define("USER_LOGIN_PATH", './user.php?page=login');
    define("USER_SIGNUP_PATH", './user.php?page=signup');
    define("USER_CREATE_PATH", './user.php?page=login&action=create');
    define("USER_PROFILE_PATH", './user.php?page=profile');
    define("USER_SEARCH_PATH", './user.php?page=search');
    define("USER_INDEX_PATH", './user.php?page=index');
    define("USER_EDIT_PATH", "./user.php?page=edit");
    // habit
    define("HABIT_EDIT_PATH", "./habit.php?page=edit");
    define("HABIT_SHOW_PATH", "./habit.php?page=show");
    
    
    // controllers 
    
    // models
    define("USER_PATH",  "./user.php");
    define("HABIT_PATH", "./habit.php");
    
    // urls
?>