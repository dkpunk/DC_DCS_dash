<?php
$vip=$_REQUEST['vip'];
#echo $vip;
$output = shell_exec(' wget -qO- http://'.$vip.'/Yodlee/DCRequestServlet');
echo "<pre>$output</pre>";
?>
