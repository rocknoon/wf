<?php
$memStart = xdebug_memory_usage();


class Rocky{
	
	private static $a = array(1,2,3,4);
	
	public function get(){
		
		return self::$a;
		
	}
	
	public function set( &$p ){
		$p = &self::$a;
	}
	
	public function shift(){
		array_shift(self::$a);
	}
	
	
}

$r = new Rocky();


$a = $r->set();
$b = $r->set();

$r->shift();

echo $a[0];



$memEnd   = xdebug_memory_usage();
echo "mem:" . ($memEnd - $memStart) . "<br/>";