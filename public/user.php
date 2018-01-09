<?php
   
    session_start();
    
    function get($name, $default="") {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
    }
    
    require(realpath('./../routes.php'));
    require(realpath('./../config/dbinfo.php'));
    
    $page = get('page', null);
    
    $view = realpath('./../app/views/user/' . $page .'.php');
    // default html page
    $home_view = realpath('./../app/views/user/index.php');
    $model = realpath('./../app/models/' . 'user' . 'Model.php');
    $controller = realpath('./../app/controllers/' . 'user' . 'Controller.php');
    
    
    require(realpath('./../app/models/Model.php'));
    
    require(realpath('./../app/models/habitModel.php'));
    require(realpath('./../app/models/postModel.php'));
    require(realpath('./../app/models/subscriptionModel.php'));
    
    require(realpath('./../app/views/layouts/navbar.php'));
    require(realpath('./../app/views/layouts/user_card.php'));
    require(realpath('./../app/views/layouts/habit_timeline.php'));
    require(realpath('./../app/views/layouts/alert.php'));
    require(realpath('./../app/views/layouts/post_card.php'));
    require(realpath('./../app/views/layouts/post_timeline.php'));
    require(realpath('./../app/views/layouts/habit_card.php'));
    require(realpath('./../app/views/layouts/subscription_timeline.php'));
    require(realpath('./../app/views/layouts/subscription_card.php'));
    require(realpath('./../app/controllers/helpers.php'));
    
    
    if(file_exists($model)) {
        require $model;
    }
    
    if(file_exists($controller)) {
        require $controller;
    }
    
    $user_model = new UserModel();
    $post_model = new PostModel();
    $subscription_model = new SubscriptionModel();
    $user_controller = new UserController();
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        switch(get('action')) {
            case 'subscribe':
                $user_controller->subscribe();
                break;
            case 'unsubscribe':
                $user_controller->unsubscribe();
                break;
            case 'create':
                $user_controller->create();
                break;
            case 'create_post':
                $user_controller->createPost();
                break;
            case 'login':
                $user_controller->login();
                break;
            case 'update':
                $user_controller->update();
                break;
            case 'delete_post':
                $user_controller->destroyPost();
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
                switch($_GET['action']) {
                    case 'posts':
                        $user_controller->findPosts(); 
                        break;
                    case 'subscriptions':
                        $user_controller->findSubscriptions(); 
                        break;
                    case 'subscribers':
                        $user_controller->findSubscribers(); 
                        break;
                    default:
                        $user_controller->findHabits(); 
                        break;
                }
                break;
            case 'index':
                if(logged_in()) {
                    $user_controller->index();
                    $user_controller->findSubscriptionPosts();
                }
                break;
            case "edit":
                $user_controller->edit(); 
                break;
            default:
                if(logged_in()) {
                    $user_controller->index();
                    $user_controller->findSubscriptionPosts();
                }
                break;
        }
    }
    
    if(file_exists($view)) {
        require $view;
    } else {
        if(file_exists($home_view)) {
            require $home_view;
        }
    }
?>