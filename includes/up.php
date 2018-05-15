<?php
if(!defined('includedie')){die(header( 'Location: '.$url ));}
require_once('config.php');
$mysqli = new mysqli('localhost',USERNAME,PASSWORD,DATABASE);
?>
