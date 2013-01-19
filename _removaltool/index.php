<?php
session_start();
if (!$_SESSION['loggedin']) {die(header('Location: login.php'));}


define('includeAllow', TRUE);
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
            <h1>Splot.cc Copyright Content Removal Tool</h1>
            <hr />
            <h2>Delete file:</h2>
<form action="delete.php" method="get">
 URI (file name): <input type="text" name="uri" />
 <input type="submit" />
 </form>
 <hr />
          </div>
        </div><!--/span-->
<?php
include('../_src/php/bottom.php');
?>