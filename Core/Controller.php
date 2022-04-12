<?php

namespace Core;

use Core\Request as Request;
use Core\TemplateEngine as TemplateEngine;

/**
 * Controller class, all user defined controller
 * have to extend this class, is abstract so user
 * cannot and should not instanciate it .
 *
 * @category Class
 * @author   Original Author <marius.le-houezec-lacaze@epitech.eu>
 * @license  Do whatever the hell you want with it license
 * @link     https://github.com/EpitechWebAcademiePromo2023/W-PHP-502-NAN-2-1-PiePHP-marius.le-houezec-lacaze
 */
abstract class Controller
{

    /**
     * $_render static variable that contain the renderer template
     */
    static $_render;


    /**
     * $request is the variable containing $_post,$_get,$_json, data
     */

    protected $request;

    /**
     * Instanciate the request element for it
     * to be avalaible inside user declared controller
     */
    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * Send the variable contained in $scope to $view
     * and set generated content inside $_render;
     *
     * @param string $view  the name of the view to be rendered
     * @param array  $scope the array containing variable name and their value
     *
     * @return void
     */
    protected function render(string $view, array $scope = []): void
    {
        extract($scope);
        $folder = substr(str_replace(
            'Controller',
            '',
            basename(get_class($this))
        ), 1);

        $f = implode(
            DIRECTORY_SEPARATOR,
            [
                dirname(__DIR__),
                'src',
                'View',
                $folder,
                $view
            ]
        ) . '.php';

        if (file_exists($f)) {
            ob_start();
            $template = new TemplateEngine($f);

            $r = $template->getTemplatePath();

            include $r;
            $view = ob_get_clean();
            ob_start();

            include implode(
                DIRECTORY_SEPARATOR,
                [dirname(__DIR__), 'src', 'View', 'index']
            ) . '.php';

            self::$_render = ob_get_clean();
        }
    }

    /**
     * Render the passed view  inside index uppon controller destruction
     *
     * @return void
     */
    function __destruct()
    {
        echo (self::$_render);
    }
}
