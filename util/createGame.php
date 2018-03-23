<?php
//create new player and game
session_start();
if(!empty($_SESSION['gid'])) {
    if(isset($_POST['pName']) && isset($_POST['monID'])) {
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
        // create game
        $sql = "INSERT INTO games (gameID, playerID) VALUES ('$gid', '$pid')";
        mysqli_query($conn, $sql);
        $_SESSION['pid'] = $pid;
        $_SESSION['name'] = $_POST['pName'];
        $name = $_SESSION['name'];
        
        // create player
        $sql = "INSERT INTO players (playerID, name) VALUES ('$pid', '$name')";
        mysqli_query($conn, $sql);

        // add mon to owned mons
        $monID = $_POST['monID'];
        $sql = "SELECT hp, atk, def, sAtk, sDef, speed FROM mons WHERE monID = '$monID'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $perk = "dummy perk";
        $atk1 = "dummy Atk";
        $hp = $row['hp'] + (rand(0, 20) - 10);
        $atk = $row['atk'] + (rand(0, 20) - 10);
        $def = $row['atk'] + (rand(0, 20) - 10);
        $sAtk = $row['atk'] + (rand(0, 20) - 10);
        $sDef = $row['atk'] + (rand(0, 20) - 10);
        $speed = $row['atk'] + (rand(0, 20) - 10);
        $monName = $_POST['monName'];
        $sql = "INSERT INTO ownedMons (monID, playerID, name, currentHP, hp, atk, def, sAtk, sDef, speed, perk1, atk1) VALUES ('$monID', '$pid', '$monName', '$hp', '$hp', '$atk', '$def', '$sAtk', '$sDef', '$speed', '$perk', '$atk1')";
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
