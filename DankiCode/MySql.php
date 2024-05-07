<?php

namespace DankiCode;

use PDO;

class MySql
{
    private static $pdo = null;

    public static function connect()
    {
        if (self::$pdo == null) {
            try {
                self::$pdo = new PDO('mysql:host=localhost;dbname=socialwave', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                echo 'Erro ao conectar: ' . $e->getMessage();
                error_log($e->getMessage());
            }
        }

        return self::$pdo;
    }
}

?>