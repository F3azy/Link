<?php
use function UI\quit;

/** @var $router \App\Service\Router */
?>

<div class="flex flex-col border-r-2 border-pink-500">
    <?php
    if (isset($_SESSION["loggedin"]) && ($_SESSION["role"] == "normal" || ($_SESSION["role"] == "admin"))) {
    ?>
    <a href="<?= $router->generatePath('private-home') ?>">
        <div class="btn-noround menu-item <?php if ($url == "home.html.php")
            echo "bg-pink-500" ?>">Home</div>
    </a>
    <a href="<?= $router->generatePath('private-links') ?>">
        <div class="btn-noround menu-item <?php if ($url == "links.html.php")
            echo "bg-pink-500" ?>">Links</div>
    </a>
    <a href="<?= $router->generatePath('private-mylinks') ?>">
        <div class="btn-noround menu-item <?php if ($url == "mylinks.html.php")
            echo "bg-pink-500" ?>">My Links</div>
    </a>
    <a href="<?= $router->generatePath('private-addlink') ?>">
        <div class="btn-noround menu-item <?php if ($url == "addLink.html.php")
            echo "bg-pink-500" ?>">Add Link</div>
    </a>
    <a href="<?= $router->generatePath('private-usersettings') ?>">
        <div class="btn-noround menu-item <?php if ($url == "usersettings.html.php")
            echo "bg-pink-500" ?>">Settings</div>
    </a>
    <?php
    } else {
    ?>
    <a href="<?= $router->generatePath('public-index') ?>">
        <div class="btn-noround menu-item">Index</div>
    </a>
    <a href="<?= $router->generatePath('public-addLink') ?>">
        <div class="btn-noround menu-item">Add Link</div>
    </a>
    <?php
    }
    if (isset($_SESSION["loggedin"]) && ($_SESSION["role"] == "admin")) {
    ?>
    <a href="<?= $router->generatePath('admin-index') ?>">
        <div class="btn-noround menu-item">Admin</div>
    </a>
    <?php
    }
    ?>
</div>