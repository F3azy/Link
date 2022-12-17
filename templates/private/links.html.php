<?php
/** @var \App\Service\Router $router */
/** @var \App\Model\Link $link */

$title = 'Linke&reg;';
$bodyClass = 'index';

ob_start(); ?>
<body>
    <h1>Linki</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>OG Version</th>
            <th>Short Version</th>
            <th>Last Visit Date</th>
            <th>Number of visits</th>
            <th>Lifetime</th>
        </tr>
        <?php foreach($links as $link): ?>
            <tr>
                <?php $index = $link->getLinkID(); ?>
                <td id=<?php echo("link-" . $index . "-linkId")?>><?php echo($link->getLinkID()) ?></td>
                <td id=<?php echo("link-" . $index . "-ogVersion")?>><?php echo($link->getOgVersion()) ?></td>
                <td id=<?php echo("link-" . $index . "-shortVersion")?>><?php echo($link->getShortVersion()) ?></td>
                <td id=<?php echo("link-" . $index . "-lastVisitDate")?>><?php echo($link->getLastVisitDate()) ?></td>
                <td id=<?php echo("link-" . $index . "-numOfVisits")?>><?php echo($link->getNumOfVisits()) ?></td>
                <td id=<?php echo("link-" . $index . "-lifeTime")?>><?php echo($link->getLifetime()) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
?>