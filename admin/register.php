<?php
define("n","\n"); // new line
define('includedie',TRUE);
$absdir=dirname(__FILE__);
$reldir=str_replace("/admin", "",$absdir);
$updir=$reldir.'/includes/up.php';
include($updir);
include($reldir.'/includes/functions.php');
$optionsdir=$reldir.'/includes/options.php';
include($optionsdir);
echo '<html>'.n;
echo '<title>Registration</title>'.n;
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '</head>'.n;
echo '<body>'.n;
echo '<div class="loginBox">';
echo '<h2>'.$title.': Registration</h2>';
if($registration=="DENY"){echo 'Registrations are not allowed by the admin.';}
if($registration=="ALLOW"){
if(!empty($_POST['username'])&&!empty($_POST['password'])&&!empty($_POST['password2'])&&!empty($_POST['email'])&&!empty($_POST['reg_code'])&&!empty($_POST['salt'])&&isset($_GET['reg'])&&$_GET['reg']=="true"){
$rusername=strtolower($_POST['username']);
$rusername=mysqli_real_escape_string($mysqli,$rusername);
$rpassword=$_POST['password'];
$rpassword=mysqli_real_escape_string($mysqli,$rpassword);
$rpassword2=$_POST['password2'];
$rpassword2=mysqli_real_escape_string($mysqli,$rpassword2);
$remail=strtolower($_POST['email']);
$remail=mysqli_real_escape_string($mysqli,$remail);
$rcode=$_POST['reg_code'];
$rcode=mysqli_real_escape_string($mysqli,$rcode);
$rsalt=$_POST['salt'];
if($rpassword==$rpassword2&&$rcode==$registrationcode&&!username_exists($rusername)&&!email_exists($remail)){
$rpassword=sha1($salt.$rpassword);
mysqli_query($mysqli,"INSERT INTO `users` (`USERNAME`,`PASSWORD`,`SALT`,`RANK`,`EMAIL`) VALUES ('".$rusername."','".$rpassword."','".$rsalt."','".$defaultrank."','".$remail."')");
echo 'Registration Successful. An email has been sent to your email to verify the successful registration.<br>Feel free to sign in via the <a href="'.$url.'/admin" title="Login Page">Login Page</a>.';
//Alert the Admin that a user has registered.
$subject='New User!';
$message='Hello, Admin!';
$message=$message.'A new user has registered!'.n;
$message=$message.'Username: '.$rusername.n;
$message=$message.'Email: '.$remail.n;
$message=$message.'Rank: '.$defaultrank.n;
$message=$message.'IP: '.$_SERVER['REMOTE_ADDR'].n;
$message=$message.'If you would like to remove this user, please enter your admin panel and remove them.'.n;
$message=$message.'This email was sent via '.$title.', powered by <a href="http://www.NovaScribe.com">NovaScribe</a>.'.n.n;
$headers = 'From: '.$title.' <'.$adminemail.n;
mail($adminemail,$subject,$message,$headers);
//Alert the user who signed up.
$subject='Successful Registration';
$message='Hello, '.$rusername.n;
$message=$message.'Your registration at '.$title.' was successful. Please keep this information for future reference:'.n;
$message=$message.'Username: '.$rusername.n;
$message=$message.'Email: '.$remail.n.n;
$message=$message.'This email was sent via '.$title.', powered by <a href="http://www.NovaScribe.com">NovaScribe</a>.'.n;
mail($remail,$subject,$message,$headers);
}
else{echo 'Registration failed. Please go to the <a href="'.$url.'/admin/register.php" title="register">registration page</a> to try again.<br>Likely reasons for this include:';
echo '<ul>';
echo '<li>Username already in use</li>';
echo '<li>Email already in use</li>';
echo '<li>Passwords did not match</li>';
echo '<li>Invalid Registration Code.</li>';
echo '</ul>';
}
}
else{
//GENERATE RANDOM SALT FOR USE IN ENCRYPTION.
$salt = uniqid(mt_rand(), true);
//REGISTRATION FORM
echo '<form action="register.php?reg=true" method="POST">'.n;
echo 'Username: <input type="text" name="username"><br>'.n;
echo 'Password: <input type="text" name="password"><br>'.n;
echo 'Confirm Password: <input type="text" name="password2"><br>'.n;
echo 'Email: <input type="text" name="email"><br>'.n;
echo 'Site Registration Code: <input type="text" name="reg_code"><br>'.n;
echo '<input type="hidden" name="salt" value="'.$salt.'">'.n;
echo '<input type="submit" value="Register">'.n;
echo '</form>'.n;
echo '<a href="'.$url.'/admin" title="Login">Login Page</a> | <a href="'.$url.'" title="Home">Home</a>';
}
}
echo '</div>';
echo '</body>'.n;
echo '</html>'.n;
?>
