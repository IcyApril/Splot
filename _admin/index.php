<?php
define('includeAllow', TRUE);
include('../_admin/login.php');
include('../_src/php/connect.php');
include('../_src/php/functions.php');

//include the S3 class
if (!class_exists('S3'))require_once('../_src/php/s3/S3.php');

//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIUUN5TUOGLUQQFWA');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

//instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);
include('../_src/php/top.php');
?>
        <div class="span9">
          <div class="hero-unit">
            <h1>Splot.cc Management Console</h1>
            <hr />
            <h2>Delete file:</h2>
<form action="delete.php" method="get">
 URI (file name): <input type="text" name="uri" />
 <input type="submit" />
 </form>
 <hr />
 
<h2>Add DMCA Agent</h2>
<form name="input" action="newuser.php" method="post">
<h3>Username:</h3>
<input type="text" name="newuser" class="input-xlarge"/>
<br />
<h3>Password:</h3>
<input type="password" name="newpassword" class="input-xlarge"/>
<br />
<input type="submit" value="Submit" />
</form>
 <hr />
 
<h2>DMCA Delete</h2>
<form name="input" action="dmcadelete.php" method="post">
<h3>DMCA Submitted by:</h3>
<input type="text" name="submittedby" class="input-xlarge"/>
<br />
<h3> URI (file name): </h3>
<input type="text" name="uri" class="input-xlarge"/>
<br />
<input type="submit" value="Submit" />
</form>
        
          </div>
        </div><!--/span-->
<?php
include('../_src/php/bottom.php');
?>