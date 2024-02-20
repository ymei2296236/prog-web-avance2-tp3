<?php

RequirePage::model('CRUD');
RequirePage::model('Privilege');
RequirePage::model('Log');

class ControllerLog extends controller {

    public function __construct()
    {
        CheckSession::sessionAuth(FALSE);
        CheckSession::privilegeAuth();
    }

    public function index()
    {
        $log = new Log;
        $select = $log->select('id', 'DESC');

        return Twig::render('log/index.php', ['logs'=>$select, 'nbLogs' => count($select)]);    
    }

}
?>