<?php

use \Core\Controller as Controller;

class Test extends Controller
{
    public function get()
    {
        $here = 'laurent le moche';

        $this->render('test', compact('here'));
        //echo ('get');
    }

    public function post()
    {
        echo ('post');
    }
}
