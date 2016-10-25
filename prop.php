<?php
include_once("inc/conn.php");
include_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>道具中心-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(6);
document.getElementById("qh_con6").getElementsByTagName('li')[0].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
		<DIV class="webgame-prop-title"></DIV>
		<DIV class="webgame-prop-tabs">
		  <DL>
		  	<?
			$query=$db->query("Select * from {$web_dbtop}cardtype where `show`=1 Order by id desc");
			while($rs=$db->fetch_array($query)){
			?>
			<DD class="webgame-propC"><A class="webgame-propC-l" title="<?=$rs["cardname"]?>"L href="<?=$rs["shopurl"]?>" target=_blank><IMG height=80 src="<?=$web_dir.$web_carddir.$rs["cardpic"]?>" width=110><SPAN><?=$rs["cardname"]?></SPAN></A>
				<UL class="webgame-propC-r">
				  <LI><?=$web_moneyname?>：<SPAN class="cRed"><?=$rs["uapoints"]?></SPAN></LI>
				  <LI>经验：<SPAN class="cRed"><?=$rs["uaexperience"]?></SPAN></LI>
				  <LI>每日<?=$web_moneyname?>：<?=$rs["udapoints"]?> 每日经验：<?=$rs["udaexperience"]?></LI>
				  <LI>VIP：<?=($rs["uevip"]==1?"√":"×")?></LI>
				  <LI>靓号选择：<?=($rs["ueid"]==1?"√":"×")?></LI>
				  <LI><A class="btn-g-kf1" title="<?=$rs["cardname"]?>" href="<?=$rs["shopurl"]?>" target=_blank><?=$rs["cardname"]?></A></LI>
				</UL>
			</DD>
			<?
			}
			?>
		  </DL>
    	</DIV>
		<div class="area960-b h5px"></div>
	</div>
	<div class="blank10"></div>
	<DIV class="page_content">
		<DIV class="webgame-prop2-title"></DIV>
		<UL class="webgame-prop2">
			<?
			$query=$db->query("Select name,url,pic from {$web_dbtop}business where tj=1 Order by id desc");
			while($rs=$db->fetch_array($query)){
			?>
			<LI><A title="<?=$rs["name"]?>" href="<?=$rs["url"];?>" target="_blank"><IMG alt="<?=$rs["name"]?>" src="<?=$web_dir.$web_businessdir.$rs["pic"]?>"><SPAN class="bb"><?=$rs["name"]?></SPAN></A></LI>
			<?
			}
			?>
		</UL>
		<div class="area960-b h5px"></div>
	</div>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>