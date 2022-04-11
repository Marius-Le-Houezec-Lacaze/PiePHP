<?php


namespace Controller;

use Core\Controller as Controller;
use Model\Genre as Genre;
use Model\Movie as Movie;


class MovieController extends Controller
{
    public function index()
    {
        $genres = Genre::getAll();
        $movies = Movie::getAll();

        $this->render('index', compact('genres', 'movies'));
    }

    public function create()
    {
        $movie = new Movie($this->request->post());

        $movie->save();
    }

    public function delete($id)
    {
        $movie = Movie::get($id);

        $movie->delete();
    }
}
