<?php
    session_start();
    function get($name, $default="") {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
    }
    
    $page = get('page', null);
    
    $view = '../app/views/user/' . $page .'.php';
    $model = '../app/models/' . 'user' . 'Model.php';
    $controller = '../app/controllers/' . 'user' . 'Controller.php';
    
    require('../app/models/habitModel.php');
    
    require('../app/views/layouts/navbar.php');
    require('../app/views/layouts/alert.php');
    require('../app/views/layouts/post.php');
    require('../app/views/layouts/card.php');
    require('../app/controllers/helpers.php');
    
    
    if(file_exists($model)) {
        require $model;
    }
    
    if(file_exists($controller)) {
        require $controller;
    }
    
    $user_model = new UserModel();
    $user_controller = new UserController();
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
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
    } else if($_SERVER['REQUEST_METHOD'] == "GET") {
        switch(get('action')) {
            case 'logout':
                $user_controller->logout();
                break;
            case 'search':
                $user_controller->search();
                break;
            case 'index':
                $user_controller->findHabits();
                break;
            case 'profile':
                $user_controller->profile();
                $user_controller->findHabits();
                break;
            default:
                break;
        }
        switch(get('page')) {
            case 'profile':
                $user_controller->profile();
                // $user_controller->findHabits();
                break;
            case 'index':
                $user_controller->findHabits();
                break;
            default:
                break;
        }
    }
    
    
    if(file_exists($view)) {
        require $view;
    }
?>