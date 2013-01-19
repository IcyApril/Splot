<?php
$maxSize = 100*1024*1024;

define('includeAllow', TRUE);
include('_src/php/connect.php');
include('_src/php/functions.php');

//include the S3 class
if (!class_exists('S3'))require_once('_src/php/s3/S3.php');

//instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);

//we'll continue our script from here in step 4!


$q = urlencode(mysql_escape_string(htmlspecialchars($_GET['q'])));

// Get the contents of our bucket  
$bucket_contents = $s3->getBucket("Splot.cc");  
  
$isFile = FALSE;

$query = "SELECT * FROM files WHERE filename='$q' ";
$result = mysql_query($query) or die(mysql_error());

if (mysql_num_rows($result) )
{
    $isFile = TRUE;
}

$result = mysql_query("SELECT * FROM files WHERE dt < (NOW() - INTERVAL 9 MONTH)");
while ($row = @mysql_fetch_array($result, MYSQL_ASSOC)) {
$uri = $row["filename"];
$sql = "DELETE FROM `files` WHERE `filename` = '$uri'";

    if (S3::deleteObject('Splot.cc', $uri)) {
    	@mysql_query($sql);
    }
}

$q = urldecode($q);
if($q=="") { $page ="home";
include('_src/php/top.php');
?>
        <div class="span9">
          <div class="hero-unit">
            <h1>Welcome to Splot.cc</h1>
            <h2>BS free file sharing.</h2>
            <p><form class="well form-inline" method="post" enctype="multipart/form-data" action="/_pages/upload">
        <input name="file" type="file" />
        <button name="submit" type="submit" class="btn btn-primary">Upload</button>
      </form>
      </p>
      <p>Music, pictures, etc. automatically embedded, files downloaded from massive CDN, unlimited parallel downloads, support for download accelerators, no waiting before downloads, no download restrictions, no personally identifying log files, No BS.<br /><br / >* Max size: 100 MB. By using this service you agree to the <a href="/_pages/terms">Terms</a>, and also you agree that you will only upload content you own the copyright to.</p>
          </div>
        </div><!--/span-->
<?php
include('_src/php/bottom.php');}
else if ($q=="_pages/terms") {$page ="terms";
include('_src/php/top.php');
?>
        <div class="span9">
          <div class="hero-unit">
            <h1>Terms.</h1>
            <p>
            By using this website you agree to the following:
            <ul>
            <li>By using this site you agree you are of legal age and ability to accept all the following terms:</li>
            <li>Warranty - THERE IS NO WARRANTY FOR THE WEBSITE, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE WEBSITE “AS IS” WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE WEBSITE IS WITH YOU. SHOULD THE WEBSITE PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION.
</li>
            <li>You warrant that you own all rights to all the content submitted. You hold this site, it's owners, affiliates, customers, vendors, hosts, employees, hosts, parents harmless from any damage, cost or liability out of any claim from any third party arising out of any you submit, upload or otherwise make accessible on this site.</li>
			<li>You give this site unlimited royalty-free, non-exclusive, perpetual, irrevocable international licence to any content or data you upload and the information therein.</li>
            <li>You agree you will not access this site in any way, but though the public web interface.</li>
            <li>You agree you will not enter any password protected or non-public area of the site.</li>
            <li>You agree you will not attempt to deny service to any other user or the site administrators.</li>
            <li>Any content that is submitted, may be deleted at any time, and there is no guaranty for the security of files stored here.</li>
            <li>The server(s) operating this service may keep log files without our knowledge, these may be handed over in accordance with legal requirements.</li>
            <li>You agree your data may be stored on 3rd party web hosting, e.g. Amazon AWS, and you agree to their terms of service also.</li>
            <li>The server operating this service may keep log files without our knowledge, these may be handed over in accordance with legal requirements.</li>
            <li>By downloading a file of this site, you agree to only use it for personal, non-commercial use, and you agree not to distribute links to this site on a commercial basis or use this site for commercial file distribution.</li>
            <li>You agree you will only use this site in accordance to laws in your respective country, the United Kingdom, United States, and European Union.</li>
			<li>You agree you will not use this site to distribute illegal content, child pornography, harass anyone, promote violence or restrict someone else's civil liberties.</li>
			<li>You agree you we may store cookies, web beacons, or other anonymous tracking on your computer for the purpose of site functionality.</li>
			<li>You hold us irresponsible for the actions of our advertisers or any other 3rd party.</li>
			<li>You agree to assume this service as a non-permanent storage facility, and data may be removed at any time.</li>
            </ul>
            </p>
          </div>
        </div><!--/span-->
<?php
include('_src/php/bottom.php');}
else if ($q=="_pages/copyright") {$page ="copyright";
include('_src/php/top.php');
?>
        <div class="span9">
          <div class="hero-unit">
            <h1>Copyright takedown requests...</h1>
            <br /><p>
            All DMCA notifications should be emailed to my email (the "designated agent")
            Please include the following:
            <ul>
            <li>Links to the offending material (starting with http://splot.cc/), or a description of where the material is with enough detail so we can find it with a description of the copyrighted work.</li>
            <li>Contact information (name, email, telephone number,email address).</li>
            <li>A statement that the complaining party has a good faith belief that use of the material in the manner complained of is not authorised by the copyright owner, its agent, or the law.</li>
			<li>A statement that the information in the notice is accurate, and under penalty of perjury, that the complaining party is authorised to act on behalf of the owner of an exclusive right that is allegedly infringed.</li>
            </ul>
            </p>
            <p>We also have a free service to allow files to be deleted directly from our servers for the exclusive use of intellectual property violations. Contact the above email address if you are interested.</p>
          </div>
        </div><!--/span-->
<?php
include('_src/php/bottom.php');}
else if ($q=="_pages/upload") {$page ="upload";
include('_src/php/upload.php');}
else if ($isFile == TRUE) {$page ="file";
include('_src/php/home.php');}
else {
include('_src/php/top.php');?>
        <div class="span9">
          <div class="hero-unit">
            <h1>404! Aka. Not Found</h1>
            <h2>Sorry, the page you were after could not be found. :( Aliens or some shit. This file may have been removed due to a DMCA Removal Request <a href="http://splot.cc/_dmcaremovals/">DMCA Removals</a>.</h2>
        <p><a class="btn btn-primary btn-large" href="/">Take me away.. &raquo;</a></p>
          </div>
        </div><!--/span-->
<?php
include('_src/php/bottom.php');
}