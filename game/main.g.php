<?php
include_once('../util/sessionTracker.php');
session_start();
if(!isset($_SESSION['gid'])) {
    header("Location: ../error.php?intro=nosesh");
    exit();
}
include_once("../layout/gameHeader.php");
?>
<div id="mainContainer">
    <?php
    include_once('views/map.php');
    include_once('views/location.php');
    ?>
</div>
<?php
include_once("../layout/gameFooter.php");
?>