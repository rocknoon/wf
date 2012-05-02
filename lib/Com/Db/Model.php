<?php
class WF_Com_Db_Model {
	
	private static $_instance = array();
	
	/**
	 * @var WF_Com_Db_PDO
	 */
	private static $_db = null;
	
	
	/**
	 * Model 所对应的表
	 * @var String
	 */
	public $table;
	
	/**
	 * 构造函数
	 */
	private function __construct($table) {
		
		if( !isset( $table ) ){
			throw new Exception("you need to specify the table name for this DB model");
		}
		
		if (self::$_db === null) {
			self::$_db = WF_Com_Db_PDO::Instance();
		}
		
		$this->table = $table;
	}
	/**
	 * 工厂单例模式
	 * @return WF_Com_Db_Model
	 */
	public static function Factory($table) {
		if (!isset(self::$_instance[$table])) self::$_instance[$table] = new self($table);
		return self::$_instance[$table];
	}
	
	/**
	 * 插入一条记录
	 * 
	 * @param data $ array 键名对应键值
	 * @return int affect rows
	 */
	public function insert($data) {
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
		$sql = 'update ' . $this->table . ' set ' . implode(',', $tmp) . ($condition ? $condition : '');
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
	public function fetch($condition = null, $pageNo = null, $pageSize = null , $column = null) {
		$fields = is_array($column) ? implode(',', $column) : ($column ? $column : '*');
		$sql = 'select ' . $fields . ' from ' . $this->table . ' ' . ($condition ? $condition : '');
		
		if( $pageNo && $pageSize ){
			  $limitCount  = (int) $pageSize;
			  $limitOffset = (int) $pageSize * ($pageNo - 1 );
        	  $sql .= ' limit '.$limitOffset . ','.$limitCount;
		}
		
		return self::$_db->query($sql);
	}
	
	/**
	 * 只获取一条数据
	 *
	 * @column mixed 字段，可为有序数组或字符串
	 * @condition string
	 * @return array 返回结果
	 * @author Rocky 2012-5-2
	 */
	public function fetchOne( $condition = null, $column = null ) {
		$fields = is_array($column) ? implode(',', $column) : ($column ? $column : '*');
		$sql = 'select ' . $fields . ' from ' . $this->table . ' ' . ($condition ? $condition : '');
		$sql .= ' limit 0,1';
	
		$rtn = self::$_db->query($sql);
		
		
		if( isset($rtn[0]) ){
			return $rtn[0];
		}else{
			return null;
		}
	}
	
	
	/**
	 * 过滤变量
	 */
	public function escape($val) {
		return self::$_db->escape($val);
	}
}
