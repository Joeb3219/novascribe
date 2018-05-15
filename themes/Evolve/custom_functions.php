<?php

function output_content($the_content){
require_once('header.php');
if (strpos(' '.$the_content,'$phpused=1;') !== false) {
eval($the_content);
}
else{echo $the_content;}
require_once('footer.php');
}
?>
