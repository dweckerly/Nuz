<?php
//create new player and game
session_start();
if(!empty($_SESSION['gid'])) {
    if(isset($_POST['id'])) {
        echo "Creating player...";
        $pid = rand();
        $unique = FALSE;
        // ensure creation of unique pid
        include_once("../includes/db.inc.php");
        while(!$unique) {
            $sql = "SELECT * FROM games WHERE playerID = '$pid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                $pid = rand();
            } else {
                $unique = TRUE;
            }
        }
        $sql = "INSERT INTO games (gameID, playerID) VALUES ('$gid', '$pid')";
        mysqli_query($conn, $sql);

        $_SESSION['pid'] = $pid;
        if(!empty($_SESSION['name'])) {
            $name = $_SESSION['name'];
        } else {
            $name = 'Bob';
        }
        $sql = "INSERT INTO players (playerID, name) VALUES ('$pid', '$name')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        exit();
    } else {
        header("Location: ../index.php?g=empty");
        exit();
    }
} else {
    header("Location: ../index.php?g=empty");
    exit();
}
