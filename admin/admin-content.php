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
echo '<title>'.$title.': Post Managements</title>';
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '</head>';
echo '<body>';
require_once("includes/sidebar.php");
echo '<div class="adminBody">';
echo '<b>Hello</b>, '.$userusername[0].'. <a href="'.$url.'/admin/admin.php?logout=true">Logout</a>?<br><br>';

if(isset($_GET['add'])&&isset($_POST['pos'])&&isset($_POST['display'])&&isset($_POST['title'])&&isset($_POST['content'])){
$add=$_GET['add'];
if($add=="true"){
$pos=kill_string($_POST['pos']);
$display=kill_string($_POST['display']);
$title=kill_string($_POST['title']);
$content=kill_string($_POST['content']);
if(!empty($pos)&&!empty($display)&&!empty($title)&&!empty($content)){
mysqli_query($mysqli,"INSERT INTO `content` (`CONTENT`,`TITLE`,`DISPLAY`,`POS`) VALUES('".$content."','".$title."','".$display."','".$pos."')") or die(mysqli_error($mysqli));
}}}

echo '<h3>Add New Content:</h3>';
echo '<em>The content editor (for both pages and posts) will be <strike>fixed</strike> started in 0.4.1.</em><br>';
echo '<form action="admin-content.php?add=true" method="POST">';
echo 'Position: <input type="text" name="pos"><br>';
echo 'Display: <select name="display"><option value="YES">Yes</option><option value="NO">No</option></select><br>';
echo 'Title: <input type="text" name="title"><br>';
echo 'Content:<br><textarea style="height:300px;width:50%;" name="content"></textarea><br>';
echo '<input type="submit" value="Add Content">';
echo '</form>';

require_once($contentdir);
echo '<table border="1">';
echo '<tr>';
echo '<td><strong>ID</strong></td>';
echo '<td><strong>Title</strong></td>';
echo '<td><strong>Content</strong></td>';
echo '<td><strong>Position</strong></td>';
echo '<td><strong>Display</strong></td>';
echo '</tr>';
$tempCount=count($contentid);
for($count=0;$count<$tempCount;$count++){
echo '<tr>';
echo '<td>'.$contentid[$count].'</td>';
echo '<td>'.$contenttitle[$count].'</td>';
echo '<td>'.$contenttext[$count].'</td>';
echo '<td>'.$contentpos[$count].'</td>';
echo '<td>'.$contentdisplay[$count].'</td>';
echo '</tr>';
}
echo '</table>';



echo '</div>';
echo '</body>';
echo '</html>';
}
//YOU AREN'T EVEN LOGGED IN! GO BACK TO LOGIN!
else{die(header( 'Location: '.$url.'/admin' ));}

$mysqli->close();
?>
