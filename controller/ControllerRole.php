<?php

RequirePage::model('CRUD');
RequirePage::model('Role');

class ControllerRole extends Controller {

    public function index() 
    {
        $role = new Role;
        $select = $role->roleActeurFilm();
        $vote = $role->checkVote($_SESSION['user_id']);

        return Twig::render('role/index.php', ['roles'=>$select,'vote'=> $vote]);
    }

    public function vote()
    {
        $data = explode('#', $_POST['role_id']);
        $role_film_id = $data[0];
        $role_acteur_id = $data[1];

        $vote = new Role;
        $insert = $vote->voteRole($role_film_id, $role_acteur_id, $_SESSION['user_id']);
        
        RequirePage::url('role');
    }

}


?>