<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>

    <style type="text/tailwindcss">
        @tailwind base;
      @tailwind components;
      @tailwind utilities;
      @layer base {
        *,
        *::before,
        *::after {
          @apply box-border antialiased;
        }
        body {
          @apply w-full h-full p-0 m-0 text-neutral-900 bg-white;
        }
        h1 {
          @apply text-5xl font-bold;
        }
        h2 {
          @apply text-4xl font-bold;
        }
        h3 {
          @apply text-3xl font-bold;
        }
        h4 {
          @apply text-2xl font-bold;
        }
        h5 {
          @apply text-xl font-bold;
        }
        h6 {
          @apply text-lg font-bold;
        }
        a {
          @apply no-underline cursor-pointer text-indigo-900;
        }
        a:hover,
        a:active {
          @apply underline;
        }
        button a:hover {
          @apply no-underline;
        }
      }
      @layer components {
        .btn {
          @apply px-4 py-2 text-center font-medium transition duration-150 ease-in-out cursor-pointer rounded-lg;
        }
        .btn:disabled,
        .btn[disabled] {
          @apply opacity-50 cursor-not-allowed;
        }
        .btn-primary {
          @apply text-indigo-900 bg-indigo-100 shadow shadow-indigo-900/25 hover:bg-indigo-200;
        }
        .btn-secondary {
          @apply text-neutral-900 bg-neutral-50 shadow shadow-black/25 hover:bg-neutral-200;
        }
        .btn-outline {
          @apply text-neutral-900 bg-transparent border border-neutral-900 hover:bg-neutral-100;
        }
        .btn-outline-primary {
          @apply text-indigo-900 bg-transparent border border-indigo-900 hover:bg-indigo-100;
        }
        .btn-danger {
          @apply text-red-900 bg-red-50 shadow shadow-red-900/25 hover:bg-red-200;
        }
        .btn-success {
          @apply text-green-900 bg-green-50 shadow shadow-green-900/25 hover:bg-green-200;
        }
        .btn-flat-secondary {
          @apply text-neutral-900 bg-transparent hover:bg-neutral-200 border-none;
        }
        .btn-flat-primary {
          @apply text-indigo-900 bg-transparent hover:bg-indigo-200 border-none;
        }
        .btn-flat-danger {
          @apply text-red-900 bg-transparent hover:bg-red-200 border-none;
        }
        .input {
          @apply w-full rounded-lg border border-neutral-300 bg-neutral-50 px-4 py-3 placeholder:text-neutral-400;
        }
      }
    </style>

</head>
<body <?= isset($bodyClass) ? "class='$bodyClass'" : '' ?>>
<style>
    footer {
        background-color: lightgray;
    }
    </style>
<nav><?php require(__DIR__ . DIRECTORY_SEPARATOR . 'nav.html.php') ?></nav>
<main><?= $main ?? null ?></main>

<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION['shortUrl']) && !empty($_SESSION['shortUrl'])) {
        if(isset($_SESSION['password']) && !empty($_SESSION['password'])) {
            echo '<script>alert("Original Link: '.$_SESSION['ogVersion'].'\nYour Link: '.$_SESSION['shortUrl'].'\nYour password: '.$_SESSION['password'].'");</script>';
            unset($_SESSION['ogVersion']);
            unset($_SESSION['shortUrl']);
            unset($_SESSION['password']);
        }
        else {
            echo '<script>alert("Original Link: '.$_SESSION['ogVersion'].'\nYour Link: '.$_SESSION['shortUrl'].'");</script>';
            unset($_SESSION['ogVersion']);
            unset($_SESSION['shortUrl']);
        }
    }
?>

<footer>&copy;<?= date('Y') ?> Linke&reg | Handmade with ❤️ in Szczecin, West Pomeranian, Poland</footer>
</body>
</html>
