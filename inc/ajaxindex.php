<?
include_once (dirname(__FILE__)."/../inc/conn.php");
include_once(dirname(__FILE__)."/../inc/function.php");
login_check();
	$db->query("delete from {$web_dbtop}adip where type=4 and STR_TO_DATE(time,'%Y-%m-%d')<'".date('Y-m-d')."'");
	$query=$db->query("Select id from {$web_dbtop}adip where uid=".intval($_COOKIE["usersid"])." and type=4 and adid=1");
	if($rs=$db->fetch_array($query)){
		echo "changed";
		exit;
	}
	$db->query("insert into {$web_dbtop}adip (uid,ip,time,type,adid) values (".intval($_COOKIE["usersid"]).",'".usersip()."','".date("Y-m-d H:i:s")."',4,1)");
	$db->query("update {$web_dbtop}users set points=points+50 where id=".intval($_COOKIE["usersid"]));
	$db->query("update {$web_dbtop}game_log set ad_hd=ad_hd+50 where uid=".intval($_COOKIE["usersid"]));
	$db->query("update {$web_dbtop}webtj set indexpoints=indexpoints+50 where time='".date("Y-m-d")."'");
	userslog(1,"广告体验 设置首页",50,0);
	echo "true";
?>