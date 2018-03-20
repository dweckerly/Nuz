<?php
if(!empty($_SESSION['gid'])) {
    include_once("../includes/db.inc.php");
    $gid = $_SESSION['gid'];
    $sql = "SELECT * FROM games WHERE gameID = '$gid'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0) {
        // show player information
    } else {
        // show create game dialogue
    }
} else {
    // empty gid in session... ¯\_(ツ)_/¯
}

/*
 * Name, location, time, number of mons, (?)
 * button to start game
 *
 * if no info give option to start new game
 */
?>
<p>This is where retrieved information about the player will be</p>

<form action="../util/loadGame.php" method="POST">
    <button class="btn btn-outline-secondary" type="submit" name="submit">Play Game!</button>
</form>