<?php

namespace Core;

class ORM
{


    private string $from;
    private string $statement;
    private $select = 'SELECT *';
    private string $where = '';


    public function from(string $table)
    {
        $this->from = 'FROM ' . $table;

        return $this;
    }


    public function select(mixed ...$select)
    {
        $this->statement = 'SELECT';
        $this->select = implode(', ', $select);
        return $this;
    }

    public function where(string $where, string $id)
    {
        $this->where = implode(' ', ['WHERE', $where, '=', $id]);
        return $this;
    }

    public function query()
    {
        $db = Database::getInstance();


        $query = $db->prepare(
            implode(' ', [$this->statement, $this->select, $this->from, $this->where])
        );

        $query->execute();

        return  $query->fetchAll();
    }
}


//$orm->from('movie')->select('title', 'duration')->query();
//$orm->from('movie')->set(['title' => 'test'])->query();