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
            'users' => $users,
            'links' => $links,
            'router' => $router
        ]);
        return $html;
    }
    public function edit(Router $router)
    {
        $data = explode("|", $_COOKIE["changeData"]);
        $model = $data[0];
        $index = (int) $data[1];
        $variable = $data[2];
        $value = $data[3];
        if($model == "user")
            $myModel = User::find($index);
        else if($model == "link")
            $myModel = Link::find($index);
        else
            $myModel = null;
        if($myModel != null)
        {
            switch($variable)
            {
                case 'userId':
                    $myModel->setUserID($value);
                    break;
                case 'userName':
                    $myModel->setUserName($value);
                    break;
                case 'userId':
                    $myModel->setUserPasswd($value);
                    break;
                case 'role':
                    $myModel->setRole($value);
                    break;
                case 'linkId':
                    $myModel->setLinkID($value);
                    break;
                case 'ogVersion':
                    $myModel->setOgVersion($value);
                    break;
                case 'shortVersion':
                    $myModel->setShortVersion($value);
                    break;
                case 'linkPasswd':
                    $myModel->setLinkPasswd($value);
                    break;
                case 'createDate':
                    $myModel->setCreateDate($value);
                    break;
                case 'editDate':
                    $myModel->setEditDateDate($value);
                    break;
                case 'lastVisitDate':
                    $myModel->setLastVisitDate($value);
                    break;
                case 'numOfVisits':
                    $myModel->setNumOfVisits($value);
                    break;
                case 'lifeTime':
                    $myModel->setLifetime($value);
                    break;
            }
            $myModel->save();
        }
        $path = $router->generatePath('admin-index');
        $router->redirect($path);
    }
    public function delete(Router $router)
    {
        $data = explode("|", $_COOKIE["deleteData"]);
        $model = $data[0];
        $index = (int) $data[1];
        if($model == "user")
            $myModel = User::find($index);
        else if($model == "link")
            $myModel = Link::find($index);
        else
            $myModel = null;
        if($myModel != null)
        {
            $myModel->delete();
        }
        $path = $router->generatePath('admin-index');
        $router->redirect($path);
    }
}