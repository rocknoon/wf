<?php 

	class WF_Application_Controller {
		
		
		public function layout( $layout ){
			$view = WF_Application_View_Manager::GetView();
			$view->setLayout( $layout );
		}
		
		public function render( $tpl ){
			
			$view = WF_Application_View_Manager::GetView();
			$view->setTpl( $tpl );
			
		}
		
		public function assign( $key, $value ){
			$view = WF_Application_View_Manager::GetView();
			$view->assign( $key , $value);
		}
		
		
	}