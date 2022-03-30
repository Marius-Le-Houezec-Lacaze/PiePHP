<?php
function my_autoloader($class)
{
    $part = explode('\\', $class);
    include end($part) . '.php';
}

spl_autoload_register('my_autoloader');
