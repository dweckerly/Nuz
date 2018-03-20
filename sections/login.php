<h3>Log In</h3>
<form class="login-form" action="includes/login.inc.php" method="POST">
    <div class="form-group">
        <input type="text" name="email" placeholder="Da emails">
        <input type="text" name="password" placeholder="yur paswerd">
    </div>
    <div class="form-group">
        <button class="btn btn-outline-secondary" type="submit" name="submit">Log In</button>
    </div>
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
<a href='#'>Or Sign Up</a>";