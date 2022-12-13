<?php
/** @var $router \App\Service\Router */

?>
<style>
    .navbar {
        background-color: lightgray;
    }
</style>
<div class="navbar">
    Linke&reg;
    <ul>
        <li><a href="<?= $router->generatePath('') ?>">Strona główna</a></li>
        <li><a href="<?= $router->generatePath('public-addLink') ?>">Dodaj link</a></li>
        <li><a href="<?= $router->generatePath('public-login') ?>">Zaloguj sie</a></li>
    </ul>
</div>
<?php
