<?php

namespace Controller;

use Core\Database as Database;


class TestController extends \Core\Controller
{
    public function index()
    {

        $db = Database::getInstance();

        $movie = $db->prepare('SELECT title, id FROM movie');
        $movie->execute();

        $movies = $movie->fetchAll();

        $this->render('test', compact('movies'));
        //echo ('get');
    }

    public function movie($id)
    {
        $db = Database::getInstance();

        $movie = $db->prepare('SELECT * FROM movie WHERE id = :id LIMIT 1');
        $movie->execute(
            ['id' => $id]
        );

        $movie = $movie->fetch();

        $this->render('movie', compact('movie'));

    }
}
