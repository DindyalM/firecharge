<?php
    function card($name, $description="") {
        $card = '<div class="card mt-2 mb-2">
                      <div class="card-body">
                        <h4 class="card-title text-dark">' . $name . '</h4>
                        <p class="card-text text-dark">' . $description . '</p>
                        <a href="/public/user.php?page=profile&username=' . $name .'" class="btn btn-link-dark text-dark">Show</a>
                        <a href="#" class="btn btn-link-dark text-dark">Update</a>
                        <a href="#" class="btn btn-link-dark text-dark">Delete</a>
                      </div>
                  </div>';
        return $card;
    }
?>