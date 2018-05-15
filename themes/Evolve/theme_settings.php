<?php
require_once('evolve_options.php');
echo '<form action="admin-theme.php?edit=true" method="POST">';
echo 'Background Colour: <input type="text" name="bgcolour" value="'.$bg_colour.'"><br>';
echo 'Nav Colour: <input type="text" name="navcolour" value="'.$nav_colour.'"><br>';
echo 'Logo Position: <input type="text" name="logopos" value="'.$logo_position.'"><br>';
echo 'Header Height: <input type="text" name="headerheight" value="'.$header_height.'"><br>';
echo '<input type="submit" value="Submit values">';
echo '</form>';
if(isset($_GET['edit'])){
$absdir=dirname(__FILE__);
$reldir=str_replace("/themes/Evolve", "",$absdir);
$updir=$reldir.'/includes/up.php';
require_once($updir);
function add_values($option,$newvalue){
global $mysqli;
mysqli_query($mysqli,"UPDATE `theme` SET `VALUE`='".$newvalue."' WHERE `OPTION`='".$option."'") or die(mysqli_error($mysqli));
}
add_values('EVOLVE_BG_COLOUR',kill_string($_POST['bgcolour']));
add_values('EVOLVE_NAV_COLOUR',kill_string($_POST['navcolour']));
add_values('EVOLVE_LOGO_POSITION',kill_string($_POST['logopos']));
add_values('EVOLVE_HEADER_HEIGHT',kill_string($_POST['headerheight']));
header( 'Location: '.$url.'/admin/admin-theme.php' );
}
?>
