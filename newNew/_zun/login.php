<?php
if(isset($_POST['submit'])) {
    require_once('inc/util.php');
    $stmt = $db->prepare("SELECT * FROM users WHERE uname = ?");
    $result = $stmt->execute([$_POST['username']])->fetch();
    if($res) {
        if(password_verify($_POST['password'], $res->pwd)) {
            // valid login
            createActiveSesh($res['uname']);
        } else {
            //invalid password
            header("Location: /index.php?login=pwd");
            exit();
        }
    } else {
        // invalid username
        header("Location: /index.php?login=nouname");
        exit();
    }
}
