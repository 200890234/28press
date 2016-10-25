<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Memer area-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(3);
document.getElementById("qh_con3").getElementsByTagName('li')[2].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
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
		<!--主体左边 Start-->
		<div class="area690 fr">
			<DIV class="users-title">
				 <H3>My Promotional Revenue</H3>
			</DIV>
        	<div class="users-content">
        		<ul class="bgk">
					<li class="b5c">account ID</li>
					<li class="b5c">event</li>
					<li class="b5c">regdate</li>
					<li class="b5c">date</li>
					<li class="b05c">bonus (<?=$web_moneyname?>)</li>
					<?php
					$intpage = 14;
					if (isset($_GET['page'])) {
						$rsnum = (intval($_GET['page']) -1)*$intpage;
					}
					else {
						$rsnum = 0;
					}
					$sql="Select * from {$web_dbtop}tjlog where uid=".intval($_COOKIE["usersid"])." Order by id desc";
					$query=$db->query($sql);
					if($db->fetch_array($query)) 
						$intnum=$db->num_rows($query);
					$query=$db->query($sql." limit $rsnum,$intpage");
					while($rs=$db->fetch_array($query)){
						echo"<li class=\"b5\">".$rs["xid"]."</li>";
						echo"<li class=\"b5\">".$rs["type"]."</li>";
						echo"<li class=\"b5\">".date("M d, Y",$rs["regtime"])."</li>";
						echo"<li class=\"b5\">".date("M d, Y",$rs["time"])."</li>";
						echo"<li class=\"b05\">".number_format($rs["points"])."<img src=\"".$web_moneypic."\" align=\"absmiddle\" /></li>";
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
</DIV>