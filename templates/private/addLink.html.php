<?php

// /** @var \App\Model\Post[] $posts */
/** @var \App\Service\Router $router */

session_start();

if(isset($_POST['originalLink']) && !empty($_POST['originalLink'])) {
    if(isset($_POST['customLink']) && !empty($_POST['customLink'])) {
        $_SESSION['shortUrl'] = "www.linker.pl/" . str_replace(' ', '', $_POST['customLink']);
    }
    else {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        $length = rand(4,10);
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $_SESSION['shortUrl']  = "www.linker.pl/" . $randomString;
    }

    header("Location: ".$router->generatePath('private-addlink'));
    exit;
} 



$title = 'Shorten';
$bodyClass = 'addLinkPrivate';


ob_start(); ?>

    <div class="privateShorten">

        <form action="" method="post">
            <div class="shortenInput">
                <input id="originalLink" type="text" name="originalLink" placeholder="Input link to shorten..."> 
                <input id="customLink" type="text" name="customLink" placeholder="Custom link(optional)..."> 
                <button id="shortenLinkButton">Shorten</button>
                <label for="password">Protect with password:</label>
                <input type="checkbox" id="passwordCheck" name="passwordCheck" value="True">
                <input id="password" type="text" name="password" placeholder="Password">
            </div>
        </form>
    </div>


    <?php
        if(isset($_SESSION['shortUrl']) && !empty($_SESSION['shortUrl'])) {
            echo '<script>alert("'.$_SESSION['shortUrl'].'");</script>';
            unset($_SESSION['shortUrl']);
        }
    ?>

    <script src="../../js/addLink.js"></script>


<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
