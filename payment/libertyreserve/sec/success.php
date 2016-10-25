<?php
$parse_url=parse_url($_SERVER[HTTP_REFERER]);
$url_from=$parse_url[host]; //获得网站来源  
if($url_from == ""){//如果来源为空说明是直接在地址栏输入访问的
//echo $url_from."oo"; 
//echo "access denied";  //
//echo "<script type=\"text/javascript\">alert(\"access denied\");window.close();</script>";
//echo " <META HTTP-EQUIV=  \"Refresh\" CONTENT=\"0;  URL=../fail.php\" >";
//exit;
}
?>
<html>
<head></head>
<body>


	<!--<h2 style="color:red;">交易成功，请将这个页面截图，同时 查看-源代码 把源代码截图</h2>-->
	
	<!--
	<form method="GET" action="http://127.0.0.1:8080/28press/payment/libertyreserve/success.php">
		<input type="hidden" name="lr_paidto" value="U123456">
		<input type="hidden" name="lr_paidby" value="U789">
		amount:<input type="hidden" name="lr_amnt" value="<?php //echo $POST_["lr_amnt"];?>">
		<input type="hidden" name="lr_fee_amnt" value="0">
		<input type="hidden" name="lr_currency" value="LRUSD">
		<input type="hidden" name="lr_transfer" value="4456778335534">
		<input type="hidden" name="lr_store" value="28store">
		transaction time<input type="text" name="lr_timestamp" value="<?php //echo date("Y-m-d H:i:s");?>">
		baggage fields set by the Merchant 
		<input type="hidden" name="track_id" value="166337678784">
		<input type="hidden" name="order_id" value="O7993547">
	</form>-->
	<!--传递过来的金额是：<?php //echo $POST_["lr_amnt"];?>; 充值者的lr账号是：<?php //echo $POST_["lr_acc"];?>-->
	
	
	<?php 
	//$usersid=$_POST["user_id"];
	//echo "传递过来的usersid参数是=".$usersid;//这个需要测试参数是否真的传过来了。
	?>
	
	

	<!--其中一个测试传过来的是：<?php //echo $_POST["test_id"];?>(正确的应该是333333)-->
</body>
</html>



<!-- 需要读取出用户的上级id，增加奖励同时发送短信 

用户充值成功后影响的账户游戏币和操作说明日志  可参考card.php（道具使用页面）
userslog表中可以添加一种日志类型：下线充值奖励。和每个会员账户充值，有关代码也可以参考card.php页面

新添加了一个deposit表，记录充值和对账户游戏币的影响

还与一个受影响的表是user  充值后要更新他的账户游戏币

或许deposit表可以直接由userslog代替

-->


<!-- 假设成功获取到了充值数据，进行的操作如下 -->
<?php
include_once("../../../inc/conn.php");
include_once("../../../inc/function.php");

global $userid;
$userid=$_POST["user_id"];  //会员id
//$userid=56902;  //会员id
$amnt=$_POST["lr_amnt"];	//充值金额
//$amnt=50;	//充值金额
$pointsget=$amnt*10000;  //获得游戏币
$upperget=$pointsget*0.02;	//上线奖励
$operation="会员充值";	//操作为充值  deposit
$time=date("Y-m-d H:i:s");	//交易时间
$paidto=$_POST["lr_paidto"];//网站方收款账号
$lr_paidby=$_POST["lr_paidby"];
function getUpperId($userid){//$userid在函数外部有值，作为参数传入后，在函数内就可以使用了
	global $web_dbtop;//设为全局变量 否则报错
	$sql="select uid from {$web_dbtop}tjlog where xid=".$userid;
	$result=mysql_query($sql);
	while($rs=mysql_fetch_assoc($result)){
		//print_r($rs);
		return $rs["uid"];
	}
}

$upperid=getUpperId($userid);
if(!$upperid){
	$upperid=00000;
}
echo $upperid;  //这里获取到了 上级id

$db->query("insert into {$web_dbtop}deposit(uid,amnt,pointsget,time,upperid,upperget,operation,paidby,paidto) values({$userid},'{$amnt}','{$pointsget}','{$time}','{$upperid}','{$upperget}','{$operation}','{$lr_paidby}','{$lr_paidto}')");   //执行sql的写法  写进存款记录表 
$db->query( "update ".$web_dbtop."game_log set dj_hd=dj_hd+{$pointsget} where uid=".$userid );



$db->query("update {$web_dbtop}users set points=points+".$pointsget." where id=".$userid);
$db->query("update {$web_dbtop}users set points=points+".$upperget." where id=".$upperid);

//接下来是否要发送站内信 给上线？？？？？？？？？？？？？？？？？
$db->query("INSERT INTO {$web_dbtop}msg (usersid,title,mag,mid,time) VALUES (0,'you get bonus',' ".$userid."deposited $".$amnt.", you got ".$upperget." PRs',".intval($upperid).",'".date("Y-m-d H:i:s")."')");
		


//echo "<script type=\"text/javascript\">window.location.href=\"../success.html\";</script>";//重定向1  禁用js后无效
echo "  <META HTTP-EQUIV=  \"Refresh\" CONTENT=\"0;  URL=../success.html\" >";  //重定向2

//$GoTo="success.html";   // 如果这里的目标链接取自数据库就实现了动态转向    
//header(sprintf("Location: %s", $GoTo));   //重定向3








?>
