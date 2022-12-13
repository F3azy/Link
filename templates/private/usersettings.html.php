<?php
/** @var \App\Service\Router $router */

$title = 'Linke&reg;';
$bodyClass = 'index';

ob_start(); ?>
<body>
    Tu będą ustawienia użytkownika
</body>

<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>