<?php

namespace Controller;

use Core\Database as Database;
use Core\ORM as ORM;
use Model\Distributor;
use Model\Genre;
use Model\Movie;
use Model\Movie_genre;

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

        $genre = $movie->getRelation('Genre');

        $distributor = $movie->getRelation('Distributor');


        var_dump(count($genre[0]->getRelation('Movie')));
        $this->render('movie', compact('movie', 'distributor', 'genre'));
    }

    public function genres()
    {
        $genres = Genre::getAll();

        $this->render('genres', compact('genres'));
    }

    public function genre($id)
    {
        $genre = Genre::get($id);
        $movies = $genre->getRelation('Movie');

        $this->render('genre', compact('genre', 'movies'));
    }

    public function list_distributor()
    {
        $distributors = Distributor::getAll();

        $this->render('distributor', compact('distributors'));
    }
}
