<?php
    require($_SERVER['DOCUMENT_ROOT'] .'/app/controllers/user.php');
    require($_SERVER['DOCUMENT_ROOT'] .'/app/views/layouts/navbar.php');
    $user = new User();
    
    switch($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            break;
        case 'GET':
            $search_query = $_GET['search'];
            if(isset($search_query)) {
                $user->search($search_query);
            }
            break;
        default:
            break;
    }
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/vendor/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./signup.css">
        <title>User</title>
    </head>
    <body>
        <header>
            <?php echo navbar('search', $user->current_user()); ?>
            <div class="jumbotron bg-info">
              <h1 class="display-3">Search</h1>
              <hr class="my-4">
              <p>blah</p>
            </div>
        </header>
    </body>
</html>