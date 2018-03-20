<h3>Sign Up</h3>
    <form class='signup-form' action='includes/signup.inc.php' method='POST'>
        <div class='form-group'>
            <input type='text' name='email' placeholder='Da emails'>
            <input type='password' name='password' placeholder='yur paswerd'>
        </div>
        <div class=form-group>
            <button class='btn btn-outline-secondary' type='submit' name='submit'>Create Account</button>
        </div>
    </form>
<?php
if(!empty($_GET['signup'])) {
    $suErr = $_GET['signup'];
    if($suErr == 'empty') {
        echo "<div class='alert alert-danger' role='alert'>Fill out both of these ^^</div>";
    } elseif($suErr == 'invalid') {
        echo "<div class='alert alert-danger' role='alert'>That's not an email...</div>";
    } elseif($suErr == 'email') {
        echo "<div class='alert alert-danger' role='alert'>This email is already in the DB.</div>";
    } elseif($suErr == 'pwd') {
        echo "<div class='alert alert-danger' role='alert'>Come on now. You can think of something > 3 characters, right?</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>" . $suErr . "</div>";
    }
} elseif(!empty($_GET['g'])) {
    $gErr = $_GET['g'];
    if($gErr == 'empty') {
        echo "<div class='alert alert-danger' role='alert'>Game not identified.</div>";
    } elseif($gErr == 'nodig') {
        echo "<div class='alert alert-danger' role='alert'>Por Que?</div>";
    } elseif($gErr == 'nofound') {
        echo "<div class='alert alert-danger' role='alert'>Game not found.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>" . $gErr . "</div>";
    }
}
?>
<a href='#'>Or log in</a>