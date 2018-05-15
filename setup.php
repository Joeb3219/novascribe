<?php
define('includedie',TRUE);
require_once('includes/up.php');
require_once('includes/functions.php');

$urlinsert='http://'.$_SERVER['HTTP_HOST'];
$urlinsertrow='\'URL\',\''.$urlinsert.'\'';
$faviconurlurl=$urlinsert.'/images/favicon32.png';
$faviconurlrow='\'FAVICON_LOCATION\',\''.$faviconurlurl.'\'';
$stylesheeturlurl=$urlinsert.'/themes/Evolve/style.php';
$stylesheetrow='\'STYLESHEET\',\''.$stylesheeturlurl.'\'';
$absdir=dirname(__FILE__);
$absdirrow='\'FULL_PATH\',\''.$absdir.'\'';
$aboutpagelink=$urlinsert.'/about';

//CREATE OPTIONS TABLE (VER: 0.1.1)
$result = mysqli_query($mysqli,"SHOW TABLES LIKE 'options'");
$tableExists = mysqli_num_rows($result) > 0;
if($tableExists==0){
mysqli_query($mysqli,"CREATE TABLE IF NOT EXISTS options (`ID` INT AUTO_INCREMENT, `OPTION` TEXT NOT NULL, `VALUE` TEXT NOT NULL, primary key (ID))");}

//CREATE CONTENT TABLE (VER: 0.1.1)
$result = mysqli_query($mysqli,"SHOW TABLES LIKE 'content'");
$tableExists = mysqli_num_rows($result) > 0;
if($tableExists==0){
mysqli_query($mysqli,"CREATE TABLE IF NOT EXISTS content (`ID` INT AUTO_INCREMENT, `URL` TEXT NOT NULL, `CONTENT` TEXT NOT NULL, `TITLE` TEXT NOT NULL, `DISPLAY` TEXT NOT NULL, `POS` INT NOT NULL, primary key (ID))");}

//CREATE NAVIGATION TABLE (VER: 0.1.1)
$result = mysqli_query($mysqli,"SHOW TABLES LIKE 'navigation'");
$tableExists = mysqli_num_rows($result) > 0;
if($tableExists==0){
mysqli_query($mysqli,"CREATE TABLE IF NOT EXISTS navigation (`ID` INT AUTO_INCREMENT, `URL` TEXT NOT NULL, `TITLE` TEXT NOT NULL, `TEXT` TEXT NOT NULL, `POSITION` TEXT NOT NULL, `DISPLAY` TEXT NOT NULL, primary key (ID))");}

//CREATE PAGES TABLE (VER: 0.1.1)
$result = mysqli_query($mysqli,"SHOW TABLES LIKE 'pages'");
$tableExists = mysqli_num_rows($result) > 0;
if($tableExists==0){
mysqli_query($mysqli,"CREATE TABLE IF NOT EXISTS pages (`ID` INT AUTO_INCREMENT, `SLUG` TEXT NOT NULL, `TITLE` TEXT NOT NULL, `DESCRIPTION` TEXT NOT NULL, `KEYWORDS` TEXT NOT NULL, `CONTENT` TEXT NOT NULL, primary key (ID))");}

//CREATE THEME TABLE (VER: 0.1.1)
$result = mysqli_query($mysqli,"SHOW TABLES LIKE 'theme'");
$tableExists = mysqli_num_rows($result) > 0;
if($tableExists==0){
mysqli_query($mysqli,"CREATE TABLE IF NOT EXISTS theme (`ID` INT AUTO_INCREMENT, `OPTION` TEXT NOT NULL, `VALUE` TEXT NOT NULL, primary key (ID))");
}

