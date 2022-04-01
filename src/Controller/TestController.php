<?php

namespace Controller;

use Core\Database as Database;
use Core\ORM as ORM;


class TestController extends \Core\Controller
{
    public function index()
    {

        $orm = new ORM();

        $movies = $orm
            ->from('movie')
            ->select('title', 'id', 'duration')
            ->query();

        $this->render('test', compact('movies'));
    }

    public function movie($id)
    {
        $orm = new ORM();

        $movie = $orm
            ->from('movie')
            ->select('duration', 'id', 'title', 'director')
            ->where('id', $id)
            ->query();

        $this->render('movie', compact('movie'));
    }
}
