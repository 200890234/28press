<?php
include_once (dirname(__FILE__)."/mysql_class.php");
include_once (dirname(__FILE__)."/config.php");
$db = new db;
$db->connect($web_datahost, $web_datauser, $web_datapassword, $web_database, $web_pconnect);

if(function_exists('date_default_timezone_set')) { 
	//date_default_timezone_set('Etc/GMT-5');
}

function inject_check($sql_str) {     
return @eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);    // ���й���     
} 

function str_check($str){
	if (inject_check($str)) { exit('�ύ�Ĳ����Ƿ���'); }
	if (!get_magic_quotes_gpc()){
		$str=addslashes($str);
	}
	$str=str_replace("_","/_",$str);
	$str=str_replace("%","/%",$str);
	return $str;
}
?>