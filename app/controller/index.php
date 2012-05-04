<?php

class IndexController extends APP_WFX_Controller_Front{
	
	
	public function index(){
		
		$this->js( "js/index.js" );
		$this->title( "Hello world" );
		$this->view->m = 'what the fuck';
		
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
