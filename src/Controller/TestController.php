<?php

use \Core\Controller as Controller;

class Test extends Controller
{
    public function get($id)
    {
        $get = $this->request->get();

        $here = '$get->test';

        var_dump($id);

        $this->render('test', compact('here'));
        //echo ('get');
    }

    public function post()
    {
        echo ('post');
    }
}
