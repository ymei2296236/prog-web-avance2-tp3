<?php

RequirePage::model('CRUD');
RequirePage::model('User');
RequirePage::library('Validation');

class ControllerLogin extends controller
{
    public function index()
    {
        Twig::render('auth/index.php');
    }

    public function auth()
    {
        $validation = new Validation;
        extract($_POST);
        $validation->name('Utilisateur')->value($username)->max(50)->required()->pattern('email');
        $validation->name('Mot de passe')->value($password)->max(20)->min(5);

        if(!$validation->isSuccess()) {
            $errors = $validation->displayErrors();
            return Twig::render('auth/index.php', ['errors'=>$errors, 'user'=>$_POST]);
            exit();
        }
        $user = new User;
        $checkUser = $user->checkUser($_POST['username'], $_POST['password']);

        Twig::render('auth/index.php', ['errors'=>$checkUser, 'user'=>$_POST]);    
    }

    public function logout()
    {
        session_destroy();
        RequirePage::url('login');
        exit();
    }
}