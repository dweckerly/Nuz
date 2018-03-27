<?php

if(isset($_POST['submit'])) {
    include_once('../includes/db.inc.php');
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(empty($email) || empty($password)) {
        mysqli_close($conn);
        header("Location: ../index.php?signup=empty");
        exit();
    } else {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            mysqli_close($conn);
            header("Location: ../index.php?signup=invalid");
            exit();
        } else {
            $sql = "SELECT * FROM users where email = '$email'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                mysqli_close($conn);
                header("Location: ../index.php?signup=email");
                exit();
            } else {
                if(strlen($password) < 4) {
                    mysqli_close($conn);
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
                        if($resultCheck > 0) {
                            $game = rand();
                        } else {
                            $unique = TRUE;
                        }
                    }
                    $sql = "INSERT INTO users (email, password, gameID) VALUES ('$email', '$hashedPwd', '$game')";
                    mysqli_query($conn, $sql);
                    mysqli_close($conn);
                    session_start();
                    $_SESSION['login'] = TRUE;
                    $_SESSION['lastActivity'] = time();
                    $_SESSION['expire'] = 3*60*60;
                    $_SESSION['gid'] = $game;
                    header("Location: ../");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}