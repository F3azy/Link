<?php
/** @var \App\Service\Router $router */

$title = 'Linke&reg;';
$bodyClass = 'index';
session_start();
if (!isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == "normal")) {
	header("Location:" .$router->generatePath('public-index'));
	exit;
}
ob_start(); ?>
<body>
    Tu będzie dodawanie linku przez użytkownika
</body>

<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>