<?php
include_once('util/sessionTracker.php');
include_once('layout/header.php');
?>

<section class="main-container">
    <div class="container">
        <div class="jumbotron">
            <!-- will add nice image here -->
            <div class="container" align="center">Something witty...</div>
        </div>
        <div class="row">
            <div class="col-sm index-section">
<?php
session_start();
if($_SESSION['login']) {
    include_once("sections/playerInfo.php");
} else {
    include_once("sections/signup.php");
    include_once("sections/login.php");
    echo "<button id='logorsignBtn' class='btn btn-link' type='button'></button>
    <script src='../js/index.js'></script>";
}
?>
                
            </div>
            <div class="col-sm index-section">
                <h3 class="index-section-header">News</h3>
                <blockquote class="blockquote">
                    <p class="mb-0">Good news, everyone!</p>
                    <footer class="blockquote-footer">Hubert J. Farnsworth</footer>
                </blockquote>
            </div>
        </div>
    </div>
</section>

<?php
include_once('layout/footer.php');
?>