<?php

/** @var \App\Model\Link $link */
/** @var \App\Service\Router $router */

$title = 'Linke&reg;';
$bodyClass = 'index';
session_start();
if (!isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == "normal")) {
	header("Location:" .$router->generatePath('public-index'));
	exit;
}

session_start();
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

        <form action="<?= $router->generatePath('public-addLink') ?>" method="post">
            <div class="shortenInput">
                <input id="originalLink" type="text" name="link[ogVersion]" placeholder="Input link to shorten..."> 
                <input id="customLink" type="text" name="link[shortVersion]" minlength="4" placeholder="Custom link(optional)..."> 
                <button id="shortenLinkButton">Shorten</button>
                <label for="password">Protect with password:</label>
                <input type="checkbox" id="passwordCheck" name="link[linkPasswdCheck]" value="True">
                <input id="password" type="password" name="link[linkPasswd]" minlength="8" value="" placeholder="8 characters minimum...">
                <input type="hidden" name="link[createDate]" value="<?= (new \DateTime())->format('Y-m-d H:i:s'); ?>">
                <input type="hidden" name="link[editDate]" value="<?= (new \DateTime())->format('Y-m-d H:i:s'); ?>">
                <input type="hidden" name="link[lastVisitDate]" value="<?= (new \DateTime())->format('Y-m-d H:i:s'); ?>">
                <input type="hidden" name="link[numOfVisits]" value="0">
                <input type="hidden" name="link[lifetime]" value="<?= (new \DateTime())->format('Y-m-d H:i:s'); ?>">
                <input type="hidden" name="link[userID]" value="0">
                <input type="hidden" name="action" value="public-addLink"> 
            </div>
        </form>
    </div>


    <?php
        if(isset($_SESSION['shortUrl']) && !empty($_SESSION['shortUrl'])) {
            if(isset($_SESSION['password']) && !empty($_SESSION['password'])) {
                echo '<script>alert("Your Link: '.$_SESSION['shortUrl'].'\nYour password: '.$_SESSION['password'].'");</script>';
                unset($_SESSION['shortUrl']);
                unset($_SESSION['password']);
            }
            else {
                echo '<script>alert("Your Link: '.$_SESSION['shortUrl'].'");</script>';
                unset($_SESSION['shortUrl']);
            }
        }
    ?>

    <script src="../../js/addLink.js"></script>


<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
