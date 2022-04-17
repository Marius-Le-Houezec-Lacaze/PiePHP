<?php

use Core\Router as Router;

//Router::Dynamic(true);

function status_auth()
{
    if (!isset($_SESSION['id'])) {
        return false;
    };

    return true;
}

Router::get('/test', ['Controller' => 'User', 'action' => 'test']);

if (status_auth()) {
    Router::get('/', ['Controller' => 'Movie', 'action' => 'index']);
    Router::get('/movies', ['Controller' => 'Movie', 'action' => 'index']);
    Router::get('/movie/:id', ['Controller' => 'Movie', 'action' => 'page']);

    Router::post('/logout', ['Controller' => 'User', 'action' => 'logout']);

    Router::post('/movie', ['Controller' => 'Movie', 'action' => 'create']);
    Router::post('/movie/delete/:id', ['Controller' => 'Movie', 'action' => 'delete']);
    Router::get('/movie/edit/:id', ['Controller' => 'Movie', 'action' => 'edit_view']);
    Router::post('/movie/edit/:id', ['Controller' => 'Movie', 'action' => 'edit']);

    Router::get('/genres', ['Controller' => 'Genre', 'action' => 'index']);
    Router::post('/genre', ['Controller' => 'Genre', 'action' => 'create']);
    Router::get('/genre/:id', ['Controller' => 'Genre', 'action' => 'read']);
    Router::post('/genre/delete/:id', ['Controller' => 'Genre', 'action' => 'delete']);
    Router::get('/genre/edit/:id', ['Controller' => 'Genre', 'action' => 'edit_view']);
    Router::post('/genre/edit/:id', ['Controller' => 'Genre', 'action' => 'edit']);


    Router::get('/profile', ['Controller' => 'User', 'action' => 'profile']);
    Router::get('/profile/edit', ['Controller' => 'User', 'action' => 'profile_edit']);
    Router::post('/profile/edit', ['Controller' => 'User', 'action' => 'edit']);
    Router::post('/profile/delete', ['Controller' => 'User', 'action' => 'delete']);

    Router::post('/history/add/:id', ['Controller' => 'User', 'action' => 'add_history']);
    Router::post('/history/delete/:id', ['Controller' => 'User', 'action' => 'remove_history']);
}


if (!status_auth()) {
    Router::get('/', ['Controller' => 'User', 'action' => 'login_view']);
    Router::get('/register', ['Controller' => 'User', 'action' => 'register_view']);
    Router::post('/register', ['Controller' => 'User', 'action' => 'register']);

    Router::get('/login', ['Controller' => 'User', 'action' => 'login_view']);
    Router::post('/login', ['Controller' => 'User', 'action' => 'login']);
}

// Router::get('/distributor/list', ['Controller' => 'Test', 'action' => 'list_distributor']);
// Router::get('/distributor/:id', ['Controller' => 'Test', 'action' => 'index']);
// Router::get('/movie/:id', ['Controller' => 'Test', 'action' => 'movie']);

// Router::get('/genres', ['Controller' => 'Test', 'action' => 'genres']);
// Router::get('/genre/:id', ['Controller' => 'Test', 'action' => 'genre']);
