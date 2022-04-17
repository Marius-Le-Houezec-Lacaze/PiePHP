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

        self::$_render = '<script>window.location = "/movies" </script>';
    }

    public function delete($id)
    {
        $movie = Movie::get($id);

        if ($movie->deleteRelation('History')) {
            $movie->delete();
        }

        self::$_render = '<script>window.location = "/movies" </script>';
    }

    public function page($id,)
    {
        $movie = Movie::get($id);

        $users = $movie->getRelation('User');
        $this->render('page', compact('movie', 'users'));
    }

    public function edit_view($id)
    {
        $movie = Movie::get($id);
        $genres = Genre::getAll();

        $this->render('edit', compact('movie', 'genres'));
    }


    public function edit($id)
    {
        $data = $this->request->post();

        $movie = Movie::get($id);

        $movie->setName($data['name']);
        $movie->setDescription($data['description']);
        $movie->setGenre(Genre::get($data['id_genre']));

        $movie->save();
        //var_dump($data);

        self::$_render = '<script>window.location = "/movie/' . $id . '" </script>';
    }
}
