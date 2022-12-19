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
          @apply no-underline cursor-pointer;
        }
        a:hover,  
        a:active {
        }
        button a:hover {
          @apply no-underline;
        }
        th {
          @apply text-sm font-medium text-gray-900 px-6 py-4 text-left bg-white;
        }
      }
      @layer components {
        .tr-item {
          @apply bg-neutral-50 border border-pink-300 transition duration-300 ease-in-out hover:bg-gray-100;
        }
        .table-index {
          @apply px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900;
        }
        .table-item {
          @apply text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap;
        }
        .btn {
          @apply px-4 py-2 text-center font-medium transition duration-150 ease-in-out cursor-pointer rounded;
        }
        .btn-noround {
          @apply px-4 py-2 text-center font-medium transition duration-150 ease-in-out cursor-pointer w-40;
        }
        .btn:disabled,
        .btn[disabled] {
          @apply opacity-50 cursor-not-allowed;
        }
        .menu-item {
          @apply text-neutral-900 bg-neutral-50 hover:bg-pink-300;
        }
        .btn-primary {
          @apply text-neutral-50 bg-pink-500 shadow shadow-pink-900/25 hover:bg-pink-300;
        }
        .btn-secondary {
          @apply text-neutral-900 bg-neutral-50 shadow shadow-black/25 hover:bg-neutral-200;
        }
        .btn-outline {
          @apply text-neutral-900 bg-transparent border border-neutral-900 hover:bg-neutral-100;
        }
        .btn-outline-primary {
          @apply text-pink-900 bg-transparent border border-pink-900 hover:bg-pink-100;
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
          @apply text-pink-900 bg-transparent hover:bg-pink-200 border-none;
        }
        .btn-flat-danger {
          @apply text-red-900 bg-transparent hover:bg-red-200 border-none;
        }
        .input {
          @apply w-full rounded border border-neutral-300 bg-neutral-50 px-4 py-3 placeholder:text-neutral-400;
        }
      }
    </style>

</head>

<body class="bg-neutral-50">
  <nav>
    <?php require(__DIR__ . DIRECTORY_SEPARATOR . 'nav.html.php') ?>
  </nav>
  <main>
    <div class="flex flex-row h-screen">
      <?php require(__DIR__ . DIRECTORY_SEPARATOR . 'sidenav.html.php') ?>
      <div class="flex flex-col gap-6 w-full items-center py-6">
        <?= $main ?? null ?>
      </div>
    </div>
  </main>

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

  <footer class="h-full text-center font-bold">&copy;<?= date('Y') ?> Linke&reg | Handmade with ❤️ in Szczecin, West
      Pomeranian, Poland</footer>
</body>

</html>