<?php

class Entity
{
    /**
     * orm that will be used in this 
     */
    private \PDO $orm;

    public function __construct(\PDO $db)
    {
        $this->orm = $db;
    }
}
