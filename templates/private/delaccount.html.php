<?php
/** @var \App\Model\User $user */

if (isset($_POST["submit"])) {
    //grab the data
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

    $user->delete();

    header("location: " . $router->generatePath('public-index'));
}
?>