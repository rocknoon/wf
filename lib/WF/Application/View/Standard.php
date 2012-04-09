<?php

	class WF_Application_View_Standard extends WF_Application_View_Abstract{
		
		
		private $_params = array();
		
		
		public function render( WF_Application_Response $response) {
			
			ob_start();
			
			if( file_exists( $this->_layoutFile ) ){
				include $this->_layoutFile;
			}else{
				include $this->_tplFile;
			}

			$response->setContent( ob_get_clean() );
		}
		
		public function content() {
			include $this->_tplFile;
		}
		
		public function assign($key, $value) {
			$this->_params[$key] = $value;
		}
		
		public function __get( $name ){
			if(isset($this->_params[$name])){
				return $this->_params[$name];
			}
		}

		
		
	}
