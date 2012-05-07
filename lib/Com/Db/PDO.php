<?php
class WF_Com_Db_PDO {
	/**
	 * 
	 * @var PDO 
	 */
	private $pdo = null;

	private static $_instance = null;
	private function __construct() {
		try {
			$conf = WF_Application_Manager::$Config;
			$this->pdo = new PDO($conf->db->driver . ':host=' . $conf->db->host . ';port=' . $conf->db->port . ';dbname=' . $conf->db->database,
				$conf->db->user,
				$conf->db->password,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}
		catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}
	/**
	 * 单例模式
	 */
	public static function Instance() {
		if (self::$_instance === null) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	/**
	 * sql语句查询接口
	 * 
	 * @return array 结果集关联数组
	 */
	public function query($sql) {
		$state = $this->pdo->query($sql);
		if (!$state) {
			throw new Exception($sql . " can't be executed.");
		}

		return $state->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * sql语句执行接口
	 * 
	 * @return bool 是否执行成功
	 */
	public function execute($sql) {
		try {
			return $this->pdo->exec($sql);
		}
		catch(Exception $e) {
			throw new Exception($sql . " can't be executed.");
		}
	}
	/**
	 * 变量转义过滤
	 * 
	 * @param  $val mixed 传入值为int float bool string类型 exp: It's a pen => 'It\'s a pen'
	 * @return mixed 其中string类型会进行转义，并且在两边加上单引号，方便sql语句字符串拼接
	 */
	public function escape($val) {
		return is_null($val) ? 'null' : (is_bool($val) ? ($val ? 1 : 0) : (is_float($val) ? (float)$val : (is_int($val) ? (int)$val : $this->pdo->quote($val))));
	}
}
