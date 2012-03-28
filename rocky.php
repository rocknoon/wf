<?php 
$memStart = xdebug_memory_usage();

$text = "1111";

echo "1";

$memEnd = xdebug_memory_usage();
echo "mem:" . ($memEnd - $memStart) . "<br/>";
?>