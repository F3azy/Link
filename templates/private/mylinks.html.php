<?php
/** @var \App\Service\Router $router */
/** @var \App\Model\User $user */
use App\Model\Link;

$url = basename(__FILE__);
$title = 'Linke&reg;';
$bodyClass = 'index';

//jakoś ogarnąć id użytkownika i wybrać wszystkie jego linki
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

ob_start(); ?>

<body>
    <?php $links = Link::findLinksOfUser($_SESSION["userID"]); ?>
    <h2>Twoje linki</h2>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-white border-b">
                            <tr>
                                <th scope="col">
                                    #
                                </th>
                                <th scope="col">
                                    Full Link
                                </th>
                                <th scope="col">
                                    Short Version
                                </th>
                                <th scope="col">
                                    Last Visit Date
                                </th>
                                <th scope="col">
                                    Number of visits
                                </th>
                                <th scope="col">
                                    Lifetime
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($links as $link): ?>
                            <tr class="tr-item">
                                <?php $index = $link->getLinkID(); ?>
                                <td class="table-index" id=<?php echo ("link-" . $index . "-ogVersion") ?>>
                                    <?php echo ($link->getLinkID()) ?>
                                </td>
                                <td class="table-item" id=<?php echo ("link-" . $index . "-ogVersion") ?>>
                                    <?php echo ($link->getOgVersion()) ?>
                                </td>
                                <td class="table-item" id=<?php echo ("link-" . $index . "-shortVersion") ?>>
                                    <?php echo ($link->getShortVersion()) ?>
                                </td>
                                <td class="table-item" id=<?php echo ("link-" . $index . "-lastVisitDate") ?>>
                                    <?php echo ($link->getLastVisitDate()) ?>
                                </td>
                                <td class="table-item" id=<?php echo ("link-" . $index . "-numOfVisits") ?>>
                                    <?php echo ($link->getNumOfVisits()) ?>
                                </td>
                                <td class="table-item" id=<?php echo ("link-" . $index . "-lifeTime") ?>>
                                    <?php echo ($link->getLifetime()) ?>
                                </td>
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