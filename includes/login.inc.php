<?php

if(isset($_POST['submit'])) {
    include_once('db.inc.php');
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(empty($email) || empty($password)) {
        header("Location: ../login.php?login=empty");
        exit();
    } else {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: ../login.php?login=invalid");
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck == 1) {
                $row = mysqli_fetch_assoc($result);
                if($row['active'] == 1) {
                    $hash = $row['password'];
                    if(password_verify($password, $hash)) {
                        echo "Success!";
                    } else {
                        header("Location: ../login.php?login=pwd");
                        exit();
                    }
                } else {
                    header("Location: ../login.php?login=inactive");
                    exit();
                }
            } else {
                header("Location: ../login.php?login=notfound");
                exit(); 
            }
        }
    }
    mysqli_close($conn);
} else {
    header("Location: ../login.php");
    exit();
}

