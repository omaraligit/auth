<?php
class Database  
{
    public const USERNAME="root";
    public const PASSWORD="";
    public const HOST="localhost";
    public const DB="iga";

    public static function getConnection(){
        $username = self::USERNAME;
        $password = self::PASSWORD;
        $host = self::HOST;
        $db = self::DB;
        $connection = new \PDO("mysql:dbname=$db;host=$host", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    }
}
