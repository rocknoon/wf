<?php 

class WF_Application_View_Manger {
	
		
	public static function GetView(){
		if( $config["view"] ){
			$view = $appilcation->component($config["view"]);
		}else{
			$view = new WF_Application_View_Default();
		}
		return $view;
	}
	
	
}