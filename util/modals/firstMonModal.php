<?php
include_once("../includes/db.inc.php");
$sql = "SELECT name, description, imgPath FROM mons WHERE monID = 1 OR monID = 4 OR monID = 7";
$result = mysqli_query($conn, $sql);
$rows = array();
while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
mysqli_close($conn);
?>
<script>
    var mons = {
        1 : {
            "name" : "<?php echo $rows[0]['name'];?>",
            "img" : "<?php echo $rows[0]['imgPath'];?>"
        },
        2 : {
            "name" : "<?php echo $rows[1]['name'];?>",
            "img" : "<?php echo $rows[1]['imgPath'];?>"
        },
        3 : {
            "name" : "<?php echo $rows[2]['name'];?>",
            "img" : "<?php echo $rows[2]['imgPath'];?>"
        }
    };
</script>
<div class='modal fade' id='monModal'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-body'>
                    <div class='row'>
                        <div class='card-group' >
                            <div class='card' id='monOne' onclick='setChoice(1)'>
                                <img class='card-img-top' src='<?php echo $rows[0]['imgPath'];?>'>
                                <div class='card-body'>
                                    <h5 class='card-title'><?php echo $rows[0]['name'];?></h5>
                                    <p class='card-text'><?php echo $rows[0]['description'];?></p>
                                </div>
                            </div>
                            <div class='card' id='monTwo' onclick='setChoice(2)'>
                                <img class='card-img-top' src='<?php echo $rows[1]['imgPath'];?>'>
                                <div class='card-body'>
                                    <h5 class='card-title'><?php echo $rows[1]['name'];?></h5>
                                    <p class='card-text'><?php echo $rows[1]['description'];?></p>
                                </div>
                            </div>
                            <div class='card' id='monThree' onclick='setChoice(3)'>
                                <img class='card-img-top' src='<?php echo $rows[2]['imgPath'];?>'>
                                <div class='card-body'>
                                    <h5 class='card-title'><?php echo $rows[2]['name'];?></h5>
                                    <p class='card-text'><?php echo $rows[2]['description'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='modal-footer' id='chooseModalFooter' align='center' style='display:none;'>
                    <p id='chooseDialogue'></p>
                    <button id='choiceBtn' type='button' class='btn btn-outline-secondary' name='submit' onclick="makeChoice()">Yes!</button>
                </div>
            </div>
        </div>
    </div>