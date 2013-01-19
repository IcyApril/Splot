<?php
//check whether a form was submitted
if(isset($_POST['submit'])){
	$fileName = alphaID(date('smhdmY'));
    $fileName .= "_";
    //retreive post variables
    $fileName .= $_FILES['file']['name'];
    $fileName = urlencode(substr($fileName,0,255));
    $fileName = str_replace (" ", "", $fileName); //Fix bug with spaces.
    $fileName = str_replace ("+", "", $fileName); //Really fix bug with spaces.
        $fileName = str_replace ("%20", "", $fileName); //Make sure I fix bug with spaces.
    $fileTempName = $_FILES['file']['tmp_name'];

	$sql = "UPDATE  `config` SET  `value`=value+'1' WHERE `option`='uploadcount'";
	mysql_query($sql);
	
	$max = 1024*1024*100;
	if ($_FILES["file"]["size"] > $max) {die('Too big! 100 MB max');} 

    //we'll continue our script from here in the next step!
}else{
    die("Please go back and select a file!");
}

//move the file
if (@$s3->putObjectFile($fileTempName, "Splot.cc", $fileName, S3::ACL_PRIVATE,array(),array(),S3::STORAGE_CLASS_RRS)) {
	$sql = "INSERT INTO `files` (`id`, `filename`, `dt`) VALUES (NULL, '$fileName', NOW());";
	mysql_query($sql)or die(mysql_error);
	include('top.php');
    //echo "We successfully uploaded your file. $fileName <br />";
    
    $path2 = urlencode('http://splot.cc/'.$fileName);
    $tweet = "Download $fileName: http://splot.cc/$fileName";
	$fbpost = "?u=http://splot.cc/$fileName&t=$fileName";
	$tumblr = "url=$path2&name=$path&description=$fileName";
?>
        <div class="span9">
          <div class="hero-unit">
            <h1>File successfully uploaded!</h1>
            <h2><a href="http://splot.cc/<?=$fileName?>">Download Page</a> (This is the link you share.)</h2>
<hr />
			<h2>Share your upload!</h2>
			Link: <input type="text" class="xlarge disabled" id="urltxt" onClick="SelectAll('urltxt');" style="width: 350px;" value="http://splot.cc/<?=$fileName?>">
			<p><a href="https://twitter.com/intent/tweet?text=<?=$tweet?>"><img src="/_src/elegantmediaicons/twitter.png"></a>
			<a href="http://www.facebook.com/sharer.php<?=$fbpost?>"><img src="/_src/elegantmediaicons/facebook.png"></a>
			<a href="http://www.tumblr.com/share/link?<?=$tumblr?>"><img src="/_src/elegantmediaicons/tumblr.png"></a>
			<a href="http://www.reddit.com/submit?url=<?=$path2?>"><img src="/_src/elegantmediaicons/reddit.png"></a>
			<a href="https://plus.google.com/share?url=<?=$path2?>"><img src="/_src/elegantmediaicons/google.png"></a>
			</p>
          </div>
        </div><!--/span-->
<script type="text/javascript">
function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
</script>
<?php
	include('bottom.php');
}else{
    die("An internal error occurred!");
}

/*
// cloud info
$username = "mjsa"; // username
$key = "6f365c7e8dec86a8762d2cf4277c4b6e"; // api key
 
// Connect to Rackspace
$auth = new CF_Authentication($username, $key, NULL, UK_AUTHURL);
$auth->authenticate();
$conn = new CF_Connection($auth);
 
// Get the container we want to use
$container = $conn->get_container('Splot.cc');
 
// store file information
$localfile = $_FILES['file']['tmp_name'];
$filename = alphaID(date('smhdmY'));
$filename .= $_FILES['file']['name'];
 
// upload file to Rackspace
$object = $container->create_object($filename);
$object->load_from_filename($localfile);

$uri = $container->make_public();
echo $object->public_uri();*/
?>