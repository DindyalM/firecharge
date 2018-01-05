<?php
    //creates a user card used for search
    function subscription_post_card($post) {
        // $card = '<div class="card" style="width: 20rem; margin: 15px;">
        //           <div class="card-body">
        //             <h4 class="card-title">' . $user['Username'] .'</h4>
        //             <h6 class="card-subtitle mb-2 text-muted">' . $user['Bio'] . '</h6>
        //             <p class="card-text"></p>
        //             <a class="card-link" href="' . USER_PROFILE_PATH .'&username=' . $user['Username'] .'">Profile</a>
        //           </div>
        //         </div>';
        
        $card = '<div class="card mt-2 mb-2 border-primary p-1 " >
           <div class="card-body">
             <span class="card-text smaller text-dark">
             <a href="' . USER_PROFILE_PATH .'&username=' . $post['Poster_Username'] .'">' . $post['Poster_Username'] . '</a>
             posted on 
             <a href="' . USER_PROFILE_PATH .'&username=' . $post['Posted_To_Username'] .'">' . ($post['Poster_Username'] == $post['Posted_To_Username'] ? 'their</a> ' : ( $post['Posted_To_Username'] == current_user()['Username'] ? 'your </a> ' : $post['Posted_To_Username'] . '</a>\'s ')) .'timeline.</span>
             <h4 class="card-title text-dark"><a href="">'. $post['Username']  .'</a>' .
             '</h4><span class="card-text smaller text-dark">' . $post['Post']. '</span>
           </div>
         </div>';
         
         return $card;
        // $card = '<div class="card mt-2 mb-2">
        //               <div class="card-body">
        //                 <h4 class="card-title text-dark">' . $user['Username'] . '</h4>
        //                 <a href="' . USER_PROFILE_PATH .'&username=' . $user['Username'] .'" class="btn btn-link-dark text-dark">Show</a>
        //               </div>
        //           </div>';
        return $card;
    }
?>