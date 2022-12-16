<?php

if(isset($_POST["submit"])){

    //grab the data
    $userName=$_POST["usernameRegister"];
    $pwd=$_POST["pswRegister"];
    $pwdRepeat=$_POST["psw-repeat"];


    //create Registercontroller class
    include "../protected/Model/User.php"
    include "../protected/Controller/RegisterController.php"
    
    $signup = new RegisterController($userName,$pwd,$pwdRepeat);

    //run error handlers and user signuo
    $signup->signupUser();

    //Going back to front page
    header("location: ".$router->generatePath('public-login'));
}


?>