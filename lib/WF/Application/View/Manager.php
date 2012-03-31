<?php 

class WF_Application_View_Manager {
	
	
	private static $_View;
	
	/**
	 * @return WF_Application_View_Abstract
	 */
	public static function GetView(){
		
		
		if( self::$_View ){
			return self::$_View;
		}
		
		if( WF_Application_Manager::$Config->app->view ){
			$view = WF_Application_Manager::Component(
					WF_Application_Manager::$Config->app->view
			);
			
		}else{
			$view = new WF_Application_View_Standard();
		}
		
		return self::$_View = $view;
	}
	
	
}