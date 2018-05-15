<?php
require_once('up.php');
$sql3 = 'SELECT * FROM content ORDER BY ID DESC';
$result3 = mysqli_query($mysqli,$sql3);
$rows3 = mysqli_num_rows($result3);

for($k = 0; $k < $rows3; $k++) {
$contentid[$k] = db_result($result3,$k,"ID");
$contenttext[$k] = db_result($result3,$k,"CONTENT");
$contenttitle[$k] = db_result($result3,$k,"TITLE");
$contentdisplay[$k] = db_result($result3,$k,"DISPLAY");
$contentpos[$k] = db_result($result3,$k,"POS");
}
$savek=$k;
while($k>0){
if($contentarea[$k-"1"]=="FOOTER"&&$contenttype[$k-"1"]=="MAIN"){$footertext=$contenttext[$k-"1"];}
$k--;
}
$k=$savek;

$sql5 = 'SELECT * FROM pages ORDER BY ID';
$result5 = mysqli_query($mysqli,$sql5);
$rows5 = mysqli_num_rows($result5);

for($m = 0; $m < $rows5; $m++) {
$pageid[$m] = db_result($result5,$m,"ID");
$pageslug[$m] = db_result($result5,$m,"SLUG");
$pagetitle[$m] = db_result($result5,$m,"TITLE");
$pagedescription[$m] = db_result($result5,$m,"DESCRIPTION");
$pagekeywords[$m] = db_result($result5,$m,"KEYWORDS");
$pagecontent[$m] = db_result($result5,$m,"CONTENT");
}
?>
