<?php
    switch($_GET['page']) {
        case 'login':
            require '../app/views/user/login.php';
            require '../app/controller/helpers/php';
            break;
        case 'signup':
            require '../app/views/user/signup.php';
            require '../app/controller/helpers/php';
            break;
        default:
            break;
}
    // if($_GET['page'] == 'home') {
    //     require '../app/views/home/index.php';
    //     require '../app/controller/helpers/php';
    // }
    // else if($_GET['page'] == 'user') {
    //     require '../app/views/user/index.php';
    // }
    // else if($_GET['page'] == 'signup') {
    //     require '../app/views/user/signup.php';
    // }
    // else {
    //     require '../app/views/home/index.php';
    // }
?>