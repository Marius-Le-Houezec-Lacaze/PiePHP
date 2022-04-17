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
            $config = json_decode(file_get_contents('config.json'))->database;

            self::$_instance = new PDO(
                "mysql:host=$config->host;dbname=$config->db_name;charset=utf8mb4",
                $config->username,
                $config->password
            );
        }

        return self::$_instance;
    }
}


// DROP DATABASE IF EXISTS my_cinema;

// CREATE DATABASE my_cinema;

// USE my_cinema;
