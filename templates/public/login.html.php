<?php
/** @var \App\Service\Router $router */

$title = 'Linke&reg;';
$bodyClass = 'LoginAndRegistration';
//User::saveByValues("Glitterfrost","Piotr123","normal");
//echo($user->getUserName());
ob_start(); 

?>
<body>
    Tu będzie logowanie z opcją tworzenia konta


    <form action="" method="post">
        <div class="container">
            <h1>Login</h1>
            <p>Wypełnij dane, żeby się zalogować.</p>
            <hr>
            <label for="username"><b>Nazwa użytkownika</b></label>
            <input type="text" placeholder="Enter username" name="usernameLogin" id="usernameLogin" required>

            <label for="psw"><b>Hasło</b></label>
            <input type="password" placeholder="Enter Password" name="pswLogin" id="pswLogin" required>


            <button type="submit" name="submit" class="loginbtn">Zaloguj</button>
        </div>
    </form>

    <form action="<?= $router->generatePath('public-signup')?>" method="post">
        <div class="container">
            <h1>Register</h1>
            <p>"<?= __DIR__ ?>"</p>
            <p>Wypełnij dane, żeby się zajerestrować.</p>
            <hr>
            <label for="username"><b>Nazwa użytkownika</b></label>
            <input type="text" placeholder="Enter username" name="usernameRegister" id="usernameRegister" required>

            <label for="psw"><b>Hasło</b></label>
            <input type="password" placeholder="Enter Password" name="pswRegister" id="pswRegister" required>

            <label for="psw-repeat"><b>Powtórz hasło</b></label>
            <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
            <hr>

            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
            <button type="submit" name="submit" class="registerbtn">Zarejestruj</button>
        </div>
    </form>
</body>


<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>