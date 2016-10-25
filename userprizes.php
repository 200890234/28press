<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();

if($_GET["act"]=="del"){
	$query=$db->query("Select * From {$web_dbtop}exchange where uid=".intval($_COOKIE["usersid"])." and id=".intval($_GET["id"])."");
	if($rs=$db->fetch_array($query)){
		if($rs["mode"]!=1){
			$points=$rs["points"];
			$db->query("update {$web_dbtop}commodities set convertnum=convertnum-1 where id=".$rs["commoditiesid"]."");
			$db->query("update {$web_dbtop}users set points=points+$points,djcs=djcs-1,djpoints=djpoints-$points where id=".$rs["uid"]."");
			$db->query("update {$web_dbtop}game_log set dj_doudou=dj_doudou-$points where uid=".$rs["uid"]);
			userslog(4,"withdraw cancellation",$points,0);
			$db->query("delete from {$web_dbtop}exchange where id=".intval($_GET["id"])."");
			echo "<script language=javascript>alert('withdraw canceled');location.href='userprizes.php';</script>";
			exit;
		}else{
			echo "<script language=javascript>alert('sorry, this order has already finished,operation failed');history.go(-1);</script>";
			exit;
		}
	}else{
		echo "<script language=javascript>alert('warning! what are you doing？？？？？？？');history.go(-1);</script>";
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
document.getElementById("qh_con7").getElementsByTagName('li')[6].className="current";
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
				 <H3>My withdraw history</H3>
			</DIV>
        	<div class="users-content">
        		<ul class="bgk">
					<li class="b250c">Title</li>
					<li class="b84c">Number</li>
					<li class="b180c">Date and Time</li>
					<li class="b100c">Status</li>
					<li class="b100c">operation</li>
					<?php
					$intpage = 14;
					if (isset($_GET['page'])) {
						$rsnum = (intval($_GET['page']) -1)*$intpage;
					}
					else {
						$rsnum = 0;
					}
					$sql="Select * from {$web_dbtop}exchange where uid=".intval($_COOKIE["usersid"])." Order by id desc";
					$query=$db->query($sql);
					if($db->fetch_array($query)) 
						$intnum=$db->num_rows($query);
					$query=$db->query($sql." limit $rsnum,$intpage");
					while($rs=$db->fetch_array($query)){
						echo"<LI class=b250><A href=\"prizes_content.php?id=".$rs["commoditiesid"]."\">".showcontent("commodities","name",$rs["commoditiesid"])."</A></LI>";
						echo"<LI class=b84>".$rs["num"]."</LI>";
						echo"<LI class=b180>".date("M d, Y H:i:s",strtotime($rs["time"]))."</LI>";
						echo"<LI class=b100>";
						if($rs["mode"]==1){
							echo"processed";
						}else if($rs["mode"]==2){
							echo"cofirmed";
						}else{
							echo"to be cofirmed";
						}
						echo"</LI>";
						echo"<LI class=b100>".($rs["mode"]==0?"<A href=\"?act=del&id=".$rs["id"]."\" onClick=\"return confirm('are you sure to cancel it?');\">Cancel</a>":"")."</LI>";
					}
					include_once("inc/page_class.php");
					$page=new page(array('total'=>$intnum,'perpage'=>$intpage));
					echo "<li class=\"bb\">".$page->show(5,"","")."</li>";
					?>
				</ul>
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
<script language="JavaScript" src="inc/Calendar.js"></script>
</DIV>