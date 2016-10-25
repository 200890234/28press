<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Member-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
<style type="text/css">

</style>
<SCRIPT src="inc/reg.js"></SCRIPT>
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(7);
document.getElementById("qh_con7").getElementsByTagName('li')[0].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
  		<!--主体右边 Start-->
    	<div class="area260 fl">
			<DIV class="news-title">
				<span><a href="news_lest.php">More&raquo;</a></span>
				 <H3 style="color:white;">Announcement</H3>
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
				 <H3 style="color:white;">Users guide</H3>
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
				<div class="fhome-jp-menu">
				<span><A href="usersms.php?act=addSms" target=_parent <? if($_GET["act"]=="addSms"){ echo "class=\"current\"";}?>>write message</a><A href="usersms.php" target=_parent <? if($_GET["act"]==""){ echo "class=\"current\"";}?>>inbox(<?=msg_num(0);?>)</a><A href="usersms.php?act=mysend" target=_parent <? if($_GET["act"]=="mysend"){ echo "class=\"current\"";}?>>outbox(<?=msg_num(1);?>)</a></span>
				</div>
				 <H3>Message</H3>
			</DIV>
        	<div class="users-content">
        		<?
				switch($_GET["act"]){
				case "look":
					look();
					break;
				case "addSms":
					addSms();
					break;
				case "saddSms":
					saddSms();
					echo "<script language=javascript>alert('Your message is successfully sent');location.href='usersms.php';</script>";
					break;
				case "lock":
					del();
					echo "<script language=javascript>alert('delete sucess');location.href='usersms.php';</script>";
					break;
				case "mysend":
					main(1);
					break;
				default:
					main(0);
					break;
				}
				
				function saddSms(){
					global $db,$web_dbtop;
					if(!$_POST["tbSmsReceiver"]){
						echo "<script language=javascript>alert('sorry,please enter the recipient ');history.go(-1);</script>";
						exit;
					}
					if(!$_POST["tbSmsSubject"]){
						echo "<script language=javascript>alert('sorry,please enter subject');history.go(-1);</script>";
						exit;
					}
						if(!$_POST["tbSmsContent"]){
						echo "<script language=javascript>alert('sorry,please enter content');history.go(-1);</script>";
						exit;
					}
					if($_POST["rType"]==1){
						$tbSmsReceiver=intval($_POST["tbSmsReceiver"]);
					}else{
						$tbSmsReceiver=showid("users","id",str_check($_POST["tbSmsReceiver"]));
					}
					if($tbSmsReceiver==intval($_COOKIE["usersid"])){
						echo "<script language=javascript>alert('your can't wirite message to yourself');history.go(-1);</script>";
						exit;
					}
					$db->query("INSERT INTO {$web_dbtop}msg (usersid,title,mag,mid,time) VALUES (".intval($_COOKIE["usersid"]).",'".str_check($_POST["tbSmsSubject"])."','".str_check($_POST["tbSmsContent"])."',".$tbSmsReceiver.",'".date("M d, Y H:i:s")."')");
				}
				
				function del(){
					global $db,$web_dbtop;
					if($_POST["chkID"]){
						$chkID=implode(",",$_POST["chkID"]);
						$query=$db->query("Select * from {$web_dbtop}msg where id in ($chkID)");
						while($rs=$db->fetch_array($query)){
							if($rs["del"]==0 && $rs["usersid"]!=0){
								$db->query("update {$web_dbtop}msg set del=1 where id=".$rs["id"]);
							}else{
								$db->query("delete from {$web_dbtop}msg where id=".$rs["id"]);
							}
						}
					}else{
						echo "<script language=javascript>alert('please choose at least one message to operate');history.go(-1);</script>";
					}
				}
				function addSms(){
				?>
				<!--添加短信-->
				<FORM action=?act=saddSms method=post>
					<ul class="bgk">
						<li class="b21" style="text-align:right"><span>Type： </span></LI>
						<li class="b22"><span style="padding-left:5px">ID <INPUT type=radio CHECKED value=1 name=rType> &nbsp;&nbsp;  E-mail <INPUT type=radio value=0 name=rType></span></LI>
						<li class="b21" style="text-align:right"><span style="padding-left:5px">To： </span></LI>
						<li class="b22"><span style="padding-left:5px"><INPUT name=tbSmsReceiver value="<?=$_GET["smsReceiver"];?>" size="30"></span></LI>
						<li class="b21" style="text-align:right"><span style="padding-left:5px">Subject：</span></LI>
						<li class="b22"><span style="padding-left:5px"><INPUT name=tbSmsSubject value="<?=$_GET["smsSubject"];?>" size="45"></span></LI>
						<li class="bh1" style="text-align:right"><span style="padding-left:5px">Content： </span></LI>
						<li class="bh2"><span style="padding-left:5px"><TEXTAREA class=table1_text360 name=tbSmsContent></TEXTAREA></span></LI>
						<li class="tj"><INPUT type=image src="images/an_fs_03.gif" border=0></span></LI>
					</UL>
				</FORM>
				<?
				}
				function look(){
					global $db,$web_dbtop;
					$query=$db->query("Select * from {$web_dbtop}msg where id =".intval($_GET['id']));
					if($rs=$db->fetch_array($query)){
						if($rs["mid"]!=$_COOKIE["usersid"] && $rs["usersid"]!=$_COOKIE["usersid"]){
							echo "<script>alert('Illegal operation??');history.go(-1);</script>";
							exit;
						}
						$id=$rs["id"];
						$usersid=$rs["usersid"];
						$mid=$rs["mid"];
						$time=date("M d, Y H:i:s",strtotime($rs["time"]));
						
						$title=$rs["title"];
						$mag=$rs["mag"];
					} 
					$db->query("update {$web_dbtop}msg set look=1 where id =".intval($_GET['id']));
				?>
				<!--短信明细-->
				<div class="right_mainContent">
					<div class="biaoge">
						<ul>
							<li class="b1" style="text-align:right">From:</li>
							<li class="b2"><?=$usersid;?></li>
							<li class="b1" style="text-align:right">To:</li>
							<li class="b2"><?=$mid;?></li>
							<li class="b1" style="text-align:right">Time:</li>
							<li class="b2"><?=$time;?></li>
							<li class="b1" style="text-align:right">Subject:</li>
							<li class="b2"><?=$title;?></li>
							<li class="b3"><span style="padding-left:25px"><?=$mag;?></span></li>
							<form method="post" action="?act=lock">
							<li class="b4" style="margin-top:20px;">
							
									<input type="hidden" name="chkID[]" value="<?=$id;?>" />
									<? if($usersid!=intval($_COOKIE["usersid"]) && $usersid!=0){?><a href="?act=addSms&smsReceiver=<?=$usersid;?>&smsSubject=Re:<?=$title;?>"><img src="images/an_hf.gif" width="49" height="20" border="0" /></a>&nbsp;&nbsp;<? }?><input type="image" src="images/an_sc_03.gif" width="53" height="20" border="0" />&nbsp;&nbsp;<a href="usersms.php">back to message list</a></li>
							</form>
						</ul>
					</div>
				</div>
				<?
				}
				function main($type){
					global $db,$web_dbtop;
				?>
				<!--收件箱-->
				<ul class="bgk">
					<li class="b84c" style="MARGIN-LEFT: 0px;margin-right:0px;"><A href="javascript:checkedAll('chkID')">Check all</A></li>
					<li class="b42c">From</li>
					<li class="b301c">Subject</li>
					<li class="b42c">Time</li>
					<FORM onsubmit="return confirm('Are your sure？')" action=?act=lock method=post>
					<?php
					$intpage = 14;
					if (isset($_GET['page'])) {
						$rsnum = (intval($_GET['page']) -1)*$intpage;
					}
					else {
						$rsnum = 0;
					}
					if($type==0){
						$sql="Select * from {$web_dbtop}msg where mid=".intval($_COOKIE["usersid"])." and del=0";
					}else{
						$sql="Select * from {$web_dbtop}msg where usersid=".intval($_COOKIE["usersid"])." and del=0";
					}
					$sql.=" Order by id desc";
					$query=$db->query($sql);
					if($db->fetch_array($query)) 
						$intnum=$db->num_rows($query);
					$query=$db->query($sql." limit $rsnum,$intpage");
					while($rs=$db->fetch_array($query)){
						echo"<LI class=b84 style=\"MARGIN-LEFT: 0px;margin-right:0px;\"><div style=\"float:left;padding-top:8px;padding-left:25px;\"><INPUT type=checkbox value=".$rs["id"]." name=chkID[]></div> <div style=\"float:left;padding-top:10px;padding-left:5px;\"><IMG height=10 src=\"".($rs["look"]==1?"images/u-mail_09.gif":"images/u-mail_08.gif")."\" width=15></div> </LI>";
						if($rs["usersid"]==0){
							echo"<LI class=b42>System</LI>";
						}else{
							echo"<LI class=b42><A href=\"user.php?id=".$rs["usersid"]."\">".$rs["usersid"]."</A></LI>";
						}
						echo"<LI class=b301><A href=\"usersms.php?act=look&id=".$rs["id"]."\">".$rs["title"]."</A></LI>";
						echo"<LI class=b42>".date("M d, Y H:i:s",strtotime($rs["time"]))."</LI>";
					}
					include_once("inc/page_class.php");
					$page=new page(array('total'=>$intnum,'perpage'=>$intpage));
					echo "<li class=\"bb\"><INPUT type=image src=\"images/an_sc_03.gif\" border=0 name=btnDelete> ".$page->show(5,"","")."</li>";
					?>
					</FORM>
				</UL>
				<?
				}
				?>
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