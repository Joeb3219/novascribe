<?php
require_once('up.php');
require_once('functions.php');
$sql = 'SELECT * FROM options ORDER BY ID';
$result = mysqli_query($mysqli,$sql);
$rows = mysqli_num_rows($result);

for($i = 0; $i < $rows; $i++) {
$id[$i] = db_result($result,$i,"ID");
$option[$i] = db_result($result,$i,"OPTION");
$value[$i] = db_result($result,$i,"VALUE");
}
$savei=$i;
while($i>0){
if($option[$i-"1"]=="URL"){$url=$value[$i-"1"];}
elseif($option[$i-"1"]=="TITLE"){$title=$value[$i-"1"];}
elseif($option[$i-"1"]=="DESCRIPTION"){$description=$value[$i-"1"];}
elseif($option[$i-"1"]=="KEYWORDS"){$keywords=$value[$i-"1"];}
elseif($option[$i-"1"]=="FAVICON_LOCATION"){$favicon=$value[$i-"1"];}
elseif($option[$i-"1"]=="STYLESHEET"){$stylesheet=$value[$i-"1"];}
elseif($option[$i-"1"]=="GAUSER"){$gauser=$value[$i-"1"];}
elseif($option[$i-"1"]=="FULL_PATH"){$fullpath=$value[$i-"1"];}
elseif($option[$i-"1"]=="LOGO"){$logo=$value[$i-"1"];}
elseif($option[$i-"1"]=="SITENAME"){$sitename=$value[$i-"1"];}
elseif($option[$i-"1"]=="SET"){$set=$value[$i-"1"];}
elseif($option[$i-"1"]=="VERSION"){$version=$value[$i-"1"];}
elseif($option[$i-"1"]=="CURRENT_THEME"){$currenttheme=$value[$i-"1"];}
elseif($option[$i-"1"]=="REGISTRATION"){$registration=$value[$i-"1"];}
elseif($option[$i-"1"]=="RCODE"){$registrationcode=$value[$i-"1"];}
elseif($option[$i-"1"]=="DEFAULT_RANK"){$defaultrank=$value[$i-"1"];}
elseif($option[$i-"1"]=="ADMIN_EMAIL"){$adminemail=$value[$i-"1"];}
elseif($option[$i-"1"]=="SESSION_LENGTH"){$sessionlength=$value[$i-"1"];}
$i--;
}
$i=$savei;

$sql4 = 'SELECT * FROM theme ORDER BY ID';
$result4 = mysqli_query($mysqli,$sql4);
$rows4 = mysqli_num_rows($result4);

for($l = 0; $l < $rows4; $l++) {
$themeid[$l] = db_result($result4,$l,"ID");
$themeoption[$l] = db_result($result4,$l,"OPTION");
$themevalue[$l] = db_result($result4,$l,"VALUE");
}


?>
