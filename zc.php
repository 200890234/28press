<?php
session_start();
include_once("inc/conn.php");
include_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>注册协议-<?=$web_name;?></title>
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
			<H3>注册协议</H3>
		</DIV>
		<div class="main_users">
			<div class="main_txzreg">
				<p>
				<?
				$query=$db->query("Select * from {$web_dbtop}reg where id =1");
				if($rs=$db->fetch_array($query)){
					echo $rs["content"];
				} 
				?>
				</p>
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