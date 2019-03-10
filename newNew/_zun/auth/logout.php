<?php
require "../inc/db.php";
require "../inc/util.php";
$util = new Util($db);
$util->removeSesh();
header("Location: ../");