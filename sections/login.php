<?php
if(!empty($_GET['login'])) {
    echo "<script>var login = true; </script>";
} else {
    echo "<script>var login = false; </script>";
}
?>
<form id="loginForm" class="login-form" action="../util/login.util.php" method="POST">
    <h3 class="index-section-header">Log In</h3>
    <div class="form-group">
        <input type="text" name="email" placeholder="Da emails">
        <input type='password' name="password" placeholder="yur paswerd">
    </div>
    <div class="form-group">
        <button class="btn btn-outline-secondary" type="submit" name='submit'>Log In</button>
    </div>
</form>
<?php
if(!empty($_GET['login'])) {
    $logErr = $_GET['login'];
    if($logErr == 'notfound') {
        echo "<div id='errMess' class='alert alert-danger' role='alert'>No account found.</div>";
    } elseif($logErr == 'inactive') {
        echo "<div id='errMess' class='alert alert-danger' role='alert'>This account has been deactivated.</div>";
    } elseif($logErr == 'pwd') {
        echo "<div id='errMess' class='alert alert-danger' role='alert'>Password doesn't match.</div>";
    } elseif($logErr == 'empty') {
        echo "<div id='errMess' class='alert alert-danger' role='alert'>Fill out both of these ^^</div>";
    } elseif($logErr == 'invalid') {
        echo "<div id='errMess' class='alert alert-danger' role='alert'>That email looks a little funny...</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>" . $logErr ."</div>";
    }
}
?>