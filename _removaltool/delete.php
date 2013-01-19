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


$uri = htmlspecialchars(mysql_escape_string($_GET['uri']));

if (stripos($uri, 'http') == 0) {
   die('Only enter the text after http://splot.cc/');
}
if (stripos($uri, 'www') == 0) {
   die('Only enter the text after http://splot.cc/');
}
if (stripos($uri, 'splot') == 0) {
   die('Only enter the text after http://splot.cc/');
}

$sql = "DELETE FROM `files` WHERE `filename` = '$uri'";

    if (S3::deleteObject('Splot.cc', $uri)) {
    	mysql_query($sql);
        echo "Deleted.<br /><a href='index.php'>Home</a>";
        $sql = "INSERT INTO `dmcaremovals` (`id`, `url`, `user`) VALUES (NULL, '$uri', '".$_SESSION['loggedinuser']."');";
    	mysql_query($sql);
    }

?>