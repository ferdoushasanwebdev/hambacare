<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])  && isset($_SESSION['user_role'])) {
    $nav_link = [
        ["url" => "./index.php", "text" => "Home"],
        ["url" => "./dashboard.php", "text" => "Dashboard"],
        ["url" => "./logout.php", "text" => "Logout"]
    ];
} else {
    $nav_link = [
        ["url" => "./index.php", "text" => "Home"],
    ];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HambaCare</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .login-form {
        max-width: 400px;
        margin: 0 auto;
    }
</style>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="./index.php">HambaCare</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <?php foreach ($nav_link as $links) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href=<?php echo ($links['url']) ?>><?php echo ($links['text']) ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>