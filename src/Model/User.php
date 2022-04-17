<?php

namespace Model;

class User extends \Core\Entity
{
    #[\Type\IntType(null: false, auto_increment: true, primary_key: true)]
    protected $id;

    #[\Type\StringType(128, null: false)]
    protected $name;

    #[\Type\StringType(null: false)]
    protected $password;

    #[\Type\StringType(null: true)]
    protected $bio;

    protected $has_many_trough = [
        "Movie" => ["history", "id_user"]
    ];


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function getHistory()
    {
        return $this->getRelation('Movie');
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function validatePassword($pass)
    {
        return password_verify($pass, $this->password);
    }

    public static function currentUser()
    {
        return User::get($_SESSION['id']);
    }
}
