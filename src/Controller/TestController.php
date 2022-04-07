<?php

namespace Controller;

use Core\Database as Database;
use Core\ORM as ORM;
use Model\Distributor;
use Model\Movie;

class TestController extends \Core\Controller
{
    public function index($id)
    {
        $distributor = Distributor::get($id);
        $movies = $distributor->getRelation('Movie');

        $this->render('test', compact('movies', 'id'));
    }

    public function movie($id)
    {
        $movie = Movie::get($id);

        $distributor = $movie->getRelation('Distributor');

        $this->render('movie', compact('movie', 'distributor'));
    }
}
