<?php
function login_check(){
		global $db,$web_dbtop,$web_loginperience,$web_dir;
		$loginjl=0;
		if (empty($_COOKIE["usersid"]) || empty($_COOKIE["password"])){
		   		echo "<script>alert('sorry, please login first,you are redirected to the login page.');location.href='".$web_dir."login.php';</script>";
	  		exit;
		}else{
			$query=$db->query("Select id,dj,djly From {$web_dbtop}users where id=" .intval($_COOKIE["usersid"]). " And password='" .str_check($_COOKIE["password"]). "'");
			if(!$rs=$db->fetch_array($query)){
				echo "<script>alert('sorry, please login first,you are redirected to the login page.');location.href='".$web_dir."index.php';</script>";
	  			exit;
			}else{
				if($rs["dj"]==1){
					setcookie("usersid");
					setcookie("password");
					echo "<script language=javascript>alert('sorry, your account is frozen - ".$rs["djly"]."');location.href='index.php';</script>";
					exit;
				}
				$query_f=$db->query("Select id from {$web_dbtop}users where STR_TO_DATE(logintime,'%Y-%m-%d')='".date("Y-m-d")."' and id=".$rs["id"]);
				if(!$rs_f=$db->fetch_array($query_f)){
					$loginjl=1;
				}
				if($loginjl==1){
					$db->query("update {$web_dbtop}users set experience=experience+$web_loginperience,maxexperience=maxexperience+$web_loginperience,logintime='".date("Y-m-d H:i:s")."' where id=".$rs["id"]);
					//userslog(4,"登陆奖励".$web_loginperience."经验值",0,$web_loginperience);
					userslog(400,"登陆奖励".$web_loginperience."经验值",0,$web_loginperience);//4和400对应userslog表中的logtype 改为400,为了区分其他logtype=4 前台就可以过滤掉读取登陆奖励了
				}
			}
	   }
}

function business_check(){
	global $db,$web_dbtop,$web_dir;
	$query=$db->query("Select id From {$web_dbtop}business where uid=" .intval($_COOKIE["usersid"]));
		if(!$rs=$db->fetch_array($query)){
			echo "<script>alert('sorry, permission denied');location.href='".$web_dir."index.php';</script>";
	  		exit;
		}
}

function usersip() {
if (getenv('HTTP_CLIENT_IP')) {
		$ip = getenv('HTTP_CLIENT_IP');
	}elseif (getenv('HTTP_X_FORWARDED_FOR')) {
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	}elseif (getenv('HTTP_X_FORWARDED')) {
		$ip = getenv('HTTP_X_FORWARDED');
	}elseif (getenv('HTTP_FORWARDED_FOR')) {
		$ip = getenv('HTTP_FORWARDED_FOR');
	}elseif (getenv('HTTP_FORWARDED')) {
		$ip = getenv('HTTP_FORWARDED');
	}else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}


function getRealIpAddr(){//获得访问者真实ip（他们使用了代理）   并不是万能的 
if (!empty($_SERVER['HTTP_CLIENT_IP'])){//check ip from share internet
$ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){//to check ip is pass from PRoxy
$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
$ip=$_SERVER['REMOTE_ADDR'];
}
return $ip;
}




function cnsubstr($str_cut,$length)
{ 
    if (strlen($str_cut) > $length)
    { 
        for($i=0; $i < $length; $i++) 
        if (ord($str_cut[$i]) > 128)    $i++; 
        $str_cut = substr($str_cut,0,$i); 
    } 
    return $str_cut; 
}


function random($length) { 
$hash = ''; 
$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'; 

$max = strlen($chars) - 1; 

for($i = 0; $i < $length; $i++) { 
$hash .= $chars[mt_rand(0, $max)]; 
} 
return $hash; 

}

function showid($tables,$tablesname,$id){
	global $db,$web_dbtop;
	$query=$db->query("Select $tablesname from $web_dbtop$tables where email='".$id."'");
	if($rs=$db->fetch_array($query)){
		return $rs[$tablesname];
	}
}

