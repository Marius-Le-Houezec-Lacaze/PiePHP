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
}
