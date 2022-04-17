<?php

namespace Model;

class Movie extends \Core\Entity
{
    #[\Type\IntType(null: false, auto_increment: true, primary_key: true)]
    protected $id;

    #[\Type\StringType(null: false)]
    protected $name;

    #[\Type\Text(null: false)]
    protected $description;

    #[\Type\IntType(null: false)]
    protected $id_genre;

    protected $has_one = [
        'Genre' => 'id_genre'
    ];

    protected $has_many_trough = [
        "User" => ["history", "id_movie"]
    ];

    public function getName()
    {
        return $this->name;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getGenre()
    {
        $genre =  $this->getRelation('Genre');

        return $genre->getName();
    }

    public function getGenreId()
    {
        $genre =  $this->getRelation('Genre');

        return $genre->getId();
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setGenre($genre)
    {
        $this->id_genre = $genre->getId();
    }

    public function setDescription($desc)
    {
        $this->description = $desc;
    }
}
