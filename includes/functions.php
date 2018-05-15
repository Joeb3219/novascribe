<?php
if(!defined('includedie')){die(header( 'Location: '.$url ));}
define("n","\n"); // new line

//LOADED ON INDEX, LOADS IN EVERYTHING. (VER: 0.1.1)
function throwcontent($page){
require_once('includes/up.php');
require_once('includes/options.php');
require_once('includes/contentgrab.php');
require_once('includes/navgrab.php');
require_once('themes/'.$currenttheme.'/custom_functions.php');
$fofcount=0;
$savem=$m;
while($m>0){
if($page==$pageslug[$m-"1"]){$titlevalue=$pagetitle[$m-"1"];$newdescription=$pagedescription[$m-"1"];$newkeywords=$pagekeywords[$m-"1"];$the_content=$pagecontent[$m-"1"];}
else{$fofcount++;}
$m--;
}
$m=$savem;
if($fofcount==$m){
$page="404";
$savem=$m;
while($m>0){
if($page==$pageslug[$m-"1"]){$titlevalue=$pagetitle[$m-"1"];$newdescription=$pagedescription[$m-"1"];$newkeywords=$pagekeywords[$m-"1"];$the_content=$pagecontent[$m-"1"];}
$m--;
}
$m=$savem;
}

require_once('includes/head.php');
output_content($the_content);
function output_files($directory){

}

$mysqli->close();
}

//CONTENT BOX -- WIDE (VER: 0.1.1)
function wide_box($boxid,$boxtitle,$boxcontent){
echo '<div class="wide_box" id="wideboxid'.$boxid.'">';
echo '<h2>'.$boxtitle.'</h2>';
echo $boxcontent;
echo '</div>';
}

//CONTENT BOX -- NORMAL (VER: 0.1.1)
function normal_box($boxid,$boxtitle,$boxcontent){
echo '<div class="normal_box" id="wideboxid'.$boxid.'">';
echo '<h2>'.$boxtitle.'</h2>';
echo $boxcontent;
echo '</div>';
}

//CONTENT BOX -- 1/3 SIZE (VER: 0.1.1)
function third_box($boxid,$boxarea,$boxtitle,$boxcontent){
}

//DEFAULT DOUBLE-SIDED RIBBON (VER: 0.1.1)
function ribbon($ribbontext){
echo '<div class="ribbonzindex">'.n;
echo '<div class="welcomeribbon">'.n;
echo '<div class="ribbonborder">'.n;
echo '<div class="ribboncontent">'.n;
echo '<div class="ribbontext">'.n;
if (isset($ribbontext)){echo $ribbontext;}
else{echo "ENTER SOME TEXT!!!";}
echo '</div>'.n;
echo '</div>'.n;
echo '</div>'.n;
echo '</div>'.n;
echo '</div>'.n;
}

//NUMBER OF ROWS RETURNED BY QUERY. (VER: 0.2.1)
function db_result($result,$row,$field) { 
  if($result->num_rows==0) return 'unknown'; 
  $result->data_seek($row);
  $ceva=$result->fetch_assoc(); 
  $rasp=$ceva[$field]; 
  return $rasp; 
}

//INSERT ROW TO DB IF NEEDED (VER: 0.2.1)
function insert_if_needed($mysqli,$table,$searchcolumn,$searchrow,$columns,$values){
global $mysqli;
$result = mysqli_query($mysqli,"SELECT '".$searchcolumn."' FROM `".$table."` WHERE `".$searchcolumn."`='".$searchrow."'") or die(mysqli_error($mysqli));
if(mysqli_num_rows($result)==0){
mysqli_query($mysqli,"INSERT INTO `".$table."` (".$columns.") VALUES(".$values.")") or die(mysqli_error($mysqli));
echo 'ADDED VALUES: ('.$values.') TO COLUMNS: ('.$columns.'), respectively, to '.$table.'<br>';
}}



//Used to remove "'" from outputs when being inserted into MYSQL. (VER: 0.3.1)
function kill_string($string){
$string=str_replace("'", "\'", $string);
return $string;
}

//Check if username exists (VER: 0.3.1)
function username_exists($username){
global $url,$mysqli;
$result = mysqli_query($mysqli,"SELECT * FROM `users` WHERE `USERNAME`='".$username."'") or die(mysqli_error($mysqli));
if(mysqli_num_rows($result)==0){return false;}
else{return true;}
}

//Check if email exists (VER: 0.3.1)
function email_exists($email){
global $url,$mysqli;
$result = mysqli_query($mysqli,"SELECT * FROM `users` WHERE `EMAIL`='".$email."'") or die(mysqli_error($mysqli));
if(mysqli_num_rows($result)==0){return false;}
else{return true;}
}

//Check if user is an admin (VER: 0.3.1)
function is_admin($username){
global $url,$mysqli;
$result = mysqli_query($mysqli,"SELECT RANK FROM `users` WHERE `USERNAME`='".$username."'") or die(mysqli_error($mysqli));
$row=mysqli_fetch_row($result);
$rank=$row[0];
if($rank=="ADMIN"){return true;}
else{return false;}
}

