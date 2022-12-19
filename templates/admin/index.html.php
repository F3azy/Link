<?php
/** @var \App\Service\Router $router */
/** @var \App\Model\User $user */
/** @var \App\Model\Link $link */
$title = 'Linke&reg;';
$bodyClass = 'index';
session_start();
if (isset($_SESSION['loggedin'])) {
    if($_SESSION['role'] != "admin")
    {
        header("Location:" . $router->generatePath('private-home'));
        exit;
    }
}
else {
    header("Location:" . $router->generatePath('public-index'));
    exit;
}

ob_start(); ?>



<body>

    <h1>Panel administratora</h1>
    <h2>Panel sterowania użytkownikami</h2>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-white border-b">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr class="tr-item">
                                <?php $index = $user->getUserID(); ?>
                                <td class="table-index" id=<?php echo ("user-" . $index . "-userId") ?>>
                                    <?php echo ($user->getUserID()) ?>
                                </td>
                                <td contenteditable class="table-item editable" id=<?php echo ("user-" . $index .
                                    "-userName") ?>>
                                    <?php echo ($user->getUserName()) ?>
                                </td>
                                <td contenteditable class="table-item editable" id=<?php echo ("user-" . $index .
                                    "-userPasswd") ?>>
                                    <?php echo ($user->getUserPasswd()) ?>
                                </td>
                                <td contenteditable class="table-item editable" id=<?php echo ("user-" . $index .
                                    "-role") ?>>
                                    <?php echo ($user->getRole()) ?>
                                </td>
                                <td class="border-neutral-50"><button class="btn btn-primary delete-btn" id=<?php echo ("user-" . $index)
                                        ?>>Delete</button></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <h2>Panel sterowania linkami</h2>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-white border-b">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">OG Version</th>
                                <th scope="col">Short Version</th>
                                <th scope="col">Password</th>
                                <th scope="col">Create Date</th>
                                <th scope="col">Edit Date</th>
                                <th scope="col">Last Visit Date</th>
                                <th scope="col">Number of visits</th>
                                <th scope="col">Lifetime</th>
                                <th scope="col">Creator ID</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($links as $link): ?>
                            <tr class="tr-item">
                                <?php $index = $link->getLinkID(); ?>
                                <td class="table-item" id=<?php echo ("link-" . $index . "-linkId") ?>>
                                    <?php echo ($link->getLinkID()) ?>
                                </td>
                                <td contenteditable class="table-item editable" id=<?php echo ("link-" . $index . "-ogVersion") ?>>
                                    <?php echo ($link->getOgVersion()) ?>
                                </td>
                                <td contenteditable class="table-item editable" id=<?php echo ("link-" . $index . "-shortVersion") ?>>
                                    <?php echo ($link->getShortVersion()) ?>
                                </td>
                                <td contenteditable class="table-item editable" id=<?php echo ("link-" . $index . "-linkPasswd") ?>>
                                    <?php echo ($link->getLinkPasswd()) ?>
                                </td>
                                <td contenteditable class="table-item editable" id=<?php echo ("link-" . $index . "-createDate") ?>>
                                    <?php echo ($link->getCreateDate()) ?>
                                </td>
                                <td contenteditable class="table-item editable" id=<?php echo ("link-" . $index . "-editDate") ?>>
                                    <?php echo ($link->getEditDate()) ?>
                                </td>
                                <td contenteditable class="table-item editable" id=<?php echo ("link-" . $index . "-lastVisitDate") ?>>
                                    <?php echo ($link->getLastVisitDate()) ?>
                                </td>
                                <td contenteditable class="table-item editable" id=<?php echo ("link-" . $index . "-numOfVisits") ?>>
                                    <?php echo ($link->getNumOfVisits()) ?>
                                </td>
                                <td contenteditable class="table-item editable" id=<?php echo ("link-" . $index . "-lifeTime") ?>>
                                    <?php echo ($link->getLifetime()) ?>
                                </td>
                                <td contenteditable class="table-item editable" id=<?php echo ("link-" . $index . "-userId") ?>>
                                    <?php echo ($link->getUserID()) ?>
                                </td>
                                <td class="border-neutral-50"><button class="btn btn-primary delete-btn" id=<?php echo ("user-" . $index)
                                    ?>>Delete</button></td>
                                </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

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
    for (let cell of cells) {
        cell.addEventListener("focusout", startEdit);
    }

    let buttons = document.getElementsByClassName("delete-btn");
    for (let btn of buttons) {
        btn.addEventListener("click", deleteRow);
    }
</script>