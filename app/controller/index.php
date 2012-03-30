<?php
class IndexController{
	public function index(){
		require 'User/Interface.php';
		APP_User_Interface::test();
	}
}
