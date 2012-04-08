<?php

class WF_Application_Response {
	
	private $_headers = array(
		'HTTP/1.1 200',
		'Content-type:text/html;charset=UTF-8'
	);
	private $_content = '';
	/**
	 * 单例
	 */
	private static $_instance = null;

	protected function __construct() {}

	/**
	 * 
	 * @return WF_Application_Response ::$_instance
	 */
	public static function Instance() {
		if (self::$_instance === null) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function send() {
		if(count($this->_headers)>0){
			foreach($this->_headers as $v){
				header($v);
			}
			echo $this->_content;
			$this->_headers = array();
			$this->_content = null;
		}
	}
	public function setHeader(){
	}
	public function setContent($data){
		$this->_content = $data;
	}
}
