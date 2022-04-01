<?php

namespace Core;

/**
 * The job of this Class is to parse incoming blade's like template
 * and output them to clean html in '.cache'
 */
class TemplateEngine
{
    /**
     * MD5 signature of incoming template file
     */
    private string $_signature;

    /**
     * Content of the template file
     */
    private string $_content;

    /**
     * Containing file path
     */
    private string $_cache_path;


    /**
     * Contain instruction for _special end statement
     */
    private array $_special = ['endempty' => 'endif', 'endisset' => 'endif'];

    /**
     * Assign the variable and hash the md5 of the file for verification
     * uppon rechecking
     *
     * @return string $path path of the template to be processed
     */
    public function __construct(
        private string $path
    ) {
        $this->_signature = md5_file($path);
        $this->_content = file_get_contents($path);
        $this->_cache_path = implode(
            DIRECTORY_SEPARATOR,
            [
                ".cache",
                $this->_signature . ".php",
            ]
        );
    }

    /**
     * Parse the the file passed in constructor
     * to replace blade's statement with plain php statement
     *
     * @return int|false
     */
    private function _parseFile(): int|false
    {
        $pattern = "/@(.*)\((.*)\)/";
        $end = "/@(.*)/";
        $echo = "/{{(.*)}}/";

        /// {{ }}
        $this->_content = preg_replace_callback(
            $echo,
            "self::_echo",
            $this->_content
        );
        // if( ... )
        $this->_content = preg_replace_callback(
            $pattern,
            "self::_evalPattern",
            $this->_content
        );
        //@endif
        $this->_content = preg_replace_callback(
            $end,
            "self::_end",
            $this->_content
        );

        return file_put_contents($this->_cache_path, $this->_content);
    }

    /**
     * Check if the template asked is not already cached, if so return it.
     * If the template is not already cached call,
     * self::parse_file() and process the template first.
     *
     * @return string the path of the cached template
     */
    public function getTemplatePath(): string
    {
        if (!is_file($this->_cache_path)) {
            $this->_parseFile();
        }

        return $this->_cache_path;
    }

    /**
     * Function to evaluate incoming action and call
     * appriopriate action handler (_if, _foreach,_isset ect...)
     *
     * @param array $match contain all the match by the preg_replace
     *
     * @return string string returned by the action handler returned here
     */
    private function _evalPattern(array $match): string
    {
        [$full, $action, $eval] = $match;

        return $this->{"_" . trim($action)}($eval);
    }

    /**
     * Replace @if with actual if statement for templating
     *
     * @param string $eval evaluation to put in if statement for templating
     *
     * @return string
     */
    private function _if(string $eval): string
    {
        return "<? if ($eval):?>";
    }

    /**
     * Replace @foreach with actual foreach statement for templating
     * 
     * @param string $eval evaluation to be put in foreach statement
     * 
     * @return string
     */
    private function _foreach(string $eval): string
    {
        return "<? foreach($eval):?>";
    }

    /**
     * Replace @end(action) with appropiate terminal in if/else/foreach ect..
     *
     * @param array $match the array containing action to be appended on @end
     *
     * @return string
     */
    private function _end(array $match): string
    {
        [$full, $action] = $match;

        if (isset($this->_special[$action])) {
            $action = $this->_special[$action];
        }

        return "<? $action;?>";
    }

    /**
     * Replace @empty(action) with appropriate php statement
     * 
     * @param string $eval evaluation to be puit in the php statement
     * 
     * @return string
     */
    private function _empty(string $eval): string
    {
        return "<? if(empty($eval)):?>";
    }


    /**
     * Replace @isset(action) with appropriate php statement
     * 
     * @param string $eval evaluation to be puit in the php statement
     * 
     * @return string
     */
    private function _isset(string $eval): string
    {
        return "<? if(isset($eval)):?>";
    }

    /**
     *  Function called by preg_replace_callback #1 to replace {{ $var }}
     *  with <?= htmlentities($var) ?> during templating
     *
     * @param array $val the name of the variable matche by preg_replace
     *
     * @return string
     */
    private function _echo(array $val): string
    {
        return "<?= htmlentities($val[1]) ?>";
    }

    /**
     * Handle when an unknown template action is called 
     * and display an error message, also avoid the template to be cached
     * 
     * @param string $name      the name of the unknow function called
     * @param array  $arguments the arguments sent to the unknow function
     * 
     * @return void
     */
    public function __call(string $name, array $arguments)
    {
        Error::templateError("Fatal templating error unknown argument $name");
    }
}
