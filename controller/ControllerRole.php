<?php

RequirePage::model('CRUD');
RequirePage::model('Role');
RequirePage::model('User');

class ControllerRole extends Controller {

    public function index() 
    {
        $role = new Role;
        $select = $role->roleActeurFilm();

        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') 
        {
            $user = new User;
            $selectUser = $user->checkVote($_SESSION['user_id']);

            if($selectUser['role_id']) $vote = $selectUser['role_id'];
            else $vote = 0;

        }
        return Twig::render('role/index.php', ['roles'=>$select,'vote'=> $vote]);
    }

}


?>