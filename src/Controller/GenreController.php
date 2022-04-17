<?php

namespace Controller;

use Core\Controller as Controller;

use Model\Genre as Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::getAll();

        $this->render('index', compact('genres'));
    }

    public function create()
    {
        $genre = new Genre($this->request->post());
        $genre->save();
    }

    public function delete($id)
    {
        $genre = Genre::get($id);

        $genre->delete();
        
    }


    public function edit_view($id)
    {
        $genre = Genre::get($id);
        
        $this->render('edit', compact('genre'));
    }
    public function edit($id)
    {
        $data = $this->request->post();
        
        $genre = Genre::get($id);

        $genre->setName($data['name']);

        $genre->save();
    }


    public function read($id)
    {
        $genre = Genre::get($id); 

        $movies = $genre->getRelation('Movie');

        $empty = $movies[0]->getId();
    
        $this->render('read', compact('movies', 'genre', 'empty'));
    }
}
