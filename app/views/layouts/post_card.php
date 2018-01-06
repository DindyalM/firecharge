<?php
    function post_card($post) {
        if($post['Poster_Id'] == current_user()['User_Id']) {
          $delete_form = '<form class="d-inline" method="POST" action="' . USER_PATH .'">
             <input name="post_id" type="hidden" value="' . $post['Post_Id'] .'"/>
             <input name="user_id" type="hidden" value="' . $post['Poster_Id'] .'"/>
             <input name="username" type="hidden" value="' . $_GET['username'] .'"/>
             <input name="action" type="hidden" value="delete_post"/>
             <input class="btn btn-primary float-right" type="submit" value="Delete"></input>
           </form>';
        }
        
        $card = '<div class="card mt-2 mb-2 border-primary p-1 " >
                   <div class="card-body">
                     <h4 class="card-title text-dark"><a href="' . USER_PROFILE_PATH .'&username=' . $post['Username'] .'">@'. $post['Username']  .'</a>' .
                     '</h4><span class="card-text smaller">' . $post['Text'] . '</span>
                    
                     ' . $delete_form . '
                   </div>
                 </div>';
        return $card;
    }
    
    function no_posts_card() {
        $card = '<div class="card text-center">
                    <div class="card-header text-dark">
                        User hasn\'t tracked any habits yet!
                    </div>
                    <div class="card-body">
                        <a href="' . USER_PATH .'" class="btn btn-dark">Go Home</a>
                    </div>
                        <div class="card-footer text-muted">
                        </div>
                    </div>';
                    
        return $card;
    }
?>

