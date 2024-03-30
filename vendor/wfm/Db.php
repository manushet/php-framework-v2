<?php

namespace WFM;

class Db
{
    use SingletonTrait;

    private static \PDO $pdo;

    private function __construct()
    {
        try {
            $db = require_once(CONFIG . '/database.php');

            static::$pdo = new \PDO($db['dsn'], $db['user'], $db['password']);

            static::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            //echo "Connected to the DataBase successfully!<br>";
        } catch(\PDOException $e) {
            echo "Connection to the database failed!<br>";
            print($e);
        }
    }

    public static function getConnection(): \PDO
    {
        return static::$pdo;
    }
}