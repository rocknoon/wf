<?php 
	class WF_Application_Router{
		
	
		private static $_instance;
		
	
		/**
		 * @return WF_Application_Router
		 */
		public static function Instance(){
			
			if( !self::$_instance ){
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		
		
		public function router( WF_Application_Request $request ){
			
			$path = $request->getUrlPath();
			$result = array();  //分析结果临时变量
			$path = trim( $path , "/" );
			$urls = explode( "/" , $path);
			
			//首先判断directory
			if( $urls[0]  && in_array($urls[0]  , WF_Application_Manager::$Config->app->router->directory)  ){
				$result["directory"] = $urls[0] ;
				array_shift($urls);
			}else{
				$result["directory"] = "default";
			}
			
			//首先判断controller
			if( $urls[0] ){
				$result["controller"] = $urls[0];
				array_shift($urls);
			}else{
				$result["controller"] = "index";
			}
			
			//首先判断action
			if( $urls[0] ){
				$result["action"] = $urls[0];
				array_shift($urls);
			}else{
				$result["action"] = "index";
			}
			
			
			
			
			$this->_setRequest( $request , $result );
			
			
			/**
			 * 如果urls 里还有其他参数 则把他们看成 params
			 */
			while( count( $urls ) > 0 ){
				$key = array_shift($urls);
				$value = array_shift($urls);
				$request->addParam( $key , $value );
			}
			
			
			/**
			 * 传统 GET 和 POST 的参数一样传给request
			 */
			foreach( $_REQUEST as $key => $value ){
				$request->addParam( $key , $value );
			}
			
			
		}
		
		private function _setRequest( WF_Application_Request $request , $result ){
			$request->setAction( $result["action"] );
			$request->setController( $result["controller"] );
			$request->setDirectory( $result["directory"] );
		}
		
		
		
	}
?>