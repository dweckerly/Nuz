<?php
// need to set up mailing system for notifications if 
// an error occurrs at this stage...
session_start();
if(!isset($_SESSION['gid']) || !isset($_SESSION['pid'])) {
    header("Location: ../error.php?intro=nosesh");
    exit();
} else {
    $gid = $_SESSION['gid'];
    $pid = $_SESSION['pid'];
    if(!ctype_digit($gid) || !ctype_digit($pid)) {
        header("Location: ../error.php?intro=nodig");
        exit();
    } else {
        include_once('../includes/db.inc.php');
        $sql = "SELECT * FROM games WHERE gameID = '$gid' AND playerID = '$pid'";
        $result = mysqli_query($conn, $sql);
        $resCheck = mysqli_num_rows($result);
        if($resCheck == 0) {
            header("Location: ../error.php?intro=nofound");
            exit();
        } elseif($resCheck > 1) {
            header("Location: ../error.php?intro=dberr");
            exit();
        } else {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['loc'] = $row['locationID'];
            $_SESSION['day'] = $row['day'];
            $_SESSION['time'] = $row['time'];
        }

        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
    <title>NuzMon</title>
</head>

<body onload="start()">
    <nav class="navbar sticky-top">
        <h3>NuzMon</h3>
        <span class="navbar-text"><div class="d-inline" id="dayCount">Day 1</div>&nbsp;<div class="d-inline" id="time">07:00</div>&nbsp;<div class="d-inline" id="dayOrNight">Day</div></span>
        <button class="btn" type="submit" disabled>Log out</button>
    </nav>
    <div class="row">
        <div class="col-md-2 d-none d-md-block sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><button class="btn"><img src="../img/ui/dex.jpg" class="img-fluid"></button></li>
                    <li class="nav-item"><button class="btn"><img src="../img/ui/mons.jpg" class="img-fluid"></button></li>
                    <li class="nav-item"><button class="btn"><img src="../img/ui/inventory.jpg" class="img-fluid"></button></li>
                    <li class="nav-item"><button class="btn"><img src="../img/ui/player.jpg" class="img-fluid"></button></li>
                    <li class="nav-item"><button class="btn"><img src="../img/ui/journal.jpg" class="img-fluid"></button></li>
                </ul>
            </div>
        </div>
    </div>
    <?php
    if(!isset($_SESSION['name'])) {
        echo "<script type='text/javascript' src='../js/namePlayer.js'></script>
    <div class='modal fade' id='nameModal'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-body'>
                    <form class='name-form' action='../includes/player.inc.php' method='POST'>
                        <div class='form-group'>
                            <input type='text' name='name' placeholder='Your name'>
                        </div>
                        <div class='form-group'>
                            <button type='submit' class='btn btn-outline-secondary' name='submit'>Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>";
    } else {
        echo "<div class='modal fade' id='monModal'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-body'>
                    <div class='row'>
                        <div class='card-group' >
                            <div class='card' id='monOne'>
                                <img class='card-img-top' src='../img/mons/muskip.jpg'>
                                <div class='card-body'>
                                    <h5 class='card-title'>Name from DB</h5>
                                    <p class='card-text'>Here would be a description from the DB</p>
                                </div>
                            </div>
                            <div class='card' id='monTwo'>
                                <img class='card-img-top' src='../img/mons/embah.jpg'>
                                <div class='card-body'>
                                    <h5 class='card-title'>Name from DB</h5>
                                    <p class='card-text'>Here would be a description from the DB</p>
                                </div>
                            </div>
                            <div class='card' id='monThree'>
                                <img class='card-img-top' src='../img/mons/derple.jpg'>
                                <div class='card-body'>
                                    <h5 class='card-title'>Name from DB</h5>
                                    <p class='card-text'>Here would be a description from the DB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='modal-footer' id='chooseModalFooter' style='display:none;'>
                    <p id='chooseDialogue'></p>
                    <button type='submit' class='btn btn-outline-secondary' id='choiceButton' name='submit'>Yes!</button>
                </div>
            </div>
        </div>
    </div>";
        if(isset($_SESSION['noname'])) {
            echo "<script type='text/javascript'>
            var txt = [\"Silent type, huh? Guess I'll just call you... " . $_SESSION['name'] . ".\" ,
                \"Don't worry though, you can change your name later.\",
                \"Whadaya say we find you a pardner? It's been tough times around here and we only got three 'mons left.\",
                \"Go ahead and choose one to take with you.\"];
        </script>";
        } else {
            echo "<script type='text/javascript'>
            var txt = [\"Well, nice to meet you, " . $_SESSION['name'] . "! Officially and all.\",
                \"Whadaya say we find you a pardner? It's been tough times around here and we only got three 'mons left.\",
                \"Go ahead and choose one to take with you.\"];
        </script>";
        }
    }
    ?>
    
    <section class="main-container">
        <div class="main-wrapper">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-8">
                    <div class="d-block">
                        <div class="row">
                            <div class="col-sm"></div>
                            <div class="col-sm">
                                <p id="startText"></p>
                            </div>
                            <div class="col-sm">
                                <img src="../img/people/pete-moss.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="d-block text-center">
                        <button class="btn btn-outline-secondary" id="nextButton" onclick="nextText()">...></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type='text/javascript' src="../js/uiEffects.js"></script>
    <script type='text/javascript' src="../js/startGame.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>