<?php

namespace Core;

use stdClass;

class Request
{

    /**
     * StdClass containing all $_GET information sanitized
     */
    private $_get;

    /**
     * StdClass containing all $_POST information sanitized
     */
    private $_post;

    /**
     * Array containing params value
     */
    private static $_params = [];

    /**
     * Parse and popuplate both $_get and $_post
     *
     * @return void
     */
    public function __construct()
    {
        $this->_get = new stdClass();


        foreach ($_GET as $key => $value) {
            $this->_get[$key] = $this->_secureInput($value);
        }

        foreach ($_POST as $key => $value) {
            $this->_post[$key] = $this->_secureInput($value);
        }
    }


    /**
     * Getter for $_get
     *
     * @return stdClass
     */
    public function get(): stdClass
    {
        return $this->_get;
    }

    /**
     * Getter for $_post
     *
     * @return stdClass
     */
    public function post(): array
    {
        return $this->_post;
    }


    /**
     * Getter for url params
     *
     * @return array
     */
    public static function params(): array
    {
        return self::$_params;
    }

    /**
     * Used to set the $_param value inside Core/Route
     *
     * @param array $params Array containing all inline url value
     *
     * @return void
     */
    public static function setParams(array $params): void
    {
        self::$_params = $params;
    }

    /**
     * Take the passed paramet $input and make it safe to display in html
     * trim, escape character, ect..
     *
     * @param string $input the input variable that need to be secure
     *
     * @return string
     */
    private function _secureInput(string $input): string
    {
        $escaped = stripslashes(trim(htmlentities($input)));
        return $escaped;
    }
}
