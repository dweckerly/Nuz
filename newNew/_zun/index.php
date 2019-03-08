<?php
require_once('inc/util.php');
readfile("layout/head.html");
if(isSeshActive()){
    $active = $db->prepare("SELECT * FROM active WHERE gameId = ?")->execute([$_SESION['sid']]);
    $user = $active->fetch();
} else {
?>
<form id="signupForm" class='signup-form' action='./signup.php' method='POST'>
    <p class="index-section-header">Sign Up</p>
    <div class='form-group '>
        <input type='text' name='uname' placeholder='name' maxlength="32">
        <input type='password' name='password' placeholder='password' maxlength="32">
    </div>
    <div class='form-group'>
        <button id="signupBtn" class='btn btn-outline-secondary' type='submit' name='submit'>Create Account</button>
    </div>
</form>
<?php
    if(!empty($_GET['signup'])) {
        $suErr = $_GET['signup'];
        if($suErr == 'empty') {
            echo "<div id='errMess' class='alert alert-danger' role='alert'>Fill out both of these ^^</div>";
        } elseif($suErr == 'unameTaken') {
            echo "<div id='errMess' class='alert alert-danger' role='alert'>That name is taken :(</div>";
        } else {
            echo "<div id='errMess' class='alert alert-danger' role='alert'>" . $suErr . "</div>";
        }
    }
}

readfile("layout/foot.html");
