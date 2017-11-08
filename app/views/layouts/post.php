<?php
function post() {
    $post = '
        <div class="card" style="color: black;">
          <div class="card-body">
            <p class="card-text">' . current_user()['Username'] . ' .: Blah blah blah.</p>
          </div>
        </div>';
        return $post;    
}

?>