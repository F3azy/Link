<?php
/** @var \App\Model\User $user */

if (isset($_POST["submit"])) {
    $oldPwd = $_POST["old-pass"];
    $pwd = $_POST["new-pass"];
    $pwdRepeat = $_POST["new-pass-repeat"];

    $user->findByUserName($_SESSION['user']);

    if ($this->emptyInput($oldPwd, $pwd, $pwdRepeat) == false) {
        //Empty Input!
        header("location: " . $router->generatePath('private-passchange') . "?error=emptyinput");
        exit();
    }
    if ($oldPwd != $user->getUserPasswd()) {
        //Invalid Password!
        header("location: " . $router->generatePath('private-passchange') . "?error=invalidpwd");
        exit();
    }

    $user->setUserPasswd($newUsername);
    $user->save();

    header("location: " . $router->generatePath('private-usersettings'));
}
?>