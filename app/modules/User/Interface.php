<?php

/**
 * 用户模块interface
 * @author www
 *
 */
interface APP_User_Interface{

	
	
	/**
	 * 用户登陆
	 * 
	 */
	public function login( $username, $password );
	
	/**
	 * 用户注册
	 * @param unknown_type $username
	 * @param unknown_type $password
	 */
	public function register( $username, $password );
	
	
	
	
}
