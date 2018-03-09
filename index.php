<?php
include_once('layout/header.php');
?>

<section class="main-container">
    <div class="main-wrapper">
        <h3>Sign Up</h3>
        <form class="signup-form" action="includes/signup.inc.php" method="POST">
            <input type="text" name="email" placeholder="Da emails">
            <input type="text" name="password" placeholder="yur paswerd">
            <button type="submit" name="submit">Create Account</button>
        </form>
    </div>
</section>

<?php
include_once('layout/footer.php');
?>