<?php
/** @var \App\Service\Router $router */

$title = 'Linke&reg;';
$bodyClass = 'ConfirmPassword';
session_start();
ob_start(); 

?>
<body>
    <form action="<?= $router->generatePath('public-confirmLinkPassword')?>" method="post">
        <div class="container">
            <h1>Link zabezpieczony hasłem</h1>
            <p>Podaj hasło do linka</p>
            <label for="linkPasswd"><b>Hasło</b></label>
            <input type="password" placeholder="Enter Link Password" name="linkPasswd" id="linkPasswd" required>
            <input type="hidden" name="redirectLink" id="redirectLink" value="<?php echo($redirectLink); ?>">
            <button type="submit" name="submit" class="loginbtn">Sprawdź hasło</button>
        </div>
    </form>
</body>


<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>