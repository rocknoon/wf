<?php 

class WF_Application_Request{
	
	
	private static $_instance;
	
	
	private $_controller;
	
	private $_action;
	
	private $_directory;
	
	private $_baseUrl;
	
	private $_urlPath;
	
	/**
	 * 请求参数
	 * @var array
	 */
	private $_params = array();
	
	
	
	/**
	 * @return WF_Application_Request
	 */
	public static function Instance(){
		if( !self::$_instance ){
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	
	
	public function __construct(){
		$this->_initBaseUrl();
		$this->_initUrlPath();
	}
	
	public function getUrlPath(){
		return $this->_urlPath;
	}
	
	public function isPost(){
		
		
	}
	
	public function addParam( $key , $value ){
		if( $key && $value ){
			$this->_params[$key] = $value;
		}
	}
	
	public function getParams(){
		return $this->_params;
	}
	
	
	
	public function setController( $c ){
		$this->_controller = $c;
	}
	
	public function setAction( $a ){
		$this->_action = $a;
	}
	
	public function setDirectory( $d ){
		$this->_directory = $d;
	}
	
	
	public function getController(){
		return $this->_controller;
	}
	
	public function getAction(){
		return $this->_action;
	}
	
	public function getDirectory( ){
		return $this->_directory;
	}
	
	
	private function _initBaseUrl(){
		$this->_baseUrl = str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]);
	}
	
	/**
	 * 初始化index.php后的Path段
	 */
	private function _initUrlPath(){
		
		$this->_urlPath = 
		str_replace("index.php", "", 
			str_replace( $this->_baseUrl , "", $_SERVER["REQUEST_URI"])
		);
	}
	
	
	
	
	
	
}


?>
