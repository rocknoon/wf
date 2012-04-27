<?php

class WF_Session{

	
	private static $_start = false;
	
	public static function Set( $key , $value ){
		self::_startSession();
		$value = serialize($value);
		$_SESSION[$key] = $value;
	}
	
	public static function Get( $key ){
		self::_startSession();
		$rtn = unserialize($_SESSION[$key]);
		return $rtn;
	}
	
	private static function _startSession(){
	
		if( !self::$_start ){
			session_start();
			self::$_start = true;
			return true;
		}
	}
	
	
	
}