<?php
session_start();
$pid = $_SESSION['pid'];
include_once("../../includes/db.inc.php");
$sql = "SELECT * FROM ownedItems WHERE playerID = '$pid'";
$result = mysqli_query($conn, $sql);
$rows = array();
while($val = mysqli_fetch_assoc($result)) {
    $rows[] = $val;
}
?>
<div class='modal fade' id='inventoryModal'>
    <div class='modal-dialog modal-dialog-centered modal-lg'>
        <div class='modal-content'>
            <div class="modal-header">
                <h5 class="modal-title">Inventory</h5><img src="/img/ui/inventory.jpg" height="64px" width="64px" />
            </div>
            <div class='modal-body' align='center'>
                <ul class="list-group">
<?php
foreach($rows as $row) {
    $iid = $row['itemID'];
    $sql = "SELECT * FROM items WHERE itemID = '$iid'";
    $result = mysqli_query($conn, $sql);
    $vals = mysqli_fetch_assoc($result);
?>
                    <li class="list-group-item"><?php echo $vals['name']; ?> <span class="float-right"><?php echo $row['quantity']; ?></li>
<?php
}
?>
                </ul>
            </div>
        </div>
    </div>
</div>


<script src="/js/gameUtil.js"></script>