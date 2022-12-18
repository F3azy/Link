<?php
/** @var $router \App\Service\Router */
//session_start();
?>
<style>
    .navbar {
        background-color: lightgray;
    }
</style>
<div class="navbar">
    Linke&reg;

    
    <h2>Wszystkie widoki:</h2>
    <h3>Public</h3>
        <a href="<?= $router->generatePath('public-index') ?>">Index</a><br>
        <a href="<?= $router->generatePath('public-addLink') ?>">Add Link</a><br>
        <a href="<?= $router->generatePath('public-login') ?>">Login</a>
    <?php 
    if(isset($_SESSION["loggedin"]) && $_SESSION["role"] == "normal")
    {
    ?>
        <h3>Private</h3>
            <a href="<?= $router->generatePath('private-home') ?>">Home</a><br>
            <a href="<?= $router->generatePath('private-links') ?>">Links</a><br>
            <a href="<?= $router->generatePath('private-mylinks') ?>">My Links</a><br>
            <a href="<?= $router->generatePath('private-addlink') ?>">Add Link</a><br>
            <a href="<?= $router->generatePath('private-usersettings') ?>">User Settings</a>
            <a href="<?= $router->generatePath('private-logOut') ?>">Log out</a>
        <?php 
        }
        elseif(isset($_SESSION["loggedin"]) && ($_SESSION["role"] == "admin"))
        {
        ?>
    <h3>Private</h3>
            <a href="<?= $router->generatePath('private-home') ?>">Home</a><br>
            <a href="<?= $router->generatePath('private-links') ?>">Links</a><br>
            <a href="<?= $router->generatePath('private-mylinks') ?>">My Links</a><br>
            <a href="<?= $router->generatePath('private-addlink') ?>">Add Link</a><br>
            <a href="<?= $router->generatePath('private-usersettings') ?>">User Settings</a>
            <a href="<?= $router->generatePath('private-logOut') ?>">Log out</a>
    <h3>Admin</h3>
        <a href="<?= $router->generatePath('admin-index') ?>">Admin</a>
    <?php 
        }
    ?>
    
</div>
<?php
