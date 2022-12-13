<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/dist/style.min.css">
</head>
<body <?= isset($bodyClass) ? "class='$bodyClass'" : '' ?>>
<style>
    footer {
        background-color: lightgray;
    }
    </style>
<nav><?php require(__DIR__ . DIRECTORY_SEPARATOR . 'nav.html.php') ?></nav>
<main><?= $main ?? null ?></main>
<footer>&copy;<?= date('Y') ?> Linke&reg | Handmade with ❤️ in Szczecin, West Pomeranian, Poland</footer>
</body>
</html>
