<?php 
/**
 * 系统所有Router的管理者
 */
class WF_Application_Router_Manager {
	
	
	
	private $_routers = array();
	
	/**
	 * @return WF_Application_Router_Manager
	 */
	public static function Instance(){
	
	}
	
	
	public function router( WF_Application_Request $request ){
		
		
		$path = $request->getPath();
		
		foreach( $this->_routers as $router ){
			
			if($router->match($path)){
				$this->_setRequest( $request );
				break;
			}
			
		}
		
		
	}
	
	public function addRouter( WF_Application_Router_Interface $router ){
		
		$this->_routers []= $router;
		
	}
	
	
}