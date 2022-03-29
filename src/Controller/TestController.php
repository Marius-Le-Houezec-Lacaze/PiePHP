<?php

use \Core\Controller as Controller;

class Test extends Controller
{
    public function get()
    {
        $get = $this->request->get();

        $here = '$get->test';

        $this->render('test', compact('here'));
        //echo ('get');
    }

    public function post()
    {
        echo ('post');
    }
}
