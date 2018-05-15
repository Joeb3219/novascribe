<?php
define("n","\n"); // new line
define('includedie',TRUE);
$absdir=dirname(__FILE__);
$reldir=str_replace("/admin", "",$absdir);
$updir=$reldir.'/includes/up.php';
$optionsdir=$reldir.'/includes/options.php';
session_start();
require_once($updir);
require_once($optionsdir);
if(isset($_SESSION['username'])&&isset($_SESSION['sesid'])){die(header( 'Location: '.$url.'/admin/admin.php' ));}
else{
echo '<html>';
echo '<title>Admin Login</title>';
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '</head>';
echo '<body>';
echo '<div class="loginBox">';
echo '<h2>'.$title.'</h2>';
echo '<form action="admin.php" method="POST">';
echo 'Username: <input type="text" name="un"/><br>';
echo 'Password: <input type="password" name="pw"/><br>';
echo '<input type="submit" value="Login"/>';
echo '</form>';
echo '<a href="'.$url.'/admin/register.php" title="Register for '.$title.'">Register</a> | <a href="'.$url.'" title="Home">Home</a>';
echo '</div>';
echo '</body>';
echo '</html>';
}
?>
