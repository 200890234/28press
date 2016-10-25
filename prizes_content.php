<?php
include_once("inc/conn.php");
include_once("inc/function.php");

if(isset($_POST["btnComment"])){
	if(!$_POST["tbCommentContent"]){
		echo "<script language=javascript>alert('sorry,please enter the comment');history.go(-1);</script>";
		exit;
	}
	$commentscontent=str_check(delkey($_POST["tbCommentContent"]));
	$db->query("INSERT INTO {$web_dbtop}comments (commentsusers,commentscontent,commentstime,commoditiesid) VALUES ('".intval($_COOKIE["usersid"])."','".$commentscontent."','".date("Y-m-d")."',".intval($_GET["id"]).")");
	echo "<script language=javascript>alert('operation success!');location.href='prizes_content.php?id=".intval($_GET['id'])."';</script>";
	exit;
}
$db->query("update {$web_dbtop}commodities set hits=hits+1 where id=".intval($_GET['id']));
$query=$db->query("Select * from {$web_dbtop}commodities where id =".intval($_GET['id']));
if($rs=$db->fetch_array($query)){
	$id=$rs["id"];
	$name=$rs["name"];
	$pic=$rs["pic"];
	$points=$rs["points"];
	$discount=$rs["discount"];
	$shoptype=$rs["shoptype"];
	$convertnum=$rs["convertnum"];
	$content=$rs["content"];
	$hits=$rs["hits"];
	$discountpoints=$points;
}
if($discount==1){
	$query=$db->query("Select maxexperience,vip From {$web_dbtop}users where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
	if($rs=$db->fetch_array($query)){
		$maxexperience=$rs["maxexperience"];
		$vip=$rs["vip"];
	}
	if(isset($maxexperience)){
		$query=$db->query("Select kinddiscount,virtualdiscount,vipkinddiscount,vipvirtualdiscount from {$web_dbtop}usergroups where creditshigher<=$maxexperience and creditslower>=$maxexperience Order by id desc");
		if($rs=$db->fetch_array($query)){
			if($shoptype==1){
				if($vip==1){
					if($rs["vipkinddiscount"]!=0){
						$discountpoints=$points*$rs["vipkinddiscount"]/10;
					}
				}else{
					if($rs["virtualdiscount"]!=0){
						$discountpoints=$points*$rs["virtualdiscount"]/10;
					}
				}
			}else{
				if($vip==1){
					$discountpoints=$points-$rs["vipvirtualdiscount"];
				}else{
					$discountpoints=$points-$rs["virtualdiscount"];
				}
			}
		}
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$name?>-prizes-<?=$web_name;?></title>
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
		<DIV class="news-search">
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
			<div class="webgame-title1"><h3>Prize Detail</h3></div>
			<div class="area690-info">
				<div class="yxxx">
					<div class="btn_hd_l">
						 <a href='<?=$web_dir.$web_picdir.$pic?>' target='_blank'><img src="<?=$web_dir.$web_picdir.$pic?>" border="0"/></a>
					</div>
					<ul style="font-size:14px;line-height:35px;"> 		
						<li>Title：<?=$name;?></li>
						<li>Serial Number：<?=$id;?></li>
						<li>Hits：<?=$hits;?></li>
						<li>Price：<?=number_format($points);?></li>
						<li class="rf">Discount：<?=number_format($discountpoints);?></li>
						<!--<li>兑出数量：<?//=$convertnum?></li>-->
						<li><A href="prizes_exchange.php?id=<?=$id?>"><img src="images/btn_ggame_reg.gif"></a></li>
					</ul>
				</div>
			</div>
			<div class="area690-b h5px"></div>
			<div class="blank10"></div>
			<div class="webgame-title1"><h3>Desciption</h3>
			</div>
			<div class="area690-info yxjs" style="padding-left:30px;"><?=$content;?></div>
			<div class="area690-b h5px"></div>
			<div class="blank10"></div>
			<!--评论-->
			  <div class="webgame-title1"><h3>Comments</h3></div>
			  <DIV class=area690-info style="padding-left:20px;">
				  <DIV id=div_comment>
					<?
					$intpage = 5;
					if (isset($_GET['page'])) {
						$rsnum = (intval($_GET['page']) -1)*$intpage;
					}else{
						$rsnum = 0;
					}
					$sql="Select * from {$web_dbtop}comments where commoditiesid=".intval($_GET["id"])." Order by id desc";
					$query=$db->query($sql);
					if($db->fetch_array($query)) 
						$intnum=$db->num_rows($query);
					$query=$db->query($sql." limit $rsnum,$intpage");
					while($rs=$db->fetch_array($query)){
					?>
					<DL class="comment">
					  <DT><SPAN style="VERTICAL-ALIGN: bottom; margin-left:10px;color:#C8F139;font-size:14px;"> User:<?=$rs["commentsusers"]?> </SPAN><EM style="VERTICAL-ALIGN: bottom;color:#C8F139;">Time:<?=$rs["commentstime"]?></EM></DT>
					  <DD style="color:#CAD57F;"><?=$rs["commentscontent"]?></DD>
					</DL>
					<?
					}
					?>
				  </DIV>
				  <DIV class=pages>
					<DIV class=pagelistbox><?php
								  include_once("inc/page_class.php");
								  $page=new page(array('total'=>$intnum,'perpage'=>$intpage));
								  echo $page->show(6,"","");?></DIV>
				  </DIV>
				  <? if(isset($_COOKIE["usersid"])){?>
				  <form action="?id=<?=$id;?>" method="post">
				  <DIV class=comment_pt style="color:white;">Post a comment<!--<SPAN class=font06>（评论内容:请文明参与评论，禁止谩骂攻击！）</SPAN> <SPAN id=ajaxBackMsg>不能超过250字节,请自觉遵守互联网相关政策法规.</SPAN>--> </DIV>
				  <div align="right">
				    <TEXTAREA class="cm_textarea" id="tbCommentContent" name="tbCommentContent"></TEXTAREA>
		          </div>
				  <DIV align="right" style="margin-top:5px;">
					<input class="btnsent pointer" name="btnComment" value="" type="submit">
				  </DIV>
				  </form>
				<?
				}
				?>
			  </DIV>
			  <DIV class="area690-b h5px"></DIV>
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