<?php
/**
 * WF框架的类自动加载处理
 * 
 * @author Rocky  2012-3-28 
 */
class WF_Loader {
	public static function Start() {
		return spl_autoload_register(array(__CLASS__, 'IncludeClass'));
	}

	public static function Stop() {
		return spl_autoload_unregister(array(__CLASS__, 'IncludeClass'));
	}

	/**
	 * 如果找不到类的回调函数
	 * 1. WF_Component
	 * 2. APP
	 * 3. WF_
	 * 
	 * @param unknown_type $class 
	 */
	public static function IncludeClass($class) {
		if (strpos($class, 'WF') === 0 || strpos($class, 'APP') === 0) {
			$r = array('APP',
				'WF_Component',
				);
			$s = array('modules',
				'Component',
				);
			$class = str_replace($r, $s, $class);
			$class = str_replace('_', '/', $class);
			require $class . '.php';
		}
	}
}
