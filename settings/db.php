<?php
    /* 
     * ===========
     * DB SETTINGS
     * ===========
     */

    if ($_SERVER["SERVER_NAME"] == "localhost" || $_SERVER["SERVER_ADDR"] == "127.0.0.1") {
        // localhost
        $dsn = "mysql:host=localhost;dbname=sportswh;charset=utf8";
        $username = "root";
        $password = "";
    } else {
        // Settings for a remote server
        $dsn = "";
        $username = "";
        $password = "";
    }
?>