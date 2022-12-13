<?php
/** @var \App\Service\Router $router */

$title = 'Linke&reg;';
$bodyClass = 'index';

ob_start(); ?>
<body>
    Tu będzie zarządzanie aplikacją jako administrator
</body>

<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>