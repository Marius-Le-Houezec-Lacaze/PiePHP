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

    protected $has_one = [
        'User' => 'id_user',
        'Movie' => 'id_movie',
        'History' => 'id_history',
    ];
}
