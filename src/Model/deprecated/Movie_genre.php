<?php

namespace Model;

class Movie_genre extends \Core\Entity
{
    protected int $id_genre;
    protected int $id_movie;

    protected array $has_one = [
        'Movie' => 'id_movie'
    ];
}
