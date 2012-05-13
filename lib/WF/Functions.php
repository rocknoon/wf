<?php
	/**
	 * 字符串转义函数
	转义引号防止SQL注入
	 */
	function wf_escape($val) {
		WF_Com_Db_PDO::Instance()->escape($val);
	}
	
	/**
	 * html转义函数
	 * 转义html实体,并且将换行符转为<br>,防止提交html标签造成xss脚本攻击,适用于<input text <textarea
	 */
	function wf_html_escape($str) {
		return nl2br(htmlspecialchars($str));
	}
	
	/**
	 * 获取客户端ip地址
	 */
	function wf_ip() {
		if ($_SERVER["HTTP_X_FORWARDED_FOR"]) $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		else if ($_SERVER["HTTP_CLIENT_IP"]) $ip = $_SERVER["HTTP_CLIENT_IP"];
		else if ($_SERVER["REMOTE_ADDR"]) $ip = $_SERVER["REMOTE_ADDR"];
		else if (getenv("HTTP_X_FORWARDED_FOR")) $ip = getenv("HTTP_X_FORWARDED_FOR");
		else if (getenv("HTTP_CLIENT_IP")) $ip = getenv("HTTP_CLIENT_IP");
		else if (getenv("REMOTE_ADDR")) $ip = getenv("REMOTE_ADDR");
		else $ip = "Unknown";
		return $ip;
	}
	
	/**
	 * 验证器
	 */
	function wf_validator($str,$type) {
		$rgx = array(
			'email' => '/^[0-9a-zA-Z]+(?:[\_\-][a-z0-9\-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+$/',
		);
		return preg_match($rgx[$type],$str);
	}
	
	/**
	 * 浏览器获取
	 */
	function wf_browser() {
	}

	/**
	 * path获取文件名
	 * path类型
	 * 价格
	 * title url seo 过滤
	 * 浏览器类型
	 */


	
	/**
	 * 格式化输出函数
	 * @param unknown_type $var
	 * @param unknown_type $echo
	 * @param unknown_type $label
	 * @param unknown_type $strict
	 */
	function dump($var, $echo=true,$label=null, $strict=true)
	{
	    $label = ($label===null) ? '' : rtrim($label) . ' ';
	    if(!$strict) {
	        if (ini_get('html_errors')) {
	            $output = print_r($var, true);
	            $output = "<pre>".$label.htmlspecialchars($output,ENT_QUOTES,C('OUTPUT_CHARSET'))."</pre>";
	        } else {
	            $output = $label . " : " . print_r($var, true);
	        }
	    }else {
	        ob_start();
	        var_dump($var);
	        $output = ob_get_clean();
	        if(!extension_loaded('xdebug')) {
	            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
	            $output = '<pre>'
	                    . $label
	                    . htmlspecialchars($output, ENT_QUOTES,C('OUTPUT_CHARSET'))
	                    . '</pre>';
	        }
	    }
	    if ($echo) {
	        echo($output);
	        return null;
	    }else {
	        return $output;
	    }
	}
	
	function C($name='',$value=null) 
	{
	    static $_config = array();
	    if(!is_null($value)) {
	        if(strpos($name,'.')) {
	            $array   =  explode('.',strtolower($name));
	            $_config[$array[0]][$array[1]] =   $value;
	        }else{
	            $_config[strtolower($name)] =   $value;
	        }
	        return ;
	    }
	    if(empty($name)) {
	        return $_config;
	    }
	
	    if(is_array($name)) {
	        $_config = array_merge($_config,array_change_key_case($name));
	        return $_config;
	    }
	    if(strpos($name,'.')) {
	        $array   =  explode('.',strtolower($name));
	        return $_config[$array[0]][$array[1]];
	    }elseif(isset($_config[strtolower($name)])) {
	        return $_config[strtolower($name)];
	    }else{
	        return NULL;
	    }
	}
