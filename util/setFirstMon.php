<?php
session_start();
if(isset($_POST['id'])) {
    include_once('../includes/db.inc.php');
    $gid = $_SESSION['gid'];
    $sql = "";
}