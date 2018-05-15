<?php
echo '<script type="text/javascript">'.n;
echo 'var _gaq = _gaq || [];'.n;
echo '_gaq.push([\'_setAccount\', \''.$gauser.'\']);'.n;
echo '_gaq.push([\'_trackPageview\']);'.n;
echo '(function() {'.n;
echo 'var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;'.n;
echo 'ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';'.n;
echo 'var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);'.n;
echo '})();'.n;
echo '</script>'.n;
?>
