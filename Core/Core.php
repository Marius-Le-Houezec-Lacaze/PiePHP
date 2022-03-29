<?php

namespace Core;

use Core\Request as Request;
use Core\Router as Router;

class Core
{

    /**
     * Run launch the application and instantiace the router ?
     */
    public function run(): void
    {
        require 'src/routes.php';

        $request = new Request();
        $cont  = Router::getRoute($_SERVER['REQUEST_URI']);

        if (!$cont) {
            echo '404';
            die();
        }

        extract($cont);

        require_once 'src/Controller/' . ${'Controller'} . 'Controller.php';

        $cont = new ${'Controller'}($request);



        $cont->$action();
    }
}
