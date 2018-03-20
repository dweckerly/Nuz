<?php
include_once('layout/header.php');
?>

<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-sm">
<?php
session_start();
if(isset($_SESSION['login'])) {
    if($_SESSION['login'] == TRUE) {

        // At some point would like to put player
        // info right here...
        
    } else {
        include_once("sections/login.php");
    }
} else {
    include_once("sections/signup.php");
}
?>
            </div>
            <div class="col-sm">
                <h3>News</h3>
            </div>
        </div>
    </div>
</section>

<?php
include_once('layout/footer.php');
?>