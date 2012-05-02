<?php

class ErrorController extends APP_WFX_Controller_Front{
	
	
	
	
	public function index(){
		
		$error = WF_Application_Manager::$DispathError;
		
		$this->assign( "error" , $error);

	}
	
	
	
	
}
