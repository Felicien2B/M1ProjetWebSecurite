<?php 
//ce fichier est le routeur de notre app

// we generate a constant that defines the path to index.php
define('ROOT',str_replace("index.php", "",$_SERVER['SCRIPT_FILENAME']));
//separate the params
//get params in array params to redirect to the corresponding controller
$params = explode("/",$_GET['p']);


//grab the main controller and model classes
require_once(ROOT.'app/Controller.php');
require_once(ROOT.'app/Model.php');
if($params[0] != "")
{
    $controller = ucfirst($params[0]);
    //verify if the controller exists 
    if(!file_exists(ROOT.'controllers/'.$controller.'.php'))
    {
        //if controller doesn't exist
        http_response_code(404);
        echo "the requested URL is not defined !";
    }
    else
    {
        //the controller class exists
        //we grab the second param if it exists
        //if not existing we go to index
        $action = isset($params[1]) ? $params[1] : 'index';

        //grab the controller file
        require_once(ROOT.'controllers/'.$controller.'.php');

        //instantiate the controller
        $controller = new $controller();

        //verify if the $action exists in the controller
        if(method_exists($controller,$action))
        {
            //verify if there's a third param in the URL
            if(isset($params[2]))
            {
                $controller->$action($params[2]);
            }
            else
            {
                $controller->$action();
            }
        }
        else
        {
            http_response_code(404);
            echo "the target URL does not exist !";
        }

    }


}
else
//if no param is prensent in the URL
{
    $controller = "Auth";
    //grab the controller file
    require_once(ROOT.'controllers/'.$controller.'.php');

    //instantiate the controller
    $controller = new $controller();
    $controller->index();
}

?>
