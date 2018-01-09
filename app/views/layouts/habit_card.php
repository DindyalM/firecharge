<?php
    function habit_card($habit) {
        $btns = "";
        if(current_user()['User_Id'] == $habit['User_Id']) {
            $btns = '<a href="' . HABIT_EDIT_PATH .'&id=' . $habit['Habit_Id'] .'" class="btn btn-dark mt-2">Update</a>
                     <form class="d-inline" method="POST" action="' . HABIT_PATH .'">
                        <input name="action" type="hidden" value="delete">
                        <input name="Habit_Id" type="hidden" value="' . $habit['Habit_Id'] .'">
                        <input class="btn btn-dark mt-2 ml-3" type="submit" value="Delete"></input>
                     </form>';
        }
        
        $created_at = $habit['Created_At'];
        
        $seconds_since_created = time() - strtotime($created_at);
        
        $days_since_created = round($seconds_since_created / ( 24 * 60 * 60 ));
        
        if($days_since_created <= 30) {
            $progress_amount = strval(floor(($days_since_created / 30) * 100));   
            $days_tracked = '<p class="font-weight-light">Progress: ' . $days_since_created .' days tracked!</p>';
        } else {
            $days_tracked = '<p class="font-weight-light">Tracking complete! Congrats!</p>';
        }
        
        $progress = $days_tracked .'
                    <div class="progress">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: ' . $progress_amount .'%;" aria-valuenow="' . $progress_amount . '" 
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>';
              
        $card = '<div class="text-dark card bg-faded mt-2 mb-2" style="background-color:#f8f9faff">
                  <div class="card-body">
                  <h4 class="card-title">'. $habit['Name']. '</h4>

                  <p class="card-text">'. $habit["Description"] . 
                  $progress . $btns . 
                  '</div>
                </div>';
                  
        return $card;
    }
    
    function no_habits_card($current_user=false) {
        if(!$current_user) {
            $msg = '<div class="card-header text-dark font-weight-bold">
                        User hasn\'t tracked any habits yet!
                    </div>
                    <div class="card-body">
                        <a href="' . USER_PATH .'" class="btn btn-dark">Go Home</a>
                    </div>';
        } else {
            $msg = '<div class="card-header text-dark font-weight-bold">
                You haven\'t tracked any habits yet!<br> What would you like to start off with?
            </div>';
        }
        $card = '<div class="card text-center">
                        ' . $msg .'
                        <div class="card-footer text-muted">
                        </div>
                 </div><br>';
                    
        return $card;
    }
?>