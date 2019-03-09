<?php
session_start();

if(!isset($db)) {
    include_once("./inc/db.php");
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function createActiveSesh($user) {
    $sesh = generateRandomString();
    $unique = FALSE;
    while(!$unique) {
        $stmt = $db->prepare("SELECT * FROM active WHERE seshId = ?");
        $stmt->execute([$sesh]);
        if($stmt->rowCount() > 0) {
            $sesh = generateRandomString();
        } else {
            $unique = TRUE;
        }
    }
    $_SESSION['sid'] = $sesh;
    $_SESSION['lastActivity'] = time();
    $db->prepare("INSERT INTO active (uname, seshId) VALUES (?, ?)")->execute([$user, $sesh]);
}

function isSeshActive() {
    if(isset($_SESSION['sid'])) {
        if($_SESSION['lastActivity'] > time()-(3*60*60)) {
            return TRUE;
        } else {
            $db->prepare("DELETE FROM active WHERE seshId = ?")->execute([$_SESSION['sid']]);
        } 
    }
    return FALSE;
}