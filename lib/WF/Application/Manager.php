<?php

class WF_Application_Manager {
	/*
	 * @var array
	 */
	private $_config;

	/**
	 * 
	 * @var WF_Application_Request 
	 */
	private $_request;

	/**
	 * 
	 * @var WF_Application_Response 
	 */
	private $_response;

	private $_component = array();

	/**
	 * 系统的启动入口
	 * 
	 * @param unknown_type $configFile 
	 * @param unknown_type $env 
	 */
	public static function run($configFile , $env) {
		$this->_initConfig($configFile , $env);

		try {
			$this->_bootstrap();

			$this->_dispath();
		}
		catch(Exception $ex) {
			// system will log it.
		}
	}

	/**
	 * 首先判断是否已经载入了这个Component,  如果载入了的话则直接返回，  如果没有载入的话则去寻找
	 * APP_PATH/lib/Component/XXX/load.php 进行载入逻辑
	 * 
	 * @return mixed $component
	 * @param unknown_type $cName 
	 */
	public function component($cName) {
	}

	private function _dispath() {
		// 获取HTTP  请求体和返回体
		$request = WF_Application_Request::Instance();
		$response = WF_Application_Response::Instance(); 
		// 路由管理器初始化
		$routerM = WF_Application_Router_Manager::Instance(); 
		// 请求分发器
		$dispather = WF_Application_Dispather::Instance(); 
		// 进行路由
		$routerM->router($request);

		try {
			$dispather->dispath($request , $response);
		}
		catch(Exception $ex) {
			// error controller show the error
			// also system will log the error
		}

		/**
		 * 进行输出
		 */
		$response->send();
	}

	/**
	 * 初始化配置
	 * 根据当前的环境 去初始化出系统所需要的配置
	 */
	private function _initConfig($configFile , $env) {
		if (file_exists($configFile)) {
			require $configFile;
			if ($env === 'product'){
				$develop = null;
				unset($develop);
				$this->_config = $product;
			} else {
				$product = null;
				unset($product);
				$this->_config = $develop;
			}
		}
	}

	private function _bootstrap() {
		/**
		 * 核心启动
		 * 
		 * 1. 设置 ini_set
		 * 2. include_path 设置
		 * 3. 加载 WF_Loader
		 */

	}
}
