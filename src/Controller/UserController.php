<?php

namespace Controller;

use Model\History;
use Model\Movie;
use Model\User;

class UserController extends \Core\Controller
{

    public function register_view()
    {
        $res = Movie::get(10);

        $genre = $res->getRelation('Genre');
        
        
        //var_dump($genre->getRelation('Movie'));
        
        //header('Content-Type: application/json; charset=utf-8');
        //self::$_render = json_encode(Movie::getAll());
        $this->render('register');
    }
    public function register()
    {
        $user = new \Model\User($this->request->post());

        $user->save();
    }
}
