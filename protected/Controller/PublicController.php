<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Model\Link;
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

    public function addLink(?array $requestLink, Templating $templating, Router $router): ?string
    {
        if ($requestLink) {
            $link = Link::fromArray($requestLink);
            // @todo missing validation
            $link->save();

            $path = $router->generatePath('public-index');
            $router->redirect($path);
            return null;
        } else {
            $link = new Link();
        }

        $html = $templating->Render('public/addlink.html.php', [
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