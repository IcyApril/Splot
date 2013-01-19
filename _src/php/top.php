<?php
if(!defined('includeAllow')){die('Direct access not permitted');}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Splot.cc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/_src/bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
       img{max-width:100%;height:auto;}
    </style>
    <link href="/_src/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="_src/bootstrap/js/google-code-prettify/prettify.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/">Splot.cc</a>
          <div class="nav pull-right">
          <li><a href="https://github.com/IcyApril">Source</a></li>
          </div>
          <div class="nav-collapse">
            <ul class="nav">
              <?php if($page == "home"){?><li class="active"><?php } else {?><li><?php } ?><a href="/">Home</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Links</li>
              <?php if($page == "home"){?><li class="active"><?php } else {?><li><?php } ?><a href="/">Splot.cc</a></li>
              <li><a href="http://junade.com">My Blog.</a></li>
              <li<?php if($page == "_dmcaremovals"){?> class="active"<?php } ?>><a href="/_dmcaremovals">DMCA Removals</a></li>
              <!--<li class="nav-header">Sidebar</li>
              <li></li>-->
              <li class="nav-header">Legal Notes</li>
              <?php if($page == "terms"){?><li class="active"><?php } else {?><li><?php } ?><a href="/_pages/terms">Terms</a></li>
              <?php if($page == "copyright"){?><li class="active"><?php } else {?><li><?php } ?><a href="/_pages/copyright">Copyright Takedown Notices</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
