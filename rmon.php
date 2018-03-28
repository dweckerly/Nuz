<?php
include_once('layout/header.php');
include_once('includes/db.inc.php');
$num = rand(1, 25);
$sql = "SELECT name, description, imgPath FROM mons WHERE monID = '$num'";
$resut = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resut);
?>
<div class="container" align="center">
    <div class="card text-center" style="width: 18rem;">
        <img class="card-img-top" src="<?php echo $row['imgPath']; ?>">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['name']; ?></h5>
            <p class="card-text"><?php echo $row['description'] ?></p>
        </div>
    </div>
    <br />
    <input type="button" class="btn btn-outline-secondary" value="Again!" onClick="window.location.reload()">
</div>

<?php
mysqli_close($conn);
include_once('layout/footer.php');
?>