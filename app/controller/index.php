<?php
class IndexController extends WF_Application_Controller{
	
	
	public function index(){
		
		WF_Application_Manager::Component("DB");
		$uModel = WF_Component_Db_Model::Factory("user");
		$data = $uModel->fetch( "where User = 'root' order by User DESC" , 1 , 3 , array("Host","Password") );
		dump($data);
		die();
		
	}
	
	
	
}
