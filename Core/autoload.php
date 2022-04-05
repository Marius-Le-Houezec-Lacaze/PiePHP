<?php

/**
 * Auto loader for Controller Core and Model
 *
 * @param string $class name of the class to be loaded
 */
function my_autoloader(string $class)
{
    $part = explode('\\', $class);

    if ($part[0] == 'Core') {
        include implode(DIRECTORY_SEPARATOR, ['Core', end($part) . '.php']);
    }

    if ($part[0] == 'Controller') {
        include implode(DIRECTORY_SEPARATOR, ['src', 'Controller', end($part) . '.php']);
    }

    if ($part[0] == 'Model') {
        include implode(DIRECTORY_SEPARATOR, ['src', 'Model', end($part) . '.php']);
    }
}

spl_autoload_register('my_autoloader');
