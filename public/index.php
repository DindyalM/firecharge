<?php
    require('../app/views/layouts/navbar.php');
    require('../app/views/layouts/alert.php');
    
    if($_GET['page'] == 'home') {
        require '../app/views/home/index.php';
        require '../app/controllers/userController.php';
    }
    else if($_GET['page'] == 'user') {
        require '../app/views/user/index.php';
    }
    else if($_GET['page'] == 'signup') {
        require '../app/views/user/signup.php';
    }
    else {
        require '../app/views/home/index.php';
    }
?>