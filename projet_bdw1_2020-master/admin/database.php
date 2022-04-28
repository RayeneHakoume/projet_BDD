<?php

class Database
{
    private static $dbHost = "localhost";
    private static $dbName = "Base";
    private static $dbUsername = "root";
    private static $dbUserpassword = "";
    
    /**
     *
     * @var PDO
     */
    private static $connection = null;
    
    public static function beginTransation(){
        self::$connection->beginTransaction();
    }
    
    public static function commit(){
        self::$connection->commit();
    }
    
    public static function connect()
    {
        if(self::$connection == null)
        {
            try
            {
              self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName , self::$dbUsername, self::$dbUserpassword);
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$connection;
    }
    
    public static function disconnect()
    {
        self::$connection = null;
    }

}
?>
