<?php
session_start();
if(!empty($_SESSION['gid'])) {
    include_once('includes/db.inc.php');
    $gid = $_SESSION['gid'];
    $sql = "SELECT * FROM games WHERE gameID = '$gid'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0) {
        $row = mysqli_fetch_assoc($result);
        $locID = $row['locationID'];
        $day = $row['day'];
        $time = $row['time'];
        $sql = "SELECT * FROM locations WHERE locationID = '$locID'";
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
        $sql = "SELECT * FROM players WHERE playerID = '$pid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $pName = $row['name'];
        $sql = "SELECT * from ownedMons WHERE playerID = '$pid'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        // show player information
?>
<div id="playerInfo" class="shadow p-3 mb-5 bg-white rounded">
    <h2><?php echo $pName; ?></h2>
    <p class="small"><?php echo $loc; ?></p>
    <p class="small"><?php echo $count; ?> NuzMon</p>
</div>
<?php
    } else {
?>
        <div class="shadow p-3 mb-5 bg-white rounded">
            <h4>Game not yet created</h4>
        </div>
    <?php
    } ?>
<form action="../util/loadGame.php" method="POST">
    <button class="btn btn-outline-secondary" type="submit" name="submit">Play Game!</button>
</form>
<?php
    mysqli_close($conn);
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