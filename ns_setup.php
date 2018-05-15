<?php
ob_start();
if(!defined('includedie')){die(header( 'Location: http://'.$_SERVER['HTTP_HOST']));}
echo '<html>';
echo '<head>';
echo '<title>NovaScribe Setup</title>';
echo '<style type="text/css" media="all">';
echo 'body{background-color:#696969;}.bodyBox{display: table;margin-left: auto;margin-right:auto;position: relative;margin-top:2%;border:1px dashed white;border-radius:5px;padding:15px;}.bodyBox h2{display: table;margin: 0 auto;padding-bottom: 15px;}a{color:white;text-decoration:underline;}a:hover{color:white;text-decoration:none;}';
echo '</style>';
echo '</head>';
echo '<body>';
echo '<center><img src="http://www.cdn.novascribe.com/images/novascribe_logo.png"/></center>';
echo '<div class="bodyBox">';
echo '<h2>Setup!</h2>';
echo '<form action="index.php?insert=true" method="POST">';
echo '<strong>Database values:</strong> These are registered through cPanel, PHPMYADMIN, etc.<br>Please visit the <a href="http://docs.novascribe.com/index.php?title=Installing_NovaScribe">NovaScribe Setup</a> page for more info.<br><br>';
echo 'Database Name (EG: novascribe, cms): <input type="text" name="database" value="novascribe"/><br>';
echo 'Database Username (EG: billybob): <input type="text" name="username"/><br>';
echo 'Database Password (EG: billypass): <input type="text" name="password"/><br>';
echo '<h2>Account Setup</h2>';
echo '<strong>Important:</strong> These are the credentials you will log in with! Write them down!<br><br>';
echo 'Username (must be lowercase): <input type="text" name="acusername"/><br>';
echo 'Password: <input type="text" name="acpass"/><br>';
echo 'Confirm Password: <input type="text" name="acpassc"/><br>';
echo 'Email: <input type="text" name="email"/><br>';
echo 'Confirm Email: <input type="text" name="emailc"/><br>';
echo '<input type="submit" value="Finish"/><br>';
echo '</form>';
if(isset($_GET['insert'])){
if(!empty($_POST['database'])&&!empty($_POST['username'])&&!empty($_POST['password'])&&!empty($_POST['acusername'])&&!empty($_POST['acpass'])&&!empty($_POST['acpassc'])&&!empty($_POST['email'])&&!empty($_POST['emailc'])&&$_POST['acpass']==$_POST['acpassc']&&$_POST['email']==$_POST['emailc']){
$values=array('db_name','db_user','db_pass','not_halfway');
$replaced=array($_POST['database'],$_POST['username'],$_POST['password'],'halfway');
$fh="includes/config.php";
$file=file_get_contents($fh);
$file=str_replace($values, $replaced, $file);
file_put_contents($fh, $file, LOCK_EX);
die(header( 'Location: http://'.$_SERVER['HTTP_HOST'].'/index.php?username='.strtolower($_POST['acusername']).'&password='.$_POST['acpass'].'&email='.$_POST['email']));
}
}
/*
<?php
define('DATABASE','db_name');
define('USERNAME','username');
define('PASSWORD','password');
define('SETUP','not_setup');
define('HALFWAY','not_halfway');
?>*/
echo '</div>';
echo '</body>';
echo '</html>';
?>

