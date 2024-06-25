<?php

namespace app\DbConnect;
use PDO;
use PDOException;

class Db
{
    public static function connect()
    {
        try {
            $db_host = 'localhost';
            $db_name = 'class_based';
            $db_user = 'root';
            $db_password = "";
            $connect= new PDO(
                "mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connect;
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
