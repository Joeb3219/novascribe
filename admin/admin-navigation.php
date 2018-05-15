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
echo '<title>'.$title.': Navigation Menus</title>';
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '</head>';
echo '<body>';
require_once("includes/sidebar.php");
echo '<div class="adminBody">';
echo '<h2>Navigation Menus</h2>';

echo '<b>Hello</b>, '.$userusername[0].'. <a href="'.$url.'/admin/admin.php?logout=true">Logout</a>?<br><br>';
if(is_admin($username)){
if(isset($_GET['editid'])){
$id=$_GET['editid'];
if($_POST['delete']=="yes"){
$deletenav=mysqli_query($mysqli,"DELETE FROM `navigation` WHERE `ID`='".$id."'") or die(mysqli_error($mysqli));
}
else{

$updatenav = mysqli_query($mysqli,"UPDATE `navigation` SET `URL`='".$_POST['url']."', `TEXT`='".$_POST['text']."', `TITLE`='".$_POST['title']."', `POSITION`='".$_POST['position']."', `DISPLAY`='".$_POST['display']."' WHERE `ID`='".$id."'") or die(mysqli_error($mysqli));
}
}
if(isset($_GET['addnew'])){
$addnav=mysqli_query($mysqli,"INSERT INTO `navigation` (`URL`,`TEXT`,`TITLE`,`POSITION`,`DISPLAY`) VALUES('".$_POST['url']."','".$_POST['text']."','".$_POST['title']."','".$_POST['position']."','".$_POST['display']."')") or die(mysqli_query($mysqli));
}
require_once($navdir);
echo 'Main Navigation Menu:';
echo '<table border="1">';
echo '<tr>';
echo '<td><strong>ID</strong></td>';
echo '<td><strong>URL</strong></td>';
echo '<td><strong>Display Text</strong></td>';
echo '<td><strong>Title</strong></td>';
echo '<td><strong>Position</strong></td>';
echo '<td><strong>Hidden?</strong></td>';
echo '<td><strong>Delete?</strong></td>';
echo '<td><strong>Make Changes?</strong></td>';
echo '</tr>';
$savej=$j;
for($count=$j;1<=$count;$count--){
echo '<tr>';
echo '<form action="admin-navigation.php?editid='.$navid[$count-1].'" method="POST">';
echo '<td>'.$navid[$count-1].'</td>';
echo '<td><input type="text" name="url" value="'.$navurl[$count-1].'"></td>';
echo '<td><input type="text" name="text" value="'.$navtext[$count-1].'" style="width:100px;"></td>';
echo '<td><input type="text" name="title" value="'.$navtitle[$count-1].'" style="width:100px;"></td>';
echo '<td><input type="text" name="position" value="'.$navposition[$count-1].'" style="width:25px;"></td>';
echo '<td><select name="display">';
if($navdisplay[$count-1]=="YES"){
echo '<option value="YES" selected="selected">No</option>';
echo '<option value="NO">Yes</option>';
}
else{
echo '<option value="YES">No</option>';
echo '<option value="NO"  selected="selected">Yes</option>';
}
echo '</select></td>';
echo '<td><input type="checkbox" name="delete" value="yes"/> Delete</td>';
echo '<td><input type="submit" value="Update"/></td>';
echo '</form>';
echo '</tr>';
$nextid=$navid[$count-1]+1;
}
echo '<tr>';
echo '<form action="admin-navigation.php?addnew" method="POST">';
echo '<td>'.$nextid.'</td>';
echo '<td><input type="text" name="url"></td>';
echo '<td><input type="text" name="text" style="width:100px;"></td>';
echo '<td><input type="text" name="title" style="width:100px;"></td>';
echo '<td><input type="text" name="position" style="width:25px;"></td>';
echo '<td><select name="display">';
echo '<option value="YES" selected="selected">No</option>';
echo '<option value="NO">Yes</option>';
echo '</select></td>';
echo '<td><input type="submit" value="Add New"/></td>';
echo '</form>';
echo '</tr>';
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
