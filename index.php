<?php
session_start();

define('PATH_DIR', 'http://localhost:8888/filmclub/');

require_once __DIR__.'/controller/Controller.php';
require_once __DIR__.'/library/RequirePage.php';
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/library/Twig.php';
require_once __DIR__.'/library/CheckSession.php';
require_once __DIR__.'/model/CRUD.php';
require_once __DIR__.'/model/Log.php';

// insert into Table log
$log = [];
if (isset($_SESSION['username']) && $_SESSION['username'] != '') 
    $log['nom'] = $_SESSION['username'];
else 
    $log['nom'] = 'Guest';

$log['ip'] = $_SERVER['REMOTE_ADDR'];
$log['url'] = $_SERVER['REQUEST_URI'];

$newLog = new Log;
$insert = $newLog->insert($log);

$url = isset($_SERVER['PATH_INFO'])? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';
// $url = isset($_GET["url"]) ? explode ('/', ltrim($_GET["url"], '/')) : '/';

if ($url == '/')
{
    require_once __DIR__.'/controller/ControllerHome.php';
    $controller = new ControllerHome;
    echo $controller->index(); 
}
// valide le controlleur
else
{
    $requestURL = $url[0];
    $requestURL = ucfirst($requestURL);
    $controllerPath = __DIR__."/controller/Controller".$requestURL.".php";
    // si le controlleur existe
    if(file_exists($controllerPath))
    {
        require_once( $controllerPath);
        $controllerName = 'Controller'.$requestURL;
        $controller = new $controllerName;
        // valide le méthode
        if (isset($url[1]) && $url[1] != '')
        {
            $method = $url[1];
        
            // si le méthode existe
            if (method_exists($controller, $method))
            {
                        
                // valide si il y a une valeur
                if(isset($url[2])) 
                {
                    $value = $url[2];
    
                    if ($value != '') echo $controller->$method($value);
                    else echo $controller->$method();
                }
                else 
                {
                    echo $controller->$method();
                }
            }
            else
            {
                require_once __DIR__.'/controller/ControllerHome.php';
                $controller = new ControllerHome;
                echo $controller->error('404'); 
            }
        }
        else 
        {
            echo $controller->index();
        }
    }
    else
    {
        require_once __DIR__.'/controller/ControllerHome.php';
        $controller = new ControllerHome;
        echo $controller->error('404'); 
    }
}

?>
