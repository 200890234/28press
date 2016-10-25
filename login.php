<?php
session_start();
include_once("inc/conn.php");
include_once("inc/function.php");
if($_GET["act"]=="login"){
	if(!is_numeric($_POST["tbUserAccount"]) && $_POST["tbLoginType"]==1){
		echo "<script language=javascript>alert('sorry，please check your id');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		exit;
	}
	if(!checkEmail($_POST["tbUserAccount"]) && $_POST["tbLoginType"]==2){
		echo "<script language=javascript>alert('sorry，please check your email address');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		exit;
	}
	if(strtolower($_SESSION["yan"])!=strtolower($_POST["tbSafeCode"])){
		echo "<script language=javascript>alert('invalid code');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		exit;
	}
	if($_POST["tbLoginType"]==1){
		$query=$db->query("Select * from {$web_dbtop}users where id=".intval(trim($_POST["tbUserAccount"]))." and password='".md5(trim($_POST["tbUserPwd"]))."'");
	}else{
		$query=$db->query("Select * from {$web_dbtop}users where email='".str_check(trim($_POST["tbUserAccount"]))."' and password='".md5(trim($_POST["tbUserPwd"]))."'");
	}
	if($rs=$db->fetch_array($query)){
		if($rs["dj"]==1){
			echo "<script language=javascript>alert('sorry,your account is frozen for ".$rs["djly"]." ');location.href='index.php';</script>";
			exit;
		}
		if($_POST["tbKeep"]==1){
			setcookie("usersid",$rs["id"],time()+3600000);
			setcookie("password",$rs["password"],time()+3600000);
		}else if($_POST["tbKeep"]==24){
			setcookie("usersid",$rs["id"],time()+8640);
			setcookie("password",$rs["password"],time()+8640);
		}else{
			setcookie("usersid",$rs["id"]);
			setcookie("password",$rs["password"]);
		}
		$db->query("update {$web_dbtop}users set loginip='".usersip()."' where id=".$rs["id"]);
		//$sql="update {$web_dbtop}users set loginip='".usersip()."' where id=".$rs["id"];
		//echo $sql;
		//exit;
		echo "<script language=javascript>alert('login success');location.href='index.php';</script>";
		exit;
	}else{
			echo "<script language=javascript>alert('sorry,your password is incorrect');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
			exit;
	}
}else if($_GET["act"]=="logout"){
	setcookie("usersid");
	setcookie("password");
	echo "<script language=javascript>location.href='index.php';</script>";
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>User login-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<DIV class="wrapper">
	<DIV class="page_content">
		<DIV class="webgame-activities-title">
			<H3>User login</H3>
		</DIV>
			<div class="main_users">
				 <div class="main_txzreg">
					<div class="txz_porfile">
						<h2>Donot have an account?</h2>
						<p class="btn_reg_b_t" style="margin-top:20px;">
							<a href="reg.php"><img src="images/btn_reg2.gif" border="0" /></a>
						</p>
						<!--<p class="f_green02">what can you do after registeration?</p>
						<p class="btn_reg_b">-->
						  <!--<a href="index.php"class="marr10" target="_blank"><img src="images/j3.gif" border="0" /></a>
						  <a href="profit.php" class="marr10" target="_blank"><img src="images/j6.gif" border="0" /></a>-->
						  <!--<a href="luck.php" class="marr10" target="_blank">play games</a><br>
						  <a href="prizes.php" class="marr10" target="_blank">withdraw earnings</a><br>
						  <a href="bbs/index.php" class="marr10" target="_blank">join community</a><br>
						  and more ...
						</p>
						-->
					</div>
					<FORM action="?act=login" method="post">
					<table width="350" border="0" cellspacing="0" cellpadding="0" class="table_log">
						<tr>
							<td height="40" colspan="2"><h2>User login</h2></td>
						</tr>
						<tr>
							<td width="50">Login by：</td>
							<td width="300"><INPUT id=rLoginID type=radio CHECKED value=1 name=tbLoginType> ID <INPUT id=rLoginMail type=radio value=2 name=tbLoginType> E-mail</td>
						</tr>
						<tr>
							<td>Username：</td>
							<td><INPUT tabindex="1" class="inpA" id=tbUserAccount name=tbUserAccount></td>
						</tr>
						<tr>
							<td>Password：</td>
							<td><INPUT tabindex="2" class="inpA" id=tbUserPwd type=password name=tbUserPwd></td>
						</tr>
						<tr>
							<td>code：</td>
						  <td><input tabindex="3" name="tbSafeCode" type="text" id="tbSafeCode" class="inpB" style="text-transform: uppercase" />  <img id="vdimgck" src="inc/code.php" alt="看不清？点击更换" width="60" height="26" style="cursor:pointer" onclick="this.src=this.src+'?'" /> 
							  <span class="findpw">forget password?<a href="resetpassword.php">click here</a></span></td>
						</tr>
						<tr style="display:none;">
							<th>&nbsp;</th> 
							<td><INPUT type=radio value=1 name=tbKeep> 永久 <INPUT type=radio value=24 name=tbKeep> 24小时 <INPUT type=radio CHECKED value=0 name=tbKeep> 退出失效</td>
						</tr>
						
						<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<td><input name="" type="submit" class="buttonlogin" value=""></td>
						</tr>
				 </table>
				</form>
				</div>
			</div>
		<div class="area960-b h5px"></div>
		<DIV class=cl></DIV>
	</div>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>


your ip is: <?php echo usersip();?>