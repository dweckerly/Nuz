<?php
session_start();
if(isset($_POST['submit'])) {
    include_once('db.inc.php');
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $pid = $_SESSION['pid'];
    if(empty($name)) {
        $_SESSION['noname'] = TRUE;
        $name = "Bob";
    }
    $_SESSION['name'] = $name;
    $sql = "INSERT INTO players (playerID, name) VALUES ('$pid', '$name')";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header("Location: ../game/intro.g.php");
    exit();
} else {
    header("Location: ../game/intro.g.php");
    exit();
}