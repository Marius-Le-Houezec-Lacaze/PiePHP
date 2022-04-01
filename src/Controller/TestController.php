<?php

namespace Controller;

class TestController extends \Core\Controller
{
    public function get($id)
    {
        //echo('here');
        $get = $this->request->get();

        $here = '$get->test';
        $array = [0, 1, 2, 3];

        //$db = Database::getInstance();
        //new PDO('mysql:host=127.0.0.1;dbname=cinema;charset=utf8', 'user', 'password');

        //write pdo

        //$movie = $db->prepare('SELECT title FROM movie');
        //$movie->execute();

        //$titles = $movie->fetchAll();

        $this->render('test', compact('here', 'id', 'array'));
        //echo ('get');
    }

    public function post()
    {
        echo ('post');
    }
}
