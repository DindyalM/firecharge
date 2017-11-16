<?php

    if(current_user()==false){
        header('Location: /public/user.php?page=login');
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="/vendor/stylesheets/bootstrap.min.css">
    <title>Update Habit</title>
    </head>
    <body>
        <header>
            <?php echo navbar(); ?>
        </header>
        <section>
            <div class="container">
                <form method="POST">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control"name="name" value="<?php echo 'data' ?>"><!-- obtain data-->
                  </div>
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" name='description' value="<?php echo 'data' ?>"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="hidden" class="form-control" name='habit_Id' value="">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Habit</button>
                  </div>
                </form>
            </div>
        </section>
         
    </body>
</html>