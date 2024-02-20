<?php

RequirePage::model('CRUD');
RequirePage::model('Privilege');
RequirePage::model('User');
RequirePage::library('Validation');

class ControllerUser extends controller 
{
    public function __construct()
    {
        CheckSession::sessionAuth(FALSE);
    }

    public function index()
    {
        CheckSession::privilegeAuth();

        $user = new User;
        $select = $user->select('username');

        $privilege = new Privilege;
        $i=0;

        // ajoute le nom de privilège au $select
        foreach($select as $user){
             $selectId = $privilege->selectId($user['privilege_id']);
             $select[$i]['privilege']= $selectId['privilege'];
             $i++;
        }
        return Twig::render('user/index.php', ['users'=>$select]);    
    }

    public function create() 
    {
        CheckSession::privilegeAuth();

        $privilege = new Privilege;
        $select = $privilege->select('privilege');

        return Twig::render('user/create.php', ['privileges'=> $select]);
    }

    public function store()
    {
        CheckSession::privilegeAuth();
        
        $validation = new Validation;
        extract($_POST);

        $validation->name('Utilisateur')->value($username)->max(50)->required()->pattern('email');
        $validation->name('Mot de passe')->value($password)->max(20)->min(5);
        $validation->name('Privilège')->value($privilege_id)->required();
        
        if(!$validation->isSuccess()) 
        {
            $errors = $validation->displayErrors();
            $privilege = new Privilege;
            $select = $privilege->select('privilege');
            
            return Twig::render('user/create.php', ['errors'=>$errors, 'privileges'=> $select, 'user'=>$_POST]);
            exit();
        }
        $user = new User;
        $options = ['cost' => 10];
        $salt = "!dL$*u";
        $passwordSalt = $_POST['password'].$salt;
        $_POST['password'] = password_hash($passwordSalt, PASSWORD_BCRYPT, $options);

        $insert = $user->insert($_POST);

        RequirePage::url('user');
    }
    
    // un usager vote pour son rôle favori, an ajoutant l'id du rôle dans le tableau de User
    public function vote()
    {
        $vote = new User;
        $update = $vote->voteRole($_POST['role_id'], $_SESSION['user_id']);
        
        RequirePage::url('role');
    }

}


?>