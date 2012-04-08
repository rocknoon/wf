<?php

class WF_Session{

	
	private static $_start = false;
	
	public static function Set( $key , $value ){
		self::_startSession();
		$_SESSION[$key] = $value;
	}
	
	public static function Get( $key ){
		self::_startSession();
		return $_SESSION[$key];
	}
	
	private static function _startSession(){
	
		if( !self::$_start ){
			session_start();
			self::$_start = true;
			return true;
		}
	}
	
	
	
}