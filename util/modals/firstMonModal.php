<?php
include_once("../includes/db.inc.php");
$sql = "SELECT name, description, imgPath FROM mons WHERE monID = 1 OR monID = 4 OR monID = 7";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
mysqli_close($conn);
?>
<script>
    var mons = {
        1 : {
            "name" : "<?php echo $row[0];?>",
            "img" : "<?php echo $row[2];?>"
        },
        2 : {
            "name" : "<?php echo $row[3];?>",
            "img" : "<?php echo $row[5];?>"
        },
        3 : {
            "name" : "<?php echo $row[6];?>",
            "img" : "<?php echo $row[8];?>"
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
                                <img class='card-img-top' src='<?php echo $row[2];?>'>
                                <div class='card-body'>
                                    <h5 class='card-title'><?php echo $row[0];?></h5>
                                    <p class='card-text'><?php echo $row[1];?></p>
                                </div>
                            </div>
                            <div class='card' id='monTwo' onclick='setChoice(2)'>
                                <img class='card-img-top' src='<?php echo $row[5];?>'>
                                <div class='card-body'>
                                    <h5 class='card-title'><?php echo $row[3];?></h5>
                                    <p class='card-text'><?php echo $row[4];?></p>
                                </div>
                            </div>
                            <div class='card' id='monThree' onclick='setChoice(3)'>
                                <img class='card-img-top' src='<?php echo $row[8];?>'>
                                <div class='card-body'>
                                    <h5 class='card-title'><?php echo $row[6];?></h5>
                                    <p class='card-text'><?php echo $row[7];?></p>
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