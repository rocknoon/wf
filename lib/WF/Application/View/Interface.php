<?php 

	interface WF_Application_View_Interface {
		
		public function setLayout( $layout );
		
		public function render( $tpl );	
		
		public function assign( $key , $value );
		
	}