<?php

namespace Model;

class Genre extends \Core\Entity
{

    #[\Type\IntType(null: false, auto_increment: true, primary_key: true)]
    protected int $id;

    #[\Type\StringType(null: false)]
    protected string $name;

    protected $has_many = [
        'Movie' => 'id_genre'
    ];

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
