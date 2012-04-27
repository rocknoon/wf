<?php 
	class APP_User_Factory{
		
		
		private static $_instance;
		
		/**
		 * @return  APP_User_Interface
		 */
		public static function Factory(){
			if( !self::$_instance ){
				self::$_instance = new APP_User_Imple();
			}
			return self::$_instance;
		}
		
	}
?>