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
    </div>
</section>

<?php
include_once('layout/footer.php');
?>