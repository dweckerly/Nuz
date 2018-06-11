<?php
session_start();
if($_SESSION['login']) {
    if($_SESSION['lastActivity'] < time()-$_SESSION['expire']) {
        $_SESSION['login'] = FALSE;
        header('Location: ../');
    } else{
        $_SESSION['lastActivity'] = time();
    }
}
