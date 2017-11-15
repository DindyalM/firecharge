<?php 
    
    function flash($msg, $flash_type="primary", $error_flash=false) {
        if($error_flash) {
            $_SESSION['error-flash'] = $msg;
        } else {
            $_SESSION['flash'] = $msg;
            $_SESSION['flash-type'] = $flash_type;    
        }
    }
    
    function logged_in() {
        return isset($_SESSION['User']);
    }
    
    function current_user() {
        $user = $_SESSION['User'];
        if(isset($user)) {
            return $user;
        }
        
        return false;
    }
?>