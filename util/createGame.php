<?php
if(!empty($_GET['gid'])) {
    include_once('../includes/db.inc.php');
    $gid = $_GET['gid'];
    $sql = "SELECT * FROM users WHERE gameID = '$gid' AND active = '1'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0) {
        echo "Loading...";
        //$sql = "INSERT INTO games "
    } else {
        header("Location: ../index.php");
        exit();
    }
    mysqli_close($conn);
} else {
    header("Location: ../index.php");
    exit();
}