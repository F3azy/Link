<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Service\Router;
use App\Service\Templating;

class PublicController
{
    public function index(Templating $templating, Router $router): ?string
    {
        $html = $templating->Render('public/index.html.php', [
            'router' => $router
        ]);
        return $html;
    }
}