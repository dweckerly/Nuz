<?php
//create new player and game
session_start();
if(!empty($_SESSION['gid'])) {
    if(isset($_POST['pName']) && isset($_POST['monID'])) {
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
        $gid = $_SESSION['gid'];
        $sql = "INSERT INTO games (gameID, playerID) VALUES ('$gid', '$pid')";
        mysqli_query($conn, $sql);
        $_SESSION['pid'] = $pid;
        $_SESSION['name'] = mysqli_real_escape_string($conn, $_POST['pName']);
        $name = $_SESSION['name'];
        
        // create player
        $sql = "INSERT INTO players (playerID, name) VALUES ('$pid', '$name')";
        mysqli_query($conn, $sql);

        // add mon to owned mons
        $monID = $_POST['monID'];
        $monName = mysqli_real_escape_string($conn, $_POST['monName']);
        $sql = "SELECT hp, atk, def, sAtk, sDef, speed, atkPool, perkPool FROM mons WHERE monID = '$monID'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        // get stats
        $hp = $row['hp'] + (rand(0, 20) - 10);
        $atk = $row['atk'] + (rand(0, 20) - 10);
        $def = $row['def'] + (rand(0, 20) - 10);
        $sAtk = $row['sAtk'] + (rand(0, 20) - 10);
        $sDef = $row['sDef'] + (rand(0, 20) - 10);
        $speed = $row['speed'] + (rand(0, 20) - 10);

        $aPool = $row['atkPool'];
        $pPool = $row['perkPool'];

        // get atks
        $sql = "SELECT * FROM attackPools WHERE apID = '$aPool'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $atk1 = $row['a1'];
        $atk2 = $row['a2'];
        
        // get perk
        $rand = rand(1, 2) - 1;
        $sql = "SELECT * FROM perkPools WHERE ppID = '$pPool'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if($rand == 1) {
            $perk = $row['p1'];
        } else {
            $perk = $row['p2'];
        }
        
        // insert into DB
        $sql = "INSERT INTO ownedMons (monID, playerID, name, currentHP, hp, atk, def, sAtk, sDef, speed, perk1, atk1, atk2, inParty) VALUES ('$monID', '$pid', '$monName', '$hp', '$hp', '$atk', '$def', '$sAtk', '$sDef', '$speed', '$perk', '$atk1', '$atk2', 1)";
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
