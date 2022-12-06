<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Service\Router;
use App\Service\Templating;

// Kontroler do którego ma się dostęp TYLKO po zweryfikowaniu kim się jest
class PrivateController
{
    public function index(Templating $templating, Router $router): ?string
    {
        $html = $templating->Render('private/home.html.php', [
            'router' => $router
        ]);
        return $html;
    }

}