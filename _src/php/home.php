<?php
$path = urlencode(htmlspecialchars(mysql_escape_string($q)));
$tempURL = el_s3_getTemporaryLink(awsAccessKey, awsSecretKey, "Splot.cc", $path,100);
$sql = "UPDATE  `splot`.`files` SET  `dt` = now() WHERE  `files`.`filename` = '$path'";
mysql_query($sql);
$extention = strtolower(substr(strrchr($path, '.'), 1));
$path2 = urlencode('http://splot.cc/'.$path);
$tweet = "Download $path: http://splot.cc/$path";
$fbpost = "?u=http://splot.cc/$path&t=$path";
$tumblr = "url=$path2&name=$path&description=$path";

$imageformats = array("png", "gif", "jpg", "jpeg");
$audioformats = array("mp3", "wav");
$videoformats = array("mp4", "ogg", "webm");
$embedformats = array("pdf", "txt");

if ((in_array($extention, $imageformats))) {$embed = '<img src="'.$tempURL.'" alt="'.$tempURL.'">';}
if ((in_array($extention, $audioformats))) {$embed = '<audio controls="controls" src="'.$tempURL.'" >
We\'re currently HTML5 only. :( Download this file to listen or download a newer browser.
</audio>';}
if ((in_array($extention, $videoformats))) {$embed = '<video width="320" height="240" controls="controls" src="'.$tempURL.'" />
We\'re currently HTML5 only. :( Download this file to watch or download a newer browser.
</audio>';}
if ((in_array($extention, $embedformats))) {$embed = '<embed width="100%" height="420" src="'.$tempURL.'" />
</embed>';}
if($embed) {$embed .= '<hr />';}
include('top.php');
?>
        <div class="span9">
          <div class="hero-unit">
            <h2>Download: <?=$path?></h2><br />
            <h1><a class="btn btn-primary btn-large" href="<?=$tempURL?>">Download</a></h1>
            <hr />
            <?=$embed?>
			<h2>Share this upload!</h2>
			Link: <input type="text" class="xlarge disabled" id="urltxt" onClick="SelectAll('urltxt');" style="width: 350px;" value="http://splot.cc/<?=$path?>">
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
 <!--       <div class="span9">
            <h1>Terms.</h1>
            <p>Testsetest
            </p>
        </div><!--/span-->
<?php
include('bottom.php');