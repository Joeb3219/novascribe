<?php
ob_start();
define("n","\n"); // new line
define('includedie',TRUE);
include("includes/includes.php");
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
echo '<title>'.$title.': NovaScribe Update </title>';
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '</head>';
echo '<body>';
include("includes/sidebar.php");
echo '<div class="adminBody">';
echo '<h2>Update NovaScribe</h2>';

echo '<b>Hello</b>, '.$userusername[0].'. <a href="'.$url.'/admin/admin.php?logout=true">Logout</a>?<br><br>';
if(try_login()){
if(is_admin($username)){
echo '<a href="'.$url.'/admin/admin-update.php?update=true">Click here to check for NovaScribe updates</a><br>';
if(isset($_GET['update'])&&$_GET['update']=="true"){
//Proof that file isn't overwritten.
$upgradecontent = file_get_contents('http://www.upgrade.novascribe.com');
$upgradeversion = explode('cv:',$upgradecontent,3);
$upgradever = trim($upgradeversion[1]);
echo 'NEW VERSION: "'.$upgradever.'"<br>';
echo 'CURRENT VERSION: "'.$version.'"<br>';
$downloadlink = explode('dl:',$upgradecontent,3);
$download = $downloadlink[1];
$download=trim($download);
$downloadbase = explode('ba:',$upgradecontent,3);
$base = trim($downloadbase[1]);
$basename = explode('fi:',$upgradecontent,3);
$basename = trim($basename[1]);

if($upgradever!=$version){
echo 'A new version of NovaScribe is available.<br>Would you like to upgrade? <a href="'.$url.'/admin/admin-update.php?confirm=confirm&update=true">Upgrade</a><br>';
if(isset($_GET['confirm'])&&$_GET['confirm']=="confirm"&&$upgradever!=$version){
//Update database -> reflect new version
mysqli_query($mysqli,"UPDATE options SET VALUE='".$upgradever."' WHERE `OPTION`='VERSION'")
or die(mysqli_error($mysqli));
//Download the zip
$src = fopen($download, 'r');
$zipdir=$fullpath.'/new.zip';
$dest = fopen($zipdir, 'w');
echo stream_copy_to_stream($src, $dest) . " bytes copied (CMS ZIP).<br>\n";
fclose($src);
fclose($dest);
$graboverwrite = $base.'overwrite.php';
$graboverwrite = file_get_contents($graboverwrite).'overwrite.php';
$overwrite = explode(';',$graboverwrite);

/*BASE
foreach(list_files($fullpath.'/NovaScribe_0_3_1') as $pointer){
if(is_dir($fullpath.'/'.$pointer)){echo 'Directory: <span style="color:red;">'.$pointer.'</span><br>';}
else{echo 'File: '.$pointer.'<br>';}
}
*/

//UNZIP THE ZIP FOLDER
$extract = new ZipArchive;
if ($extract->open($zipdir) === TRUE) {
$extract->extractTo($fullpath);
$extract->close();
echo 'UNZIPPED!<br>';}
else {echo 'UNZIPPED FAILED.<br>';}

//Create new directories.
foreach(list_files($fullpath.'/'.$basename) as $pointer){
if(is_dir($fullpath.'/'.$pointer)){
$testdir=$fullpath.'/'.$pointer;
if(!is_dir($testdir)){
mkdir($testdir, 0755, true);
echo 'Directory Annexed: '.$testdir.'<br>';
}}}

//Delete old files.
foreach(list_files($fullpath) as $existingFile){
if(is_file($fullpath.'/'.$existingFile)&&strpos($existingFile,$basename)===false&&strpos($existingFile,'new.zip')===false){
$tryfile=$fullpath.'/'.$existingFile;
$fileExists=false;
foreach(list_files($fullpath.'/'.$basename) as $pointer){
if($pointer==$existingFile){$fileExists=true;}
}
if($fileExists==false){
unlink($tryfile);
echo 'File Removed: '.$existingFile.'<br>';
}}}

//Add new files.
foreach(list_files($fullpath.'/'.$basename) as $pointer){
if(is_file($fullpath.'/'.$pointer)){
$testfile=$fullpath.'/'.$pointer;
if(!is_file($testfile)){
copy($fullpath.'/'.$basename.'/'.$pointer,$testfile);
echo 'File Annexed: '.$pointer.'<br>';
}}}

//Overwrite files
foreach($overwrite as $replace){
if(is_file($fullpath.'/'.$replace)&&is_file($fullpath.'/'.$basename.'/'.$replace)){
$replacefile=$fullpath.'/'.$replace;
unlink($replacefile);
rename($fullpath.'/'.$basename.'/'.$replace,$replacefile);
echo 'File Altered: '.$replace.'<br>';
}}

//Delete zipped folder + created folder
unlink($zipdir);

function rrmdir($dir) { 
  foreach(glob($dir . '/*') as $file) { 
    if(is_dir($file)){rrmdir($file);}else{unlink($file);} 
  } rmdir($dir); 
}
rrmdir($fullpath.'/'.$basename);
include($fullpath.'/setup.php');
//die(header( 'Location: '.$url.'/admin/admin-update.php' ));
}
else{echo 'Up to date!';}
}}

echo '</div>';
echo '</body>';
echo '</html>';
}}
else{echo 'You are not authorized to view this page!';}
}
//YOU AREN'T EVEN LOGGED IN! GO BACK TO LOGIN!
else{die(header( 'Location: '.$url.'/admin' ));}

$mysqli->close();
?>
