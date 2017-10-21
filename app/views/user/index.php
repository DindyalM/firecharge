<html>
    <head>
        <!--<link href="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/app/vendor/stylesheets/bootstrap.min.css' ?>"></link>-->
        <link rel="stylesheet" type="text/css" href="/app/vendor/stylesheets/bootstrap.min.css">
        <title>User</title>
    </head>
    <body>
        <h1>User</h1>
        <form class="form-group">
            <input class="form-control" name='username' type='text' placeholder="Username"></input>
            <input class="form-control" name='password' type='password' placeholder="Password"></input>
            <input class="form-control" name='password_confirmation' type='password' placeholder="Confirm Password"></input>
            <input class='btn btn-success' type='submit'></input>
        </form>
    </body>
</html>