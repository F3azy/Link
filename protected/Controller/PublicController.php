<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Model\Link;
use App\Service\Router;
use App\Service\Templating;
use App\Model\User;

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
            $link = Link::createNewFromArray($requestLink);
            // @todo missing validation

            if($link) {
                $link->save();

                $path = $router->generatePath('public-index');
                $router->redirect($path);
                return null;
            }
            else {
                $path = $router->generatePath('public-addlink');
                $router->redirect($path);
                return null;
            }

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

    public function redirect(string $redirectLink, Router $router)
    {
        $link = Link::findByShortName($redirectLink);
        if($link == null)
            $link = Link::findByFullName($redirectLink);
        if($link != null)
            header("Location: http://www." . $link->getOgVersion());
        else
        throw new NotFoundException("(Nie znaleziono takiej strony)");
    }

    public function signup(Templating $templating, Router $router): void
    {
        $userName=$_POST["usernameRegister"];
        $pwd=$_POST["pswRegister"];
        $pwdRepeat=$_POST["psw-repeat"];
        $role = "normal";

        $this->createUser($userName,$pwd,$pwdRepeat,$role,$router);
        // $templating->Render('public/login.html.php', [
        //     'router' => $router
        // ]);
        header("location: ".$router->generatePath('public-login'));
    }

    public function loginUser(Templating $templating, Router $router): void
    {
        $userName=$_POST["usernameLogin"];
        $pwd=$_POST["pswLogin"];
        

        $this->logUser($userName,$pwd,$router);
        // $templating->Render('public/login.html.php', [
        //     'router' => $router
        // ]);
        //echo "LOOOOOOOOL";
        
        header("location: ".$router->generatePath('private-home'));
    }


    public function logUser($userName,$userPasswd,$router): void {
        // if($this->emptyInput($userName,$userPasswd,"placeholder")==false){
        //     //Empty Input!
        //     header("location: ".$router->generatePath('public-login')."?error=emptyinput");
        //     //header("location: ".$router->generatePath('public-login'));
        //     exit();
        // }
        $user = User::findByUserName($userName);
        if ($user == null){
            header("location: ".$router->generatePath('public-login')."?error=userdontexits");
            sleep(5);
            //header("location: ".$router->generatePath('public-login'));
            exit();
        }
        $passwdHashed = $user->getUserPasswd(); 
        $checkPwd = password_verify($userPasswd,$passwdHashed);
        if ($checkPwd == false){
            header("location: ".$router->generatePath('public-login')."?error=wrongpasswd");
            sleep(10);
            //header("location: ".$router->generatePath('public-login'));
            exit();
        } 
        session_start();
        $_SESSION["userID"] = $user->getUserID();
        $_SESSION["userName"] = $user->getUserName();
        $_SESSION["role"] = $user->getRole();
        $_SESSION['loggedin'] = "loggedin";
       
    }
    


    public function createUser($userName,$userPasswd,$pwdRepeat,$role,$router){
        if($this->emptyInput($userName,$userPasswd,$pwdRepeat)==false){
            //Empty Input!
            //header("location: ".$router->generatePath('public-login')."?error=emptyinput");
            header("location: ".$router->generatePath('public-login'));
            exit();
        }
        if($this->invalidUserName($userName)==false){
            //Invalud username
            //header("location: ".$router->generatePath('public-login')."?error=invaliddata");
            header("location: ".$router->generatePath('public-login'));
            exit();
        }
        if($this->pwdMatch($userPasswd,$pwdRepeat)==false){
            //passwd don't match
            //header("location: ".$router->generatePath('public-login')."?error=passwddontMatch");
            header("location: ".$router->generatePath('public-login'));
            exit();
        }
        if($this->checkUser($userName)==false){
            //username already taken
            //header("location: ".$router->generatePath('public-login')."?error=usernametaken");
            header("location: ".$router->generatePath('public-login'));
            exit();
        }

        User::saveByValues($userName,$userPasswd,$role);


    }
    private function emptyInput($userName,$userPasswd,$userPasswdRepeat) {
        $result;
        if(empty($userName) || empty($userPasswd) || empty($userPasswdRepeat)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidUserName($userName) {
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$userName)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function pwdMatch($userPasswd,$userPasswdRepeat){
        $result;
        if($userPasswd !== $userPasswdRepeat){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    //if username or passwd exits in database
    private function checkUser($useruserName){
        $result;
        if(User::findByUserName($useruserName) != null){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
}