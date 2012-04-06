<?php
class Model {
	private $pdo = null;
	private static $_instance = null;
	private function __construct() {
		$conf = WF_Application_Manager::$Config;
		$this->pdo = new PDO(
			$conf->db->driver:'host=' . $conf->db->host . ';port=' . $conf->db->port . ';dbname=' . $conf->db->database,
			'username',
			'password',
			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
			);
	}
	public static function Instance() {
		if(self::$_instance === null) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	public function query($sql){
		return $this->pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
	}
	public function execute($sql) {
		return $this->pdo->exec($sql);
	}
	public function escape($val) {
		return is_null($val) ? 'null' : (is_bool($val) ? ($val ? 1 : 0) : (is_float($val) ? (float)$val : (is_int($val) ? (int)$val : '\'' . PDO::quote($val) . '\'')));
	}
}
