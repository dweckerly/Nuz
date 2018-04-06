<?php

include_once("../includes/db.inc.php");
if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM items WHERE itemID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
} else {
    echo "error...";
}


mysqli_close($conn);

?>