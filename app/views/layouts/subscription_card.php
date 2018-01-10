<?php
    //creates a user card used for search
    function subscription_post_card($post) {
        $card = '<div class="card mt-2 mb-2 border-primary p-1 mr-3 ml-3 " >
                    <div class="card-body">
                    <span class="card-text smaller text-dark">
                    <a href="' . USER_PROFILE_PATH .'&username=' . $post['Poster_Username'] .'">' . $post['Poster_Username'] . '</a>
                    posted on 
                    <a href="' . USER_PROFILE_PATH .'&username=' . $post['Posted_To_Username'] .'">' . ($post['Poster_Username'] == $post['Posted_To_Username'] ? 'their</a> ' : ( $post['Posted_To_Username'] == current_user()['Username'] ? 'your</a> ' : $post['Posted_To_Username'] . '</a>\'s ')) .'timeline.</span>
                    <h4 class="card-title text-dark"><a href="">'. $post['Username']  .'</a>' .
                    '</h4><span class="card-text smaller text-muted">' . $post['Post']. '</span>
                  </div>
                </div>';
         
        return $card;
    }
    
    // EFFECTS: returns a card for subscriptions
    //          if subscription card is true, adds an unsubscribe link for that user
    function subscription_card($user, $subscription_card=false, $profile_owner_username=false) {
        $unsubscribe_form = '<form style="display: inline;" method="POST">
                                  <input type="hidden" name="action" value="unsubscribe">
                                  <input type="hidden" name="Unsubscribe_To_Id" value="' . $user['User_Id'] . '">
                                  <input type="submit" class="btn btn-link text-primary" value="Unsubscribe"></input>
                                </form>';
                                
        $card = '<div class="card border-primary" style="width: 20rem; margin: 15px;">
                  <div class="card-body">
                    <a class="link-success" href="' . USER_PROFILE_PATH .'&username=' . $user['Username'] .'">
                    <h4 class="card-title ">@' . $user['Username'] .'</h4>
                    </a>
                    <h6 class="card-subtitle mb-2 text-muted">' . $user['Bio'] . '</h6>'
                    . (($subscription_card == 'subscriptions') && (current_user()['Username'] == $profile_owner_username) ? $unsubscribe_form : '') .
                    '</div>
                </div>';
 
        return $card;
    }
    
    function no_subscriptions_card() {
        
        $search_form = '<form class=" my-2 my-lg-0" method="GET" action="' . USER_PATH . '">
                          <input name="action" type="hidden" value="search">
                          <input name="page" type="hidden" value="search">
                          <input name="search" class="form-control text-center mb-3" style="width: 200px; margin: 0 auto;" type="search" placeholder="Enter a term!">
                          <button class="btn btn-dark" type="submit">Search For Users</button>
                        </form>';
        
        $card = '<div class="card text-center text-dark">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">hmm...</h5>
                    <p class="card-text">Looks like you haven\'t subscribed to any users yet!</p>
                    ' . $search_form .'
                    <br>
                    <p class="card-text text-muted">(Note: You can leave the field blank to search through all users)</p>
                    </div>
                        <div class="card-footer text-muted">
                        </div>
                    </div>';
                    
        return $card;
    }
?>