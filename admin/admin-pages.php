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
echo '<title>'.$title.': Page Managements</title>';
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '</head>';
echo '<body>';
require_once("includes/sidebar.php");
echo '<div class="adminBody">';
echo '<h2>Page Management</h2>';

echo '<b>Hello</b>, '.$userusername[0].'. <a href="'.$url.'/admin/admin.php?logout=true">Logout</a>?<br><br>';
if(is_admin($username)){

if(isset($_GET['editid'])){
if($_GET['editid']==1){
$updatehome=mysqli_query($mysqli,"UPDATE `pages` SET `CONTENT`='".kill_string($_POST['content'])."' WHERE `ID`='1'") or die(mysqli_error($mysqli));
}
else{
if($_POST['delete']=="yes"){
$deletepage=mysqli_query($mysqli,"DELETE FROM `pages` WHERE `ID`='".$_GET['editid']."'") or die(mysqli_error($mysqli));
}
else{
$updatepage=mysqli_query($mysqli,"UPDATE `pages` SET `CONTENT`='".kill_string($_POST['content'])."', `SLUG`='".kill_string($_POST['slug'])."', `TITLE`='".kill_string($_POST['title'])."', `KEYWORDS`='".kill_string($_POST['keywords'])."', `DESCRIPTION`='".kill_string($_POST['description'])."' WHERE `ID`='".$_GET['editid']."'") or die(mysqli_error($mysqli));
}
}
}

if(isset($_GET['addnew'])){
$addpage=mysqli_query($mysqli,"INSERT INTO `pages` (`SLUG`,`TITLE`,`CONTENT`,`KEYWORDS`,`DESCRIPTION`) VALUES ('".kill_string($_POST['slug'])."','".kill_string($_POST['title'])."','".kill_string($_POST['content'])."','".kill_string($_POST['keywords'])."','".kill_string($_POST['description'])."')") or die(mysqli_error($mysqli));
}

require_once($contentdir);
echo '<table border="1">';
echo '<tr>';
echo '<td><strong>ID</strong></td>';
echo '<td><strong>Slug</strong></td>';
echo '<td><strong>Title</strong></td>';
echo '<td><strong>Content</strong></td>';
echo '<td><strong>Keywords</strong></td>';
echo '<td><strong>Descriptions</strong></td>';
echo '<td><strong>Delete</strong></td>';
echo '<td><strong>Confirm</strong></td>';
echo '</tr>';
for($count=$m;1<=$count;$count--){
echo '<tr>';
echo '<form action="admin-pages.php?editid='.$pageid[$count-1].'" method="POST">';
echo '<td>'.$pageid[$count-1].'</td>';
if($pagetitle[$count-1]!="null"){
echo '<td><input type="text" name="slug" style="width:100px;" value="'.$pageslug[$count-1].'"/></td>';
echo '<td><input type="text" name="title" style="width:150px;"  value="'.$pagetitle[$count-1].'"/></td>';
}
else{
echo '<td>'.$pageslug[$count-1].'</td>';
echo '<td>'.$pagetitle[$count-1].'</td>';
}
echo '<td><textarea name="content" style="width:300px;">'.htmlentities($pagecontent[$count-1]).'</textarea></td>';
if($pagetitle[$count-1]=="null"){
echo '<td>'.$pagekeywords[$count-1].'</td>';
echo '<td>'.$pagedescription[$count-1].'</td>';
echo '<td></td>';
}
else{
echo '<td><input type="text" name="keywords" style="width:150px;"  value="'.$pagekeywords[$count-1].'"/></td>';
echo '<td><input type="text" name="description" style="width:150px;"  value="'.$pagedescription[$count-1].'"/></td>';
echo '<td><input type="checkbox" name="delete" value="yes"/> Delete</td>';
}
echo '<td><input type="submit" value="Update"/></td>';
echo '</form>';
echo '<tr>';
$nextid=$pageid[$count-1]+1;
}
echo '<tr>';
echo '<form action="admin-pages.php?addnew" method="POST">';
echo '<td>'.$nextid.'</td>';
echo '<td><input type="text" name="slug" style="width:100px;"/></td>';
echo '<td><input type="text" name="title" style="width:150px;"/></td>';
echo '<td><textarea name="content" style="width:300px;"></textarea></td>';
echo '<td><input type="text" name="keywords" style="width:150px;"/></td>';
echo '<td><input type="text" name="description" style="width:150px;"/></td>';
echo '<td><input type="submit" value="Add New"/></td>';
echo '</form>';
echo '<tr>';


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
