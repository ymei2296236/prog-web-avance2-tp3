<?php

class CheckSession {

    // valide la session
    static public function sessionAuth($status)
    {        
        // empêche un logout non voulu
        if ($status == TRUE)
        {
            if(isset($_SESSION['fingerPrint']) && $_SESSION['fingerPrint'] === md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']))
                RequirePage::url('home');
            else
                return true;
        }
        // impose un login
        else
        {
            if(isset($_SESSION['fingerPrint']) && $_SESSION['fingerPrint'] === md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']))
                return true;
            else
                RequirePage::url('login');
        }
    }

    // valide si l'usager connecté a le privilège de l'Admin
    static public function privilegeAuth()
    {
        if($_SESSION['privilege'] == 1) 
            return true;
        else
            RequirePage::url('home');
    }
}

?>