//Logs out the current user (VER: 0.3.1)
function clear_login($username){
global $mysqli;
mysqli_query($mysqli,"UPDATE `users` SET `SID`='', `IP`='' WHERE `USERNAME`='".$username."'") or die(mysqli_error($mysqli));
}

//Destroys the current session for the user (VER: 0.3.1)
function destroy_session($username){
clear_login($username);
session_unset();
session_destroy();
}

//Creates a new session for the user (VER: 0.3.1)
function create_session($username){
global $mysqli,$sessionlength;
$ip=$_SERVER['REMOTE_ADDR'];
$_SESSION['sesid']=md5(uniqid(mt_rand(), true));
$_SESSION['username']=$username;
$expiretime=strtotime(date('Y-m-d H:i:s'))+(60*$sessionlength);
$updateuser = mysqli_query($mysqli,"UPDATE `users` SET `SID`='".$_SESSION['sesid']."', `IP`='".$ip."', `TIME`='".$expiretime."' WHERE `USERNAME`='".$username."'") or die(mysqli_error($mysqli));
}

//Used to check if login is expired via time passed (VER: 0.3.1)
function time_login_is_expired($time){
$now=date('Y-m-d H:i:s');
$now=strtotime($now);
if($time<$now){return true;}
else{return false;}
}

//Check if user is logged in (VER: 0.3.1)
function is_logged_in($username){
global $mysqli;
$result = mysqli_query($mysqli,"SELECT TIME FROM `users` WHERE `USERNAME`='".$username."'") or die(mysqli_error($mysqli));
if(mysqli_num_rows($result)==0){return false;}
else{
$row=mysqli_fetch_row($result);
$time=$row[0];
if(empty($time)){return false;}
else{
if(!time_login_is_expired($time)){return true;}else{return false;}
}
}
}

//Used to actually log a user in (VER: 0.3.1)
function try_login(){
global $mysqli;
if(isset($_SESSION['username'])&&isset($_SESSION['sesid'])){
$username=$_SESSION['username'];
$sessionID=$_SESSION['sesid'];
if(is_logged_in($username)){
$result = mysqli_query($mysqli,"SELECT SID FROM `users` WHERE `USERNAME`='".$username."'") or die(mysqli_error($mysqli));
$row=mysqli_fetch_row($result);
$realID=$row[0];
$result = mysqli_query($mysqli,"SELECT IP FROM `users` WHERE `USERNAME`='".$username."'") or die(mysqli_error($mysqli));
$row=mysqli_fetch_row($result);
$realIP=$row[0];
$ip=$_SERVER['REMOTE_ADDR'];
if($realID==$sessionID&$realIP==$ip){return true;}
else{destroy_session($username);return false;}}
else{destroy_session($username);return false;}}
elseif(isset($_POST['un'])&&isset($_POST['pw'])){
$username=mysqli_real_escape_string($mysqli,$_POST['un']);
$result = mysqli_query($mysqli,"SELECT PASSWORD FROM `users` WHERE `USERNAME`='".$username."'") or die(mysqli_error($mysqli));
$row=mysqli_fetch_row($result);
$realPassword=$row[0];
$result = mysqli_query($mysqli,"SELECT SALT FROM `users` WHERE `USERNAME`='".$username."'") or die(mysqli_error($mysqli));
$row=mysqli_fetch_row($result);
$salt=$row[0];
$trypassword=mysqli_real_escape_string($mysqli,$_POST['pw']);
$trypassword=sha1($salt.$trypassword);
if($realPassword==$trypassword){clear_login($username);create_session($username);die(header( 'Location: '.$url.'/admin/admin.php' ));return true;}
else{return false;}}
else{return false;}
}

//Used to install a new theme (VER: 0.3.1)
function install_theme($themename){
//error_reporting(0);
global $mysqli,$url;
$dir='/themes/'.$themename;
$updatetheme=mysqli_query($mysqli,"UPDATE `options` SET `VALUE`='".$themename."' WHERE `OPTION`='CURRENT_THEME'") or die(mysqli_error($mysqli));
$stylesheet=$url.'/themes/'.$themename.'/style.php';
$updatestyle=mysqli_query($mysqli,"UPDATE `options` SET `VALUE`='".$stylesheet."' WHERE `OPTION`='STYLESHEET'") or die(mysqli_error($mysqli));
$absdir=dirname(__FILE__);
$reldir=str_replace($dir, "",$absdir);
$reldir=str_replace("/includes", "",$reldir);
require_once($reldir.'/themes/'.$themename.'/theme_setup.php');
theme_setup();
return 0;
}

function list_files($dir){
$base=scandir($dir);
foreach($base as $key){
if($key!=''&&$key!=' '&&$key!='.'&&$key!='..'&&$key!='cgi-bin'){
if(is_file($dir.'/'.$key)){$files[]=$key;}
if(is_dir($dir.'/'.$key)){$files[]=$key;foreach(list_files($dir.'/'.$key) as $inner){$files[]=$key.'/'.$inner;}}}}
return $files;
}
?>
