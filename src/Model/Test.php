<?php

namespace Model;

class Test extends \Core\Entity
{
    #[\Type\IntType(null: false)]
    protected $id_user;

    #[\Type\IntType(null: false)]
    protected $id_movie;

    #[\Type\IntType(null: false)]
    protected $id_history;


    #[\Type\StringType(null: false, lenght:200)]
    protected $name;

    protected $has_one = [
        'User' => 'id_user',
        'Movie' => 'id_movie',
        'History' => 'id_history',
    ];
}
