<?php
class WF_Component_MySQL_Adapter {
	private static $_instance = array();
	private static $_db = null;
	public $table;
	private function __construct($table) {
		if (self::$_db = null) {
			class_exists('Model') || require 'Model.php';
			self::$_db = Model::Instance();
		}
		$this->table = $table;
	}
	public static function factory($table) {
		if (!isset(self::$_instance[$table])) self::$_instance[$table] = new self($table);
		return $_instance[$table];
	}
	public function create($data) {
		foreach($data as $key => $value) {
			$keys[] = $key;
			$values[] = $this->escape($value);
		}
		$sql = 'insert into ' . $this->table . '(' . implode(',', $keys) . ') values(' . implode(',', $values) . ')';
		return $_db->execute($sql);
	}
	public function update($data,$condition = null) {
		foreach($data as $key => $value) {
			$tmp = $key . '=' . $this->escape($value);
		}
		$sql = 'update ' . $this->table . ' set ' . implode(',',$tmp) . $condition ? ' where ' $condtion : '';
		return $_db->execute();
	}
	public function delete($condition = null) {
		$sql = 'delete from ' . $this->table . $condition ? ' where ' .$condition : '';
	}
	public function read() {
	}
	public function escape($val) {
		return $_db->escape($val);
	}
}
