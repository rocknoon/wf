<?php

include APP_PATH . "/lib/WF/Util.php";

class WF_Application_Manager {
	
	
	/*
	 * @var array
	 */
	public static $Config;

	
	private static $_Component = array();

	
	/**
	 * 系统的启动入口
	 * 
	 * @param unknown_type $configFile 
	 * @param unknown_type $env 
	 */
	public static function Run($configFile , $env) {
		
		self::_InitConfig($configFile , $env);

		try {
			self::_Bootstrap();
			self::_Dispath();
		}
		catch(Exception $ex) {
			// system will log it.
			throw $ex;
		}
	}

	/**
	 * 首先判断是否已经载入了这个Component,  如果载入了的话则直接返回，  如果没有载入的话则去寻找
	 * APP_PATH/lib/Component/XXX/load.php 进行载入逻辑
	 * 
	 * @return mixed $component
	 * @param unknown_type $cName 
	 */
	public static function Component($cName) {
		
	}

	private static function _Dispath() {
		
		// 获取HTTP  请求体和返回体
		$request 	= WF_Application_Request::Instance();
		//$response 	= WF_Application_Response::Instance(); 
		
		// 路由管理器初始化
		$router = WF_Application_Router::Instance();
		
		// 请求分发器
		//$dispather = WF_Application_Dispather::Instance(); 
		// 进行路由
		$router->router($request);
		
		dump($request);
		die();

// 		try {
// 			$dispather->dispath($request , $response);
// 		}
// 		catch(Exception $ex) {
// 			// error controller show the error
// 			// also system will log the error
// 		}

		/**
		 * 进行输出
		 */
		//$response->send();
	}

	/**
	 * 初始化配置
	 * 根据当前的环境 去初始化出系统所需要的配置
	 */
	private static function _InitConfig($configFile , $env) {
		
		if (file_exists($configFile)) {
			require $configFile;
			if ($env === 'product'){
				$develop = null;
				unset($develop);
			} else {
				$product = null;
				unset($product);
			}
			self::$Config = $$env;
		}
		
	}

	
	/**
	 * 
	 * @author Rocky 2012-3-28
	 */
	private static function _Bootstrap() {
		/**
		 * 核心启动
		 * 
		 * 1. 设置 ini_set
		 * 2. include_path 设置
		 * 3. 加载 WF_Loader
		 */
		
		
		/**
		 * 把 app/modules 和 lib 俩个目录仿如 include_path 下 
		 */
		set_include_path(implode(PATH_SEPARATOR, array(
				APP_PATH . "/lib",
				APP_PATH . "/app/modules",
				get_include_path(),
		)));
		
		
		/**
		 * 启动 WF_Loader
		 */
		include APP_PATH . '/lib/WF/Loader/Standard.php';
		WF_Loader_Standard::Start();
		

	}
}
