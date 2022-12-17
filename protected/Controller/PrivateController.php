<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Service\Router;
use App\Service\Templating;
use App\Model\Link;

// Kontroler do którego ma się dostęp TYLKO po zweryfikowaniu kim się jest
class PrivateController
{
    public function home(Templating $templating, Router $router): ?string
    {
        $html = $templating->Render('private/home.html.php', [
            'router' => $router
        ]);
        return $html;
    }

    public function links(Templating $templating, Router $router): ?string
    {
        $links = Link::findAll();
        $html = $templating->Render('private/links.html.php', [
            'router' => $router,
            'links' => $links
        ]);
        return $html;
    }
    
    public function myLinks(Templating $templating, Router $router): ?string
    {
        $html = $templating->Render('private/mylinks.html.php', [
            'router' => $router
        ]);
        return $html;
    }

    public function addLink(?array $requestLink, Templating $templating, Router $router): ?string
    {
        if ($requestLink) {
            $link = Link::fromArray($requestLink);
            // @todo missing validation
            $link->save();

            $path = $router->generatePath('private-index');
            $router->redirect($path);
            return null;
        } else {
            $link = new Link();
        }

        $html = $templating->Render('private/addlink.html.php', [
            'router' => $router
        ]);
        return $html;
    }
    
    public function userSettings(Templating $templating, Router $router): ?string
    {
        $html = $templating->Render('private/usersettings.html.php', [
            'router' => $router
        ]);
        return $html;
    }
    public function logOut(Templating $templating, Router $router): void {
        session_start();
        session_unset();
        session_destroy();
        header("location: ".$router->generatePath('public-login'));
    }
}