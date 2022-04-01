<?php
function my_autoloader($class)
{
    //var_dump($class);
    $part = explode('\\', $class);
    if ($part[0] == 'Core') {
        include './Core/' . end($part) . '.php';
    }

    if ($part[0] == 'Controller') {
        include './src/Controller/' . end($part) . '.php';
    }
}

spl_autoload_register('my_autoloader');
