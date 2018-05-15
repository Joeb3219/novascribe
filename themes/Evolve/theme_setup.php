<?php
function theme_setup(){
$absdir=dirname(__FILE__);
$reldir=str_replace("/themes/Evolve", "",$absdir);
require_once($reldir.'/includes/up.php');
insert_if_needed($mysqli,'theme','OPTION','EVOLVE_BG_COLOUR','`OPTION`,`VALUE`','\'EVOLVE_BG_COLOUR\',\'#292929\'');
insert_if_needed($mysqli,'theme','OPTION','EVOLVE_NAV_COLOUR','`OPTION`,`VALUE`','\'EVOLVE_NAV_COLOUR\',\'#292929\'');
insert_if_needed($mysqli,'theme','OPTION','EVOLVE_LOGO_POSITION','`OPTION`,`VALUE`','\'EVOLVE_LOGO_POSITION\',\'BOTTOM LEFT\'');
insert_if_needed($mysqli,'theme','OPTION','EVOLVE_HEADER_HEIGHT','`OPTION`,`VALUE`','\'EVOLVE_HEADER_HEIGHT\',\'80px\'');
}
?>
