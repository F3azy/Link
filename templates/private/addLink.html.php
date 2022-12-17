<?php

/** @var \App\Model\Link $link */
/** @var \App\Service\Router $router */

session_start();

// if(isset($_POST['originalLink']) && !empty($_POST['originalLink'])) {
//     if(isset($_POST['customLink']) && !empty($_POST['customLink'])) {
//         if(strlen($_POST['customLink']) >= 4) {
//             $_SESSION['shortUrl'] = "www.linker.pl/" . str_replace(' ', '', $_POST['customLink']);
//         }
//         else {
//             $_SESSION['Error'] = "<div>The given custom link is too short, must be at least 4 characters<div>";
//         }
//     }
//     else {
//         $_SESSION['shortUrl']  = "www.linker.pl/" . randomLink();
//     }

//     if(isset($_POST['passwordCheck']) && !empty($_POST['passwordCheck']) && $_POST['passwordCheck'] == "True") {
//         if(isset($_POST['password']) && !empty($_POST['password'])) {
//             if(strlen($_POST['password']) >= 8) {
//                 $_SESSION['password'] = trim($_POST['password']);            }
//             else {
//                 $_SESSION['Error'] = "<div>The given password is too short, must be at least 8 characters<div>";
//                 unset($_SESSION['shortUrl']);
//             }
//         }
//     }

//     header("Location: ".$router->generatePath('private-addlink'));
//     exit;
// } 



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
