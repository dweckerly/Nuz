<?php
include_once('../includes/db.inc.php');
$sql = "SELECT * FROM locations";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
?>
<div class="card location-card">
    <div class="card-body">
        <h5 class="card-title"><?php echo $row['name'];?></h5>
        <p class="card-text"><?php echo $row['description'];?></p>
    </div>
</div>
<?php
}
mysqli_close($conn);