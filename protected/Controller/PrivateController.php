<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Service\Router;
use App\Service\Templating;

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
        $html = $templating->Render('private/links.html.php', [
            'router' => $router
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

    public function addLink(Templating $templating, Router $router): ?string
    {
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
}