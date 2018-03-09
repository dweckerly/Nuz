<?php
include_once('layout/header.php');
?>

<section class="main-container">
    <div class="main-wrapper">
        <h3>Log In</h3>
        <form class="login-form" action="includes/login.inc.php" method="POST">
            <input type="text" name="email" placeholder="Da emails">
            <input type="text" name="password" placeholder="yur paswerd">
            <button type="submit" name="submit">Log In</button>
        </form>
        <?php
        if(!empty($_GET['login'])) {
            $logErr = $_GET['login'];
            if($logErr == 'notfound') {
                echo "<div class='alert alert-danger' role='alert'>No account found.</div>";
            } elseif($logErr == 'inactive') {
                echo "<div class='alert alert-danger' role='alert'>This account has been deactivated.</div>";
            } elseif($logErr == 'pwd') {
                echo "<div class='alert alert-danger' role='alert'>Password doesn't match.</div>";
            } elseif($logErr == 'empty') {
                echo "<div class='alert alert-danger' role='alert'>Fill out both of these ^^</div>";
            } elseif($logErr == 'invalid') {
                echo "<div class='alert alert-danger' role='alert'>That email looks a little funny...</div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>" . $logErr ."</div>";
            }
        }
        ?>
    </div>
</section>

<?php
include_once('layout/footer.php');
?>