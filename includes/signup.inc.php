<?php

if(isset($_POST['submit'])) {
    include_once('db.inc.php');
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(empty($email) || empty($password)) {
        header("Location: ../index.php?signup=empty");
        exit();
    } else {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: ../index.php?signup=invalid");
            exit();
        } else {
            $sql = "SELECT * FROM users where email = '$email'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                header("Location: ../index.php?signup=email");
                exit();
            } else {
                if(strlen($password) < 4) {
                    header("Location: ../index.php?signup=pwd");
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    $game = rand();
                    $unique = FALSE;
                    while(!$unique) {
                        $sql = "SELECT * FROM users WHERE gameID = '$game'";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if($resultCheck == 0) {
                            $unique = TRUE;
                        } else {
                            $game = rand();
                        }
                    }
                    $sql = "INSERT INTO users (email, password, gameID) VALUES ('$email', '$hashedPwd', '$game')";
                    mysqli_query($conn, $sql);
                    header("Location: ../util/createGame.php?gid=$game");
                }
            }
        }
    }
    mysqli_close($conn);
} else {
    header("Location: ../index.php");
    exit();
}