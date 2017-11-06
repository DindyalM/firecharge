<?php
    function card($name, $description="") {
        $card = '<div class="card">
                      <div class="card-body">
                        <h4 class="card-title">' . $name . '</h4>
                        <p class="card-text">' . $description . '</p>
                        <a href="#" class="btn btn-primary">Show</a>
                      </div>
                  </div>';
        return $card;
    }
?>