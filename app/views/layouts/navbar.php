<?php
    function navbar($active="", $user_logged_in=false) {
        $signup = "";
        $login = "";
        $home = "";
        
        switch($active) {
            case "home":
                $home="active";
                break;
            case "login":
                $login = "active";
                break;
            case "signup":
                $signup = "active";
                break;
            default:
                break;
        }

        $navbar_links = '';

        if ($user_logged_in) {
            $navbar_links = '
                <li class="navbar-item ' . $signup . '">
                    <a class="nav-link" href="#">Friends</a>
                </li>
                <li class="navbar-item">
                    <a class="nav-link" href="/app/views/user/logout.php">Logout</a>
                </li>
            ';
        }
        else {
            $navbar_links = '
                <li class="navbar-item ' . $signup . '">
                    <a class="nav-link" href="' . "/public/user.php?page=signup" .'">Sign Up</a>
                </li>
                <li class="navbar-item ' . $login . '">
                    <a class="nav-link" href="' . "/public/user.php?page=login" .'">Log In</a>
                </li>
            ';
        }
        
        $navbar = '
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
                  <a class="navbar-brand" href="#">FireCharge</a>
                </nav>
                <ul class="navbar-nav ml-auto mr-4">
                    <li class="navbar-item ' . $home .'">
                        <a class="nav-link" href=" '. "/public/index.php" .'">Home</a>
                    </li>
                    ' . $navbar_links . '

                </ul>
                <form class="form-inline my-2 my-lg-0" method="GET" action="/app/views/user/search.php">
                  <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </nav>
        ';
        
        return $navbar;
    }

?>