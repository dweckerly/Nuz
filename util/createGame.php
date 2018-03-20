<?php
if(!empty($_GET['gid'])) {
    include_once('../includes/db.inc.php');
    $gid = urldecode($_GET['gid']);
    if(!ctype_digit($gid)) {
        // gid passed is not all digit
        header("Location: ../index.php?g=nodig");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE gameID = '$gid' AND active = '1'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0) {
            echo "Loading...";
            $pid = rand();
            $unique = FALSE;
            // ensure creation of unique pid
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
            session_start();
            $_SESSION['pid'] = $pid;
            header("Location: ../game/intro.g.php");
            exit();
        } else {
            // check for gid in users table returned 0
            header("Location: ../index.php?g=nofound");
            exit();
        }
        mysqli_close($conn);
    }
} else {
    // no gid passed in the url
    header("Location: ../index.php?g=empty");
    exit();
}