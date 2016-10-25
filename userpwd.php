<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();
if($_GET["act"]=="modifyPwd"){
	if($_POST["tbNewPwd"]!=$_POST["tbRePwd"]){
		echo "<script language=javascript>alert('sorry,password do not match');history.go(-1);</script>";
		exit;
	}
	if($_POST["tbOldPwd"]==$_POST["tbNewPwd"]){
		echo "<script language=javascript>alert('sorry，failed to change password ！');history.go(-1);</script>";
		exit;
	}
	$query_f=$db->query("Select id From {$web_dbtop}users where id=" .intval($_COOKIE["usersid"]). " And password='" .md5(trim($_POST["tbOldPwd"])). "'");
	if($rs_f=$db->fetch_array($query_f)){
		$db->query("update {$web_dbtop}users set password='" .md5(trim($_POST["tbNewPwd"])). "' where id=".$rs_f["id"]."");
		setcookie("password",md5(trim($_POST["tbNewPwd"])));
		echo "<script language=javascript>alert('change password success');location.href='userpwd.php';</script>";
		exit;
	}else{
		echo "<script language=javascript>alert('sorry，please check your current password！');history.go(-1);</script>";
		exit;
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Member-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(7);
document.getElementById("qh_con7").getElementsByTagName('li')[10].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
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
		<!--主体左边 Start-->
		<div class="area690 fr">
			<DIV class="users-title">
				 <H3>Change Password</H3>
			</DIV>
        	<div class="users-content">
				<form action="?act=modifyPwd" method="post" enctype="multipart/form-data">
        		<ul class="bgk">
					<li class="b21" style="text-align:right;"><spans>Current password：</span></li>
					<li class="b22"><span style="padding-left:5px"><input name="tbOldPwd" class="input170" type="password" /></span></li>
					<li class="b21" style="text-align:right;"><span>New password：</span></li>
					<li class="b22"><span style="padding-left:5px"><input name="tbNewPwd" class="input170" type="password" /></span></li>
					<li class="b21" style="text-align:right;"><span>Cofirm password：</span></li>
					<li class="b22"><span style="padding-left:5px"><input name="tbRePwd" class="input170" type="password" /></span></li>
					<li class="tj"><input id="btnSubmit" type="image" src="images/an_ljtj_03.gif"  border="0" /></li>
				</ul>
				</form>
			</div>
			<div class="area690-b h5px"></div>
        	<div class="blank10"></div>
		</div>
		<!--主体左边 End-->
	</DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>