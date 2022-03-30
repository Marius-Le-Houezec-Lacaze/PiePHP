<?php

use \Core\Controller as Controller;
use Core\Database;

class Test extends Controller
{
    public function get($id)
    {
        $get = $this->request->get();

        $here = '$get->test';

        $db = Database::getInstance();
        //new PDO('mysql:host=127.0.0.1;dbname=cinema;charset=utf8', 'user', 'password');

        //write pdo

        $movie = $db->prepare('SELECT title FROM movie');
        $movie->execute();

        $titles = $movie->fetchAll();

        $this->render('test', compact('here', 'id'));
        //echo ('get');
    }

    public function post()
    {
        echo ('post');
    }
}
