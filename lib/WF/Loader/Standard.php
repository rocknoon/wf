<?php 
/**
 * 
 * WF框架的类自动加载处理
 * 
 * @author Rocky  2012-3-28
 *
 */
class WF_Loader_Standard {

	
	public static function Start()
	{
		return spl_autoload_register(array(__CLASS__, 'IncludeClass'));
	}
	
	public static function Stop()
	{
		return spl_autoload_unregister(array(__CLASS__, 'IncludeClass'));
	}
	
	
	/**
	 * 如果找不到类的回调函数
	 * 1. WF_Component
	 * 2. APP
	 * 3. WF_
	 * @param unknown_type $class
	 */
	public static function IncludeClass( $class )
	{
		
		$APP_MODULE_PATH = APP_PATH . '/modules/';
		$LIB_PATH = APP_PATH . "/lib/";
		
		$nps = explode('_', $class);
	
		switch( $nps[0] ){
			
			/**
			 * 如果是以APP 开头则加载 app/modules 下的模块
			 */
			case "APP":
				array_shift($nps);
				include_once $APP_MODULE_PATH . implode( "/" , $nps) . '.php';
				break;
				
			/**
			 * 如果是以WF 开头则加载 lib/ 下的模块
			 * 
			 */
			case "WF":
				
				//加载 Component 类
				if( $nps[1] === 'Component' ){
					array_shift($nps);
					include_once $LIB_PATH . implode( '/' , $nps) . '.php';
				}
				//加载核心类
				else{
					include_once $LIB_PATH . implode( '/' , $nps) . '.php';
				}
				break;
				
				
			default:
				throw new Exception( $class. ' Class is not found!' );
				break;
		}
		

	}
	
}