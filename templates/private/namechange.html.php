<?php
/** @var \App\Model\User $user */

if (isset($_POST["submit"])) {
    $newUsername = $_POST["uname"];

    $user->findByUserName($_SESSION['user']);
    $user->setUserName($newUsername);
    $user->save();

    header("location: " . $router->generatePath('private-usersettings'));
}
?>