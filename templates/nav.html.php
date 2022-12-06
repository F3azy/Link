<?php
/** @var $router \App\Service\Router */

?>
<ul>
    <li><a href="<?= $router->generatePath('') ?>">Home</a></li>
    <li><a href="<?= $router->generatePath('post-index') ?>">Posts</a></li>
    <li><a href="<?= $router->generatePath('public-addLink') ?>">Add Link</a></li>
</ul>
<?php