function msg_num($type){
	global $db,$web_dbtop;
	$sql="select count(id) from {$web_dbtop}msg";
	if($type==1){
		$sql.=" where usersid=".intval($_COOKIE["usersid"])." and del=0 and look=0";
	}else{
		$sql.=" where mid=".intval($_COOKIE["usersid"])." and del=0 and look=0";
	}
	return $db->result_first($sql);
}

function ck_secans($secans){
global $db,$web_dbtop;
	$query=$db->query("Select secans From {$web_dbtop}users where id=" .intval($_COOKIE["usersid"]). " And password='" .str_check($_COOKIE["password"]). "'");
	if($rs=$db->fetch_array($query)){
		if($rs["secans"]!=$secans){
			echo "<script language=javascript>alert('sorry, your security answer is incorrect, please check');history.go(-1);</script>";
			exit;
		}
	}
}

function backlog($mun,$type){
	global $db,$web_dbtop;
	if($type==1){
		$db->query("INSERT INTO {$web_dbtop}backlog (time,log,points,back,usersid) VALUES ('".date("Y-m-d H:i:s")."','deposit',".-$mun.",".$mun.",".intval($_COOKIE["usersid"]).")");
	}else{
		$db->query("INSERT INTO {$web_dbtop}backlog (time,log,points,back,usersid) VALUES ('".date("Y-m-d H:i:s")."','withdraw',".$mun.",".-$mun.",".intval($_COOKIE["usersid"]).")");
	}
}

function userslog($logtype,$log,$points,$experience,$usersid=''){
	global $db,$web_dbtop;
	if(!$usersid)
		$usersid=intval($_COOKIE["usersid"]);
	$db->query("INSERT INTO {$web_dbtop}userslog (time,logtype,log,points,experience,usersid) VALUES ('".date("Y-m-d H:i:s")."',".intval($logtype).",'".str_check($log)."',".intval($points).",".intval($experience).",".$usersid.")");
}

function showstars($num) {
	global $web_dir;
	$starthreshold=3;
	$alt = 'alt="等级: '.$num.'级"';
	if(empty($starthreshold)) {
		for($i = 0; $i < $num; $i++) {
			echo '<img src="'.$web_dir.'images/score/1.gif" '.$alt.' />';
		}
	} else {
		for($i = 6; $i > 0; $i--) {
			$numlevel = intval($num / pow($starthreshold, ($i - 1)));
			$num = ($num % pow($starthreshold, ($i - 1)));
			for($j = 0; $j < $numlevel; $j++) {
				echo '<img src="'.$web_dir.'images/score/'.$i.'.gif" '.$alt.' />';
			}
		}
	}
}

function userslive($experience){
	global $db,$web_dbtop;
	$query=$db->query("Select stars from {$web_dbtop}usergroups where creditshigher<=$experience and creditslower>=$experience Order by id desc");
	if($rs=$db->fetch_array($query)){
		return $rs["stars"];
	}
}

function showselect($id){
	global $db,$web_dbtop;
	echo "<OPTION value=\"\" ".(!$id?"selected":"").">All Prizes</OPTION>";
	$query=$db->query("Select * from {$web_dbtop}ctype where typeid=0 Order by sort asc,id desc");
	while($rs=$db->fetch_array($query)){
		echo "<OPTION value=".$rs["id"]." ".($id==$rs["id"]?"selected":"").">".$rs["name"]."</OPTION>";
		$query_f=$db->query("Select * from {$web_dbtop}ctype where typeid=".$rs["id"]." Order by sort asc,id desc");
		while($rs_f=$db->fetch_array($query_f)){
			echo "<OPTION value=".$rs_f["id"]." ".($id==$rs_f["id"]?"selected":"").">├--".$rs_f["name"]."</OPTION>";
		}
	}
}

function showcontent($tables,$tablesname,$id){
	global $db,$web_dbtop;
	$query=$db->query("Select $tablesname from $web_dbtop$tables where id=$id");
	if($rs=$db->fetch_array($query)){
		return $rs[$tablesname];
	}
}

function typesid($id){
	global $db,$web_dbtop;
	$query=$db->query("Select * from {$web_dbtop}ctype where typeid=$id Order by sort asc,id desc");
	while($rs=$db->fetch_array($query)){
		$content.=$rs["id"].",";
	}
	return rtrim($content,",");
}

