<?php
session_start();
if(isset($_POST['submit'])) {
    include_once('db.inc.php');
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(empty($email) || empty($password)) {
        mysqli_close($conn);
        header("Location: ../login.php?login=empty");
        exit();
    } else {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            mysqli_close($conn);
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
                        echo "Loading...";
                        $_SESSION['login'] = TRUE;
                        $_SESSION['gid'] = $row['gameID'];
                        $gid = $_SESSION['gid'];
                        $sql = "SELECT playerID FROM games WHERE gameID = '$gid'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $_SESSION['pid'] = $row['playerID'];
                        $_SESSION['loc'] = $row['locationID'];
                        $_SESSION['day'] = $row['day'];
                        $_SESSION['time'] = $row['time'];
                        mysqli_close($conn);
                        // add game redirect logic here
                        // preferably utilizing SESSION
                    } else {
                        mysqli_close($conn);
                        header("Location: ../login.php?login=pwd");
                        exit();
                    }
                } else {
                    mysqli_close($conn);
                    header("Location: ../login.php?login=inactive");
                    exit();
                }
            } else {
                mysqli_close($conn);
                header("Location: ../login.php?login=notfound");
                exit(); 
            }
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}