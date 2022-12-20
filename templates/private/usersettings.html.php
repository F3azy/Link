<?php
/** @var \App\Service\Router $router */

$url = basename(__FILE__);
$title = 'settings&reg;';
$bodyClass = 'index';
session_start();

if (isset($_SESSION['loggedin'])) {
    if($_SESSION['role'] != "normal")
    {
        header("Location:" . $router->generatePath('admin-index'));
        exit;
    }
}
else {
    header("Location:" . $router->generatePath('public-index'));
    exit;
}

ob_start(); ?>

<body>
    <div class="flex flex-col w-full items-center py-6 gap-12">
        <div class="flex flex-col w-80 items-center">
            <form class="flex flex-col items-center gap-2"
                action="<?php echo $router->generatePath('private-passchange'); ?>" method="post">
                <h2>Zmień hasło</h2>
                <span>
                    <label for="old-pass">Stare hasło:</label>
                    <input class="input" type="password" name="old-pass" id="old-pass" required>
                </span>
                <span>
                    <label for="new-pass">Nowe hasło:</label>
                    <input class="input" type="password" name="new-pass" id="new-pass" required>
                </span>
                <span>
                    <label for="new-pass-repeat">Powtórz nowe hasło:</label>
                    <input class="input" type="password" name="new-pass-repeat" id="new-pass-repeat" required>
                </span>
                <input class="btn btn-primary" type="submit" value="Change password">
            </form>
        </div>
        <div class="w-80">
            <form class="flex flex-col items-center gap-2"
                action="<?php echo $router->generatePath('private-namechange'); ?>" method="post">
                <h2>Zmień nazwę użytkownika</h2>

                <span>
                    <label for="newName">Nowa nazwa użytkownika:</label>
                    <input class="input" type="text" name="new-name" id="uname" required>
                </span>
                <input class="btn btn-primary" type="submit" value="Change username">
            </form>
        </div>
        <div class="w-80">
            <form class="flex flex-col items-center gap-2"
                action="<?php echo $router->generatePath('private-delaccount'); ?>" method="post">
                <h2>Usuń konto</h2>
                <span>
                    <label for="password">Hasło:</label>
                    <input class="input" type="password" name="password" id="password" required>
                </span>
                <input class="btn btn-primary" type="submit" value="Delete account">
            </form>
        </div>
    </div>
</body>

<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>