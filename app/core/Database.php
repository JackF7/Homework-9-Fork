<?php

namespace app\core;

use PDO;
use PDOException;

trait Database
{
    private function connect()
    {
        $type = 'mysql';
        $server = 'localhost';
        $db = 'homework_9';
        $port = '8888';
        $charset = 'utf8mb4';

        //the mamp default values here
        $username = '';
        $password = '';

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            //set the default fetch type
            //PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,/
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";

        try {
            return new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }
}
