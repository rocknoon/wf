<?php
class IndexController extends WF_Application_Controller{
	public function index(){
		$u = WF_Component_Db_Adapter::factory('user');
		var_dump($u->read());
	}
}
