<?php
session_start();
$_SESSION['login'] = FALSE;
session_destroy();
header("Location: ../");
?>