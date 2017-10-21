<?php
    function navbar($active="") {
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
        
        $navbar = '
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
                <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
                  <a class="navbar-brand" href="#">FireCharge</a>
                </nav>
                <ul class="navbar-nav ml-auto mr-4">
                    <li class="navbar-item ' . $home .'">
                        <a class="nav-link" href=" '. "/app/views/home/index.php" .'">Home</a>
                    </li>
                    <li class="navbar-item ' . $signup . '">
                        <a class="nav-link" href="'. "/app/views/user/signup.php" .'">Sign Up</a>
                    </li>
                    <li class="navbar-item ' . $login . '">
                        <a class="nav-link" href="'. "/app/views/user/login.php" .'">Log In</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </nav>
        ';
        
        return $navbar;
    }

?>