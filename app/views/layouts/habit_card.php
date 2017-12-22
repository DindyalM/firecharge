<?php
    function habit_card($habit) {
        $btns = "";
        if(current_user()['User_Id'] === $habit['User_Id']) {
            // $btns = '<a href="/public/habit.php?page=edit&id=' . $habit['Habit_Id'] .'" class="btn btn-link-dark text-dark">Update</a>
            //         <a href="/public/habit.php?id=' . $habit['Habit_Id'] .'" class="btn btn-link-dark text-dark">Delete</a>
            //          ';
            $btns = '<a href="' . HABIT_EDIT_PATH .'&id=' . $habit['Habit_Id'] .'" class="btn btn-link-dark text-dark">Update</a>
                     <form class="d-inline" method="POST" action="' . HABIT_PATH .'">
                        <input name="action" type="hidden" value="delete">
                        <input name="Habit_Id" type="hidden" value="' . $habit['Habit_Id'] .'">
                        <input class="btn btn-link-dark text-dark" type="submit" value="Delete"></input>
                     </form>';
                    //  <a href="' . HABIT_PATH . '?action=delete&id=' . $habit['Habit_Id'] .'" class="btn btn-link-dark text-dark">Delete</a>
             
        }
        #<a href="/public/habit.php?action=delete&id=" class="btn btn-link-dark text-dark">Delete</a>
        
        $created_at = $habit['Created_At'];
        
        $seconds_since_created = time() - strtotime($created_at);
        
        $days_since_created = round($seconds_since_created / ( 24 * 60 * 60 ));
        
        if($days_since_created <= 30) {
            $progress_amount = strval(floor(($days_since_created / 30) * 100));    
        }
        
        $progress = '<div class="progress">
                        <div class="progress-bar progress-bar-striped bg-primary" 
                        role="progressbar" style="width: ' . $progress_amount .'%" aria-valuenow="' . $progress_amount . '" 
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>';
            
        $card = '<div class="card mt-2 mb-2">
                      <div class="card-body">
                        <h4 class="card-title text-dark">' . $habit['Name'] . '</h4>
                        <p class="card-text text-dark">' . $habit['Description'] . '</p>
                        <p>' . $days_since_created .' days tracked.</p>
                        <a href="' . HABIT_SHOW_PATH . '&id=' . $habit['Habit_Id'] .'" class="btn btn-link-dark text-dark">Show</a>
                        ' . $btns . $progress . '
                      </div>
                  </div>';
        return $card;
    }
?>