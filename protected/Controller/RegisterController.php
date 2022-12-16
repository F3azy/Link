<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Service\Router;
use App\Service\Templating;
//include "../protected/Model/User.php"
class RegisterController{
    
    private $userName;
    private $userPasswd;
    private $userPasswdRepeat
    private $role;

    public function __construct($userName, $passwd,$passwdRepeat){
        $this->userName = $userName;
        $this->userPasswd =  $passwd;
        $this->userPasswdRepeat =  $passwdRepeat;
        $this->role = 'normal';
    }

    public function signupUser(){
        if($this->emptyInput()==false){
            //Empty Input!
            header("location: ".$router->generatePath('public-login')."?error=emptyinput")
            exit();
        }
        if($this->invalidUserName()==false){
            //Invalud username
            header("location: ".$router->generatePath('public-login')."?error=invaliddata")
            exit();
        }
        if($this->pwdMatch()==false){
            //passwd don't match
            header("location: ".$router->generatePath('public-login')."?error=passwddontMatch")
            exit();
        }
        if($this->checkUser()==false){
            //username already taken
            header("location: ".$router->generatePath('public-login')."?error=usernametaken")
            exit();
        }

        User::saveByValues($this->userName,$this->userPasswd,$this->role);


    }
    private function emptyInput() {
        $result;
        if(empty($this->userName) || empty($this->userPasswd) || empty($this->userPasswdRepeat)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function invalidUserName() {
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->userName)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    private function pwdMatch(){
        $result;
        if($this->userPasswd !== $this->userPasswdRepeat){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    //if username or passwd exits in database
    private function checkUser(){
        $result;
        if(User::findByUserName($this->useruserName) == null){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

}

?>