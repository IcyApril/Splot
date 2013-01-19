<?php
define('includeAllow', TRUE);
include('../_src/php/connect.php');
include('../_src/php/functions.php');

//include the S3 class
if (!class_exists('S3'))require_once('../_src/php/s3/S3.php');

//instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);


$uri = htmlspecialchars(mysql_escape_string($_GET['uri']));
$sql = "DELETE FROM `files` WHERE `filename` = '$uri'";

    if (S3::deleteObject('Splot.cc', $uri)) {
    	mysql_query($sql);
        echo "Deleted.";
    }

?>