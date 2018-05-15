<?php
ob_start("ob_gzhandler");
define('includedie',TRUE);
header("Content-type: text/css; charset: UTF-8");
$absdir=dirname(__FILE__);
$reldir=str_replace("/themes/Evolve", "",$absdir);
$optionsdir=$reldir.'/includes/options.php';
require_once($reldir.'/includes/functions.php');
require_once($optionsdir);
require_once('evolve_options.php');

?>
html{height:100%;}
body{background-image:url("<?php echo $url;?>/images/background.jpeg"); background-position: center top;background-repeat: repeat;background-size: auto auto;height:101%;font-family:Ubuntu,Georgia,"Times New Roman",Times,serif;}
.mainwrapper{box-shadow: 0px 2px 2px 3px #696969;-webkit-box-shadow: 0px 2px 2px 3px #696969;min-height:101%;width:90%;margin:-7px AUTO 0 AUTO;border-left:1px solid black;border-right:1px solid black;height:auto;background-color:<?php echo $bg_colour;?>}
a{}
.header {height:<?php echo $header_height;?>;width:100%;background-color: #474746;}
.logo{background-image: url("<?php echo $logo;?>");height:<?php echo $header_height;?>;width:100%;background-repeat: no-repeat;background-position:<?php echo $logo_position;?>;}
.wrapperouter{background-color:<?php echo $bg_colour;?>;width:100%;min-height:101%;height:auto;}
.content{height:auto;padding:5px;color:#C2C2C2;position:relative;}
.navigation{height:22px;border-bottom:1px solid black;overflow:hidden;background:<?php echo $nav_colour;?>;}
.navigation ul{list-style-type:none;margin-bottom:-14px;}
.navigation li{float:left;margin-left:2px;}
.navigation a{text-decoration:none;background:#DDDDDD;padding:0 10px;font-family: Georgia,"Times New Roman",Times,serif;font-size:1.1em;color:#111111;}
.navigation a:hover{text-decoration:underline;background:<?php echo $nav_colour;?>;padding:0 10px;font-family: Georgia,"Times New Roman",Times,serif;font-size: 1.1em;color:#111111;}

.footer{box-shadow: 0px 2px 2px 3px #696969;-webkit-box-shadow: 0px 2px 2px 3px #696969;height:25px;background:#474746;width:90%;margin:0 AUTO 0 AUTO;border-left:1px solid black;border-right:1px solid black;color:#FFFFFF;}
.footer a{color:#A1A1A1;text-decoration:none;}
.footer a:hover{color:#2356A6;text-decoration:underline;}

.welcomeribbon{ background: none repeat scroll 0 0 #6D8C50;box-shadow: 0 2px 0 rgba(0, 0, 0, 0.1);font-weight: bolder;height: 35px;margin-bottom: 15px;margin-left: -38px;margin-top: 15px;padding-right: 2px;padding-top: 15px;position: relative;right: -19px;text-align: center;width: auto;}
.welcomeribbon:before, .welcomeribbon:after {content: "";position: absolute;display: block;bottom: -1em;border: 1.5em solid #5E734B;z-index:-1;}
.welcomeribbon:before {left:-29px;border-right-width: 1.5em;border-left-color: transparent;}
.welcomeribbon:after {right:-29px;border-left-width: 1.5em;border-right-color: transparent;}
.welcomeribbon .ribboncontent:before, .welcomeribbon .ribboncontent:after {content: "";position: absolute;display: block;border-style: solid;border-color: #526144 transparent transparent transparent;bottom: -1em;}
.welcomeribbon .ribboncontent:before {left: -1px;border-width: 1em 0 0 1em;}
.welcomeribbon .ribboncontent:after {right: -1px;border-width: 1em 1em 0 0;}
.ribbonzindex{position: relative; z-index: 1;font-size: 0.91em;}
.ribbonborder{border-top:2px dotted black; border-bottom:2px dotted black;margin-top: -10px;padding-top: 17px;}
.ribbontext{position: relative;top: -8px;color:#FFFFFF;font-size:1.1em;}

.sidebarwrap{height:auto;position:relative;float:right;width:25%;background-color:purple;}
