<?php
define('includeAllow', TRUE);
include('../_src/php/connect.php');
include('../_src/php/functions.php');
$auth_salt = "siledhfklsdhfjksfhjkshfgkljshfjkfghirt98347584375893475";

$newuser = htmlspecialchars(mysql_real_escape_string($_POST['newuser']));
$newpassword = htmlspecialchars(mysql_real_escape_string($_POST['newpassword']));

if ($newuser && $newpassword) {
$hashedpassword =  hash('sha512', $newpassword.$auth_salt);
$sql = 'INSERT INTO dmcausers (id, user, password) VALUES (NULL, "'.$newuser.'", "'.$hashedpassword.'")';
if (!mysql_query($sql))  {
   die(mysql_error());
  }
echo "User added!";
}
