<?php
$memStart = xdebug_memory_usage();
$timeStart = microtime(true); 


$memEnd   = xdebug_memory_usage();
$timeEnd = microtime(true); 
echo "mem:" . ($memEnd - $memStart) . "<br/>";
echo "time:" . ($timeEnd - $timeStart) * 1000 . "<br/>";