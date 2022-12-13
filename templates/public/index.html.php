<?php
/** @var \App\Service\Router $router */

$title = 'Linke&reg;';
$bodyClass = 'index';

ob_start(); ?>
<body>
    <h1>Witamy na stronie Linke&reg;</h1>
    <a href="<?= $router->generatePath('public-index') ?>">Index</a><br>
    <a href="<?= $router->generatePath('public-addLink') ?>">Add Link</a><br>
    <a href="<?= $router->generatePath('public-login') ?>">Login</a><br>
    <a href="<?= $router->generatePath('private-home') ?>">Home</a><br>
    <a href="<?= $router->generatePath('private-links') ?>">Links</a><br>
    <a href="<?= $router->generatePath('private-mylinks') ?>">My Links</a><br>
    <a href="<?= $router->generatePath('private-addlink') ?>">Add Link</a><br>
    <a href="<?= $router->generatePath('private-usersettings') ?>">User Settings</a><br>
    <a href="<?= $router->generatePath('admin-index') ?>">Admin</a><br>
</body>

<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>