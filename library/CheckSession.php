<?php

class CheckSession {

    static public function sessionAuth()
    {
        if(isset($_SESSION['fingerPrint']) && $_SESSION['fingerPrint'] === md5($_SESSION['HTTP_USER_AGENT'].$_SESSION['REMOTE_ADDR']))
        {
            return true;
        }
        else
        {
            RequirePage::url('login');
            exit();
        }
    }
}