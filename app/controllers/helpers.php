<?php 
    
    function set_message($message, $message_type="primary") {
        $_SESSION['message'] = $message;
        $_SESSION['message-type'] = $message_type;   
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