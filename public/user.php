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

    // echo var_dump($_POST);
    
    if(file_exists($model)) {
        require $model;
    }
    if(file_exists($controller)) {
        require $controller;
    }
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_controller = new UserController();
        switch(get('action')) {
            case 'create':
                $user_controller->create();
                break;
            case 'login':
                $user_controller->login();
                break;
            default:
                break;
        }

    }
    
    
    if(file_exists($view)) {
        require $view;
    }
    

    
    

?>