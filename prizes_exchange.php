<?php
include_once("inc/conn.php");
include_once("inc/function.php");
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();

if($_GET["act"]=="but"){
	if(intval($_POST["tbExchangedCount"])<=0){
		echo "<script language=javascript>alert('warning !! what are you doing？？？？？？？');history.go(-1);</script>";
		exit;
	}
	if(!$_POST["tbExchangedCount"]){
		echo "<script language=javascript>alert('sorry,please enter quantity');history.go(-1);</script>";
		exit;
	}
	//if(!$_POST["tbUserCardID"]){//取消身份验证
		//echo "<script language=javascript>alert('对不起,身份证号码不能为空！');history.go(-1);</script>";
		//exit;
	//}
	if(!$_POST["tbUserSecAns"]){
		echo "<script language=javascript>alert('sorry,please enter your seucrity answer');history.go(-1);</script>";
		exit;
	}
	if(!$_POST["tbUserAddressee"]){
		echo "<script language=javascript>alert('sorry,please enter your account name');history.go(-1);</script>";
		exit;
	}

	$query=$db->query("Select * From {$web_dbtop}users where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
	if($rs=$db->fetch_array($query)){
		$uid=$rs["id"];
		$upoints=$rs["points"];
		$uback=$rs["back"];
		$authentication=$rs["authentication"];
		$maxexperience=$rs["maxexperience"];
		$vip=$rs["vip"];
		$secans=$rs["secans"];
	}
	if(($upoints+$uback)<$prizes_points){//这个是兑奖下限 在站点设置里面
		echo "<script language=javascript>alert('sorry,your balance must be greater than".$prizes_points.$web_moneyname."');history.go(-1);</script>";
		exit;
	}
	if($secans!=str_check($_POST["tbUserSecAns"])){
		echo "<script language=javascript>alert('sorry,security answer incorrect');history.go(-1);</script>";
		exit;
	}
	//if($web_ck_card==1){
		//if($authentication!=1){//取消身份验证
			//echo "<script language=javascript>alert('对不起,您的身份证没有通过验证,请先验证！');location.href='userValid.php';</script>";
			//exit;
		//}
	//}
	$query=$db->query("Select sum(num) as num From {$web_dbtop}exchange where uid=$uid and STR_TO_DATE(time,'%Y-%m-%d')='".date("M d, Y")."'");
	if($rs=$db->fetch_array($query)){
		if(($rs["num"]+intval($_POST["tbExchangedCount"]))>($vip=1?$web_exchanged_num_vip:$web_exchanged_num)){
			//echo "<script language=javascript>alert('对不起,您今日已经超过兑奖次数！\\r\\n您进今日已经兑奖".$rs["num"]."次！\\r\\n您每日可以兑奖".($vip=1?$web_exchanged_num_vip:$web_exchanged_num)."次！');history.go(-1);</script>";
			echo "<script language=javascript>alert('sorry,you have already requested ".$rs["num"]." times today,please come back tomorrow');history.go(-1);</script>";
			exit;
		}
	}
	$query=$db->query("Select * from {$web_dbtop}commodities where id =".intval($_GET['id']));
	if($rs=$db->fetch_array($query)){
		$id=$rs["id"];
		$name=$rs["name"];
		$points=$rs["points"];
		$discount=$rs["discount"];
		$shoptype=$rs["shoptype"];
		$autocard=$rs["autocard"];
		$cardtype=$rs["cardtype"];
	}
	if($discount==1){
		$query=$db->query("Select kinddiscount,virtualdiscount,vipkinddiscount,vipvirtualdiscount from {$web_dbtop}usergroups where creditshigher<=$maxexperience and creditslower>=$maxexperience Order by id desc");
		if($rs=$db->fetch_array($query)){
			if($shoptype==1){
				if($vip==1){
					if($rs["vipkinddiscount"]!=0){
						$points=$points*$rs["vipkinddiscount"]/10;
					}
				}else{
					if($rs["virtualdiscount"]!=0){
						$points=$points*$rs["virtualdiscount"]/10;
					}
				}
			}else{
				if($vip==1){
					$points=$points-$rs["vipvirtualdiscount"];
				}else{
					$points=$points-$rs["virtualdiscount"];
				}
			}
		}
	}
	if($upoints<$points*intval($_POST["tbExchangedCount"])){
		echo "<script language=javascript>alert('sorry, you don\'t have enough ".$web_moneyname."');history.go(-1);</script>";
		exit;
	}
	$points=$points*intval($_POST["tbExchangedCount"]);
	$db->query("update {$web_dbtop}commodities set convertnum=convertnum+".intval($_POST["tbExchangedCount"])." where id=$id");
	$db->query("update {$web_dbtop}users set points=points-$points,djcs=djcs+".intval($_POST["tbExchangedCount"]).",djpoints=djpoints+$points where id=$uid");
	$tbUserAddressee=str_check($_POST["tbUserAddressee"]);
	$tbUserLr=str_check($_POST["tbUserLr"]);
	$tbUserPhone=str_check($_POST["tbUserPhone"]);
	$tbUserAddress=str_check($_POST["tbUserAddress"]);
	$tbUserPostCode=str_check($_POST["tbUserPostCode"]);
	$tbExchangedDescription=str_check($_POST["tbExchangedDescription"]);
	if($autocard==1){
		$query=$db->query("Select cardtop,cardlen,cardtype from {$web_dbtop}cardtype where id=$cardtype");
		if($rs=$db->fetch_array($query)){
			$cardtop=$rs["cardtop"];
			$cardlen=$rs["cardlen"];
			$sc_cardtype=$rs["cardtype"];
		}
		for($y=0;$y<intval($_POST["tbExchangedCount"]);$y++){
			$cardid=$cardtop.createrandstring($cardlen,$sc_cardtype);
			$cardpwd=createrandstring($cardlen,$sc_cardtype);
			//$db->query("INSERT INTO {$web_dbtop}card (cardtype,cardid,cardpaw,time,businessid,state) VALUES ($cardtype,'".$cardid."','".$cardpwd."','".date("M d, Y H:i:s")."',0,2)");
			//$sms_c.="卡号：".$cardid."&nbsp;&nbsp;&nbsp;&nbsp;密码：".$cardpwd."<br><br>";//发送卡密
		}
		$db->query("INSERT INTO {$web_dbtop}msg (usersid,title,mag,mid,time) VALUES (0,'withdrawal alert','your request for ".$name." has been processed <br>".$sms_c."',".$uid.",'".date("M d, Y H:i:s")."')");
		$db->query("insert into {$web_dbtop}exchange (uid,commoditiesid,num,rname,card,points,qq,tel,address,zip,remarks,time,mode) values 
						($uid,$id,".intval($_POST["tbExchangedCount"]).",'".$tbUserAddressee."','".intval($_POST["tbUserCardID"])."',$points,'".intval($_POST["tbUserQQ"])."','".$tbUserPhone."','".$tbUserAddress."','".$tbUserPostCode."','".$sms_c."','".date("M d, Y H:i:s")."',1)");
		$db->query("update {$web_dbtop}game_log set dj_doudou=dj_doudou+".intval($points)." where uid=".intval($_COOKIE["usersid"]));
		$db->query("update {$web_dbtop}webtj set exchangepoints=exchangepoints+$points where time='".date("M d, Y")."'");
		userslog(4,"request for $name quantity: ".intval($_POST["tbExchangedCount"]),-$points,0);
		echo "<script language=javascript>alert('success,please check your message box');location.href='userprizes.php';</script>";
		exit;
	}else{
		$db->query("insert into {$web_dbtop}exchange (uid,commoditiesid,num,rname,lr_acc,card,points,qq,tel,address,zip,remarks,time) values 
						($uid,$id,".intval($_POST["tbExchangedCount"]).",'".$tbUserAddressee."','".$tbUserLr."','".intval($_POST["tbUserCardID"])."',$points,'".intval($_POST["tbUserQQ"])."','".$tbUserPhone."','".$tbUserAddress."','".$tbUserPostCode."','".$tbExchangedDescription."','".date("Y-m-d,H:i:s")."')");//这个时间格式要按标准写入数据库（数据库时间字段特有格式），读取时候在按照具体格式输出
		$db->query("update {$web_dbtop}game_log set dj_doudou=dj_doudou+".intval($points)." where uid=".intval($_COOKIE["usersid"]));
		userslog(4,"request for $name quantity: ".intval($_POST["tbExchangedCount"]),-$points,0);
		echo "<script language=javascript>alert('success,please wait for our confirmation');location.href='userprizes.php';</script>";
		exit;
	}
}

$query=$db->query("Select * from {$web_dbtop}commodities where id =".intval($_GET['id']));
if($rs=$db->fetch_array($query)){
	$id=$rs["id"];
	$name=$rs["name"];
	$pic=$rs["pic"];
	$points=$rs["points"];
	$discount=$rs["discount"];
	$shoptype=$rs["shoptype"];
	$convertnum=$rs["convertnum"];
	$content=$rs["content"];
	$discountpoints=$points;
}
	$query=$db->query("Select * From {$web_dbtop}users where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
	if($rs=$db->fetch_array($query)){
		$maxexperience=$rs["maxexperience"];
		$vip=$rs["vip"];
		$secques=$rs["secques"];
		$qq=$rs["qq"];
		$tel=$rs["tel"];
		$authentication=$rs["authentication"];
		$card=$rs["card"];
		$rname=$rs["rname"];
	}
if($discount==1){
	if(isset($maxexperience)){
		$query=$db->query("Select kinddiscount,virtualdiscount,vipkinddiscount,vipvirtualdiscount from {$web_dbtop}usergroups where creditshigher<=$maxexperience and creditslower>=$maxexperience Order by id desc");
		if($rs=$db->fetch_array($query)){
			if($shoptype==1){
				if($vip==1){
					if($rs["vipkinddiscount"]!=0){
						$discountpoints=$points*$rs["vipkinddiscount"]/10;
					}
				}else{
					if($rs["virtualdiscount"]!=0){
						$discountpoints=$points*$rs["virtualdiscount"]/10;
					}
				}
			}else{
				if($vip==1){
					$discountpoints=$points-$rs["vipvirtualdiscount"];
				}else{
					$discountpoints=$points-$rs["virtualdiscount"];
				}
			}
		}
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$name?>-Prizes-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(4);
document.getElementById("qh_con4").getElementsByTagName('li')[0].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
		<!--主体左边 Start-->
		<div class="area690 fl" style="float:right;">
			<form action="?act=but&id=<?=$id?>" method="post">
			<div class="webgame-title1"><h3>Prize Detail</h3></div>
			<div class="area690-info">
				<div class="yxxx">
					<div class="btn_hd_l">
						 <a href='<?=$web_dir.$web_picdir.$pic?>' target='_blank'><img src="<?=$web_dir.$web_picdir.$pic?>" width="86" height="110" border="0"/></a>
					</div>
					<ul>		
						<li style="height:45px;">Title：<?=$name;?></li>
						<li style="height:45px;">Serial Number：<?=$id;?></li>
						<li style="height:45px;">Price：<?=number_format($points);?></li>
						<li class="rf" style="height:45px;">Discount：<?=number_format($discountpoints);?></li>
						<!--<li>兑出数量：<?=$convertnum?></li>-->
						<li style="height:45px;">Quantity：<INPUT class=bk size=6 value=1 name=tbExchangedCount></li>
					</ul>
				</div>
			</div>
			<div class="area690-b h5px"></div>
			<div class="blank10"></div>
			<div class="webgame-title1"><h3>Check Your Info</h3></div>
			<div class="area690-info">
			<TABLE cellSpacing=8 cellPadding=0 width="95%" align=center border=0 class="font14">
			<TBODY>
			 <!-- <TR>
				<TD width="24%" align=right>身份证号码：</TD>
				<TD width="76%"><INPUT name=tbUserCardID class=bk id=tbUserCardID value="<?=($authentication==1?$card:"")?>" size=25 maxLength=18>&nbsp;<FONT class="rf">*</FONT></TD>
			  </TR>-->
			  <TR>
				<TD align=right width="150">Security question：</TD>
				<TD><?=$secques?></TD>
			  </TR>
			  <TR>
				<TD align=right>Your answer：</TD>
				<TD><INPUT class=bk id=tbUserSecAns size=25 name=tbUserSecAns>&nbsp;<FONT class="">*</FONT></TD>
			  </TR>
			  <TR>
				<TD align=right>Account name：</TD>
				<TD><INPUT class=bk maxLength=50 size=25 name=tbUserAddressee value="<?=($authentication==1?$rname:"")?>">&nbsp;<FONT class="">* Your account name of LR </FONT></TD>
			  </TR>
			  <TR>
				<TD align=right>LR account：</TD>
				<TD><INPUT class=bk maxLength=10 size=25 name=tbUserLr value="<?=($authentication==1?$rname:"")?>">&nbsp;<FONT class="">* Your LR account ,usually begins with U </FONT></TD>
			  </TR>
			  <!--<TR>
				<TD align=right>联系QQ：</TD>
				<TD><INPUT class=bk maxLength=15 size=25 name=tbUserQQ value="<?=$qq?>"></TD>
			  </TR>-->
			  <TR>
				<TD align=right>Mobile：</TD>
				<TD><INPUT class=bk maxLength=15 size=25 name=tbUserPhone value="<?=$tel?>">&nbsp;<FONT class=rf><!--联系QQ和电话必填一项！--></FONT></TD>
			  </TR>
			 <!-- <TR>
				<TD class=font-red align=right>请填写收货地址：</TD>
				<TD><INPUT class=bk maxLength=200 size=40 name=tbUserAddress></TD>
			  </TR>
			  <TR>
				<TD align=right>邮编：</TD>
				<TD><INPUT class=bk maxLength=6 name=tbUserPostCode></TD>
			  </TR>-->
			  <TR>
				<TD align=right>Memo：</TD>
				<TD><TEXTAREA class=cm_textarea name=tbExchangedDescription style="width:400px;"></TEXTAREA>
					<BR>
					<BR>
				<!--兑换奖品为充值卡或Q币之类的物品时，请务必填写你相应的QQ号码，方便我们与您取得联系。--></TD>
			  </TR>
			  <TR>
			    <TD align=right>&nbsp;</TD>
			    <TD><input name="imageField" type="image" src="images/an_ljtj_03.gif" width="100" height="25" border="0"></TD>
		      </TR>
			</TBODY>
			</TABLE>
			</div>
			<div class="area690-b h5px"></div>
			<div class="blank10"></div>
			<DIV class=cl></DIV>
			</form>
		</div>
		<!--主体左边 End-->
  		<!--主体右边 Start-->
    	<div class="area260 fl" style="float:left;">
			<DIV class="news-title">
				<span><a href="news_lest.php">More&raquo;</a></span>
				 <H3 style="color:white;font-size:15px;">Latest News</H3>
			</DIV>
			<ul class="area260-info news-list">
				<?
				$query=$db->query("Select * from {$web_dbtop}news Order by top desc,id desc limit 10");
				while($rs=$db->fetch_array($query)){
				?>
				<LI><A title="<?=$rs["title"]?>" href="news_content.php?id=<?=$rs["id"]?>"><?=$rs["title"]?></A></LI>
				<?
				}
				?>
			</ul>
			 <DIV class="area260-b h5px"></DIV>
			 <DIV class=blank10></DIV>
			 <DIV class="news-title">
				<span><a href="help_lest.php">More&raquo;</a></span>
				 <H3 style="color:white;font-size:15px;">Users Guide</H3>
			</DIV>
			<ul class="area260-info news-list">
				<?
				$query=$db->query("Select * from {$web_dbtop}help Order by top desc,id desc limit 10");
				while($rs=$db->fetch_array($query)){
				?>
				<LI><A title="<?=$rs["title"]?>" href="help_content.php?id=<?=$rs["id"]?>"><?=$rs["title"]?></A></LI>
				<?
				}
				?>
			</ul>
			 <DIV class="area260-b h5px"></DIV>
			 <DIV class=blank10></DIV>
		</div>
	</DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>