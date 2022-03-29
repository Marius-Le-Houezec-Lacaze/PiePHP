<?php

namespace Core;

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
     * Pass the request Object to the controller
     * 
     * @param Request $request Request object 
     */
    public function __construct(
        private Request $request,
    ) {
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
        $f = implode(
            DIRECTORY_SEPARATOR,
            [
                dirname(__DIR__),
                'src',
                'View',
                str_replace(
                    'Controller',
                    '',
                    basename(get_class($this))
                ), $view
            ]
        ) . '.php';

        if (file_exists($f)) {
            ob_start();
            include $f;
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
     * Render the view uppon controller destruction
     * 
     * @return void
     */
    function __destruct()
    {
        echo (self::$_render);
    }
}
