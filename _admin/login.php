<?php

if (isset($_POST['password'])) {
    if ($_POST['password'] == $dbpass) {
        $_SESSION['adminLoggedIn'] = true;
    } else {
        die ('Incorrect password');
    }
} 

if (!$_SESSION['adminLoggedIn']) { 
	include('../_src/php/top.php');
?>
        <div class="span9">
          <div class="hero-unit">
            <h1>Login</h1>
            <hr />
    <h2>Enter database password to access the admin panel:</h2>
    <form method="post">
      Password: <input type="password" name="password" class="input input-xlarge"> <br />
      <input type="submit" name="submit" value="Login" class="btn btn-primary">
    </form>
 </form>
 <hr />
          </div>
        </div><!--/span-->
<?php 
include('../_src/php/bottom.php');
die(); }?>