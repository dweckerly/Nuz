<?php
session_start();
if(!isset($_SESSION['gid'])) {
    header("Location: ../error.php?intro=nosesh");
    exit();
}
include_once("../layout/introHeader.php");
?>

    <div class='modal fade' id='nameModal'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-body' align='center'>
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
    </div>
    <div class='modal fade' id='monModal'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-body'>
                    <div class='row'>
                        <div class='card-group' >
                            <div class='card' id='monOne' onclick='confirmChoice(1)'>
                                <img class='card-img-top' src='../img/mons/carnipula.jpg'>
                                <div class='card-body'>
                                    <h5 class='card-title'>Name from DB</h5>
                                    <p class='card-text'>Here would be a description from the DB</p>
                                </div>
                            </div>
                            <div class='card' id='monTwo' onclick='confirmChoice(2)'>
                                <img class='card-img-top' src='../img/mons/embah.jpg'>
                                <div class='card-body'>
                                    <h5 class='card-title'>Name from DB</h5>
                                    <p class='card-text'>Here would be a description from the DB</p>
                                </div>
                            </div>
                            <div class='card' id='monThree' onclick='confirmChoice(3)'>
                                <img class='card-img-top' src='../img/mons/derple.jpg'>
                                <div class='card-body'>
                                    <h5 class='card-title'>Name from DB</h5>
                                    <p class='card-text'>Here would be a description from the DB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='modal-footer' id='chooseModalFooter' align='center' style='display:none;'>
                    <p id='chooseDialogue'></p>
                    <button type='submit' class='btn btn-outline-secondary' id='choiceButton' name='submit' onclick='makeChoice()'>Yes!</button>
                </div>
            </div>
        </div>
    </div>
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
    <script type='text/javascript' src="../js/intro/startGame.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>