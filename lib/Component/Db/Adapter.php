<?php
class WF_Component_Db_Adapter {
	private static $_instance = array();
	private static $_db = null;
	public $table;
	/**
	 * 构造函数
	 */
	private function __construct($table) {
		if (self::$_db === null) {
			//class_exists('WF_Component_Db_PDO') || require 'PDO.php';
			self::$_db = WF_Component_Db_PDO::Instance();
		}
		$this->table = $table;
	}
	/**
	 * 工厂单例模式
	 */
	public static function factory($table) {
		if (!isset(self::$_instance[$table])) self::$_instance[$table] = new self($table);
		return self::$_instance[$table];
	}
	/**
	 * 插入一条记录
	 * 
	 * @param data $ array 键名对应键值
	 * @return int affect rows
	 */
	public function create($data) {
		foreach($data as $key => $value) {
			$keys[] = $key;
			$values[] = $this->escape($value);
		}
		$sql = 'insert into ' . $this->table . '(' . implode(',', $keys) . ') values(' . implode(',', $values) . ')';
		return self::$_db->execute($sql);
	}
	/**
	 * 修改
	 * 
	 * @param data $ array 键名对就键值
	 * @param condition $ string 条件 exp: $condition = 'where id>1';
	 * @return int affect rows
	 */
	public function update($data, $condition = null) {
		foreach($data as $key => $value) {
			$tmp = $key . '=' . $this->escape($value);
		}
		$sql = 'update ' . $this->table . ' set ' . implode(',', $tmp) . ($condition ? $condtion : '');
		return self::$_db->execute($sql);
	}
	/**
	 * 删除
	 * 
	 * @param condition $ string
	 * @return int affect rows
	 */
	public function delete($condition = null) {
		$sql = 'delete from ' . $this->table . ($condition ? $condition : '');
		return self::$_db->execute($sql);
	}
	/**
	 * 查询
	 * 
	 * @column mixed 字段，可为有序数组或字符串
	 * @condition string
	 * @return array 返回结果
	 */
	public function read($column = null, $condition = null) {
		$fields = is_array($column) ? implode(',', $column) : ($column ? $column : '*');
		$sql = 'select ' . $fields . ' from ' . $this->table . ($condition ? $condition : '');
		return self::$_db->query($sql);
	}
	/**
	 * 过滤变量
	 */
	public function escape($val) {
		return self::$_db->escape($val);
	}
}
