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

    protected $has_many_trough = [
        "Movie" => ["history", "id_user"]
    ];
}
