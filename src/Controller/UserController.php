<?php

namespace Controller;

use Model\History;
use Model\Movie;
use Model\User;

class UserController extends \Core\Controller
{

    public function register_view()
    {
        $this->render('register');
    }

    public function register()
    {
        $user_data = $this->request->post();

        $user_data['password'] = $this->hashPassword($user_data['password']);

        $user = new \Model\User($user_data);

        if ($user->save()) {
            self::$_render = '<script>window.location = "/" </script>';
        }
    }


    public function login_view()
    {
        $this->render('login');
    }

    public function login()
    {
        $user_data = $this->request->post();

        $user = User::whereLike('name', $user_data['name']);

        if ($user) {
            if ($user->validatePassword($user_data['password'])) {
                $_SESSION['id'] = $user->getId();
            }
        }
        self::$_render = '<script>window.location = "/" </script>';
    }

    public function logout()
    {
        unset($_SESSION['id']);
        session_destroy();
    }

    public function profile()
    {
        $user = User::currentUser();
        $movies = $user->getHistory();

        $this->render('profile', compact('user', 'movies'));
    }


    public function profile_edit()
    {
        $user = User::currentUser();

        $this->render('edit', compact('user'));
    }


    public function edit()
    {
        $data = $this->request->post();
        $user = User::currentUser();

        $user->setBio($data['bio']);

        $user->setName($data['name']);

        $user->save();
    }


    public function delete()
    {
        $user = User::currentUser();

        if ($user->deleteRelation('History')) {
            $user->delete();
            session_destroy();
            self::$_render = '<script>window.location = "/" </script>';
        }
    }

    public function add_history($id)
    {
        $entry = new History([
            'id_movie' => $id,
            'id_user' => $_SESSION['id']
        ]);

        $entry->save();
        self::$_render = '<script>window.location = "/profile" </script>';
    }


    public function remove_history($id)
    {

        $entry = History::whereLike('id_movie', $id);

        if ($entry->delete()) {
            self::$_render = '<script>window.location = "/profile" </script>';
        }
    }

    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function test()
    {
        $counts = [1, 2, 3, 4, 5, 6];

        $records = ['billy', 'is', 'awesome'];

        $empty = '';

        $this->render('test', compact('counts', 'records', 'empty'));
    }
}
