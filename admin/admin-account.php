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
echo '<title>'.$title.': My Account</title>';
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '</head>';
echo '<body>';
require_once("includes/sidebar.php");
echo '<div class="adminBody">';
echo '<h2>My Account</h2>';
echo '<b>Hello</b>, '.$userusername[0].'. <a href="'.$url.'/admin/admin.php?logout=true">Logout</a>?<br><br>';

if(isset($_GET['edit'])){
if(isset($_POST['old'])){$freepass=$_POST['old'];}
$trypassword=sha1($usersalt[0].$freepass);
if(isset($_POST['old'])&&isset($_POST['new'])&&$trypassword==$userpassword[0]){
$newpass=sha1($usersalt[0].$_POST['new']);
mysqli_query($mysqli,"UPDATE `users` SET `PASSWORD`='".$newpass."' WHERE `USERNAME`='".$grabuser."'") or die(mysqli_error($mysqli));
mysqli_query($mysqli,"UPDATE `users` SET `SID`='', `IP`='' WHERE `USERNAME`='".$grabuser."'") or die(mysqli_error($mysqli));
}


}
echo '<form action="admin-account.php?edit=true" method="POST">'.n;
echo 'Old Password: <input type="text" name="old"><br>'.n;
echo 'New Password: <input type="text" name="new"><br>'.n;
echo 'Email: <input type="text" name="email" value="'.$useremail[0].'"><br>'.n;
echo '<input type="submit" value="Update Account">'.n;
echo '</form>'.n;



echo '</div>';
echo '</body>';
echo '</html>';
}
//YOU AREN'T EVEN LOGGED IN! GO BACK TO LOGIN!
else{die(header( 'Location: '.$url.'/admin' ));}

$mysqli->close();
?>
