<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoload.php';

$config = new \App\Service\Config();

$templating = new \App\Service\Templating();
$router = new \App\Service\Router();

$action = $_REQUEST['action'] ?? null;
if($action != null)
    $actionParams = explode("-", $action) ?: null;
else
{
    $actionParams = [];
    $actionParams[0] = null;
    $actionParams[1] = null;
}

switch($actionParams[0])
{
    case null:
    case 'public':
        $controller = new \App\Controller\PublicController();
        switch($actionParams[1])
        {
            case 'login':
                $view = $controller->login($templating, $router);
                break;
            case 'addLink':
                $view = $controller->addLink($templating, $router);
                break;
            default:
                $view = $controller->index($templating, $router);
                break;
        }
        break;
    case 'private':
        $controller = new \App\Controller\PrivateController();
        switch($actionParams[1])
        {
            case 'home':
                $view = $controller->home($templating, $router);
                break;
            case 'links':
                $view = $controller->links($templating, $router);
                break;
            case 'mylinks':
                $view = $controller->myLinks($templating, $router);
                break;
            case 'addlink':
                $view = $controller->addLink($templating, $router);
                break;
            case 'usersettings':
                $view = $controller->userSettings($templating, $router);
                break;
        }
        break;
    case 'admin':
        $controller = new \App\Controller\AdminController();
        switch($actionParams[1])
        {
            case 'edit':
                $view = $controller->edit($router);
                break;
            case 'delete':
                $view = $controller->delete($router);
                break;
            default:
                $view = $controller->index($templating, $router);
                break;
        }
        break;
    default:
        $view = "Not found!";
        break;

}
if ($view) {
    echo $view;
}
