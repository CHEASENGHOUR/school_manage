<?php

namespace App\Core;

use mysqli;

class Database
{
    public static function connect(): mysqli
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            die("DB Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
