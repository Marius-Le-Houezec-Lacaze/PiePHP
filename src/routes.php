<?php

use Core\Router as Router;



Router::get('/movies', ['Controller' => 'Test', 'action' => 'index']);
Router::get('/movie/:id', ['Controller' => 'Test', 'action' => 'movie']);
