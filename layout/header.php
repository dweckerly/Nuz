<?php
session_start();
if(!isset($_SESSION['login'])) {
    $_SESSION['login'] == FALSE;
}
?>
<!DOCTYPE html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link href="../css/style.css" rel="stylesheet">
    <script src="../js/ajax.js"></script>
    <script src="../js/uiEffects.js"></script>
    <title>NuzMon</title>
</head>
<body>
<nav class="navbar navbar-light navbar-expand-lg text-dark">
    <a class="navbar-brand" href="../">NuzMon</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item text-right">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item text-right">
                <a class="nav-link" href="rmon.php">Random 'Mon</a>
            </li>
            <?php 
            if($_SESSION['login']) {
                echo "<li class='nav-item text-right'>
                <a class='nav-link' href='util/logout.util.php'>Log Out</a>
            </li>";
            }
            ?>
        </ul>
    </div>
</nav>