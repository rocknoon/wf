<?php

class IndexController extends APP_WFX_Controller_Front{
	
	
	public function index(){
		
		$this->js( "js/index.js" );
		$this->title( "Hello world" );
		$user = WF_Com_Db_Model::Factory('user');

		$cond = $user->eq('User','root');
		$data = $user->fetch($cond);
		dump($data);
		exit;
		
		//throw new Exception("1111");

	}
	
	public function login(){
		
	}
	
	public function postLogin(){
		
		/*
		 * 判断请求必须是  POST
		 */
		if(!$this->isPost()){
			throw new Exception("you need post data");
		}
		
		$userName = $this->param->username;
		$password = $this->param->password;
		
		$userMod = APP_User::Instance();
		
		$userMod->login($userName, $password);
		
		$this->redirect("login");
		
	}
	
	
}
