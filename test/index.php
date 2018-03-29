
<button id="testBtn" type="button">Try me</button>
<div id="testTarget"></div>

<script src="../js/ajax.js"></script>
<script src="test.js"></script>

<?php
include_once("../includes/db.inc.php");
$sql = "SELECT name, description, imgPath FROM mons WHERE monID = 1 OR monID = 4 OR monID = 7";
$result = mysqli_query($conn, $sql);
$rows = array();
while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
mysqli_close($conn);
echo $rows[0]['name'];
echo $rows[1]['name'];
echo $rows[2]['name'];
?>