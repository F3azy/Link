<?php

/** @var \App\Model\Link $link */
/** @var \App\Service\Router $router */
$url = basename(__FILE__);
$title = 'Linke&reg;';
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

$title = 'Shorten';
$bodyClass = 'addLinkPrivate';
ob_start(); ?>

<div class="privateShorten">

        <?php
            if(isset($_SESSION['Error']) && !empty($_SESSION['Error'])) {
                echo $_SESSION['Error'];
                unset($_SESSION['Error']);
            }
        ?>

        <form action="<?= $router->generatePath('private-addlink') ?>" method="post">
            <div class="shortenInput">
                <input id="originalLink" type="text" name="link[ogVersion]" placeholder="Input link to shorten..."> 
                <input id="customLink" type="text" name="link[shortVersion]" minlength="4" placeholder="Custom link(optional)..."> 
                <button id="shortenLinkButton">Shorten</button>
                <label for="password">Protect with password:</label>
                <input type="checkbox" id="passwordCheck" name="link[linkPasswdCheck]" value="True">
                <input id="password" type="password" name="link[linkPasswd]" minlength="8" value="" placeholder="8 characters minimum...">
                <input type="hidden" name="action" value="private-addlink"> 
            </div>
        </form>
    </div>

<script src="../../js/addLink.js"></script>


<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';