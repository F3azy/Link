<?php
/** @var \App\Service\Router $router */

session_start();

$title = 'settings&reg;';
$bodyClass = 'index';

session_start();
if (!isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == "normal")) {
	header("Location:" .$router->generatePath('public-index'));
	exit;
 
ob_start(); ?>

<body>
    <div class="change-pass">
        <form action="<?php echo $router->generatePath('private-passchange'); ?>" method="post">
            <label for="old-pass">Old password:</label>
            <input type="password" name="old-pass" id="old-pass" required>
            <label for="new-pass">New password:</label>
            <input type="password" name="new-pass" id="new-pass" required>
            <label for="new-pass-repeat">Repeat new password:</label>
            <input type="password" name="new-pass-repeat" id="new-pass-repeat" required>
            <input type="submit" value="Change password">
        </form>
    </div>
    <div class="change-name">
        <form action="<?php echo $router->generatePath('private-namechange'); ?>" method="post">
            <label for="newName">New username:</label>
            <input type="text" name="new-name" id="uname" required>
            <input type="submit" value="Change username">
        </form>
    </div>
    <div class="del-account">
        <form action="<?php echo $router->generatePath('private-delaccount'); ?>" method="post">
            <label for="password">Old password:</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="Delete account">
        </form>
    </div>
</body>

<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>