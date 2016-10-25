<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();
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
<style type="text/css">
.tabs-menu span{width:auto;padding:0 15px;}
.tabs-menu span.hover{width:auto;padding:0 15px;}
</style>
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(7);
document.getElementById("qh_con7").getElementsByTagName('li')[4].className="current";
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
				 <H3>My Account </H3>
			</DIV>
        	<div class="users-content">
        		<ul class="bgk">
					<?
					$query=$db->query("Select * From {$web_dbtop}users where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
					if($rs=$db->fetch_array($query)){
					?>
					<li class="bb21">Your total <?=$web_moneyname?>：<?=number_format($rs["points"]+$rs["back"]);?><img src="<?=$web_moneypic?>" align="absmiddle" />&nbsp;&nbsp;&nbsp;&nbsp;<?=$web_moneyname?> in bank：<?=number_format($rs["back"]);?><img src="<?=$web_moneypic?>" align="absmiddle" /></li>
					<!--<li class="bb21">你的当前经验值是：<?//=$rs["experience"];?>&nbsp;&nbsp;&nbsp;&nbsp;累计经验值：<?//=$rs["maxexperience"];?></li>
					<li class="bb21">当前经验值等级：<? //showstars(userslive($rs["maxexperience"]));?></li>
					<? //if($rs["vip"]==1){?>
					<li class="bb21">VIP到期时间：<?//=date("Y-m-d",strtotime($rs["vipdate"]."+1 day"));?></li>
					<?
						//}
					}
					?>-->
					<!--<form action="?" method="get">
					<li class="b33"><img src="images/gif-0282.gif" width="70" height="27" /></li>
					<li class="b31"><div class="l151"><ul><li><input name="m" type="radio" value=""  <? //if(empty($_GET["m"])) echo"checked";?>/>全部
														<input name="m" type="radio" value="1"  <? //if($_GET["m"]==1) echo"checked";?>/>获得<?//=$web_moneyname?>
														<input name="m" type="radio" value="0"  <? //if($_GET["m"]==0 && isset($_GET["m"])) echo"checked";?>/>使用<?//=$web_moneyname?>
														<input name="m" type="radio" value="2"  <? //if($_GET["m"]==2) echo"checked";?>/>经验值变动<br />
					时间<input name="sd" type="text" size="12" maxlength="10"  onfocus=setday(this) readOnly value="<?//=(empty($_GET["sd"])?date("Y-m-").(date("d")-1):$_GET["sd"]);?>" />至<input name="ed" type="text" size="12" maxlength="10" onfocus=setday(this) readOnly value="<?//=(empty($_GET["ed"])?date("Y-m-d"):$_GET["ed"]);?>" /></li></ul></div></li>
					<li class="b32"><input type="image" src="images/an_cx_03.gif" /></li>
					</form>
					-->
					<!--
					<li class="tabs-menu">
						<?=($_GET["k"]==0?"<span class=\"hover\"><a href=\"?k=0\">View All</a></span>":"<span><a href=\"?k=0\">View All</a></span>")?>
						<?=($_GET["k"]==1?"<span class=\"hover\"><a href=\"?k=1\">Advertisement</a></span>":"<span><a href=\"?k=1\">Advertisement</a></span>")?>
						<?//=($_GET["k"]==2?"<span class=\"hover\"><a href=\"?k=2\">体验卡使用</a></span>":"<span><a href=\"?k=2\">体验卡使用</a></span>")?>
						<?=($_GET["k"]==3?"<span class=\"hover\"><a href=\"?k=3\">rewards and punishments</a></span>":"<span><a href=\"?k=3\">rewards and punishments</a></span>")?>
						<?=($_GET["k"]==4?"<span class=\"hover\"><a href=\"?k=4\">Others</a></span>":"<span><a href=\"?k=4\">Others</a></span>")?>
					</li>
					-->
					<li style="clear:both;height:20px;"></li>
					<li class="b180c">Date and Time</li>
					<li class="b150c">Operation</li>
					<li class="b42c"><?=$web_moneyname?></li>
					<li class="b42c"><!--影响经验值--></li>
					<?php
						$intpage = 14;
						if (isset($_GET['page'])) {
							$rsnum = (intval($_GET['page']) -1)*$intpage;
						}
						else {
							$rsnum = 0;
						}
						$sql="Select * from {$web_dbtop}userslog where usersid=".intval($_COOKIE["usersid"])."";
						if($_GET["act"]=="search"){
							$sql.=" and (STR_TO_DATE(time,'%Y-%m-%d') userslog '".str_check($_GET["sd"])."' and '".str_check($_GET["ed"])."')";
						}
						if($_GET["k"]!=0){
							$sql.=" and logtype=".intval($_GET["k"])."";
						}
						if($_GET["m"]){
							if($_GET["m"]==0){
								$sql.=" and points<0";
							}else if($_GET["m"]==1){
								$sql.=" and points>0";
							}else if($_GET["m"]==2){
								//$sql.=" and experience!=0";
								
							}
						}
						$sql.= " and logtype!=400";
						$sql.=" Order by id desc";
						
						$query=$db->query($sql);
						if($db->fetch_array($query)) 
							$intnum=$db->num_rows($query);
						$query=$db->query($sql." limit $rsnum,$intpage");
						while($rs=$db->fetch_array($query)){
							echo"<li class=\"b180\">".date("M d, Y H:i:s",strtotime($rs["time"]))."</li>";
							echo"<li class=\"b150\">".$rs["log"]."</li>";
							echo"<li class=\"b42\">".number_format($rs["points"])."<img src=\"".$web_moneypic."\" align=\"absmiddle\" /></li>";
							//echo"<li class=\"b42\">".$rs["experience"]."</li>";
							echo"<li class=\"b42\"></li>";//对应影响经验值
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