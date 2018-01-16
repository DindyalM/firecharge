<?php
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    define("SERVER_NAME", $url["host"]);
    define("USERNAME", $url["user"]);
    define("PASSWORD", $url["pass"]);
    define("DATABASE", substr($url["path"], 1));
    
?>