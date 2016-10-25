<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include_once("inc/conn.php");
include_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<meta name="verification" content="51248265fd28f7f1166255d4b142cc40" /><!--zanox流量联盟验证用-->
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<? include_once("top.php");?>
<DIV class="wrapper">
	<DIV class="page_content" style="background:#215308;">
		<!--主体左边 Start-->
		<div class="theleft" style="float:left;width:690px;">
		<DIV class="area690 fl">
			<DIV class="area340 fl" style="float:right;border:px solid red;">
				<DIV class="area340-t h5px"></DIV>
				<DIV class="area340-info" style="height:190px;font-size:14px;font-weight:bold;">
					<img src="28logo.png" width="340" height="200">
					<!--Welcome to 28press.com. Play greatest lottery games online. Here are the awesome features that you will find in 28press:<br>
					The Prize Fund is 95%+ of sales !<br>
					The lottery games draw every 30 minutes for 24 hours!<br>
					Play games automatically even you are offline !<br>
					Play games use preset patterns or create your own patterns(as much as 40 patterns) .-->
				</DIV>
				<DIV class="area340-b h5px"></DIV>
			</DIV>
			<DIV class="area340 fr" style="float:left;width:350px;padding-left:0px;border:px solid red;margin-left:-15px;">
				<DIV class="area340-t h5px"></DIV>
				<DIV class="area340-info">
				<DIV class="newshome_tabs" style="margin-left:5px;margin-top:-5px;">
					<div style="background-image:url(images/titleleft.gif);float:left;width:10px;height:34px;"></div>
					<div style="background-image:url(images/titlecenter.gif);background-repeat:repeat-x;float:left;width:200px;height:43px;">
						<div style="display:block;width:30px;float:left;padding-top:8px;"><img src="images/go.gif"></div>
						<div style="display:block;float:left;margin-top:-4px;"><H3 style="color:white;">Latest News</H3></div>
					</div>
					<div style="background-image:url(images/titleright.gif);float:left;width:12px;height:34px;"></div>
					<div style="clear:both;"></div>	
				</DIV>
					<UL class="focus-list" style="margin-top:10px;">
						<!--<li style="font-size:16px;font-weight:bold;height:35px;padding-top:5px;">Latest News</li>-->
						<?
						$i=0;
						$query=$db->query("Select * from {$web_dbtop}news Order by top desc,id desc limit 5");
						while($rs=$db->fetch_array($query)){
						$i++;
							if($i==1){
						?>
						<LI class="focus--" style="text-align:left;padding-left:20px;font-size:14px;">
							<A title="<?=$rs["title"]?>" href="news_content.php?id=<?=$rs["id"]?>"><?=$rs["title"]?></A>
						</LI>
						
						<?
							}else{
						?>
						<LI style="padding-left:20px;font-size:14px;"><A title="<?=$rs["title"]?>"！ href="news_content.php?id=<?=$rs["id"]?>"><?=$rs["title"]?></A></LI>
						<?
							}
						}
						?>
					</UL>
				</DIV>
				<DIV class="area340-b h5px"></DIV>
			</DIV>
		</DIV>
		<DIV class=blank10></DIV>
		<DIV class="area690 fl">
			<DIV class="newshome-mmtitle--" style="width:690px;height:43px;">
				<div style="margin-left:0px;width:690px;">
					<div style="background-image:url(images/titleleft.gif);float:left;width:12px;height:34px;"></div>
					<div style="background-image:url(images/titlecenter.gif);background-repeat:repeat-x;float:left;width:666px;height:34px;padding-top:8px;">
						<div style="display:block;width:30px;float:left;"><img src="images/go.gif"></div>
						<div style="display:block;float:left;font-size:14px;font-weight:bold;margin-top:-2px;">28Press Lottery Games</H3></div>
						<div style="float:right;margin-right:15px;margin-top:-3px;"><A href="game.php">More&raquo;</A></div>
					</div>
					<div style="background-image:url(images/titleright.gif);float:left;width:12px;height:34px;"></div>
					<div style="clear;both;"></div>	
				</div>			
			</DIV>
					
			<UL class="newshome-mmlist">
				<LI><span class="spanimg"><A title="Luck28" href="luck.php"><IMG alt="luck28" src="images/game28.jpg"></A></span><SPAN class="spantext">Luck 28<a href="luck.php">Press it now</a></SPAN></LI>
				<LI><span class="spanimg"><A title="Luck16" href="happy.php"><IMG alt="luck16" src="images/game16.jpg"></A></span><SPAN class="spantext">Luck 16<a href="happy.php">Press it now</a></SPAN></LI>
				<LI><span class="spanimg"><!--<A title="Luck11" href="joyous.php">--><IMG alt="luck11" src="images/game11.jpg"><!--</A>--></span><SPAN class="spantext">Luck 11<!--<a href="joyous.php">Press it now</a>--><a onclick="return false">Coming soon...</a></SPAN></LI>
			</UL>
		</DIV>
		<DIV class=blank10></DIV>
		<DIV class="area690 fl">
			
			<DIV class="area340 fr" style="float:left;">
				<DIV class="newshome_tabs">
					<div style="margin-left:0px;">
					<div style="background-image:url(images/titleleft.gif);float:left;width:12px;height:34px;"></div>
					<div style="background-image:url(images/titlecenter.gif);background-repeat:repeat-x;float:left;width:200px;height:43px;">
						<div style="display:block;width:30px;float:left;padding-top:8px;"><img src="images/go.gif"></div>
						<div style="display:block;float:left;margin-top:-4px;"><H3 style="color:white;">Help</H3></div>
						<div style="float:right;margin-right:5px;margin-top:-4px;"><A href="help_lest.php">More&raquo;</A></div>
					</div>
					<div style="background-image:url(images/titleright.gif);float:left;width:12px;height:34px;"></div>
					<div style="clear:both;"></div>	
					</div>	
				</DIV>
				<DIV class="area340-info">
					<UL class="help-list">
						<?
						$i=0;
						$query=$db->query("Select * from {$web_dbtop}help Order by top desc,id desc limit 7");
						while($rs=$db->fetch_array($query)){
						?>
						<LI style="float:none;"><A title="<?=$rs["title"]?>" href="help_content.php?id=<?=$rs["id"]?>"><?=$rs["title"]?></A></LI>
						<?
						}
						?>
					</UL>
				</DIV>
				<DIV class="area340-b h5px"></DIV>
			</DIV>
		</DIV>
		</div>
		<!--主体左边 End-->
	
		<!--主体右边 Start-->
		<div class="theright" style="float:right;width:250px;background:#133304;">
		<DIV class="area260 fr">
			<DIV class="news-title-index" style="width:250px;">
				<ul style="margin-left:0px;">
					<li style="background-image:url(images/titleleft-dark.gif);float:left;width:12px;height:34px;"></li>
					<li style="background-image:url(images/titlecenter.gif);background-repeat:repeat-x;float:left;width:226px;">
						<span style="display:block;width:30px;float:left;padding-top:8px;"><img src="images/go.gif"></span>
						<span style="display:block;float:left;margin-top:-4px;"><H3 style="color:white;">User Login</H3></span>
					</li>
					<li style="background-image:url(images/titleright-dark.gif);float:left;width:12px;height:34px;"></li>
				</ul>
			</DIV>
			<DIV class="area260-info">
				<UL class="news-list">
					<?php
					  $query=$db->query("Select * From {$web_dbtop}users where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
					  if($rs=$db->fetch_array($query)){
					 ?>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="login">
						<tr>
							<td height="35" align="right">Account：</td>
							<td><span class=rf><?=$rs["id"]?></span> <?=($rs["vip"]==1?"":"")?></td>
						</tr>
						<tr>
							<td height="35" align="right">Balance：</td>
							<td><span class=rf><?=number_format($rs["points"])?></span></td>
						</tr>
						<tr>
							<td height="35" align="right">Message：</td>
							<td><A href="usersms.php"><span <?=(msg_num(0)!=0?"class=rf":"")?>>new message(<?=msg_num(0)?>)</span></A></td>
						</tr>
						<tr align="center">
						  <td height="52" colspan="2"><a href="login.php?act=logout"><img src="images/dc03.gif" border="0"></a></td>
						</tr>
				 </table>
					<?
					}else{
					?>
					<form name='form' method='post' action='login.php?act=login'>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="login">
						<tr>
							<td width="70" height="26">login by：</td>
							<td><INPUT id="rLoginID" type="radio" CHECKED value="1" name="tbLoginType"> 
							  ID 
							  <INPUT id="rLoginMail" type="radio" value="2" name="tbLoginType"> 
						    E-mail</td>
						</tr>
						<tr>
							<td height="26">username：</td>
							<td><input  name="tbUserAccount" type="text" id="tbUserAccount"  class="inpl" style="background:#ddd;width:125px;" /></td>
						</tr>
						<tr>
							<td height="26">password：</td>
							<td><input  name="tbUserPwd" type="password" id="tbUserPwd" class="inpl" style="background:#ddd;width:125px;" /></td>
						</tr>
						<tr>
							<td height="26">code：</td>
							<td><input name="tbSafeCode" type="text" class="inp_yz" id="tbSafeCode" style="background:#ddd;text-transform: uppercase" maxlength="4" />  <img id="vdimgck" src="inc/code.php" alt="refresh" width="60" height="22" style="cursor:pointer" onClick="this.src=this.src+'?'" /></td>
						</tr>
						<!--<tr align="center">
							<td height="26" colspan="2"><INPUT type=radio value=1 name="tbKeep">
							  永久
							    <INPUT type=radio value=24 name="tbKeep">
							    24小时
							    <INPUT type=radio CHECKED value=0 name="tbKeep">
						    退出失效</td>
						</tr>-->
						<tr align="center">
						  <td height="52" colspan="2">
						  <input name="Login" type="submit" class="but" value="Login"> 
						  &nbsp;&nbsp;&nbsp;<a href="reg.php" style="font-size:14px;">register now</a> 
						</tr>
				 </table>
			      </form>
					<?
					  }
					 ?>
				</UL>
			</DIV>
		</DIV>

		

		<div class="blank10--" style="clear:both;height:1px;"></div>
		<DIV class="area260 fr">
			<DIV class="news-title-index">
				<ul style="margin-left:0px;">
					<li style="background-image:url(images/titleleft-dark.gif);float:left;width:12px;height:34px;"></li>
					<li style="background-image:url(images/titlecenter.gif);background-repeat:repeat-x;float:left;width:226px;">
						<span style="display:block;width:30px;float:left;padding-top:8px;"><img src="images/go.gif"></span>
						<span style="display:block;float:left;margin-top:-4px;"><H3 style="color:white;">Latest Withdrawal</H3></span>
					</li>
					<li style="background-image:url(images/titleright-dark.gif);float:left;width:12px;height:34px;"></li>
				</ul>				
			</DIV>
			<DIV class="area260-info">
				<ul class="kf-title">
					<li style="width:54px;">Date</li>
					<li style="width:130px;">Prize</li>
					<li style="width:44px;">User</li>
				</ul>
				<ul class="kf-list">
					<?
					$query=$db->query("Select * from {$web_dbtop}exchange Order by id desc limit 5");
					while($rs=$db->fetch_array($query)){
					?>
					<li><span><?=date("M d",strtotime($rs["time"]))?></span><span style="text-align:center;"><a href="prizes_content.php?id=<?=$rs["commoditiesid"]?>"><?=showcontent("commodities","name",$rs["commoditiesid"])?></A></span><span style="text-align:right;"><A href="user.php?id=<?=$rs["uid"]?>"><?=$rs["uid"]?></A></span></li>
					<?
					}
					?>
					
				</ul>
			</DIV>
		</DIV>
		
		<div class="blank10" style="height:13px;"></div>
		<DIV class="area260 fr">
			<DIV class="news-title-index">
				<ul style="margin-left:0px;">
					<li style="background-image:url(images/titleleft-dark.gif);float:left;width:12px;height:34px;"></li>
					<li style="background-image:url(images/titlecenter.gif);background-repeat:repeat-x;float:left;width:226px;">
						<span style="display:block;width:30px;float:left;padding-top:8px;"><img src="images/go.gif"></span>
						<span style="display:block;float:left;margin-top:-4px;" ><H3 style="color:white;">Hot Topics</H3></span>
					</li>
					<li style="background-image:url(images/titleright-dark.gif);float:left;width:12px;height:34px;"></li>
				</ul>
			</DIV>
			<DIV class="area260-info">
				<UL class="news-list">
					<?
					$query=$db->query("Select * from {$web_dbtop}bbs_posts Order by dj desc,id desc limit 6");
					while($rs=$db->fetch_array($query)){
					?>
					<LI><A title="<?=$rs["title"]?>" href="<?=$web_dir?>bbs/read.php?forumsid=<?=$rs["section"]?>&threadsid=<?=$rs["id"]?>" target=_blank><?=$rs["title"]?></A></LI>
					<?
					}
					?>
				</UL>
			</DIV>
			<DIV class="area260-b h5px"></DIV>
		</DIV>
		</div>
		<!--主体右边 End-->
	</DIV>
	
	
	<div class="blank10"></div>
	<div id="flink" class="clearfix">
		<div class="flink-h h5px"></div>
		<div class="flink-info">
			<div class="photo">
				<h6>Links</h6>
				<ul>
					<?
					$query=$db->query("Select * from {$web_dbtop}link Order by sort asc,id desc");
					while($rs=$db->fetch_array($query)){
					?>
					<li><a href='<?=$rs["weburl"]?>' target='_blank'><?=$rs["webname"]?></a></li>
					<?
					}
					?>
				</ul>
			</div>
		</div>
		<div class="flink-b h5px"></div>
	</div>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<? include_once("footer.php");?>
</DIV>



