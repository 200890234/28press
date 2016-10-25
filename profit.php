<?php
include_once("inc/conn.php");
include_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Earn Pr-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(1);
</script>
<!--主题开始 -->

<DIV class="wrapper">
	<DIV class="page_content" style="height:600px;">
		<div class="blank10"></div>			
		<DIV class="webgame-activities-title">
			<H3>Get Free Pr</H3>
		</div>
		<div>
		<UL class="webgame-activities">
			<LI><A title="get free pr" href="almsgiving.php"><IMG alt="get free 500<?=$web_moneyname?>" src="images/jj.gif"><SPAN class="bb">Get free <font color="#FF0000">500</font> <?=$web_moneyname?></SPAN></A></LI>
		</UL>	
		</div>
		<div class="blank10"></div>			
		<DIV class="webgame-activities-title">
			<H3>Advertisement</H3>
		</DIV>
		<div>
			<UL class="webgame-activities">
				<?
				$query=$db->query("Select * from {$web_dbtop}adsp Order by id desc limit 0,12");
				while($rs=$db->fetch_array($query)){
				?>
				<LI><A title="<?=$rs["title"]?>" href="adtask.php?adid=<?=$rs["id"]?>" target="_blank"><IMG alt="<?=$rs["title"]?>" src="<?=$web_adpicdir.$rs["adpic"]?>"><SPAN><?=$rs["title"]?></SPAN></A><SPAN class="dd"><?=number_format($rs["points"])?> <?=$web_moneyname?><font color="#FF0000"></font></SPAN></LI>
				<?
				}
				?>
			</UL>
		</div>					
		<div class="blank10"></div>			
		<DIV class="webgame-activities-title">
			<H3>More...</H3><!-- 消费体验 -->
		</DIV>
		<div>
			<UL class="webgame-activities">
				<?
				$query=$db->query("Select * from {$web_dbtop}adsp where type=2 Order by id desc limit 0,12");
				while($rs=$db->fetch_array($query)){
				?>
				<LI><A title="<?=$rs["title"]?>" href="adclick.php?adid=<?=$rs["id"]?>" target="_blank"><IMG alt="<?=$rs["title"]?>" src="<?=$web_adpicdir.$rs["adpic"]?>"><SPAN><?=$rs["title"]?></SPAN></A><SPAN class="dd"><?=number_format($rs["points"])?> <?=$web_moneyname?><font color="#FF0000"></font></SPAN></LI>
				<?
				}
				?>
			</UL>
		</div>				  
<!--主题结束 -->	 			
		<div class="blank10"></div>		
	</div>
</div>			
<div class="blank10"></div>
			<!--Footer Start-->
		<?php include_once("footer.php");?>
	
