<?php
include_once("inc/conn.php");
include_once("inc/function.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Rankings-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(4);
document.getElementById("qh_con4").getElementsByTagName('li')[2].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
		<!--主体左边 Start-->
		<div class="area690 fl" style="float:right;">
			<div class="table690 h5px" style="padding-top:15px;"></div>
					<table class="ng_tab" width="100%" cellpadding="0" cellspacing="0">
					<thead>
						  <th width="15%" align="center" height="30">AccountID</th>
						    <th align="center">Title</th>
						    <th width="25%" align="center">Total Amount(<?=$web_moneyname?>)</th>
						    <th width="15%" align="center">Date</th>
							<th width="15%" align="center">Status</th>
					</thead>
					<tbody>
					<?
					$intpage = 20;
					if (isset($_GET['page'])) {
						$rsnum = (intval($_GET['page']) -1)*$intpage;
					}else{
						$rsnum = 0;
					}
					if($_GET["id"]){
						$sql="Select * from {$web_dbtop}exchange where uid=".intval($_GET["id"])." Order by id desc";
					}else{
						$sql="Select * from {$web_dbtop}exchange Order by id desc";
					}
					$query=$db->query($sql);
					if($db->fetch_array($query)) 
						$intnum=$db->num_rows($query);
					$query=$db->query($sql." limit $rsnum,$intpage");
					while($rs=$db->fetch_array($query)){
					?>
					<tr>
						<td><A href="user.php?id=<?=$rs["uid"]?>" target="_blank"><?=$rs["uid"]?><?=(showcontent("users","vip",$rs["uid"])==1?"":"")?></A></td>
						<td><A href="prizes_content.php?id=<?=$rs["commoditiesid"]?>"><?=showcontent("commodities","name",$rs["commoditiesid"])?></A></td>
						<td><?=number_format($rs["points"])?></td>
						<td><?=date("M d, Y",strtotime($rs["time"]))?></td>
						<td><?=($rs["mode"]==1?"processed":"to be confirmed")?></td>
					</tr>
					<?
					}
					?>
					</tbody>
					</table>
					<div class="area690-b h5px"></div>	
					<div class="pages" style="text-align:center;">
					<?php
					include_once("inc/page_class.php");
					$page=new page(array('total'=>$intnum,'perpage'=>$intpage));
					echo $page->show(5,"","");?>
					</div>
		</div>
		<!--主体左边 End-->
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
	</DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>