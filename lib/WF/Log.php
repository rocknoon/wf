<?php
/**
 * 日志处理类
 * @author rocky
 */
class WF_Log
{
 
	 /**
	  * 写日志
	  *
	  * @param array $parameters 日志内容（必须为数组）
	  * @param string $filename 日志文件名
	  */
	 public static function W($parameters, $file)
	 {
	  $parameters = (array)$parameters;
	  $parameters['DATE'] = date('Y-m-d H:i:s');
	  $parameters['IP'] = $_SERVER['REMOTE_ADDR'];
	 
	  $contents = implode("|", $parameters);
	 
	 
	  file_put_contents($file, $contents . "\r\n", FILE_APPEND);
	 }
 

 
}