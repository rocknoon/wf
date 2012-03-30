<?php 
$memStart = xdebug_memory_usage();

$a = "111";

rocky($a);


echo $a;

function rocky( &$b ){
	
	$b = "333";
	echo xdebug_memory_usage();
	
}

$memEnd = xdebug_memory_usage();
echo "<br/>mem:" . ($memEnd - $memStart) . "<br/>";
echo "PEAK:" . xdebug_peak_memory_usage();
?>