<?php
// need to set up mailing system for notifications if 
// an error occurrs at this stage...
session_start();
if(!isset($_SESSION['gid']) || !isset($_SESSION['pid'])) {
    header("Location: ../error.php?intro=nosesh");
    exit();
} else {
    $gid = $_SESSION['gid'];
    $pid = $_SESSION['pid'];
    if(!ctype_digit($gid) || !ctype_digit($pid)) {
        header("Location: ../error.php?intro=nodig");
        exit();
    } else {
        include_once('../includes/db.inc.php');
        $sql = "SELECT * FROM games WHERE gameID = '$gid' AND playerID = '$pid'";
        $result = mysqli_query($conn, $sql);
        $resCheck = mysqli_num_rows($result);
        if($resCheck == 0) {
            header("Location: ../error.php?intro=nofound");
            exit();
        } elseif($resCheck > 1) {
            header("Location: ../error.php?intro=dberr");
            exit();
        } else {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['loc'] = $row['locationID'];
            $_SESSION['day'] = $row['day'];
            $_SESSION['time'] = $row['time'];
        }

        mysqli_close($conn);
    }
}
include("html/intro.html");