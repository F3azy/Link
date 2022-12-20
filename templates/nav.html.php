<?php
use function UI\quit;

/** @var $router \App\Service\Router */
?>
<div class="flex flex-row justify-between items-center bg-neutral-50 h-20 px-6 py-2">
    <div class="flex items-center font-bold text-pink-500">
        <a href="
            <?php
            if (isset($_SESSION["loggedin"])) {
                $router->generatePath('public-index');
            } else {
                $router->generatePath('private-home');
            }
            ?>">Linke<span class="text-2xl">&reg;</a></span>
    </div>

    <div class="flex flex-row justify-center items-center gap-1">
        <?php
        if (isset($_SESSION["loggedin"])) {
        ?>
        <div class=" btn btn-primary"><a href="<?= $router->generatePath('private-logOut') ?>">Wyloguj się</a></div>
        <?php
        } else {
        ?>
        <div class="btn btn-primary"><a href="<?= $router->generatePath('public-login') ?>">Zaloguj się</a></div>
        <?php
        }
        if (isset($_SESSION["loggedin"]) && ($_SESSION["role"] == "admin")) {
        ?>
        <div class="btn btn-primary"><a href="<?= $router->generatePath('admin-index') ?>">Admin</a></div>
        <?php
        }
        ?>
    </div>

</div>
<?php