<?php

namespace Model;

class Movie extends \Core\Entity
{
    #[\Type\IntType(null: false, auto_increment: true, primary_key: true)]
    protected $id;

    #[\Type\StringType]
    protected $name;

    #[\Type\IntType(null: false)]
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
