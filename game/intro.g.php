<?php
include_once('../util/sessionTracker.php');
session_start();
if(!isset($_SESSION['gid'])) {
    header("Location: ../error.php?intro=nosesh");
    exit();
}
include_once("../layout/introHeader.php");
include_once("../util/modals/nameModal.php");
include_once("../util/modals/firstMonModal.php");
include_once("../util/modals/nameMonModal.php");
?>
    <section class="main-container">
        <div class="main-wrapper">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-8">
                    <div class="d-block">
                        <div class="row">
                            <div class="col-sm"></div>
                            <div class="col">
                                <p id="startText"></p>
                            </div>
                            <div class="col">
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
    <script src="../js/intro/startGame.js"></script>
<?php
include_once('../layout/gameFooter.php');