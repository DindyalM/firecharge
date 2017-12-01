<?php
    // assets
    define("ROOTPATH", __DIR__ . '/');
    
    // die(realpath(realpath('./')));
    
    define("STYLESHEETS_PATH", realpath('public/assets/stylesheets/'));
    define("JAVASCRIPTS_PATH", realpath('public/assets/javascripts/'));
    define("ASSETS_PATH", realpath(ROOTPATH . 'public/assets/'));
    
    // view
    ///public/user.php?page=login
    
    // $path = $_SERVER['REQUEST_URI'];
    // define("*MODELNAME*_*ACTIONNAME*_PATH")
    define("USER_LOGIN_PATH", 'public/user.php?page=login');
    define("USER_CREATE_PATH", 'public/user.php?page=login&action=create');
    
    // die($path);
    
    
    // controllers 
    
    // models
    define("USER_PATH", realpath(ROOTPATH . "public/user.php"));
    define("HABIT_PATH", realpath(ROOTPATH . "public/habit.php"));
    
    // urls
?>