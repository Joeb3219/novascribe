<?php
define('includedie',TRUE);
require_once('includes/options.php');
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
//MAKE DATABASE REFLECT NEW VERSION.
mysql_query("UPDATE options SET VALUE='".$upgradever."' WHERE `OPTION`='VERSION'")
or die(mysql_error());
//DOWNLOAD THE ZIP FILE OF NEW VERSION!
$src = fopen($download, 'r');
$dest = fopen('new.zip', 'w');
echo stream_copy_to_stream($src, $dest) . " bytes copied (CMS ZIP).\n";
fclose($src);
fclose($dest);
//DELETE OLD FILES (Unneeded, changed, etc.)
$grabdeletefile = $base.'remove.php';
$grabdeletefile = file_get_contents($grabdeletefile).'remove.php';
$deletebroken = explode(';',$grabdeletefile);
$i=count($deletebroken);$savei=$i;
$newdirfile = $base.'directories.php';
$newdirfile = file_get_contents($newdirfile);
$createfiles = explode(';',$newdirfile);
$dircount=count($createfiles);
//CREATE NEW DIRECTORIES
$savedircount=$dircount;
while($dircount>0){
if($createfiles[$dircount-"1"]!=" "&&$createfiles[$dircount-"1"]!=''){mkdir($createfiles[$dircount-"1"], 0755, true);
echo 'Directory Annexed: '.$createfiles[$dircount-"1"].'<br>';}
$dircount--;}
$dircount=$savedircount;
//LET'S DELETE THE FILES
$savei=$i;
while($i>0){
if($deletebroken[$i-"1"]!=" "&&$deletebroken[$i-"1"]!=''){unlink($deletebroken[$i-"1"]);
echo 'File Deleted: '.$deletebroken[$i-"1"].'<br>';}
$i--;}
$i=$savei;
//UNZIP THE NEEDED FILES TO FOLDER
$extract = new ZipArchive;
if ($extract->open('new.zip') === TRUE) {
$savei=$i;
while($i>0){
$deletefile[$i-"1"]=$basename.'/'.$deletebroken[$i-"1"];
if($deletebroken[$i-"1"]!=" "&&$deletebroken[$i-"1"]!=''){$extract->extractTo($fullpath,$deletefile[$i-"1"]);
echo 'File Annexed: '.$deletefile[$i-"1"].'<br>';}
$i--;}
$i=$savei;
$extract->close();
echo 'UNZIPPED!';}
else {echo 'UNZIPPED FAILED.';}
//MOVE NEEDED FILES TO NEEDED DESTINATION
$savei=$i;
while($i>0){
copy($deletefile[$i-"1"],$deletebroken[$i-"1"]);
$i--;}
$i=$savei;
//DELETE ZIPPED FOLDER && CREATED FOLDER
unlink('new.zip');

function rrmdir($dir) { 
  foreach(glob($dir . '/*') as $file) { 
    if(is_dir($file)) rrmdir($file); else unlink($file); 
  } rmdir($dir); 
}
rrmdir($basename);
}

else{echo 'Up to date!';}
?>
