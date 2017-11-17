<?php
function habit_timeline($habits) {
    $timeline = '<div id="timeline" class="row">
                  <div class="col-md-10 offset-1">
                    <form action="/public/habit.php" method="POST">
                        <div class="form-group mx-auto">
                          <input class="form-control" name="action" type="hidden" value="create"/>
                          <input name="name" class="form-control" type="text" name="Name" placeholder="Name"/></br>
                          <textarea name="description" class="form-control" name="Details" placeholder="Details"></textarea>
                        </div>
                        <input class="btn btn-dark" type="submit" value="Create Habit"/>
                    </form>
                    <div class="text-dark">';
    // insert data into timeline
    if($habits) {
        foreach($habits as $habit) {
            $timeline = $timeline . habit_card($habit);
        }
    }
        
    $timeline = $timeline . '</div>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <a href="#" class="">Load More</a>
                    </div>';
                    
    return $timeline;
}
?>