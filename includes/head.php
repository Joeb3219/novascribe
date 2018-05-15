<?php
require_once('includes/options.php');
require_once('includes/contentgrab.php');
define("n","\n"); // new line
if(!defined('includedie')){die(header( 'Location: '.$url ));}
ob_start("ob_gzhandler");
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">'.n;
echo '<html>'.n;
echo '<head>'.n;
echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >'.n;
if (isset($titlevalue)){
if($titlevalue=="null"){echo '<title>'.$title.'</title>'.n;}
else{echo '<title>'.$titlevalue.'</title>'.n;}
}else{echo '<title>'.$title.'</title>'.n;}

if(isset($newdescription)&&$newdescription!="null"){echo '<meta name="description" content="'.$newdescription.'">'.n;}
else{echo '<meta name="description" content="'.$description.'">'.n;}

if(isset($newkeywords)&&$newkeywords!="null"){echo '<meta name="keywords" content="'.$newkeywords.'">'.n;}
else{echo '<meta name="keywords" content="'.$keywords.'">'.n;}

echo '<link rel="shortcut icon" type="image/png" href="'.$favicon.'">'.n;

echo '<link rel="stylesheet" href="'.$stylesheet.'" type="text/css">'.n;

echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>'.n;

require_once('tracking.php');
echo '</head>'.n;
