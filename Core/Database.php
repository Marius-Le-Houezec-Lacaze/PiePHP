<?php

namespace Core;

class Database extends \PDO
{
    private static $instance = null;

    public function __construct()
    {
    }
}
