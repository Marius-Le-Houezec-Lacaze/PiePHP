<?php

namespace Core;

/**
 * ## Declaring a new route
 *
 * To declare a simple new get route you can just do it in your src/routes.php file:
 * ```
 * Router::get('/hello', ['Controller' => 'Hello', 'action' => 'sayHello'] );
 * ```
 * The Core will then instanciate the Controller HelloController and call
 * the declared action sayHello on it, you can also declare dynamix route with the
 * :id notation
 *
 * @category Class
 * @author   Original Author <marius.le-houezec-lacaze@epitech.eu>
 * @license  Do whatever the hell you want with it license
 * @link     https://github.com/EpitechWebAcademiePromo2023/W-PHP-502-NAN-2-1-PiePHP-marius.le-houezec-lacaze
 */
class Router
{

    //list of post route
    private static $_post = [];
    //list of get route
    private static $_get = [];

    /**
     * Register a route that will both trigger
     * no matter if the request is POST or GET
     *
     * @param string $url        url must use :var notation for dynamic link variable
     * @param array  $controller array containing action and controller
     *
     * @return void
     */
    public static function connect(string $url, array $controller): void
    {
        $regex = self::_processRoute($url);


        self::$_post[$regex] = $controller;
        self::$_get[$regex] = $controller;
    }


    /**
     * Register a route that will only be triggered upon a matching GET request
     *
     * @param string $url        url must use /:var notation for dynamic variable
     * @param array  $controller array containing action and controller
     *
     * @return void
     */
    public static function get(string $url, array $controller): void
    {
        $regex = self::_processRoute($url);

        self::$_get[$regex] = $controller;
    }

    /**
     * Register a route that will only be triggered upon a matching POST request
     *
     * @param string $url        url must use /:var notation for dynamic variable
     * @param array  $controller array containing action and controller
     *
     * @return void
     */
    public static function post(string $url, array $controller): void
    {
        $regex = self::_processRoute($url);
        self::$_post[$regex] = $controller;
    }

    /**
     * Process declared route and output a matching regex using
     * it has key for the checkMatch()
     *
     * @param string $route route to be processed
     *
     * @return string
     */
    private static function _processRoute(string $route): string
    {
        $match_pattern = '/\\\:[a-zA-Z0-9\_\-]+/';
        $pattern = "@^" . preg_replace(
            $match_pattern,
            '([a-zA-Z0-9\-\_]+)',
            preg_quote($route)
        ) . "$@D";

        return $pattern;
    }

    /**
     * Check if the uri passed inside has been declared has a route
     * Return either a bool(false) or an assiociative array containing
     * matching controller its actions
     *
     * @param string $uri is the the current path to be checked
     *
     * @return false|array return either false or an associative array
     *  */
    public static function getRoute(string $uri): false|array
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            foreach (self::$_get as $pattern => $controller) {
                $match = self::_checkMatch($pattern, $uri);
                if ($match) {
                    return $controller;
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach (self::$_post as $pattern => $controller) {
                $match = self::_checkMatch($pattern, $uri);
                if ($match) {
                    return $controller;
                }
            }
        }

        return false;
    }

    /**
     * This function check if the passed pattern and uri match
     *
     * @param string $pattern is a string regex of the uri
     * @param string $uri     is the uri to be checked
     *
     * @return bool representing if the uri match or not
     */
    private static function _checkMatch(string $pattern, string $uri): bool
    {
        $value = [];
        if ($var = preg_match($pattern, $uri, $value)) {
            array_shift($value);
            Request::setParams($value);

            return true;
        }
        return false;
    }
}
