<?php 
    class iimysqli_result
    {
        public $stmt, $nCols;
    }    
    
    // Function i wrote to wrap functions below
    function stmt_to_assoc($stmt) {
        $arr = [];
        
        while($assoc_array = iimysqli_result_fetch_assoc($stmt)) {
            array_push($arr, $assoc_array);
        }
        
        return $arr;
    }
    
    // Function i wrote to wrap functions below
    function stmt_to_arr($stmt) {
        $result = iimysqli_stmt_get_result($stmt);
        
        $arr = [];
        
        while($row = iimysqli_result_fetch_array($result)) {
            array_push($arr, $row);
        }
        
        return $arr;
    }
    
    // Used to get around gblearn not having "mysqlnd"
    function iimysqli_stmt_get_result($stmt)
    {
        /**    EXPLANATION:
         * We are creating a fake "result" structure to enable us to have
         * source-level equivalent syntax to a query executed via
         * mysqli_query().
         *
         *    $stmt = mysqli_prepare($conn, "");
         *    mysqli_bind_param($stmt, "types", ...);
         *
         *    $param1 = 0;
         *    $param2 = 'foo';
         *    $param3 = 'bar';
         *    mysqli_execute($stmt);
         *    $result _mysqli_stmt_get_result($stmt);
         *        [ $arr = _mysqli_result_fetch_array($result);
         *            || $assoc = _mysqli_result_fetch_assoc($result); ]
         *    mysqli_stmt_close($stmt);
         *    mysqli_close($conn);
         *
         * At the source level, there is no difference between this and mysqlnd.
         **/
        $metadata = mysqli_stmt_result_metadata($stmt);
        $ret = new iimysqli_result;
        if (!$ret) return NULL;
    
        $ret->nCols = mysqli_num_fields($metadata);
        $ret->stmt = $stmt;
    
        mysqli_free_result($metadata);
        return $ret;
    }
    
    function iimysqli_result_fetch_assoc($stmt)
    {
        $stmt->store_result();
        
        if($stmt->num_rows>0)
        {
            $result = array();
            $md = $stmt->result_metadata();
            $params = array();
            while($field = $md->fetch_field()) {
                $params[] = &$result[$field->name];
            }
            call_user_func_array(array($stmt, 'bind_result'), $params);
            if($stmt->fetch())
                return $result;
        }
    
        return null;
    }
    
    function iimysqli_result_fetch_array(&$result)
    {
        $ret = array();
        $code = "return mysqli_stmt_bind_result(\$result->stmt ";
    
        for ($i=0; $i<$result->nCols; $i++)
        {
            $ret[$i] = NULL;
            $code .= ", \$ret['" .$i ."']";
        };
    
        $code .= ");";
        if (!eval($code)) { return NULL; };
    
        // This should advance the "$stmt" cursor.
        if (!mysqli_stmt_fetch($result->stmt)) { return NULL; };
    
        // Return the array we built.
        return $ret;
    }

    abstract class Model {
        protected $db;
        
        // EFFECTS: sets $db to the database connection
        // MODIFIES: $db
        // REQUIRES: there must be a database with name in database variable
        // RETURNS: boolean
        protected function connect() {
            if(isset($db)) {
                return true;
            }
            
            $servername = SERVER_NAME;
            $username = USERNAME;
            $password = PASSWORD;
            $database = DATABASE;
            $dbport = DB_PORT;
             
            // Create connection
            $this->db = new mysqli($servername, $username, $password, $database);
    
            // Check connection
            if ($this->db->connect_error) {
                return false;
            }
            
            return true;
        }
    }
?>