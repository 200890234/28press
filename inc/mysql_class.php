<?php
class db {
	function connect($dbhost, $dbuser, $dbpw, $dbname = '', $pconnect = 0) {
		if($pconnect) {
			if(!@mysql_pconnect($dbhost, $dbuser, $dbpw)) {
				$this->halt('Can not connect to MySQL server');
			}
		} else {
			if(!@mysql_connect($dbhost, $dbuser, $dbpw)) {
				$this->halt('Can not connect to MySQL server');
			}
		}
		if($this->version() > '4.1') {
			global $web_dbcharset;
			if($web_dbcharset) {
				mysql_query("SET character_set_connection=$web_dbcharset, character_set_results=$web_dbcharset, character_set_client=binary");
			}
			if($this->version() > '5.0.1') {
				mysql_query("SET sql_mode=''");
			}
		}
		if($dbname) {
			mysql_select_db($dbname);
		}
	}

	function select_db($dbname) {
		return mysql_select_db($dbname);
	}

	function insert_id() {
		$id = mysql_insert_id();
		return $id;
	}

	function query($sql, $type = '') {
		if($type == 'UNBUFFERED' && @function_exists('mysql_unbuffered_query')) {
			$query = mysql_unbuffered_query($sql);
		} else {
			if($type == 'CACHE' && intval(mysql_get_server_info()) >= 4) {
				$sql = 'SELECT SQL_CACHE'.substr($sql, 6);
			}
			if(!($query = mysql_query($sql)) && $type != 'SILENT') {
				$this->halt('MySQL Query Error', $sql);
			}
		}
		return $query;
	}

	function fetch_array($query, $result_type = MYSQL_ASSOC) {
		return mysql_fetch_array($query, $result_type);
	}

	function fetch_first($sql) {
		return $this->fetch_array($this->query($sql));
	}

	function result($query, $row) {
		$query = @mysql_result($query, $row);
		return $query;
	}

	function result_first($sql) {
		return $this->result($this->query($sql), 0);
	}
	
	//返回结果集中行的数目
	function num_rows($query) {
		$query = mysql_num_rows($query);
		return $query;
	}
	
	//返回结果集中字段的数目
	function num_fields($query) {
		return mysql_num_fields($query);
	}

	//返回根据所取得的行生成的数组
	function fetch_row($query) {
		$query = mysql_fetch_row($query);
		return $query;
	}

	//函数从结果集中取得列信息并作为对象返回
	function fetch_fields($query) {
		return mysql_fetch_field($query);
	}

	//函数释放结果内存
	function free_result($query) {
		return mysql_free_result($query);
	}

	function affected_rows() {
		return mysql_affected_rows();
	}

	function error() {
		return mysql_error();
	}

	function errno() {
		return intval(mysql_errno());
	}

	function version() {
		return mysql_get_server_info();
	}

	function close() {
		return mysql_close();
	}

	function halt($message = '', $sql = '') {
		exit("MySQL Query:$sql<br> Message:$message");
	}
}
?>