<?php

//AWS access info
// CHANGE DETAILS!
if (!defined('awsAccessKey')) define('awsAccessKey', 'changeMe');
if (!defined('awsSecretKey')) define('awsSecretKey', 'changeMe');

$dbhost = "changeMe";
$dbuser = "changeMe";
$dbpass = "changeMe";
$dbdatabase = "splot"; 
mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
mysql_select_db($dbdatabase) or die(mysql_error());

$sqllaunch = '
CREATE TABLE IF NOT EXISTS `config` (
  `option` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  UNIQUE KEY `option` (`option`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `dmcaremovals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `dmcausers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt` datetime NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;';
mysql_query($sqllaunch);
?>