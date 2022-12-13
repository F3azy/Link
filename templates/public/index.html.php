<?php
/** @var \App\Service\Router $router */

$title = 'Linke&reg;';
$bodyClass = 'index';

ob_start(); ?>
<body>
    <h1>Witamy na Linke&reg;</h1>
    <div>
    Na naszej stronie możesz skrócić link lub stworzyć w pełni personalizowany link z wybranym przez siebie tagiem w całości <b>ZA DARMO</b><br>
    Cała magia tkwi w naszej aplikacji, która dokonuje zmian tak jak w zaprezentowanym poniżej schemacie:
    </div>
    <h2>Jak to jest zrobione?</h2>
    <img src="/img/HowItIsDone.png">
</body>

<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>