<?php
    session_start();
    function get($name, $default="") {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
    }
    
    $page = get('page', null);
    
    $view = '../app/views/habit/' . $page .'.php';
    $home_view = '../app/views/habit/index.php';
    $model = '../app/models/habitModel.php';
    $controller = '../app/controllers/habitController.php';
    
    
    require('../app/views/layouts/navbar.php');
    require('../app/views/layouts/alert.php');
    require('../app/views/layouts/post_card.php');
    require('../app/views/layouts/habit_card.php');
    require('../app/controllers/helpers.php');
    require(realpath('./../routes.php'));
    
    
    if(file_exists($model)) {
        require $model;
    }
    
    if(file_exists($controller)) {
        require $controller;
    }
    
    $habit_controller = new HabitController();
    $habit_model = new HabitModel();
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        switch(get('action')) {
            case 'create':
                $habit_controller->create();
                break;
            case 'update':
                $habit_controller->update();
                break;
            case 'delete':
                $habit_controller->destroy();
                break;
            default:
                break;
        }
    } else if($_SERVER['REQUEST_METHOD'] == "GET") {
        switch(get('page')) {
            case('edit'):
                $habit_controller->edit();
                break;
            case('show');
                $habit_controller->show();
            default:
                break;
        }
    }
    
    if(file_exists($view)) {
        require $view;
    } elseif(file_exists($home_view)) {
        require $home_view;
    }
?>