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
		
		
		//实力化出应该调用的 contrller
		
		//执行controller 的perAction
		$controller->perAction();
		
		//执行controller 的action 部分
		$ifRender = $controller->action();
		
		//执行contoller 的postAction 部分
		$controller->postAction();
		
		/**
		 * 如果需要进行渲染则 启用View引擎, 使用何种View 引擎可以在配置中进行配置
		 */
		if( $ifRender ){
			
			$view = WF_Application_View_Manager::GetView();
			$view->render( $tpl , $response );
			
		}
		
		
			
	}
	
	
}

?>