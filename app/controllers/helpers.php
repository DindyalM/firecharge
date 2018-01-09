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
    
    function get_result( $Statement ) {
        $RESULT = array();
        $Statement->store_result();
        for ( $i = 0; $i < $Statement->num_rows; $i++ ) {
            $Metadata = $Statement->result_metadata();
            $PARAMS = array();
            while ( $Field = $Metadata->fetch_field() ) {
                $PARAMS[] = &$RESULT[ $i ][ $Field->name ];
            }
            call_user_func_array( array( $Statement, 'bind_result' ), $PARAMS );
            $Statement->fetch();
        }
        return $RESULT;
    }
?>