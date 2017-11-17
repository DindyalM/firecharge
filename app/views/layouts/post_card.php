<?php
    function post_card($post) {
        echo var_dump($post);
        $card = '<div class="card mt-2 mb-2">
                      <div class="card-body">
                        <p class="text-dark">@' . $post['Username'] . '</p>
                        <p class="card-text text-dark">' . $post['Text'] . '</p>
                      </div>
                  </div>';
        return $card;
    }
?>