//CREATE USERS TABLE (VER: 0.2.1)
$result = mysqli_query($mysqli,"SHOW TABLES LIKE 'users'");
$tableExists = mysqli_num_rows($result) > 0;
if($tableExists==0){
mysqli_query($mysqli,"CREATE TABLE IF NOT EXISTS users (`ID` INT AUTO_INCREMENT, `USERNAME` TEXT NOT NULL, `PASSWORD` TEXT NOT NULL, `SALT` TEXT NOT NULL, `RANK` TEXT NOT NULL, `EMAIL` TEXT NOT NULL, `SID` TEXT NOT NULL, `IP` TEXT NOT NULL,`TIME` TEXT NOT NULL, primary key (ID))");
}
//DEFAULT VALUES ADDED AS OF VER 0.1.1
insert_if_needed($mysqli,'options','OPTION','URL','`OPTION`,`VALUE`',$urlinsertrow);
insert_if_needed($mysqli,'options','OPTION','TITLE','`OPTION`,`VALUE`','\'TITLE\',\'This is the Default Title!\'');
insert_if_needed($mysqli,'options','OPTION','DESCRIPTION','`OPTION`,`VALUE`','\'DESCRIPTION\',\'This is a default description!!\'');
insert_if_needed($mysqli,'options','OPTION','KEYWORDS','`OPTION`,`VALUE`','\'KEYWORDS\',\'This is a default keyword!!\'');
insert_if_needed($mysqli,'options','OPTION','FAVICON_LOCATION','`OPTION`,`VALUE`',$faviconurlrow);
insert_if_needed($mysqli,'options','OPTION','STYLESHEET','`OPTION`,`VALUE`',$stylesheetrow);
insert_if_needed($mysqli,'options','OPTION','FULL_PATH','`OPTION`,`VALUE`',$absdirrow);
insert_if_needed($mysqli,'options','OPTION','LOGO','`OPTION`,`VALUE`','\'LOGO\',\'http://www.cdn.websitebegin.com/wp-images/09/logo4_white.png\'');
insert_if_needed($mysqli,'options','OPTION','SET','`OPTION`,`VALUE`','\'SET\',\'UP\'');
insert_if_needed($mysqli,'options','OPTION','VERSION','`OPTION`,`VALUE`','\'VERSION\',\'0.3.1\'');
$urlinsertrowrow='\''.$urlinsert.'\',\'Home\',\'Home!\',\'1\',\'YES\'';
insert_if_needed($mysqli,'navigation','TITLE','Home','`URL`,`TITLE`,`TEXT`,`POSITION`,`DISPLAY`',$urlinsertrowrow);
$aboutpagerow='\''.$aboutpagelink.'\',\'About\',\'ABOUT!\',\'2\',\'YES\'';
insert_if_needed($mysqli,'navigation','TITLE','About','`URL`,`TITLE`,`TEXT`,`POSITION`,`DISPLAY`',$aboutpagerow);

insert_if_needed($mysqli,'pages','SLUG','','`SLUG`,`TITLE`,`DESCRIPTION`,`KEYWORDS`,`CONTENT`','\'\',\'null\',\'null\',\'null\',\'Welcome to your home page! It is very exciting to have you visit.<br><br>You can edit your website by navigating to the backend.<br><br> - Joe Boyle (on  behalf of the <a href="http://www.novascribe.com">NovaScribe</a> team)\'');
insert_if_needed($mysqli,'pages','SLUG','about','`SLUG`,`TITLE`,`DESCRIPTION`,`KEYWORDS`,`CONTENT`','\'about\',\'About Page\',\'ABOUT ME!\',\'ABOUT ME!\',\'This is your very own about page. Tell the entire world about you. You are gonna be big. It will be great!<br><br>-Joe Boyle\'');
insert_if_needed($mysqli,'pages','SLUG','404','`SLUG`,`TITLE`,`DESCRIPTION`,`KEYWORDS`,`CONTENT`','\'404\',\'404 Error Page\',\'404 Error Page\',\'404 Error Page\',\'<h2>Yikes! Four oh Four!</h2>You seem to have run into a slight problem! The page you requested cannot be found.<br><br>Try swimming back to the homepage while our team of underwater investigators search for the problem.\'');
//DEFAULT VALUES ADDED AS OF VER 0.2.1
insert_if_needed($mysqli,'options','OPTION','REGISTRATION','`OPTION`,`VALUE`','\'REGISTRATION\',\'ALLOW\'');
insert_if_needed($mysqli,'options','OPTION','RCODE','`OPTION`,`VALUE`','\'RCODE\',\'111111\'');
insert_if_needed($mysqli,'options','OPTION','GAUSER','`OPTION`,`VALUE`','\'GAUSER\',\'UA-1234567\'');
//DEFAULT VALUES ADDED AS OF VER 0.3.1
insert_if_needed($mysqli,'options','OPTION','DEFAULT_RANK','`OPTION`,`VALUE`','\'DEFAULT_RANK\',\'USER\'');
insert_if_needed($mysqli,'options','OPTION','ADMIN_EMAIL','`OPTION`,`VALUE`','\'ADMIN_EMAIL\',\'changeme@novascribe.com\'');
insert_if_needed($mysqli,'options','OPTION','SESSION_LENGTH','`OPTION`,`VALUE`','\'SESSION_LENGTH\',\'120\'');
//Used to setup a theme on first run. (VER: 0.3.1)
$checktheme = mysqli_query($mysqli,"SELECT 'VALUE' FROM `options` WHERE `OPTION`='CURRENT_THEME'") or die(mysqli_error($mysqli));
if(mysqli_num_rows($checktheme)==0){
insert_if_needed($mysqli,'options','OPTION','CURRENT_THEME','`OPTION`,`VALUE`','\'CURRENT_THEME\',\'Evolve\'');
install_theme('Evolve');
}


?>