function delkey($content){//应该是ubb函数 不用他了
	global $web_commentskey;
	$commentskey=explode("|",$web_commentskey);
	for($i=0; $i<count($commentskey); $i++){
		$content=str_replace($commentskey[$i],"*",$content);
	}
	return htmlspecialchars($content);
}

function checkEmail($inAddress){ 
 	return (preg_match("/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/",$inAddress)); //这句会出问题   在新版本php 不建议ereg
}

function cardtypeselect(){
	global $db,$web_dbtop;
	echo"<select name=\"cardtype\">";
   	echo"<option value=\"\">请选择充值卡类型</option>";
	$query=$db->query("Select * FROM {$web_dbtop}cardtype Order by id desc");
	while($rs=$db->fetch_array($query)){
		echo"<option value=".$rs["id"].">".$rs["cardname"]."</option>";
	}
    echo "</select>";
}

function showbusinessid($uid){
	global $db,$web_dbtop;
	$query=$db->query("Select id from {$web_dbtop}business where uid=$uid");
	if($rs=$db->fetch_array($query)){
		return $rs["id"];
	}
}

function showcardtype($id){
	global $db,$web_dbtop;
	$query=$db->query("Select cardname from {$web_dbtop}cardtype where id=$id");
	if($rs=$db->fetch_array($query)){
		return $rs["cardname"];
	}
}

function createrandstring($length,$type) { 
	$hash = ''; 
	$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	switch($type){
	case 0:
		$max=9;
		break;
	case 1:
		$max=35;
		break;
	case 2:
		$max = strlen($chars) - 1; 
		break;
	default:
		$max=9;
		break;
	}
	for($i = 0; $i < $length; $i++){ 
		$hash .= $chars[mt_rand(0, $max)]; 
	} 
	return $hash; 
}

function DateDiff($date1, $date2, $unit = ""){
switch ($unit) { 
case 's': 
$dividend = 1; 
break; 
case 'i': 
$dividend = 60; 
break; 
case 'h': 
$dividend = 3600; 
break; 
case 'd': 
$dividend = 86400; 
break; 
default: 
$dividend = 86400; 
} 
$time1 = strtotime($date1);
$time2 = strtotime($date2);
if ($time1 && $time2)
return (float)($time1 - $time2) / $dividend;
return false;
}

function zint($val){
	if($val>0){
		return $val;
	}else{
		return 0;
	}
}

function game11pl($num){
	$game11_array = array(36,18,12,9,7.2,6,7.2,9,12,18,36);
	return $game11_array[$num-2];
	unset($game11_array);
}

function game16pl($num){
	$game16_array = array(216,72,36,21.6,14.4,10.29,8.64,8,8,8.64,10.29,14.4,21.6,36,72,216);
	return $game16_array[$num-3];
	unset($game16_array);
}

function game28pl($num){
	$game28_array = array(1000,333.33,166.67,100,66.66,47.61,35.71,27.77,22.22,18.18,15.87,14.49,13.69,13.33,13.33,13.69,14.49,15.87,18.18,22.22,27.77,35.71,47.61,66.66,100,166.66,333.33,1000);
	return $game28_array[$num];
	unset($game28_array);
}

function fsockurl($httpurl){
	$url=explode("/",$httpurl);
	$urls=$url[2];
	if(stristr($urls,":")){
	$w_url=explode(":",$urls);
	$urls=$w_url[0];
	$port=$w_url[1];
	}else{
	$port=80;
	}
	for($i=3;$i<count($url);$i++){ 
		$pstr .= "/".$url[$i]; 
	}
	$fp = @fsockopen($urls,$port);
	if($fp){
		$out = "GET $pstr HTTP/1.1\r\n"; 
		$out .= "Host: $urls\r\n"; 
		$out .= "Connection: Close\r\n\r\n"; 
		fwrite($fp, $out); 
		while (!feof($fp)){ 
			$httpcontent.=fgets($fp, 1024);
		} 
		fclose($fp);
	}
	$httpcontent=explode("\r\n\r\n",$httpcontent,2); 
	return $httpcontent[1];
}

