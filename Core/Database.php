<?php

namespace Core;

use PDO;

class Database
{
    /**
     * Contain the single pdo instance 
     */
    private static $_instance = null;

    /**
     * Return the static instance representing the database
     * 
     * @return PDO 
     */
    static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new PDO(
                'mysql:host=172.17.0.1;dbname=cinema;charset=utf8mb4',
                'root',
                'password'
            );
        }

        return self::$_instance;
    }
}
