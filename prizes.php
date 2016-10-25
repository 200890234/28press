<?php
include_once("inc/conn.php");
include_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Prizes-<?=$web_name;?></title>
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
		<DIV class="news-search"><!-- 这里设置了display:none;-->
			<FORM action="prizes_list.php" method="get">
			<strong>奖品搜索：</strong>
			<SELECT name="id">
			<? showselect('');?>
			</SELECT>
			<strong>价格：</strong>
			<SELECT name=p>
			  <OPTION label=请选择价格 value=0 selected>请选择价格</OPTION>
			  <OPTION label=1000--10000<?=$web_moneyname?> value=1>1000--10000<?=$web_moneyname?></OPTION>
			  <OPTION label=10000--30000<?=$web_moneyname?> value=2>10000--30000<?=$web_moneyname?></OPTION>
			  <OPTION label=30000--80000<?=$web_moneyname?> value=3>30000--80000<?=$web_moneyname?></OPTION>
			  <OPTION label=80000--150000<?=$web_moneyname?> value=4>80000--150000<?=$web_moneyname?></OPTION>
			  <OPTION label=150000--300000<?=$web_moneyname?> value=5>150000--300000<?=$web_moneyname?></OPTION>
			  <OPTION label=300000--1000000<?=$web_moneyname?> value=6>300000--1000000<?=$web_moneyname?></OPTION>
			  <OPTION label=1000000--2000000<?=$web_moneyname?> value=7>1000000--2000000<?=$web_moneyname?></OPTION>
			  <OPTION label=2000000以上 value=8>2000000以上</OPTION>
		  	</SELECT>
			<button type="submit" class="search-submit" title="搜索"></button>
			</FORM>
			<span class="pop-keyword"><strong>热门搜索：</strong>
			<?
			$query=$db->query("Select * from {$web_dbtop}commodities where tj=1 Order by id desc limit 7");
			while($rs=$db->fetch_array($query)){
			?>
			<a href='prizes_content.php?id=<?=$rs["id"]?>' target="_blank" title="<?=$rs["name"]?>" ><?=$rs["name"]?></a>&nbsp;
			<?
			}
			?>
			</span>
			<DIV class=cl></DIV>
		</DIV>
		<div class="area690 fl" style="float:right;">
			<div class="webgame-title1"><h3>Prizes List</h3></div>
			<div class="area690-info">
				<UL class="prizes-list">
					<?
					$query=$db->query("Select * from {$web_dbtop}commodities Order by id asc limit 10");
					while($rs=$db->fetch_array($query)){
					?>
					<LI><A title="<?=$rs["name"]?>" href="prizes_content.php?id=<?=$rs["id"]?>"><IMG alt="<?=$rs["name"]?>" src="<?=$web_dir.$web_picdir.$rs["pic"]?>"><SPAN style="COLOR: #C8F13A;font-size:16px;font-weight:bold;"><?=$rs["name"]?></SPAN></A><SPAN>Price : <?=number_format($rs["points"])?> <?php echo $web_moneyname;?></SPAN></LI>
					<?
					}
					?>
				</UL>
			</div>
			<div class="area690-b h5px"></div>
			<div class="blank10" style="height:80px;"></div>
			
			<DIV class=cl></DIV>
		</div>
		<!--主体左边 End-->
  		<!--主体右边 Start-->
		<div class="area260 fl">
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