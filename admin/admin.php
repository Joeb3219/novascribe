<?php
ob_start();
define("n","\n"); // new line
define('includedie',TRUE);
require_once("includes/includes.php");
session_start();
if(try_login()){
$sql9 = "SELECT * FROM users WHERE USERNAME='".$username."'";
$result9 = mysqli_query($mysqli,$sql9);
$rows9 = mysqli_num_rows($result9);

for($q = 0; $q < $rows9; $q++) {
$userid[$q] = db_result($result9,$q,"ID");
$userusername[$q] = db_result($result9,$q,"USERNAME");
$userpassword[$q] = db_result($result9,$q,"PASSWORD");
$useremail[$q] = db_result($result9,$q,"EMAIL");
$usersalt[$q] = db_result($result9,$q,"SALT");
$usersid[$q] = db_result($result9,$q,"SID");
$userip[$q] = db_result($result9,$q,"IP");
$rightnow[$q] = db_result($result9,$q,"TIME");
}
echo '<html>';
echo '<head>';
echo '<title>'.$title.': Admin Dashboard</title>';
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '</head>';
echo '<body>';
require_once("includes/sidebar.php");
echo '<div class="adminBody">';
echo '<h2>ADMIN DASHBOARD (VER: '.$version.')</h2>';
if(isset($_GET['logout'])){destroy_session($username);die(header( 'Location: '.$url.'/admin' ));}
echo '<b>Hello</b>, '.$userusername[0].'. <a href="'.$url.'/admin/admin.php?logout=true">Logout</a>?<br><br>';
require_once($fullpath.'/includes/contentgrab.php');
require_once($fullpath.'/includes/navgrab.php');
require_once('includes/grabusers.php');
echo 'Total Pages: '.$m.'<br>';
echo 'Total Posts: '.$k.'<br>';
echo 'Total Users: '.$z.'<br>';
echo 'Total Navigation Entries: '.$j.'<br>';

if(is_admin($username)){
echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
echo '<input type="submit" name="upgrade_cms" value="Check for and Install Novascribe Update">';
echo '</form>';
if(isset($_POST['upgrade_cms'])){upgrade_novascribe();}
}

echo '</div>';
echo '</body>';
echo '</html>';
}
//YOU AREN'T EVEN LOGGED IN! GO BACK TO LOGIN!
else{die(header( 'Location: '.$url.'/admin' ));}

$mysqli->close();
?>
