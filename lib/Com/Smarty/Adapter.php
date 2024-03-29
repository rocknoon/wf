<?php

class WF_Com_Smarty_Adapter extends WF_Application_View_Abstract {
	/**
	 * smarty对象
	 */
	private $_smarty = null;
	/**/
	private static $_instance = null;

	/**
	 * 私有化构造函数，只能进行单例获取对象
	 * 2012-5-13  @rocky  没有私有化, Zend Studio 要报错
	 * 
	 */
    function __construct() {
		require 'Smarty.class.php';
		$this->_smarty = new Smarty();

		$cnf = WF_Application_Manager::$Config;

		$this->_smarty->left_delimiter = $cnf->smarty->left_delimiter;
		$this->_smarty->right_delimiter = $cnf->smarty->right_delimiter;
		$this->_smarty->force_compile = $cnf->smarty->debug;
		$this->_smarty->debugging = false;
		$this->_smarty->compile_dir = $cnf->smarty->compile_dir;
		$this->_smarty->cache_dir = $cnf->smarty->cache_dir;
		$this->_smarty->template_dir = $cnf->smarty->template_dir;
		$this->_smarty->auto_literal = $cnf->smarty->auto_literal;
		$cnf->smarty->compress && $this->_smarty->registerFilter('pre', array(& $this, '__template_compress'));

		if ($cnf->smarty->cache_lifetime > 0) {
			$this->_smarty->caching = true;
			$this->_smarty->cache_lifetime = $cnf->smarty->cache_lifetime;
		} else $this->_smarty->caching = false;
	}

	public function Instance() {
		if(self::$_instance === null) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * smarty模板预处理函数，进行压缩
	 */
	public function __template_compress($source) {
		$source = preg_replace('/<!--.*-->/Ums', '', $source);
		return preg_replace('/\s*[\n\r]+\s*/', '', $source);
	}
	/**
	 * 赋值
	 */
	public function assign($key, $value) {
		$this->_smarty->assign($key, $value);
	}

	public function render(WF_Application_Response $response) {
		//die($this->_smarty->fetch($this->_tplFile));
		$response->setContent($this->_smarty->fetch($this->_tplFile));
	}
}
