<?php
class Database
{
    private static $conn;
    public static function connectDatabase()
    {
        //singleton patern
        if (self::$conn == NULL)
            self::$conn = new mysqli("localhost", "root", "", "kurser");
        return self::$conn;
    }
}





?>