<?php 

	class WF_Application_Controller {
		
		/**
		 * @var 请求参数
		 */
		private $param;
		
		/**
		 * @var Action name
		 */
		private $a;
		
		/**
		 * @var controller Name
		 */
		private $c;
		
		/**
		 * @var directory name
		 */
		private $d;
		
		
		/**
		 * 构造方法
		 */
		function __construct(){
			
			$this->_initParams();
			$this->_initACD();
			
		}
		
		/**
		 * 设置当前所要使用的layout
		 * $this->layout("login");
		 * @param string $layout
		 */
		public function layout( $layout ){
			$view = WF_Application_View_Manager::GetView();
			$view->setLayout( $layout );
		}
		
		/**
		 * 手动指定需要进行渲染的模版
		 * @param string $tpl
		 */
		public function render( $tpl ){	
			$view = WF_Application_View_Manager::GetView();
			$view->setTpl( $tpl );
		}
		
		/**
		 * 向模版渲染变量
		 * @param unknown_type $key
		 * @param unknown_type $value
		 */
		public function assign( $key, $value ){
			$view = WF_Application_View_Manager::GetView();
			$view->assign( $key , $value);
		}
		
		/**
		 * url 生成器
		 * @param unknown_type $data
		 * @param unknown_type $anchor
		 */
		public function url($arg0, $arg1, $arg2, $arg3) {
			$router = WF_Application_Router::Instance();
			return $router->url($arg0, $arg1, $arg2, $arg3);
		}
		
		/**
		 * 判断请求是否是 POST 方法
		 * @return bool
		 */
		public function isPost(){
			
		}
		
		
		/**
		 * 构建 param 变量
		 */
		private function _initParams(){
			
			$this->param = new stdClass();
			$request = WF_Application_Request::Instance();
			$params = $request->getParams();
			foreach( $params as $key => $value ){
				$this->param->$key = &$value;
			}
		}
		
		private function _initACD(){
			
			$request = WF_Application_Request::Instance();
			$this->a = $request->getAction();
			$this->c = $request->getController();
			$this->d = $request->getDirectory();
		}
		
		
	}
