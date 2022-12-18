<?php
/** @var \App\Service\Router $router */
/** @var \App\Model\User $user */
/** @var \App\Model\Link $link */
$title = 'Linke&reg;';
$bodyClass = 'index';
session_start();
if (!isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] != "admin")) {
	header("Location:" .$router->generatePath('public-index'));
	exit;
}
ob_start(); ?>
<body>
    <h1>Panel administratora</h1>
    <h2>Panel sterowania użytkownikami</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role</th>
            <th>Delete</th>
        </tr>
        <?php foreach($users as $user): ?>
            <tr>
                <?php $index = $user->getUserID(); ?>
                <td id=<?php echo("user-" . $index . "-userId")?>><?php echo($user->getUserID()) ?></td>
                <td contenteditable class="editable" id=<?php echo("user-" . $index . "-userName")?>><?php echo($user->getUserName()) ?></td>
                <td contenteditable class="editable" id=<?php echo("user-" . $index . "-userPasswd")?>><?php echo($user->getUserPasswd()) ?></td>
                <td contenteditable class="editable" id=<?php echo("user-" . $index . "-role")?>><?php echo($user->getRole()) ?></td>
                <td><button class="delete-btn" id=<?php echo("user-" . $index)?>>Delete</button></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h2>Panel sterowania linkami</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>OG Version</th>
            <th>Short Version</th>
            <th>Password</th>
            <th>Create Date</th>
            <th>Edit Date</th>
            <th>Last Visit Date</th>
            <th>Number of visits</th>
            <th>Lifetime</th>
            <th>Creator ID</th>
            <th>Action</th>
        </tr>
        <?php foreach($links as $link): ?>
            <tr>
                <?php $index = $link->getLinkID(); ?>
                <td id=<?php echo("link-" . $index . "-linkId")?>><?php echo($link->getLinkID()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-ogVersion")?>><?php echo($link->getOgVersion()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-shortVersion")?>><?php echo($link->getShortVersion()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-linkPasswd")?>><?php echo($link->getLinkPasswd()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-createDate")?>><?php echo($link->getCreateDate()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-editDate")?>><?php echo($link->getEditDate()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-lastVisitDate")?>><?php echo($link->getLastVisitDate()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-numOfVisits")?>><?php echo($link->getNumOfVisits()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-lifeTime")?>><?php echo($link->getLifetime()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-userId")?>><?php echo($link->getUserID()) ?></td>
                <td><button class="delete-btn" id=<?php echo("link-" . $index)?>>Delete</button></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

<style>
    table, th, td, tr {
        border: 1px solid black;
    }
    </style>
<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>

<script>
    function createCookie(name, value, days) {
    var expires;
      
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
      
    document.cookie = escape(name) + "=" + 
        escape(value) + expires + "; path=/";
    }

    function startEdit() {
        let data = this.id.split("-");
        let model = data[0];
        let index = data[1];
        let variable = data[2];
        let value = this.textContent;
        createCookie("changeData", model + "|" + index + "|" + variable + "|" + value, 1);
        window.location.replace("/index.php?action=admin-edit");
    }

    function deleteRow() {
        let data = this.id.split("-");
        let model = data[0];
        let index = data[1];
        createCookie("deleteData", model + "|" + index, 1);
        window.location.replace("/index.php?action=admin-delete");
    }
    let cells = document.getElementsByClassName("editable");
    for(let cell of cells)
    {
        cell.addEventListener("focusout", startEdit);
    }

    let buttons = document.getElementsByClassName("delete-btn");
    for(let btn of buttons)
    {
        btn.addEventListener("click", deleteRow);
    }
</script>