<?php

namespace Model;

class History extends \Core\Entity
{

    #[\Type\IntType(null: false, auto_increment: true, primary_key: true)]
    protected $id;

    #[\Type\IntType(null: false)]
    protected $id_movie;

    #[\Type\IntType(null: false)]
    protected $id_user;

    protected $has_one = [
        'Movie' => 'id_movie',
        'User' => 'id_user'
    ];
}
