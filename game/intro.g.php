<?php
session_start();
if(!isset($_SESSION['gid'])) {
    header("Location: ../error.php?intro=nosesh");
    exit();
}
include_once("../layout/introHeader.php");
include_once("../util/modals/nameModal.php");
include_once("../util/modals/firstMonModal.php");
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type='text/javascript' src="../js/intro/startGame.js"></script>
</body>