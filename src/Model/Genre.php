<?php

namespace Model;

class Genre extends \Core\Entity
{
    protected int $id;

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
}
