<?php

namespace Core;

class Error
{
    /**
     * Display error message and kill the process to avoid caching
     * 
     * @param string $error is the error to be displayed 
     * 
     * @return void
     */
    static function templateError(string $error)
    {
        $message = $error;
        include './Core/internal/views/error/Template.php';
        die();
    }
}
