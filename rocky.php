<?php 
$memStart = xdebug_memory_usage();

include "111.php";


echo "<br/>mem:" . ($memEnd - $memStart) . "<br/>";
echo "PEAK:" . xdebug_peak_memory_usage();
?>