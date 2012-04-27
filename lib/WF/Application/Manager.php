<?php

/**
 * require some core part
 */
require APP_PATH . '/lib/WF/Dump.php';
require APP_PATH . '/lib/WF/Loader.php';
require APP_PATH . '/lib/WF/Log.php';
require APP_PATH . '/lib/WF/Session.php';

require APP_PATH . '/lib/WF/Application/Dispather.php';
require APP_PATH . '/lib/WF/Application/Request.php';
require APP_PATH . '/lib/WF/Application/Response.php';
require APP_PATH . '/lib/WF/Application/Router.php';
require APP_PATH . '/lib/WF/Application/Controller.php';
require APP_PATH . '/lib/WF/Application/View/Manager.php';

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
			//log error
			self::_errorLog( $ex->getMessage() );
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
		
		
		$cName = ucwords($cName);
		
		if( isset( self::$_Component[$cName] ) ){
			return self::$_Component[$cName];
		}
		
		$cLoadFile = APP_PATH . '/lib/Component/' . $cName . '/load.php';
		
		if( file_exists( $cLoadFile ) ){
			self::$_Component[$cName] = include $cLoadFile;
			return self::$_Component[$cName];
		}else{
			throw new Exception( "$cName Component loading fail, WF didn't find the $cName/load.php file." );
		}
		
	}

	private static function _Dispath() {
		
		// 获取HTTP  请求体和返回体
		$request 	= WF_Application_Request::Instance();
		$response 	= WF_Application_Response::Instance(); 
		
		// 路由管理器初始化
		$router = WF_Application_Router::Instance();
		
		// 进行路由
		$router->router($request);
		

		// 请求分发器
		try {
			WF_Application_Dispather::dispath($request , $response); 
		}
		catch(Exception $ex) {
			// error controller show the error
			// also system will log the error
			throw $ex;
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
	private static function _InitConfig($configFile , $env) {
		
		if (file_exists($configFile)) {
			
			//specify env config
			require $configFile;
			if ($env === 'product'){
				$develop = null;
				unset($develop);
			} else {
				$product = null;
				unset($product);
			}
			self::$Config = $$env;
			
			//check config validation.
			
			//create error_file
			if( isset(self::$Config->app->error_log) && !file_exists( self::$Config->app->error_log ) ){
				$fp=fopen(self::$Config->app->error_log, "w+"); //打开文件指针，创建文件
				if ( !is_writable(self::$Config->app->error_log) ){
				      throw new Exception( 'sorry the file'.self::$Config->app->error_log.' is not writable' );
				}
				fclose($fp);  //关闭指针
			}
			
			
		}else{
			throw new Exception("WF didn't find $configFile config file");
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
				APP_PATH . "/app",
				get_include_path(),
		)));
		
		
		/**
		 * 启动 WF_Loader
		 */
		WF_Loader::Start();
		

	}
	
	
	private static function _errorLog( $message ){
		WF_Log::W( array( $message ) , self::$Config->app->error_log );
	}
	
}
