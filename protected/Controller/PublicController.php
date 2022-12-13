<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Service\Router;
use App\Service\Templating;

// Kontroler publiczny
class PublicController
{
    public function index(Templating $templating, Router $router): ?string
    {
        $html = $templating->Render('public/index.html.php', [
            'router' => $router
        ]);
        return $html;
    }

    public function addLink(Templating $templating, Router $router): ?string
    {
        $html = $templating->Render('public/addLink.html.php', [
            'router' => $router
        ]);
        return $html;
    }

    public function login(Templating $templating, Router $router): ?string
    {
        $html = $templating->Render('public/login.html.php', [
            'router' => $router
        ]);
        return $html;
    }
}