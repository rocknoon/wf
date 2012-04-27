<?php 
	class WF_Application_Router{
		
	
		private static $_instance;
		
		private static $_htaccess = null;
	
		/**
		 * @return WF_Application_Router
		 */
		public static function Instance(){
			
			if( !self::$_instance ){
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function url($arg0 = null, $arg1 = null, $arg2 = null, $arg3 = null){
			if(is_array($arg0) && is_string($arg1) && $arg2 === null && $arg3 === null) {
				return $this->_rewrite($arg0, $arg1);
			} else {
				if(is_array($arg2)) return $this->_defaultUrl($arg0,$arg1,$arg3,$arg2);
				else return $this->_defaultUrl($arg0,$arg1,$arg2,$arg3);
			}
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

		private function _defaultUrl($controller,$action,$dir = null,$params = null){
		}

		private function _rewrite($data, $anchor) {
			if(self::$_htaccess === null) {
				$ht = file_get_contents(PUBLIC_PATH . '/.htaccess');
				if(preg_match_all('/^\s*RewriteRule\s+(\S*)\s+\S*\s+\[NC=(\w*)\]$/Um',$ht,$out)) {
					$tmp = array();
					foreach($out[1] as $v) {
						$tmp[] = str_replace(array('\\','^','$'),array('','',''),$v);
					}
					self::$_htaccess = array_combine($out[2],$tmp);
				}
			}
			$url = self::$_htaccess[$anchor];
			foreach($data as $d){
				$url = preg_replace('/\(.*\)/U',$d,$url,1);
			}
			return $url;
			//$tmp = explode('@', $map->$anchor);
			//$n = count($tmp)-1;
			//$uri = array();
			//for($i = 0;$i < $n;$i++) {
			//	$uri[] = $tmp[$i];
			//	$uri[] = $data[$i];
			//	if ($i + 1 === $n) $uri[] = $tmp[$n];
			//}
			//return implode('', $uri);
		}
		
	}
?>
