<?php

namespace Model;

class Distributor extends \Core\Entity
{

    protected int|null $id;

    protected string|null $name;
    protected string|null $phone;
    protected string|null $adress;
    protected string|null $zipcode;
    protected string|null $city;
    protected string|null $country;

    protected array $has_many = [
        'Movie' => 'id_distributor'
    ];


    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
