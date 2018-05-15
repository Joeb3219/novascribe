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
echo '<title>'.$title.': Theme Selection</title>';
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo '</head>';
echo '<body>';
require_once("includes/sidebar.php");
echo '<div class="adminBody">';
echo '<h2>Theme Selection</h2>';

echo '<b>Hello</b>, '.$userusername[0].'. <a href="'.$url.'/admin/admin.php?logout=true">Logout</a>?<br><br>';
if(is_admin($username)){
if(isset($_GET['update'])){
install_theme($_POST['theme']);
die(header('Location: '.$url.'/admin/admin-themes.php'));
}

echo '<table border="1">';
echo '<tr>';
echo '<td><strong>Active?</strong></td>';
echo '<td><strong>Theme Name</strong></td>';
echo '<td><strong>Theme Author</strong></td>';
echo '<td><strong>Theme Description</strong></td>';
echo '<td><strong>Theme Version</strong></td>';
echo '</tr>';
echo '<form action="admin-themes.php?update=true" method="POST">';
if ($handle = opendir($fullpath.'/themes')){
    while (false!==($result = readdir($handle))){
        if($result!='.'&&$result!='..'){

require_once($fullpath.'/themes/'.$result.'/info.php');
$themeDescription.'-'.$themeAuthor.'-'.$themeWebsite;
echo '<tr>';
echo '<td>';
if($currenttheme==$result){echo '<input type="radio" name="theme" value="'.$result.'" checked="yes">';}
else{echo '<input type="radio" name="theme" value="'.$result.'">';}
echo '</td>';
echo '<td>'.$themeName.'</td>';
echo '<td><a href="'.$themeWebsite.'">'.$themeAuthor.'</a></td>';
echo '<td style="width:500px;">'.substr($themeDescription,0, 150).'</td>';
echo '<td>'.$themeVersion.'</td>';
echo '</tr>';

        }
    }
    closedir($handle);
}
echo '</table>';
echo '<input type="submit" value="Update">';
echo '</form>';
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
