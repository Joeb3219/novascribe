<?php
$savel=$l;
while($l>0){
if($themeoption[$l-"1"]=="EVOLVE_BG_COLOUR"){$bg_colour=$themevalue[$l-"1"];}
if($themeoption[$l-"1"]=="EVOLVE_NAV_COLOUR"){$nav_colour=$themevalue[$l-"1"];}
if($themeoption[$l-"1"]=="EVOLVE_LOGO_POSITION"){$logo_position=$themevalue[$l-"1"];}
if($themeoption[$l-"1"]=="EVOLVE_HEADER_HEIGHT"){$header_height=$themevalue[$l-"1"];}

$l--;
}
$l=$savel;
?>
