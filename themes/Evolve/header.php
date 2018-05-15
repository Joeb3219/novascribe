<?php
if(!defined('includedie')){die(header( 'Location: '.$url ));}
define("n","\n"); // new line
require($fullpath.'includes/navgrab.php');
echo '<body>'.n;
echo '<div class="mainwrapper" id="mainwrapper">'.n;
echo '<div class="header">'.n;
echo '<div class="logo"></div>'.n;
$CurrentURL = $_SERVER['PHP_SELF'];
$bgcolour="#FFFFFF";


echo '</div>'.n;
echo '<div class="navigation">'.n;
echo '<div class="navbar">'.n;
echo '<ul>'.n;
$savej=$j;
while($j>0){
if($navdisplay[$j-"1"]!="NO"){
echo '<li><a href="'.$navurl[$j-"1"].'" title="'.$navtitle[$j-"1"].'" navid="'.$navid[$j-"1"].'">'.$navtext[$j-"1"].'</a></li>';
}
$j--;
}
$j=$savej;
echo '</ul>'.n;
echo '</div>'.n;
echo '</div>'.n;
echo '<div class="wrapperouter">'.n;
echo '<div class="content">'.n;
