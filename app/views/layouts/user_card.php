<?php
    //creates a user card used for search
    function user_card($user) {
        $card = '<div class="card mt-2 mb-2">
                      <div class="card-body">
                        <h4 class="card-title text-dark">' . $user['Username'] . '</h4>
                        <a href="/public/user.php?page=profile&username=' . $user['Username'] .'" class="btn btn-link-dark text-dark">Show</a>
                      </div>
                  </div>';
        return $card;
    }
?>