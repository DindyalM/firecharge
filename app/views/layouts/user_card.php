<?php
    //creates a user card used for search
    function user_card($user) {
        $card = '<div class="card" style="width: 20rem; margin: 15px;">
                  <div class="card-body">
                    <a class="link-success" href="' . USER_PROFILE_PATH .'&username=' . $user['Username'] .'">
                    <h4 class="card-title ">@' . $user['Username'] .'</h4>
                    </a>
                    <h6 class="card-subtitle mb-2 text-muted">' . $user['Bio'] . '</h6>
                    <p class="card-text"></p>
                    
                  </div>
                </div>';
 
        return $card;
    }
?>