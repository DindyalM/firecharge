<?php

    function get($name, $default="") {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
    }
    
    
    $page = get('page', null);
    
    $view = '../app/views/user/' . $page .'.php';
    $model = '../app/models/' . 'user' . 'Model.php';
    $controller = '../app/controllers/' . 'user' . 'Controller.php';
    
    require('../app/views/layouts/navbar.php');
    require('../app/views/layouts/alert.php');
    
    // if(file_exists($view)) {
        
    // }
    // if(file_exists($model)) {
        require $model;
    // }
    // if(file_exists($controller)) {
        require $controller;
        
        $user = new UserController();
        $user->login();
        
        require $view;
    // }
    

?>