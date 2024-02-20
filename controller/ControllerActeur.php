<?php
RequirePage::model('CRUD');
RequirePage::model('Acteur');

class ControllerActeur extends Controller {

    public function index() {
        $acteur = new Acteur;
        $select = $acteur->select();

        return Twig::render('acteur/index.php', ['acteurs'=> $select]);
    }
}



?>