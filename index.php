<?php
define('includedie',TRUE);
require_once('includes/config.php');
function is_setup(){
if(DATABASE!="db_name"&&USERNAME!="username"&&PASSWORD!="password"&&SETUP=="is_setup"){return true;}
else{return false;}
}
if(is_setup()){
require_once('includes/functions.php');
$currenturl = strtolower($_SERVER['REQUEST_URI']);
$currenturl=str_replace('/','',$currenturl);
$currenturl=str_replace('.php','',$currenturl);
$currenturl=str_replace('.html','',$currenturl);
throwcontent($currenturl);
}
else{
if(HALFWAY=="not_halfway"){
require_once('ns_setup.php');
}
else{
ob_start();
require_once('includes/config.php');
require_once('includes/functions.php');
require_once('setup.php');
$salt = uniqid(mt_rand(), true);
$saltedpassword=sha1($salt.$_GET['password']);
$emailColumnExists=mysqli_query($mysqli,"SELECT `EMAIL` FROM `users` LIMIT 1");
if(!$emailColumnExists){$addEmailColumn=mysqli_query($mysqli,"ALTER TABLE `users` ADD `EMAIL` TEXT NOT NULL") or die(mysqli_error($mysqli));}
$rankColumnExists=mysqli_query($mysqli,"SELECT `RANK` FROM `users` LIMIT 1");
if(!$rankColumnExists){$addRankColumn=mysqli_query($mysqli,"ALTER TABLE `users` ADD `RANK` TEXT NOT NULL") or die(mysqli_error($mysqli));}
$addadmin=mysqli_query($mysqli,"INSERT INTO `users` (`USERNAME`,`PASSWORD`,`EMAIL`,`RANK`,`SALT`) VALUES ('".$_GET['username']."','".$saltedpassword."','".$_GET['email']."','ADMIN','".$salt."')") or die(mysqli_error($mysqli));
$fh="includes/config.php";
$file=file_get_contents($fh);
$file=str_replace('not_setup','is_setup', $file);
file_put_contents($fh, $file, LOCK_EX);
die(header('Location: http://'.$_SERVER['HTTP_HOST']));
}
}
?>
