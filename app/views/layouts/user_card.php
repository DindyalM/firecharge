<?php
    //creates a user card used for search
    function user_card($user) {
        $card = '<div class="card" style="width: 20rem; margin: 15px;">
                  <div class="card-body">
                    <h4 class="card-title">' . $user['Username'] .'</h4>
                    <h6 class="card-subtitle mb-2 text-muted">' . $user['Bio'] . '</h6>
                    <p class="card-text"></p>
                    <a class="card-link" href="' . USER_PROFILE_PATH .'&username=' . $user['Username'] .'">Profile</a>
                  </div>
                </div>';
        
        
        // $card = '<div class="card mt-2 mb-2">
        //               <div class="card-body">
        //                 <h4 class="card-title text-dark">' . $user['Username'] . '</h4>
        //                 <a href="' . USER_PROFILE_PATH .'&username=' . $user['Username'] .'" class="btn btn-link-dark text-dark">Show</a>
        //               </div>
        //           </div>';
        return $card;
    }
?>