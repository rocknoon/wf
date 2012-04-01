<?php
class IndexController extends WF_Application_Controller{
	
	
	public function index(){

		
		dump(WF_Application_Manager::Component("Db"));
		die();
		
		$this->layout("layout2");
		$this->assign("name", "Rocky");
		$this->render( "rocky" );		
	}
	
}
