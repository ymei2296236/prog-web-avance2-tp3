<?php

RequirePage::model('CRUD');
RequirePage::model('Role');

class ControllerRole extends Controller {

    public function index() 
    {
        $role = new Role;
        $select = $role->roleActeurFilm();

        return Twig::render('role/index.php', ['roles'=> $select]);
    }

    public function vote()
    {
        $data = explode('#', $_POST['role_id']);
        $role_film_id = $data[0];
        $role_acteur_id = $data[1];

        $vote = new Role;
        $insert = $vote->voteRole($data[0], $data[1], $user_id);
        // RequirePage::url('film/show/'.$insert);
    }

}


?>