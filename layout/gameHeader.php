<!DOCTYPE html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link href="../css/style.css" rel="stylesheet">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/ajax.js"></script>
    <title>NuzMon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php 
include_once('../includes/db.inc.php');
$pid = $_SESSION['pid'];
$sql = "SELECT * FROM players WHERE playerID = '$pid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
?>
<body>
    <div id="wrapper" class="sidebar bg-light">
        <div class="overlay"></div>
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav flex-column">
                <li class="nav-item"><button class="btn btn-light">NuzPad</button></li>
                <li class="nav-item"><button class="btn btn-light">NuzMon</button></li>
                <li class="nav-item"><button class="btn btn-light">Inventory</button></li>
                <li class="nav-item"><button class="btn btn-light"><?php echo $name; ?></button></li>
                <li class="nav-item"><button class="btn btn-light">Map</button></li>
                <li class="nav-item"><button class="btn btn-light">Journal</button></li>
                <li><a href="#" class="close">Close</a></li>
            </ul>
        </nav>
    </div>
    <div class="bg-light" id="main-nav">
        <button type="button" class="hamburger open-nav is-closed animated fadeInLeft">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>
        <ul class="nav" id="main-nav-list">
            <li class="nav-item nav-bar" id="dayOrNight"></li>
            <li class="nav-item nav-bar" id="dayCount"></li>
            <li class="nav-item nav-bar" id="time"></li>
            <li class="nav-item nav-bar"><a href='../util/logout.util.php'>Log Out</a></li>
        </ul>
    </div>
    <script src="../js/dayAndTime.js"></script>