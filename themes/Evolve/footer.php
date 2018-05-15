<?php
if(!defined('includedie')){die(header( 'Location: '.$url ));}
define("n","\n"); // new line
require_once($fullpath.'includes/options.php');
echo $pageid[1];
echo '</div>'.n;
echo '</div>'.n;
echo '</div>'.n;
echo '<div class="footer">'.n;
echo 'Copyright <a href="'.$url.'" title="'.$title.'">'.$title.'</a> 2013. Powered by <a href="http://www.novascribe.com" title="NovaScribe">NovaScribe</a>.'.n;
echo '</div>'.n;
echo '</body>'.n;
echo '</html>'.n;
?>
