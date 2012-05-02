<?php 

	class WF_Application_Controller {
		
		/**
		 * @var 请求参数
		 */
		private $param;
		
		/**
		 * @var Action name
		 */
		private $action;
		
		/**
		 * @var controller Name
		 */
		private $controller;
		
		/**
		 * @var directory name
		 */
		private $dir;
		
		
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
		public function url($arg0 = null, $arg1 = null, $arg2 = null, $arg3 = null) {
			return WF_Application_Router::Instance()->url($arg0, $arg1, $arg2, $arg3);
		}
		
		/**
		 * 重定向
		 * 特别: 如果 $this->redirect("http://www.sina.com");  如果只有一个参数 并且 第二个参数没有 则直接重定向
		 */
		public function redirect($arg0 = null, $arg1 = null, $arg2 = null, $arg3 = null){
			
			if( is_string( $arg0 ) && $arg1 === null ){
				$url = $arg0;
			}else{
				$url = WF_Application_Router::Instance()->urlWithDomain($arg0, $arg1, $arg2, $arg3);
			}
			
			
			header('HTTP/1.1 301 Moved Permanently');
 			header('Location: ' . $url);
 			die();
		}
		
		/**
		 * 加入 js 文件
		 */
		public function js( $file ){
			WF_Application_View_Manager::GetView()->addJs($file);
		}
		
		/**
		 * 加入title
		 */
		public function title( $title ){
			WF_Application_View_Manager::GetView()->setTitle($title);
		}
		
		
		
		/**
		 * 判断请求是否是 POST 方法
		 * @return bool
		 */
		public function isPost(){
			return WF_Application_Request::Instance()->isPost();
		}
		
		/**
		 * 判断请求是否是 POST 方法
		 * @return bool
		 */
		public function isGet(){
			return WF_Application_Request::Instance()->isGet();
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
			$this->action = $request->getAction();
			$this->controller = $request->getController();
			$this->dir = $request->getDirectory();
		}
		
		
	}
