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
echo '<title>'.$title.': General Options</title>';
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '</head>';
echo '<body>';
require_once("includes/sidebar.php");
echo '<div class="adminBody">';
echo '<h2>General Options</h2>';
if(is_admin($username)){
echo '<b>Hello</b>, '.$userusername[0].'. <a href="'.$url.'/admin/admin.php?logout=true">Logout</a>?<br><br>';
echo '<form action="admin-options.php" method="POST">';
echo 'Site URL (Not recommended to change): <input type="text" name="url" value="'.$url.'"><br>';
echo 'Site Default Title: <input type="text" name="title" value="'.$title.'"><br>';
echo 'Site Default Description (Limit to 160 chars): <input type="text" name="description" value="'.$description.'"><br>';
echo 'Site Default Keywords (separated by commas): <input type="text" name="keywords" value="'.$keywords.'"><br>';
echo 'Admin Email: <input type="text" name="adminemail" value="'.$adminemail.'"><br>';
echo 'Favicon Location: <input type="text" name="favicon" value="'.$favicon.'"><br>';
echo 'Stylesheet URL: <input type="text" name="stylesheet" value="'.$stylesheet.'"><br>';
echo 'Google Analytics UA-String: <input type="text" name="gauser" value="'.$gauser.'"><br>';
echo 'Logo URL: <input type="text" name="logo" value="'.$logo.'"><br>';
echo 'Session Length: <input type="text" name="session" value="'.$sessionlength.'"><br>';
echo 'Default Rank: <input type="text" name="defaultrank" value="'.$defaultrank.'"><br>';
echo 'Allow Registration?: <select name="registration">';
if($registration=="ALLOW"){echo '<option value="ALLOW">Allow</option><option value="DENY">Deny</option>';}
else{echo '<option value="DENY">Deny</option><option value="ALLOW">Allow</option>';}
echo '</select><br>';
echo 'Registration Code (used to register): <input type="text" name="rcode" value="'.$registrationcode.'"><br>';
echo '<input type="submit" value="Submit values">';
echo '</form>';
if(isset($_POST['url'])){
function add_values($option,$newvalue){
$absdir=dirname(__FILE__);
$reldir=str_replace("/admin", "",$absdir);
$updir=$reldir.'/includes/up.php';
require($updir);
mysqli_query($mysqli,"UPDATE `options` SET `VALUE`='".$newvalue."' WHERE `OPTION`='".$option."'") or die(mysqli_error($mysqli));
}
add_values('URL',kill_string($_POST['url']));
add_values('TITLE',kill_string($_POST['title']));
add_values('DESCRIPTION',kill_string($_POST['description']));
add_values('KEYWORDS',kill_string($_POST['keywords']));
add_values('FAVICON_LOCATION',kill_string($_POST['favicon']));
add_values('STYLESHEET',kill_string($_POST['stylesheet']));
add_values('GAUSER',kill_string($_POST['gauser']));
add_values('LOGO',kill_string($_POST['logo']));
add_values('DEFAULT_RANK',kill_string($_POST['defaultrank']));
add_values('REGISTRATION',kill_string($_POST['registration']));
add_values('RCODE',kill_string($_POST['rcode']));
add_values('ADMIN_EMAIL',kill_string($_POST['adminemail']));
add_values('SESSION_LENGTH',kill_string($_POST['session']));
if(1==1){header( 'Location: '.$url.'/admin/admin-options.php' );}
echo '<h3>Values updated (refresh your page)!</h3>';
}}
else{echo 'You are not authorized to view this page.';}
echo '</div>';
echo '</body>';
echo '</html>';
}
//YOU AREN'T EVEN LOGGED IN! GO BACK TO LOGIN!
else{die(header( 'Location: '.$url.'/admin' ));}

$mysqli->close();
?>
