<?php
if(!defined('includedie')){die(header( 'Location: '.$url ));}
require('up.php');

$sql2 = 'SELECT * FROM navigation ORDER BY POSITION DESC, ID DESC';
$result2 = mysqli_query($mysqli,$sql2);
$rows2 = mysqli_num_rows($result2);

for($j = 0; $j < $rows2; $j++) {
$navid[$j] = db_result($result2,$j,"ID");
$navurl[$j] = db_result($result2,$j,"URL");
$navtitle[$j] = db_result($result2,$j,"TITLE");
$navtext[$j] = db_result($result2,$j,"TEXT");
$navposition[$j] = db_result($result2,$j,"POSITION");
$navdisplay[$j] = db_result($result2,$j,"DISPLAY");
}

?>
