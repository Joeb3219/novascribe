<?php
define('includedie',TRUE);
$absdir=dirname(__FILE__);
$reldir=str_replace("/admin/includes", "",$absdir);
$updir=$reldir.'/includes/up.php';
require_once($updir);
require_once($reldir.'/includes/functions.php');
$optionsdir=$reldir.'/includes/options.php';
require_once($optionsdir);
$themefunctions=$reldir.'/themes/'.$currenttheme.'/custom_functions.php';
require_once($themefunctions);
$contentdir=$reldir.'/includes/contentgrab.php';
$navdir=$reldir.'/includes/navgrab.php';
?>
