<?php
session_start();
$_SESSION['login'] = FALSE;
header("Location: ../");
?>