function GetBodyc($string,$start,$end){
	$start=stripcslashes($start);
	$end=stripcslashes($end);
	$message = @explode($start,$string);
	$message = @explode($end,$message[1]);
	if(count($message)>1){
		return $message[0];
	} else{
		return false;
	}
}

function pro_rand($pro, &$res, $num=1){
	$pro_sum = array_sum($pro);
	for($i = 0; $i < $num; $i++){
		$rand_num = mt_rand(1, $pro_sum);
		reset($pro);
		foreach($pro as $key => $value){
				if($rand_num <= $value){
					break;
				}else{
					$rand_num -= $value;
				}
		}
		$res[$i] = $key;
	}
}

function dodgejg($pk,$ww){
	 if($pk - $ww == -1 || $pk - $ww == 2){    
        return 1;      
     }elseif($pk - $ww == 1 || $pk - $ww == -2){    
        return 2;     
     }else{    
     	return 3;      
     }
}

function today_posts_num($id){
	global $db,$web_dbtop;
	$sql="select count(id) from {$web_dbtop}bbs_posts where STR_TO_DATE(time,'%Y-%m-%d')='".date("Y-m-d")."'";
	$sql.=" and section=".intval($id);
	return $db->result_first($sql);
}

function posts_num($id){
	global $db,$web_dbtop;
	$sql="select count(id) from {$web_dbtop}bbs_posts where";
	$sql.=" section=".intval($id);
	return $db->result_first($sql);
}

function reply_num($id){
	global $db,$web_dbtop;
	$sql="select count({$web_dbtop}bbs_reply.id) from {$web_dbtop}bbs_reply,{$web_dbtop}bbs_posts where";
	$sql.=" {$web_dbtop}bbs_reply.pid={$web_dbtop}bbs_posts.id and {$web_dbtop}bbs_posts.section=".intval($id);
	return $db->result_first($sql);
}

function f_reply_num($id){
	global $db,$web_dbtop;
	$sql="select count(id) from {$web_dbtop}bbs_reply where";
	$sql.=" pid=".intval($id);
	return $db->result_first($sql);
}

function f_final_id($id){
	global $db,$web_dbtop;
	$query=$db->query("Select uid from {$web_dbtop}bbs_reply where pid=".intval($id)." Order by id desc");
	if($rs=$db->fetch_array($query)){
		return showcontent("users","name",$rs["uid"]);
	}
	return "&nbsp;";
}

function flashslide($Slidewidth,$Slideheight){
	global $db,$web_dbtop,$web_dir,$web_slidedir;
	$flashslide="<script type=text/javascript>\n";
	$flashslide.="var swf_width=".$Slidewidth.";\n";
	$flashslide.="var swf_height=".$Slideheight.";\n";
	$query=$db->query("select * from {$web_dbtop}slide Order by sort asc,id desc");
	while($rs=$db->fetch_array($query)){
		$i++;
		if(stristr($rs["slidepic"],"http://")){
		$images=$rs["slidepic"];
		}else{
		$images=$web_dir.$web_slidedir.$rs["slidepic"];
		}
	$pic.=$images."|";
	$links.=$rs["slideurl"]."|";
	}
	$flashslide.="var files='".rtrim($pic,"|")."';\n";
	$flashslide.="var links='".rtrim($links,"|")."';\n";
	$flashslide.="var texts='';\n";
	$flashslide.="document.write('<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"'+ swf_width +'\" height=\"'+ swf_height +'\">');\n";
	$flashslide.="document.write('<param name=\"movie\" value=\"".$web_dir."inc/flash.swf\"><param name=\"quality\" value=\"high\">');\n";
	$flashslide.="document.write('<param name=\"menu\" value=\"false\"><param name=\"wmode\" value=\"opaque\">');\n";
	$flashslide.="document.write('<param name=\"FlashVars\" value=\"bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'\">');\n";
	$flashslide.="document.write('<embed src=\"".$web_dir."inc/flash.swf\" wmode=\"opaque\" FlashVars=\"bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'& menu=\"false\" quality=\"high\" width=\"'+ swf_width +'\" height=\"'+ swf_height +'\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />'); document.write('</object>');\n";
	$flashslide.="</script>";
	return $flashslide;
}
?>