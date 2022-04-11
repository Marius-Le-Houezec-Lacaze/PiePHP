<?php

namespace Model;

class Movie extends \Core\Entity
{
    protected int $id;

    protected int $id_distributor;

    protected int|null $duration;

    protected string $release_date;

    protected string $title;

    protected string $rating;

    protected string $director;

    protected array $has_one = [
        'Distributor' => 'id_distributor'
    ];

    protected array $has_many_trough = [
        "Genre" => ['movie_genre', 'id_movie']
    ];

    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
}
