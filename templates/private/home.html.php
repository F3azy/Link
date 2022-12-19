<?php
/** @var \App\Service\Router $router */
use App\Model\Link;

session_start();

$title = 'Home&reg;';
$bodyClass = 'index';

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin']) && ($_SESSION['role'] != "normal" || $_SESSION['role'] == "admin" )) {
	header("Location:" .$router->generatePath('public-index'));
	exit;
}
ob_start(); ?>

<body>
    <?php $links = Link::findLinksOfUser($_SESSION["userID"]);
    $links = array_slice($links, 0, 10);

    if (!empty($links)) {
    ?>
    Tu będzie ekran startowy użytkownika zalogowanego
    <div class="content-wrapper">
        <h2>Twoje ostatnie 10 linków</h2>
        <table>
            <tr>

                <th>OG Version</th>
                <th>Short Version</th>
                <th>Password</th>
                <th>Create Date</th>
                <th>Edit Date</th>
                <th>Last Visit Date</th>
                <th>Number of visits</th>
                <th>Lifetime</th>
                <th>Edit</th>

            </tr>
            <?php foreach ($links as $link): ?>
            <tr>
                <?php $index = $link->getLinkID(); ?>
                <td contenteditable class="editable" id=<?php echo ("link-" . $index . "-ogVersion") ?>>
                    <?php echo ($link->getOgVersion()) ?>
                </td>
                <td contenteditable class="editable" id=<?php echo ("link-" . $index . "-shortVersion") ?>>
                    <?php echo ($link->getShortVersion()) ?>
                </td>
                <td contenteditable class="editable" id=<?php echo ("link-" . $index . "-linkPasswd") ?>>
                    <?php echo ($link->getLinkPasswd()) ?>
                </td>
                <td contenteditable class="editable" id=<?php echo ("link-" . $index . "-createDate") ?>>
                    <?php echo ($link->getCreateDate()) ?>
                </td>
                <td contenteditable class="editable" id=<?php echo ("link-" . $index . "-editDate") ?>>
                    <?php echo ($link->getEditDate()) ?>
                </td>
                <td contenteditable class="editable" id=<?php echo ("link-" . $index . "-lastVisitDate") ?>>
                    <?php echo ($link->getLastVisitDate()) ?>
                </td>
                <td contenteditable class="editable" id=<?php echo ("link-" . $index . "-numOfVisits") ?>>
                    <?php echo ($link->getNumOfVisits()) ?>
                </td>
                <td contenteditable class="editable" id=<?php echo ("link-" . $index . "-lifeTime") ?>>
                    <?php echo ($link->getLifetime()) ?>
                <td><button class="edit-btn" id=<?php echo ("link-" . $index) ?>>Delete</button></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php
    } else {
        echo "Brak linków";
    }
    ?>

    <?php
    if ($_SESSION["role"] == "normal") {
    ?>
    <h2>Wszystkie widoki:</h2>
    <h3>Public</h3>
    <a href="<?= $router->generatePath('public-index') ?>">Index</a><br>
    <a href="<?= $router->generatePath('public-addlink') ?>">Add Link</a><br>
    <a href="<?= $router->generatePath('public-login') ?>">Login</a>
    <h3>Private</h3>
    <a href="<?= $router->generatePath('private-home') ?>">Home</a><br>
    <a href="<?= $router->generatePath('private-links') ?>">Links</a><br>
    <a href="<?= $router->generatePath('private-mylinks') ?>">My Links</a><br>
    <a href="<?= $router->generatePath('private-addlink') ?>">Add Link</a><br>
    <a href="<?= $router->generatePath('private-usersettings') ?>">User Settings</a>
    <a href="<?= $router->generatePath('private-logOut') ?>">Log out</a>
    <?php
    } else {
        echo $_SESSION["role"];
    ?>
    <h3>Admin</h3>
    <a href="<?= $router->generatePath('admin-index') ?>">Admin</a>
    <a href="<?= $router->generatePath('private-logOut') ?>">Log out</a>
    <?php
    }
    ?>
</body>
<style>
    table,
    th,
    td,
    tr {
        border: 1px solid black;
    }
</style>
<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>