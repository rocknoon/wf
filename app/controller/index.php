<?php

class IndexController extends APP_WFX_Controller_Front{
	
	
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
