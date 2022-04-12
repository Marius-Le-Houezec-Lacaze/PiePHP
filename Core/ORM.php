<?php

namespace Core;

class ORM
{
    /**
     * Query string that will be build
     */
    private string $_query_string = '';

    /**
     * Name of the table to be interacted with
     */
    private string $_table;

    /**
     * Database that will be used in orm instance
     */
    private \PDO $_db;

    /**
     * Result of the select if one needed to be returned
     */
    private array $_result;

    /**
     * Maximum number of result in select
     */
    private int $_limit;

    /**
     * Condition for where in sql statement
     */
    private array $_condition = [];

    /**
     * FIeld that will be selected in sql statement
     */
    private array $_select = [];

    /**
     * Contain join information
     */
    private string $_join = '';


    /**
     * Construct for ORM take the PDO of a database in parameter
     *
     * @param \PDO $db the database to be used for query     *
     */
    function __construct(\PDO $db)
    {
        $this->_db = $db;
    }



    /**
     * Setter for the table that will be used in all futur sql query
     *
     * @param string $table the table to be used
     *
     * @return ORM the reference of this object
     */
    public function table(string $table): ORM
    {
        $this->_table = $table;

        return $this;
    }

    /**
     * Fill the select field in the sql query
     *
     * @param mixed ...$params take multiple params and return the selection
     *
     * @return ORM the reference of this object
     */
    public function select(...$params): ORM
    {
        $this->_select = array_merge($this->_select, $params);
        return $this;
    }

    /**
     * Setter for where condition in sql SELECT
     *
     * @param string $condition any valid sql condition (=,LIKE,ect...)
     *
     * @return ORM
     */
    public function where(string $condition): ORM
    {
        $this->_condition[] = $condition;
        return $this;
    }


    /**
     * Limit the number of result in the sql query
     *
     * @param int $limit number of result sent
     *
     * @return ORM the reference of this object
     */
    public function limit(int $limit): ORM
    {
        $this->_limit = $limit;
        return $this;
    }


    /**
     * Build the SELECT query  for execution
     *
     * @return void
     */
    private function _prepareSelect()
    {
        if (sizeof($this->_select) == 0) {
            $this->_select = ['*'];
        }

        $this->_query_string .= 'SELECT ' . implode(', ', $this->_select) . " FROM $this->_table $this->_join";
    }

    /**
     * Executed SELECT sql statement
     *
     * @return array
     */
    public function fetch()
    {

        $this->_prepareSelect();

        $this->_setWhere();
        if (isset($this->_limit)) {
            $this->_query_string .= " LIMIT $this->_limit";
        }

        //var_dump($this->_query_string);

        $query = $this->_db->prepare($this->_query_string);

        $query->execute();

        $this->_result = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $this->_result;
    }


    /**
     * Prepare WHERE statement for sql query add the appropriate AND ect..
     *
     * @return void
     */
    private function _setWhere()
    {
        foreach ($this->_condition as $key => $value) {
            if ($key == 0) {
                $this->_query_string = implode(
                    ' ',
                    [
                        $this->_query_string,
                        'WHERE',
                        $value
                    ]
                );
            } else {
                $this->_query_string = implode(
                    ' ',
                    [
                        $this->_query_string,
                        'AND',
                        $value
                    ]
                );
            }
        }
    }

    /**
     * Execute the DELETE statement
     *
     * @return void
     */
    public function delete()
    {
        $this->_query_string .= "DELETE FROM $this->_table";
        $this->_setWhere();

        $query = $this->_db->prepare($this->_query_string);

        return $query->execute();
    }


    /**
     * Prepare and execute sql statement for INSERT directive
     *
     * @param array $array_params the parametter to be
     *                            inserted inside the sql statement
     *
     * @return int|bool
     */
    public function insert(array $array_params): int|bool
    {

        $params = implode(', ', array_keys($array_params));
        $insert =  implode(
            ', ',
            array_map(
                fn ($v) => ':' . $v,
                array_keys($array_params)
            )
        );

        $query_string = "INSERT INTO $this->_table ($params) VALUES ($insert)";

        $query = $this->_db->prepare($query_string);

        $res = $query->execute($array_params);

        if (!$res) {
            return $res;
        }

        return $this->_db->lastInsertId();
    }


    /**
     * Update the entry with the params passed in parametter
     *
     * @param array $array_params the params passed in parameter in
     *                            the form of a 2 dimensionnal array
     *
     * @return bool
     */
    public function update(array $array_params): bool
    {
        $update =  implode(
            ', ',
            array_map(
                fn ($v) => $v . ' = :' . $v,
                array_keys($array_params)
            )
        );

        $this->_query_string = "UPDATE $this->_table SET $update";
        $this->_setWhere();

        //var_dump($this->_query_string);
        $query = $this->_db->prepare($this->_query_string);

        return $query->execute($array_params);
    }

    /**
     * Join 2 table together on foreign key
     */

    public function join($table, $key, $pivot = false, $type = 1)
    {
        $statement = [];

        switch ($type) {
            case 1:
                $statement[] = 'LEFT JOIN';
                break;
            case 2:
                $statement[] = 'INNER JOIN';
                break;
        }

        if ($pivot === false) {
            $pivots = $this->_table;
        } else {
            $pivots = $pivot;
        }


        $statement[] = $table;
        $statement[] = "ON $key = $pivots.id";

        $this->_join .= ' ' . implode(' ', $statement);
        return $this;
    }
}
