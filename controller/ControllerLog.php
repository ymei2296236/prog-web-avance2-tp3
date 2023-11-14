<?php

RequirePage::model('CRUD');
RequirePage::model('Privilege');
RequirePage::model('Log');

class ControllerLog extends controller {

    public function __construct(){
        CheckSession::sessionAuth();
        if($_SESSION['privilege'] != 1) {
            RequirePage::url('home');
            exit();
        }
    }

    public function index(){
        $log = new Log;
        $select = $log->select();

        return Twig::render('log/index.php', ['logs'=>$select, 'nbLogs' => count($select)]);    

    }

}
?>