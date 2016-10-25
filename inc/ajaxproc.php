<?
include_once (dirname(__FILE__)."/../inc/conn.php");
	$query=$db->query("Select id from {$web_dbtop}users where email='".str_check(trim($_GET["user"]))."'");
	if($rs=$db->fetch_array($query)){
		echo"true";
	}else{
		echo "false";
	}
?>