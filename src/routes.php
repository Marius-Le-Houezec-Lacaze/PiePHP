<?php

use Core\Router as Router;


Router::get('/movies', ['Controller' => 'Movie', 'action' => 'index']);
Router::post('/movie', ['Controller' => 'Movie', 'action' => 'create']);
Router::post('/movie/delete/:id', ['Controller' => 'Movie', 'action' => 'delete']);

Router::get('/genres', ['Controller' => 'Genre', 'action' => 'index']);
Router::get('/genre/:id', ['Controller' => 'Genre', 'action' => 'page']);

Router::get('/register', ['Controller' => 'User', 'action' => 'register_view']);
Router::post('/register', ['Controller' => 'User', 'action' => 'register']);



// Router::get('/distributor/list', ['Controller' => 'Test', 'action' => 'list_distributor']);
// Router::get('/distributor/:id', ['Controller' => 'Test', 'action' => 'index']);
// Router::get('/movie/:id', ['Controller' => 'Test', 'action' => 'movie']);

// Router::get('/genres', ['Controller' => 'Test', 'action' => 'genres']);
// Router::get('/genre/:id', ['Controller' => 'Test', 'action' => 'genre']);
