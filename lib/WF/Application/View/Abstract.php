<?php 

	abstract class WF_Application_View_Abstract {
		
		
		protected $_layout;
		
		protected $_tpl;
		
		protected $_layoutFile;

		protected $_tplFile;
		
		
		
		/**
		 * title
		 */
		protected $_title;
		
		protected $_js = array();
		
		
		/**
		 * 对某一个模版进行渲染
		 */
		abstract public function render( WF_Application_Response $response );
		
		/**
		 * 设置 模版里需要用到的变量
		 */
		abstract public function assign( $key , $value );
		
		
		
		/**
		 * 设置当前 应该用 哪一个 layout
		 */
		public function setLayout( $layout ){
			$this->_layout = $layout;
		}
		
		public function getLayout(){
			return $this->_layout;
		}
		
		public function setTpl( $tpl ){
			$this->_tpl = $tpl;
		}
		
		public function getTpl(){
			return $this->_tpl;
		}
		
		public function setTplFile( $tplFile ){
			$this->_tplFile = $tplFile;
		}
		
		public function setLayoutFile( $layoutFile ){
			$this->_layoutFile = $layoutFile;
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
		 * 输出title 段
		 */
		public function title(){
			echo '<title>'.$this->_title.'</title>' . "\n";
		}
		
		/**
		 * 输出js
		 */
		public function js(){
			$baseUrl = WF_Application_Request::Instance()->getBaseUrl();
			foreach( $this->_js as $js ){
				echo '<script type="text/javascript" src="'.$baseUrl.$js.'"></script>'. "\n";
			}
		}
		
		
		
		public function setTitle( $title ){
			$this->_title = $title;
		}
		
		/**
		 * 添加一个 js
		 * @param unknown_type $js
		 */
		public function addJs( $js ){
			$this->_js []= $js;	
		}
		
		
		
	}
