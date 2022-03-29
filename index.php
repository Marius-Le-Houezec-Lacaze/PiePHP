<?php

define('BASE_URI', str_replace('\\', '/', substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']))));
define('METHOD', $_SERVER['REQUEST_METHOD']);
require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));
$app = new Core\Core();
$app->run();
