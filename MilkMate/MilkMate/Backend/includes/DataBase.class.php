<?php

class DataBase
{
    public static $conn = null;

    public static function getConnection()
    {

        if (DataBase::$conn == null) {
            $servername = get_config('db_server');
            $username = get_config('db_username');
            $password = get_config('db_password');
            $dbname = get_config('db_name');

            // Create connection
            $connection = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            } else {
                DataBase::$conn = $connection;
                return DataBase::$conn;
            }
        } else {
            return DataBase::$conn;
        }
    }
}
