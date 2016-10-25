<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once("inc/conn.php");
include_once("inc/function.php");
if ( $_COOKIE["usersid"]=="" )
{
$usersid="";
}
else
{
$usersid=$_COOKIE["usersid"];
}
login_check();
$serverUrlAndPath = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["REQUEST_URI"]);
$serverUrlAndPath = str_replace("\\", "/", $serverUrlAndPath);
$succesUrl = $serverUrlAndPath."/payment/libertyreserve/sec/success.php";
$failUrl = $serverUrlAndPath."/payment/libertyreserve/fail.php";
$statusUrl = $serverUrlAndPath."/payment/libertyreserve/status.php";
//echo $succesUrl."<br>";
//echo $failUrl."<br>";
//echo $statusUrl."<br>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>deposit-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
<style>
	.inp{background:#eee;height:24px;line-height:24px;vertical-align:middle;font-size:15px;}
	span{font-size:16px;line-height:24px;}
	.submit{width:64px;height:26px;font-size: 16px;margin-top:10px;}
</style>
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(9);
//document.getElementById("qh_con8").getElementsByTagName('li')[9].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
	  <div style="float:left;width:40%;"><!--left-->
		<DIV class="webgame-activities-title">
			<H3>Make a deposit</H3>
		</DIV>
		<span style="display:block;height:20px;">&nbsp;</span>
		<span>Transaction Fee of liberty reserve(LR) is 1%.<br>
		Minimum amount of a deposit is $2($1=10000PRs).<br> </span>
		<span style="color:#FF6308;">Important: </span>
		<span style="">In order to have your account credited instantly, Please click <font color="#FF6308">"Return To Merchant"</font> button after your successful payment.or your account will not be credited. If this happens, please send email to <a href="mailto:service@28press.com">service@28press.com</a> or <a href="mailto:service.28press@gmail.com">service.28press@gmail.com</a> including your LR account, amount and 28press account. we'll credit your account within 24 hours .
		</span>	
		<DIV class=cl></DIV>
	  </div>	<!--left-->
	  <div style="width:50%;float:left;margin-left:80px;margin-top:20px;"><!--right-->
	  	<div style="margin-top:20px;font-size:15px;">
	  		<span style="color:#FF6308;font-weight:bold;">Please read the instructions carefully before your deposit !</span>
			<form method="POST" action="https://sci.libertyreserve.com" target="_blank">
				<table>
					<tr>
					<td style="width:60px;text-align:right;padding-right:25px;height:55px;">Pay to:</td><td><input type="text" name="lr_acc" value="U6456089" readonly="readonly" class="inp"></td>
					</tr>
					<tr>
					<td style="width:60px;text-align:right;padding-right:25px;height:55px;">Amount:</td><td><input type="text" name="lr_amnt" class="inp">&nbsp;&nbsp;(>= $2)</td>
					</tr>
					<tr>
					<td style="width:60px;text-align:right;padding-right:25px;height:120px;">Memo:</td><td><textarea name="lr_comments" cols="40" rows="10" style="background:#eee;"></textarea></td>
					</tr>	
					<tr>
					<td colspan="3" align="center"><input type="submit" name="submit" class="submit" value="deposit"></td>
					</tr>
				</table>		
					<input type="hidden" name="lr_currency" value="LRUSD">
					<input type="hidden" name="lr_success_url" value="<?php echo $succesUrl;?>">
					<input type="hidden" name="lr_success_url_method" value="POST">
					<input type="hidden" name="lr_fail_url" value="<?php echo $failUrl;?>">
					<input type="hidden" name="lr_fail_url_method" value="POST">
					<input type="hidden" name="user_id" value="<?php echo $usersid;?>">		
			</form>
		</div>	
	  </div><!--right-->
	</div>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
<script type="text/javascript">
function $(obj){
	return typeof(obj) == "string" ? document.getElementById(obj) : obj;
}
</script>
</DIV>