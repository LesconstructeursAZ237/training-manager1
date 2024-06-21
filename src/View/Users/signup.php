<?php

require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\UsersController;

(new UsersController())->signUp();

/**
 * @var string $message Sample message
 */

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page de connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="./../../../assets/js/nav.js" defer></script>
    <script src="./../../../assets/js/login.js" defer></script>
    <style>
        .error {
            border: 2px solid red;
        }
    </style>
</head>

<body class="">
<?= $message ?>
</body>
</html>
<?php
session_start();
session_destroy();
header('Location: index.php');
?>