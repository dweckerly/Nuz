<?php
if(isset($_POST['submit'])){
    session_start();
    if(!empty($_SESSION['gid'])) {
        include_once('../includes/db.inc.php');
        $gid = $_SESSION['gid'];

        //first check if user is active...
        $sql = "SELECT * FROM users WHERE gameID = '$gid' AND active = '1'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0) {
            echo "Loading...";

            //check if game exists, if not create one
            $sql = "SELECT * FROM games WHERE gameID = '$gid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                echo "Found game...";
                // load game here
                $row = mysqli_fetch_assoc($result);
                $pid = $row['playerID'];
                $_SESSION['pid'] = $pid;
                mysqli_close($conn);
                // send to main game
                header("Location: ../game/main.g.php");
                exit();
            } else {
                mysqli_close($conn);
                // send to intro scene
                header("Location: ../game/intro.g.php");
                exit();
            }
        } else {
            // check for gid in users table returned 0
            header("Location: ../index.php?g=nofound");
            mysqli_close($conn);
            exit();
        }
        mysqli_close($conn);
    } else {
        // no gid passed in the session
        header("Location: ../index.php?g=empty");
        exit();
    }
} else {
    echo "I like your face...";
}
