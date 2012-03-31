<?php 

	abstract class WF_Application_View_Abstract {
		
		
		protected $_layout;
		
		protected $_tpl;
		
		protected $_layoutFile;

		protected $_tplFile;
		
		
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
		
		
		
	}
