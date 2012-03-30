<?php 

class WF_Application_Dispather{
	
	
	/**
	 * @return WF_Application_Dispather
	 */
	public static function Instance(){
	
	}

	/**
	 * 对请求进行分发
	 * 
	 * @param WF_Application_Request $request
	 * @param WF_Application_Response $response
	 */
	public function dispath( WF_Application_Request $request , WF_Application_Response $response ){
		
		
		//实例化出应该调用的 contrller
		$dir = $request->getDirectory();
		$controller_key = $request->getController();
		$controller_name = ucfirst($controller_key) . 'Controller';
		$action = $request->getAction();
		$hierarchy = ($request->getDirectory() === 'default') ? '' : $dir . '/';	
		$controller_file = APP_PATH . '/app/' . $hierarchy . 'controller/' . $controller_key . '.php';
		try{
			require $controller_file;
			$controller = new $controller_name();
			//调用action
			$ifRender = $controller->$action();
		} catch (Exception $ex){
			echo $ex->getMessage();
		}
		
		/**
		 * 如果需要进行渲染则 启用View引擎, 使用何种View 引擎可以在配置中进行配置
		 */
		if($ifRender === null){
			
			$view = WF_Application_View_Manager::GetView();
			$view->render( $tpl , $response );
			
		}
	}
}
