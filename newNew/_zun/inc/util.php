<?php
if(!isset($_SESSION)) {
    session_start();
}

if(!isset($db)) {
    include_once("./inc/db.php");
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_-=+';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function createActiveSesh($user) {
    $sesh = generateRandomString();
    $unique = FALSE;
    while(!$unique) {
        $stmt = $db->query("SELECT * FROM active WHERE sheshId = '$sesh'")->fetchAll();
        if($stmt) {
            $sesh = generateRandomString();
        } else {
            $unique = TRUE;
        }
    }
    $_SESSION['sid'] = $sesh;
    $_SESSION['lastActivity'] = time();
    $stmt = $db->prepare("INSERT INTO active SET uname = ?, seshId = ?")->execute($user, $sesh);
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