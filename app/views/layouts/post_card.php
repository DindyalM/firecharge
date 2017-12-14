<?php
    function post_card($post) {
        if($post['Poster_Id'] == current_user()['User_Id']) {
          $delete_form = '<form class="d-inline" method="POST" action="' . USER_PATH .'">
             <input name="post_id" type="hidden" value="' . $post['Post_Id'] .'"/>
             <input name="user_id" type="hidden" value="' . $post['Poster_Id'] .'"/>
             <input name="username" type="hidden" value="' . $_GET['username'] .'"/>
             <input name="action" type="hidden" value="delete_post"/>
             <input class="btn btn-link-dark text-dark" type="submit" value="Delete"></input>
           </form>';
        }
        
        $card = '<div class="card mt-2 mb-2">
                   <div class="card-body">
                     <p class="text-dark">@' . $post['Username'] . '</p>
                    <p class="card-text text-dark">' . $post['Text'] . '</p>
                     ' . $delete_form . '
                   </div>
                 </div>';
        return $card;
    }
?>