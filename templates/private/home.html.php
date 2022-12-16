<?php
/** @var \App\Service\Router $router */
use App\Model\Link;
session_start();

$title = 'Linke&reg;';
$bodyClass = 'index';

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header("Location:" .$router->generatePath('public-index'));
	exit;
}
ob_start(); ?>
<body>
	<?php $links =  Link::findLinksOfUser($_SESSION["userID"]); ?>
    Tu będzie ekran startowy użytkownika zalogowanego
	<?php 
        if($_SESSION["role"] == "normal")
        {
    ?>
    <h2>Wszystkie widoki:</h2>
    <h3>Public</h3>
        <a href="<?= $router->generatePath('public-index') ?>">Index</a><br>
        <a href="<?= $router->generatePath('public-addLink') ?>">Add Link</a><br>
        <a href="<?= $router->generatePath('public-login') ?>">Login</a>
    <h3>Private</h3>
        <a href="<?= $router->generatePath('private-home') ?>">Home</a><br>
        <a href="<?= $router->generatePath('private-links') ?>">Links</a><br>
        <a href="<?= $router->generatePath('private-mylinks') ?>">My Links</a><br>
        <a href="<?= $router->generatePath('private-addlink') ?>">Add Link</a><br>
        <a href="<?= $router->generatePath('private-usersettings') ?>">User Settings</a>
		<a href="<?= $router->generatePath('private-logOut') ?>">Log out</a>
        <?php 
        }
        else
        {
			echo $_SESSION["role"];
        ?>
    <h3>Admin</h3>
        <a href="<?= $router->generatePath('admin-index') ?>">Admin</a>
		<a href="<?= $router->generatePath('private-logOut') ?>">Log out</a>
    <?php 
        }
    ?>
    
</body>
<style>
    table, th, td, tr {
        border: 1px solid black;
    }
    </style>
<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>