<?php

use Core\Router as Router;



Router::get('/distributor/:id', ['Controller' => 'Test', 'action' => 'index']);
Router::get('/movie/:id', ['Controller' => 'Test', 'action' => 'movie']);
