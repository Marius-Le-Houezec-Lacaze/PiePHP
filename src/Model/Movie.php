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


    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
}
