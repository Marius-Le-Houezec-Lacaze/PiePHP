<?php

use Core\Router as Router;



Router::connect('/echo/:id/:test', ['Controller' => 'Test', 'action' => 'get']);
//Router::post('/echo', ['Controller' => 'Test', 'action' => 'post']);
