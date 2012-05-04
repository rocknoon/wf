<?php 

class WF_Application_Dispather{
	
	/**
	 * 对请求进行分发
	 * 
	 * @param WF_Application_Request $request
	 * @param WF_Application_Response $response
	 */
	public static function dispath( WF_Application_Request $request , WF_Application_Response $response ){
		
		
		//实例化出应该调用的 contrller
		$dir = $request->getDirectory();
		$controller_key = $request->getController();
		$controller_name = ucfirst($controller_key) . 'Controller';
		$action = $request->getAction();
		$hierarchy = ($request->getDirectory() === 'default') ? '' : $dir . '/';	
		$controller_file = APP_PATH . '/app/' . $hierarchy . 'controller/' . $controller_key . '.php';
	
		require $controller_file;
		$controller = new $controller_name();
		$controller->init();
		//调用action
		$ifRender = $controller->$action();
		
		
		/**
		 * 如果需要进行渲染则 启用View引擎, 使用何种View 引擎可以在配置中进行配置
		 */
		if($ifRender === null){
			
			$view = WF_Application_View_Manager::GetView();
			if($controller->view) {
				foreach($controller->view as $key=>$value) {
					$view->$key = $value;
				}
			}
			
			//找到相应的tpl
			$tpl   = $view->getTpl();
			if( $tpl ){
				$tplfile 	  = APP_PATH . '/app/' . $hierarchy . 'views/' . $controller_key . '/'.$tpl . '.phtml';
			}else{
				$tplfile 	  = APP_PATH . '/app/' . $hierarchy . 'views/' . $controller_key . '/'.$action . '.phtml';
			}
			$view->setTplFile( $tplfile );
			
			//如果设置了layout 找到相应的layout 文件
			$layout   = $view->getLayout();
			if( $layout ){
				$layoutFile = APP_PATH . '/app/' . $hierarchy . 'views/' . $layout . '.phtml';
			}else{
				$layoutFile = APP_PATH . '/app/' . $hierarchy . 'views/layout.phtml';
			}
			$view->setLayoutFile( $layoutFile );
			
			$view->render( $response );
			
		}
	}
}
