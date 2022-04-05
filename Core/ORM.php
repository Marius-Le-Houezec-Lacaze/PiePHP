<?php

namespace Core;

require_once './Database.php';

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
        $this->_query_string .= "SELECT ";
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

        $this->_query_string .= 'SELECT ' . implode(', ', $this->_select) . " FROM $this->_table";
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
     * @return bool
     */
    public function insert(array $array_params): bool
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

        return $query->execute($array_params);
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
            ' ',
            array_map(
                fn ($v) => $v . ' = :' . $v,
                array_keys($array_params)
            )
        );

        $this->_query_string = "UPDATE $this->_table SET $update";
        $this->_setWhere();

        $query = $this->_db->prepare($this->_query_string);

        return $query->execute($array_params);
    }
}




$orm = new Orm(Database::getInstance());


$res = $orm->table('movie')
    ->where('id = 1')
    ->update([
        'title' => 'this is from my query builder update mothafacka'
    ]);
            
// $res =  $orm->table('movie')
//     ->where('id > 10')
//     ->where('duration = 100')
//     ->fetch();

// // $res = $orm->table('membership_log')
// //     ->where('id_membership = 10')
// //     ->where('id_session = 26')
// //     ->delete();

// //     var_dump($res);

// // Instantiate a DateTime with microseconds.
// $d = new \DateTime('2011-01-01T15:03:01.012345Z');

// // $orm->table('movie')
// //     ->insert([
// //         'id_distributor' => '1',
// //         'director' => 'billy',
// //         'duration' => '100',
// //         'release_date' => date_format($d, 'Y-m-d H:i:s'),
// //         'title' => 'hello world',
// //         'rating' => '0'
// //     ]);


// var_dump($res);

//$orm->from('movie')->select('title', 'duration')->get();
//$orm->from('movie')->set(['title' => 'test'])->query();

//                 'movie'
// $orm->table(Movie::class)->id(1);

//  new Movie()