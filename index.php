<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoload.php';

$config = new \App\Service\Config();

$templating = new \App\Service\Templating();
$router = new \App\Service\Router();

$action = $_REQUEST['action'] ?? null;

$actionParams = explode("-", $action) ?: null;

switch($actionParams[0])
{
    case null:
    case 'public':
        // $controller = new \App\Controller\PublicController();
        switch($actionParams[1])
        {
            case 'login':
                // $view =
                break;
            case 'addLink':
                // $view =
                break;
            default:
                // $view =
                break;
        }
        break;
    case 'private':
        // $controller = new \App\Controller\PrivateController();
        switch($actionParams[1])
        {
            case 'home':
                // $view =
                break;
            case 'links':
                // $view =
                break;
            case 'mylinks':
                // $view =
                break;
            case 'addlink':
                // $view =
                break;
            case 'usersettings':
                // $view =
                break;
        }
        break;
    case 'admin-panel':
        // $controller = new \App\Controller\AdminController();
        // $view = controller->
        break;
    default:
        $view = "Not found!";
        break;

}
if ($view) {
    echo $view;
}