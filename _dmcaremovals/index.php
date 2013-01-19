<?php
define('includeAllow', TRUE);
include('../_src/php/connect.php');
include('../_src/php/functions.php');
$page = "_dmcaremovals";
include('../_src/php/top.php');

//CONNECT
mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbdatabase);
?>
        <div class="span9">
<?php
$result = mysql_query("SELECT * FROM `dmcaremovals`");
if (!$result) {
    die("Query to show fields from table failed");
}

$fields_num = mysql_num_fields($result);

echo "<h1>DMCA Removals</h1>";
echo "<table class='table table-bordered'><tr>";
// printing table headers
for($i=0; $i<$fields_num; $i++)
{
    $field = mysql_fetch_field($result);
    echo "<td>{$field->name}</td>";
}
echo "</tr>\n";
// printing table rows
while($row = mysql_fetch_row($result))
{
    echo "<tr>";
    foreach($row as $cell)
        echo "<td>$cell</td>";

    echo "</tr>\n";
}
?>
</table>
</div>
<?php
include('../_src/php/bottom.php');
?>
</body>
</html>