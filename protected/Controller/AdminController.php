<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Service\Router;
use App\Service\Templating;

// Kontroler do którego ma się dostęp TYLKO po zweryfikowaniu kim się jest
class AdminController
{
    public function index(Templating $templating, Router $router): ?string
    {
        $html = $templating->Render('admin/index.html.php', [
            'router' => $router
        ]);
        return $html;
    }
}