<?php

namespace System\Database\DBConnection;

use PDO;

use PDOException;
use System\Config\Config;

class DBConnection
{
    private static $dbConnectionInstance = null;

    private function __construct()
    {
        // no one can define an object out of this class from this class 
    }

    public static function getDBConnectionInstance()
    {
        if (self::$dbConnectionInstance == null) {
            $DBConnectionInstance = new DBConnection();

            self::$dbConnectionInstance = $DBConnectionInstance->dbConnection();
        }
        return self::$dbConnectionInstance;
    }


    private function dbConnection()
    {
        $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        try {
            return new PDO("mysql:host=" . Config::get('DB_HOST') . ";dbname=" . Config::get('DB_NAME'), Config::get('DB_USERNAME'), Config::get('DB_PASSWORD'), $option);
        } catch (PDOException $e) {
            echo "error in database connection: " . $e->getMessage();
            return false;
        }
    }
}