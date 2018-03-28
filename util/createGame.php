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
        $def = $row['atk'] + (rand(0, 20) - 10);
        $sAtk = $row['atk'] + (rand(0, 20) - 10);
        $sDef = $row['atk'] + (rand(0, 20) - 10);
        $speed = $row['atk'] + (rand(0, 20) - 10);

        $aPool = $row['atkPool'];
        $pPool = $row['perkPool'];

        // get atks
        $sql = "SELECT '0', '1' FROM attackPools WHERE apID = '$aPool'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $atk1 = $row['0'];
        $atk2 = $row['1'];
        
        // get perk
        $rand = rand(1, 2) - 1;
        $sql = "SELECT '$rand' FROM perkPools WHERE ppID = '$pPool'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $perk = $row["$rand"];
        
        // insert into DB
        $sql = "INSERT INTO ownedMons (monID, playerID, name, currentHP, hp, atk, def, sAtk, sDef, speed, perk1, atk1, atk2) VALUES ('$monID', '$pid', '$monName', '$hp', '$hp', '$atk', '$def', '$sAtk', '$sDef', '$speed', '$perk', '$atk1', '$atk2')";
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
