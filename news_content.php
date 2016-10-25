<?php
include_once("inc/conn.php");
include_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Announcement-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<DIV class="wrapper">
	<DIV class="page_content">
		<!--主体左边 Start-->
		<div class="area690 fl" style="float:right;">
			<div class="area690-t h5px"></div>
        	<div class="end-content">
				<?
				  $query=$db->query("Select * from {$web_dbtop}news where id =".intval($_GET['id']));
					if($rs=$db->fetch_array($query)){
						$title=$rs["title"];
						$content=$rs["content"];
						$time=$rs["time"];
					} 
				?>
        		<h1 id="h1title" style="color:#C8F14D;"><?=$title?></h1>
            	<span class="info"><?php echo date("M d, Y",strtotime($time))?></span>
				<div class="end-text" style="color:#EEDFFF;"><?=$content?></div>
			</div>
			<div class="area690-b h5px"></div>
        	<div class="blank10"></div>
		</div>
		<!--主体左边 End-->
  		<!--主体右边 Start-->
    	<div class="area260 fr" style="float:left;">
			
			<DIV class="news-title">
				<span><a href="help_lest.php">More&raquo;</a></span>
				 <H3 style="color:white;">Users Guide</H3>
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
			 <DIV class="news-title">
				<span><a href="bbs/">More&raquo;</a></span>
				 <H3 style="color:white;">Hot Topics</H3>
			</DIV>
			<ul class="area260-info news-list">
				<?
				$query=$db->query("Select * from {$web_dbtop}bbs_posts Order by dj desc,id desc limit 10");
				while($rs=$db->fetch_array($query)){
				?>
				<LI><A title="<?=$rs["title"]?>" href="<?=$web_dir?>bbs/read.php?forumsid=<?=$rs["section"]?>&threadsid=<?=$rs["id"]?>" target=_blank><?=$rs["title"]?></A></LI>
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