<?php

namespace Model;

class Genre extends \Core\Entity
{
    protected int $id;
    protected string $name;

    protected array $has_many_trough = [
        "Movie" => ['movie_genre', 'id_genre']
    ];


    public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }
}
