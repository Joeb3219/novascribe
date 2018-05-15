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
echo '<title>'.$title.': Manage Users</title>';
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '</head>';
echo '<body>';
require_once("includes/sidebar.php");
echo '<div class="adminBody">';
echo '<h2>Manage Users</h2>';
if(is_admin($username)){

if(isset($_GET['editid'])){
$id=$_GET['editid'];
if($_POST['delete']=="yes"){
$deleteuser=mysqli_query($mysqli,"DELETE FROM `users` WHERE `ID`='".$id."'") or die(mysqli_error($mysqli));
}
else{
$email=$_POST['email'];
$rank=$_POST['rank'];
$updateuser = mysqli_query($mysqli,"UPDATE `users` SET `EMAIL`='".$email."', `RANK`='".$rank."' WHERE `ID`='".$id."'") or die(mysqli_error($mysqli));
}
}


echo '<b>Hello</b>, '.$userusername[0].'. <a href="'.$url.'/admin/admin.php?logout=true">Logout</a>?<br><br>';
echo '<table border="1">';
echo '<tr>';
echo '<td><strong>ID</strong></td>';
echo '<td><strong>Username</strong></td>';
echo '<td><strong>Email</strong></td>';
echo '<td><strong>Rank</strong></td>';
echo '<td><strong>Logged in?</strong></td>';
echo '<td><strong>Delete User?</strong></td>';
echo '<td><strong>Make Changes</strong></td>';
echo '</tr>';
require_once('includes/grabusers.php');
$savez=$z;
for($count=1;$count<=$z;$count++){
if(is_logged_in($uname[$count-1])){$loggedin="Yes";}else{$loggedin="No";}
echo '<tr>';
echo '<form action="admin-users.php?editid='.$uid[$count-1].'" method="POST">';
echo '<td>'.$uid[$count-1].'</td>';
echo '<td>'.$uname[$count-1].'</td>';
echo '<td><input type="text" name="email" value="'.$uemail[$count-1].'"/></td>';
echo '<td>';
echo '<select name="rank">';
if($urank[$count-1]=="USER"){
echo '<option value="USER" selected="selected">USER</option>';
echo '<option value="EDITOR">EDITOR</option>';
echo '<option value="ADMIN">ADMIN</option>';
}
elseif($urank[$count-1]=="EDITOR"){
echo '<option value="USER">USER</option>';
echo '<option value="EDITOR" selected="selected">EDITOR</option>';
echo '<option value="ADMIN">ADMIN</option>';
}
elseif($urank[$count-1]=="ADMIN"){
echo '<option value="USER">USER</option>';
echo '<option value="EDITOR">EDITOR</option>';
echo '<option value="ADMIN" selected="selected">ADMIN</option>';
}
echo '</select></td>';
echo '<td>'.$loggedin.'</td>';
echo '<td><input type="checkbox" name="delete" value="yes"/> Delete</td>';
echo '<td><input type="submit" value="Update"/></td>';
echo '</form>';
echo '</tr>';
}


echo '</table>';

}
else{echo 'You are not authorized to view this page.';}


echo '</div>';
echo '</body>';
echo '</html>';
}
//YOU AREN'T EVEN LOGGED IN! GO BACK TO LOGIN!
else{die(header( 'Location: '.$url.'/admin' ));}

$mysqli->close();
?>
