<?php
require "inc/db.php";
require "inc/util.php";
if(isset($_POST['submit'])) {  
    $uname = $_POST['uname'];
    $password = $_POST['password'];
    if(empty($uname) || empty($password)) {
        // redirect for empty fields
        header("Location: index.php?signup=empty");
        exit();
    } else {
        $stmt = $db->prepare("SELECT * FROM users WHERE uname = ?");
        $stmt->execute([$uname]);
        if($stmt->rowCount() > 0) {
            // redirect for non-unique username
            header("Location: index.php?signup=unameTaken");
            exit();
        } else {
            // hash and insert credentials into DB
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $db->prepare("INSERT INTO users SET uname = ?, pwd = ?")->execute([$uname, $hash]);
            $util = new Util($db);
            $util->createActiveSesh($uname);
            header("Location: index.php");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}