<?php
if(!empty($_SESSION['gid'])) {
    include_once("../includes/db.inc.php");
    $gid = $_SESSION['gid'];
    $sql = "SELECT * FROM games WHERE gameID = '$gid'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0) {
        $row = mysqli_fetch_assoc($result);
        $locID = $row['locationID'];
        $day = $row['day'];
        $time = $row['time'];
        $sql = "SELECT name FROM locations WHERE locationID = '$locID'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $loc = $row['name'];
        if(empty($_SESSION['pid'])){
            $pid = $row['playerID'];
            $_SESSION['pid'] = $pid;
        } else {
            $pid = $_SESSION['pid'];
        }
        // get player name from player table
        // show player information
    } else {?>

    <?php
        // show create game dialogue
    } ?>
<form action="../util/loadGame.php" method="POST">
    <button class="btn btn-outline-secondary" type="submit" name="submit">Play Game!</button>
</form>
<?php
} else {
    // empty gid in session... ¯\_(ツ)_/¯
    ?>
    <p>You ain't got no info...</p>
    <?php
}

/*
 * Name, location, time, number of mons, (?)
 * button to start game
 *
 * if no info give option to start new game
 */
?>