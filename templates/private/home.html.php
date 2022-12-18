<?php
/** @var \App\Service\Router $router */
use App\Model\Link;
session_start();

$title = 'Linke&reg;';
$bodyClass = 'index';

// If the user is not logged in redirect to the login page...

if (!isset($_SESSION['loggedin']) && ($_SESSION['role'] == "normal" || $_SESSION['role'] == "admin" )) {
	header("Location:" .$router->generatePath('public-index'));
	exit;
}
ob_start(); ?>
<body>
	<?php $links =  Link::findLinksOfUser($_SESSION["userID"]); ?>
    Tu będzie ekran startowy użytkownika zalogowanego

    
</body>
<style>
    table, th, td, tr {
        border: 1px solid black;
    }
    </style>
<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>