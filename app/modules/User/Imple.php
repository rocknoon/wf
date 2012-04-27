<?php 
	class APP_User_Imple implements APP_User_Interface {
		
		
		
		const SESSION_KEY_USER = "app-user";
		
		/**
		 * 
		 * @var WF_Component_Db_Model
		 */
		private $_model;
		
		
		
		function __construct(){
			
			$this->_model = WF_Com_Db_Model::Table("user");
			
		}
		
		
		public function login($username, $password) {
			
			//检查用户是否存在
			$userInfo = $this->_getUserByName($username);
			if( empty( $userInfo ) ){
				throw new Exception( "error" );
			}
			
			//检查password是否正确
			if( $userInfo["password"] != $password ){
				throw new Exception( "error" );
			}
			
			//如果存在 获取用户 放入session
			WF_Session::Set( self::SESSION_KEY_USER , $userInfo);
			
		}

		
		public function register($username, $password) {
			
			
			//验证username  password 有效性
			
			
			
			//判断用户名是否存在
			$userInfo = $this->_getUserByName($username);
			if( !empty( $userInfo ) ){
				throw new Exception( "error" );
			}
			
			
			$this->_createUser( $username , $password );
			
			
		}
		
		
		private function _createUser( $username , $password ){
			
			$this->_model->insert(array(
				"username" => $username,
				"password" => md5( $password )
			));
			
		}
		
		
		private function _getUserByName( $username ){
			
			$username = $this->_model->escape( $username );
			//Todo model 应该有一个 fetchOne
			return $this->_model->fetch( "where username = $username" );
			
		}

	}
?>