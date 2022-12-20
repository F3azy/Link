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
            echo "bg-pink-500" ?>">Widok domowy</div>
    </a>
    <a href="<?= $router->generatePath('private-links') ?>">
        <div class="btn-noround menu-item <?php if ($url == "links.html.php")
            echo "bg-pink-500" ?>">Linki</div>
    </a>
    <a href="<?= $router->generatePath('private-mylinks') ?>">
        <div class="btn-noround menu-item <?php if ($url == "mylinks.html.php")
            echo "bg-pink-500" ?>">Moje linki</div>
    </a>
    <a href="<?= $router->generatePath('private-addlink') ?>">
        <div class="btn-noround menu-item <?php if ($url == "addlink.html.php")
            echo "bg-pink-500" ?>">Dodaj link</div>
    </a>
    <a href="<?= $router->generatePath('private-usersettings') ?>">
        <div class="btn-noround menu-item <?php if ($url == "usersettings.html.php")
            echo "bg-pink-500" ?>">Ustawienia</div>
    </a>
    <?php
    } else {
    ?>
    <a href="<?= $router->generatePath('public-index') ?>">
        <div class="btn-noround menu-item">Strona główna</div>
    </a>
    <a href="<?= $router->generatePath('public-addlink') ?>">
        <div class="btn-noround menu-item">Dodaj link anonimowo</div>
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