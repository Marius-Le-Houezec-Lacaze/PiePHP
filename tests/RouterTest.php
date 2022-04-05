<?php
require 'Core/Router.php';
require 'Core/Request.php';

class RouterTest extends PHPUnit\Framework\TestCase
{

    /**
     * Assert that get route work and properly output an 
     * action and a controller for the Core to instanciate
     */
    public function testRouterGetMethod(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';

        Core\Router::get('/true', ['Controller' => 'True', 'action' => 'truthy']);
        Core\Router::post('/post', ['Controller' => 'True', 'action' => 'truthy']);


        $holla = Core\Router::getRoute('/true');
        $false = Core\Router::getRoute('/false');
        $post = Core\Router::getRoute('/post');



        $this->assertIsArray($holla, 'Is true has expected');
        $this->assertFalse($false, 'Is false has expected');
        $this->assertFalse($post, 'Route post is innacessible using GET');
    }

    /**
     * Assert that get route work and properly output an 
     * action and a controller for the Core to instanciate
     */
    public function testRouterPostMethod(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Core\Router::get('/true', ['Controller' => 'True', 'action' => 'truthy']);
        Core\Router::post('/post', ['Controller' => 'True', 'action' => 'truthy']);


        $holla = Core\Router::getRoute('/true');
        $false = Core\Router::getRoute('/false');
        $post = Core\Router::getRoute('/post');

        $this->assertFalse($holla, 'Not accessible using post method');
        $this->assertFalse($false, 'Should be false since 404');
        $this->assertIsArray($post, 'Is an array and post');
    }
}
