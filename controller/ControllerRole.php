<?php

RequirePage::model('CRUD');
RequirePage::model('Role');
RequirePage::model('User');

class ControllerRole extends Controller {

    public function index() 
    {
        $role = new Role;
        $vote = $role->countVote();
        $roles = $role->select();
        $voteRole = 0;

        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') 
        {
            $user = new User;
            $selectUser = $user->checkVote($_SESSION['user_id']);

            if($selectUser['role_id']) $voteRole = $selectUser['role_id'];
        }

        return Twig::render('role/index.php', ['votes'=> $vote, 'roles' => $roles, 'voteRole' => $voteRole]);
    }

}


?>