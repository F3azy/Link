<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Service\Router;
use App\Service\Templating;
use App\Model\User;
use App\Model\Link;

// Kontroler do którego ma się dostęp TYLKO po zweryfikowaniu kim się jest
class AdminController
{
    public function index(Templating $templating, Router $router): ?string
    {
        $users = User::findAll();
        $links = Link::findAll();
        $html = $templating->Render('admin/index.html.php', [
            'router' => $router
        ]);
        return $html;
    }
}