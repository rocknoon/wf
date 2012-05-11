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
