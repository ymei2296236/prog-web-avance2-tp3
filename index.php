<?php
session_start();

define('PATH_DIR', 'http://localhost:8888/prog-web-avance2-tp3/');
// define('PATH_DIR', 'https://e2296236.webdev.cmaisonneuve.qc.ca/tp-03/');
require_once __DIR__.'/controller/Controller.php';
require_once __DIR__.'/library/RequirePage.php';
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/library/Twig.php';
require_once __DIR__.'/library/CheckSession.php';

$url = isset($_SERVER['PATH_INFO'])? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';
// $url = isset($_GET["url"]) ? explode ('/', ltrim($_GET["url"], '/')) : '/';

if ($url == '/')
{
    require_once __DIR__.'/controller/ControllerHome.php';
    $controller = new ControllerHome;
    echo $controller->index(); 
}
else
{
    $requestURL = $url[0];
    $requestURL = ucfirst($requestURL);
    $controllerPath = __DIR__."/controller/Controller".$requestURL.".php";

    if(file_exists($controllerPath))
    {
        require_once( $controllerPath);
        $controllerName = 'Controller'.$requestURL;
        $controller = new $controllerName;

        if (isset($url[1]) && $url[1] != '')
        {
            $method = $url[1];

            if (method_exists($controller, $method))
            {
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
