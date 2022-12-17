<?php
/** @var \App\Service\Router $router */
/** @var \App\Model\User $user */
use App\Model\Link;
$title = 'Linke&reg;';
$bodyClass = 'index';

//jakoś ogarnąć id użytkownika i wybrać wszystkie jego linki
session_start();
ob_start(); ?>
<body>
    
    Tu będą linki użytkownika
    <?php $links =  Link::findLinksOfUser($_SESSION["userID"]); ?>
    <h2>Twoje linki</h2>
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
            
        </tr>
        <?php foreach($links as $link): ?>
            <tr>
                <?php $index = $link->getLinkID(); ?>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-ogVersion")?>><?php echo($link->getOgVersion()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-shortVersion")?>><?php echo($link->getShortVersion()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-linkPasswd")?>><?php echo($link->getLinkPasswd()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-createDate")?>><?php echo($link->getCreateDate()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-editDate")?>><?php echo($link->getEditDate()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-lastVisitDate")?>><?php echo($link->getLastVisitDate()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-numOfVisits")?>><?php echo($link->getNumOfVisits()) ?></td>
                <td contenteditable class="editable" id=<?php echo("link-" . $index . "-lifeTime")?>><?php echo($link->getLifetime()) ?></td>
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