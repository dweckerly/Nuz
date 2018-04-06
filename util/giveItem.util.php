<?php
if(!isset($_POST['id'])) {
    exit();
} else {
    include_once('../includes/db.inc.php');
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $sql = "SELECT * FROM items WHERE itemID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);

    if(isset($_POST['q'])) {
        $q = mysqli_real_escape_string($conn, $_POST['q']);
    } else {
        $q = 1;
    }
    session_start();
    $pid = $_SESSION['pid'];
    $sql = "INSERT INTO ownedItems (itemID, playerID, quantity) VALUES ('$id', '$pid', '$q')";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    exit();
}