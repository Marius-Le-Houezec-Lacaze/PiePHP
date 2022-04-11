<?php

namespace Model;

class Movie extends \Core\Entity
{
    protected $id;

    protected $name;
    protected $id_genre;

    protected $has_one = [
        'Genre' => 'id_genre'
    ];

    public function getName()
    {
        return $this->name;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getGenre()
    {
        $genre =  $this->getRelation('Genre');

        return $genre->getName();
    }
}
