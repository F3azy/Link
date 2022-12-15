<?php
/** @var \App\Service\Router $router */

$title = 'Linke&reg;';
$bodyClass = 'index';

ob_start(); ?>
<body>
    Tu będzie zarządzanie aplikacją jako administrator

    Wszystkie widoki:
    <h2>Public</h2>
    <a href="<?= $router->generatePath('public-index') ?>">Index</a><br>
    <a href="<?= $router->generatePath('public-addLink') ?>">Add Link</a><br>
    <a href="<?= $router->generatePath('public-login') ?>">Login</a>
    <h2>Private</h2>
    <a href="<?= $router->generatePath('private-home') ?>">Home</a><br>
    <a href="<?= $router->generatePath('private-links') ?>">Links</a><br>
    <a href="<?= $router->generatePath('private-mylinks') ?>">My Links</a><br>
    <a href="<?= $router->generatePath('private-addlink') ?>">Add Link</a><br>
    <a href="<?= $router->generatePath('private-usersettings') ?>">User Settings</a>
    <h2>Admin</h2>
    <a href="<?= $router->generatePath('admin-index') ?>">Admin</a>
</body>

<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>