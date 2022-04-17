<?php

namespace Core;

abstract class Entity implements \JsonSerializable
{
    /**
     * Name tof the current entity
     */
    protected string $table_name;

    /**
     *Orginal field of this database
     */
    protected array $table_key;

    public function __construct($data)
    {
        $orm = new ORM(Database::getInstance());

        $this->table_name = strtolower((new \ReflectionClass($this))->getShortName());

        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        $this->table_key = array_flip(array_keys($data));
    }

    /**
     * Remove entry from database without deleteing relation 
     * 
     * @return bool
     */
    public function delete(): bool
    {
        $orm = new ORM(Database::getInstance());

        if (!isset($this->id)) {
            return false;
        }

        $orm->table($this->table_name)
            ->where("id = $this->id");

        return $orm->delete();
    }


    /**
     * Save new entry in database or update an existing one
     * 
     * @return bool|int;
     */
    public function save()
    {
        $orm = new ORM(Database::getInstance());

        $data = get_object_vars($this);
        $data = array_intersect_key($data, $this->table_key);

        if (!isset($this->id)) {
            return $this->id = $orm->table($this->table_name)
                ->insert($data);
        } else {
            $id = $data['id'];
            unset($data['id']);

            return $this->id = $orm->table($this->table_name)
                ->where("id = $id")
                ->update($data);
        }
    }


    /**
     * Return an instance of the entity asked
     */
    public static function get(int $id)
    {
        $class_name = static::class;
        $table_name = strtolower((new \ReflectionClass($class_name))->getShortName());

        $orm = new ORM(Database::getInstance());
        $data = $orm->table($table_name)
            ->where("id = $id")
            ->fetch()[0];

        return new $class_name($data);
    }

    /**
     * Find entity with specific field
     */

    public static function whereLike($field, $value)
    {
        $class_name = static::class;
        $table_name = strtolower((new \ReflectionClass($class_name))->getShortName());

        $orm = new ORM(Database::getInstance());
        $data = $orm->table($table_name)
            ->where("$field LIKE '$value'")
            ->fetch();


        return isset($data[0]) ? new $class_name($data[0]) : false;
    }


    /**
     * Return all instance of the entity
     */
    public static function getAll(...$fields): array
    {
        $class_name = static::class;
        $table_name = strtolower((new \ReflectionClass($class_name))->getShortName());

        $orm = new ORM(Database::getInstance());

        $res = $orm->table($table_name)
            ->select(...$fields)
            ->fetch();

        return array_map(function ($entry) use ($class_name) {
            return new $class_name($entry);
        }, $res);
    }

    public function getRelation($relation)
    {

        $orm = new ORM(Database::getInstance());
        $class = strtolower($relation);
        if (isset($this->has_many_trough)) {
            if (isset($this->has_many_trough[$relation])) {
                $rel = $this->has_many_trough[$relation];
                [$join_table, $pivot] = $this->has_many_trough[$relation];
                $raw = $orm->table($this->table_name)
                    ->select($class . '.*')
                    ->join($join_table, $pivot)
                    ->join($class, 'id_' . $class, $class)
                    ->where("$this->table_name.id = $this->id")
                    ->fetch();

                if ($raw[0]['id'] == null) {
                    return [];
                }
                return array_map(function ($entry) use ($class) {
                    return new ('\Model\\' . ucfirst($class))($entry);
                }, $raw);
            }
        }
        if (isset($this->has_many)) {
            $rel = $this->has_many[$relation];
            if (isset($rel))
                return $this->joinMany($class, $rel);
        }

        if (isset($this->has_one)) {
            $rel = $this->has_one[$relation];
            if (isset($rel))
                return $this->joinOne($class, $rel);
        }
    }

    private function joinOne($class, $rel)
    {
        $orm = new ORM(Database::getInstance());

        $db = $orm->table($class)
            ->select($class . '.*')
            ->join($this->table_name, $rel)
            ->where($this->table_name . '.id = ' . $this->id)
            ->limit(1)
            ->fetch();

        return new ('\Model\\' . ucfirst($class))($db[0]);
    }
    private function joinMany($class, $relation)
    {
        $orm = new ORM(Database::getInstance());

        $db = $orm->table($this->table_name)
            ->select($class . '.*')
            ->join($class, $relation)
            ->where($this->table_name  . '.id = ' . $this->id);

        $db = $db->fetch();
        $res = [];

        foreach ($db as $r) {
            $res[] = new ('\Model\\' . ucfirst($class))($r);
        }
        return $res;
    }


    public function deleteRelation($class)
    {
        $orm = new ORM(Database::getInstance());

        $class = strtolower($class);

        return $orm->table($class)
            ->select($class . '.*')
            ->where("id_$this->table_name = $this->id")
            ->delete();
    }

    /**
     * Make this object convertable to json via json_encode
     */
    public function jsonSerialize(): mixed
    {

        $json = [];

        foreach ($this->table_key as $key => $index) {

            $json[$key] = $this->$key;
        }
        return $json;
    }
}
