<?php
class IndexController extends WF_Application_Controller{
	
	
	public function index(){

		$this->layout("layout2");
		$this->assign("name", "Rocky");
		$this->render( "rocky" );		
	}
	
}
