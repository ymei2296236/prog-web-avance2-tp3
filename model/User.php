<?php

class User extends CRUD 
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'username', 'password', 'privilege_id'];

    public function checkUser($username, $password) {

        $sql = "SELECT * FROM $this->table WHERE username = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($username));
        $count = $stmt->rowCount();

        if($count === 1) {
            $salt = "!dL$*u";
            $passwordSalt = $password.$salt;
            $info_user = $stmt->fetch();

            if(password_verify($passwordSalt, $info_user['password']))
            {
                session_regenerate_id();
                $_SESSION['user_id'] = $info_user['id'];
                $_SESSION['username'] = $info_user['username'];
                $_SESSION['privilege'] = $info_user['privilege_id'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
                // to be decided
                $_SESSION['uri'] = $_SERVER['REQUEST_URI'];
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['httpUserAgent'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['time'] = date('Y-m-d H:i:s');

                RequirePage::url('role');
                exit();
            }
            else
            {
                $errors = "<ul><li>Verifiez le mot de passe</li></ul>";
                return $errors;
            }
        }
        else
        {
            $errors = "<ul><li>Verifiez le nom de l'utilisateur</li></ul>";
            return $errors;
        }
    }

}

?>