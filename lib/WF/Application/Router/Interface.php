<?php 

Interface WF_Application_Router_Interface{
	
	
	/**
	 * 匹配path 返回匹配结果
	 * @return array( "action" , "controller" , "path" )
	 * @param unknown_type $path
	 */
	public function match( $path );
	
	/**
	 * 用于生成改路由的String
	 * @param array $params
	 * @return String
	 */
	public function assemble( array $params );
	
}

?>