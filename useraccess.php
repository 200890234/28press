<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();

if($_GET["act"]=="access"){
	$tbAccessG=intval($_POST["tbAccessG"]);
	if(empty($tbAccessG)){
		echo "<script language=javascript>alert('你是想被注销号吧？？？？？？？');history.go(-1);</script>";
		exit;
	}
	if($tbAccessG<0){
		echo "<script language=javascript>alert('你是想被注销号吧？？？？？？？');history.go(-1);</script>";
		exit;
	}
	ck_secans(str_check($_POST["tbUserSecAns"]));
	if($_POST["tbAccessType"]==1){
		$query_f=$db->query("Select points From {$web_dbtop}users where id=" .intval($_COOKIE["usersid"]). " And password='" .str_check($_COOKIE["password"]). "'");
		if($rs_f=$db->fetch_array($query_f)){
			if($rs_f["points"]>=$tbAccessG){
				$db->query("update {$web_dbtop}users set points=points-$tbAccessG,back=back+$tbAccessG where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
				backlog($tbAccessG,$_POST["tbAccessType"]);
				userslog(4,"bank operation".$web_moneyname,-$tbAccessG,0);
			}else{
				echo "<script language=javascript>alert('sorry，you donot have enough ".$web_moneyname."');history.go(-1);</script>";
			}
		}
	}else{
		$query_f=$db->query("Select back From {$web_dbtop}users where id=" .intval($_COOKIE["usersid"]). " And password='" .str_check($_COOKIE["password"]). "'");
		if($rs_f=$db->fetch_array($query_f)){
			if($rs_f["back"]>=$tbAccessG){
				$db->query("update {$web_dbtop}users set points=points+$tbAccessG,back=back-$tbAccessG where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
				backlog($tbAccessG,$_POST["tbAccessType"]);
				userslog(4,"bank operation".$web_moneyname,$tbAccessG,0);
			}else{
				echo "<script language=javascript>alert('sorry,you do not have enough ".$web_moneyname."');history.go(-1);</script>";
			}
		}
	}
	echo "<script language=javascript>alert('success');location.href='useraccess.php';</script>";
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Member area-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(7);
document.getElementById("qh_con7").getElementsByTagName('li')[2].className="current";
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
				 <H3><?=$web_moneyname?> Bank</H3>
			</DIV>
        	<div class="users-content" style="padding-left:15px;;">
        		<ul class="bgk">
					<?
					$query=$db->query("Select * From {$web_dbtop}users where id=".intval($_COOKIE["usersid"])." and password='".str_check($_COOKIE["password"])."'");
					if($rs=$db->fetch_array($query)){
					?>
					<form action="?act=access" method="post">
					<li class="bb21">Your total <?=$web_moneyname?>：<?=number_format($rs["points"]+$rs["back"]);?><img src="<?=$web_moneypic?>" width="10" height="10" border="0" /></li>
					<li class="bb21"><?=$web_moneyname?> In Bank：<?=number_format($rs["back"]);?><img src="<?=$web_moneypic?>" width="10" height="10" border="0" /> &nbsp;&nbsp;<?=$web_moneyname?> Available：<?=number_format($rs["points"]);?><img src="<?=$web_moneypic?>" width="10" height="10" border="0" /></li>
					
					<li class="b21"><span style="padding-left:41px">Action：</span></li>
					<li class="b22"><span style="padding-left:5px">
						  <select name="tbAccessType" id="tbAccessType">
							<option value="1">depoist <?=$web_moneyname?></option>
							<option value="2">withdraw <?=$web_moneyname?></option>
						  </select></span></li>
					<li class="b21"><span style="padding-left:41px">Amount：</span></li>
					<li class="b22"><span style="padding-left:5px"><input class="bk" name="tbAccessG" type="text" id="tbAccessG" value="" size="25" /></span></li>
					<li class="b21"><span style="padding-left:5px">Security question：</span></li>
					<li class="b22"><span style="padding-left:5px"><?=$rs["secques"];?></span></li>
					<li class="b21"><span style="padding-left:5px">Your answer：</span></li>
					<li class="b22"><span style="padding-left:5px"><input class="bk" name="tbUserSecAns" type="text" id="tbUserSecAns" value="" size="25" /></span></li>
					<li class="tj" style="MARGIN-BOTTOM: 1px;"><input id="btnSubmit" type="image" src="images/an_ljtj_03.gif"  border="0" /></li>
					</form>
					<?
					}
					?>
					<!--<form action="?" method="get">
					<input name="act" type="hidden" value="search">
					<li class="b33" style="MARGIN-BOTTOM: 1px;"></li>
					<li class="b31" style="MARGIN-BOTTOM: 1px;">
						<div class="l151">
							<ul>
								<li><input name="m" type="radio" value="2" <? //if($_GET["m"]==2 || empty($_GET["m"])) echo"checked";?> />
								全部<input name="m" type="radio" value="1" <? //if($_GET["m"]==1) echo"checked";?> />
								存入<?//=$web_moneyname?><input name="m" type="radio" value="0" <? //if($_GET["m"]==0 && isset($_GET["m"])) echo"checked";?> />取出<?//=$web_moneyname?><br />
								时间<input name="sd" type="text" size="12" maxlength="10"  onfocus=setday(this)  value="<?//=(empty($_GET["sd"])?date("Y-m-").(date("d")-1):$_GET["sd"]);?>" />至<input name="ed" type="text" size="12" maxlength="10" onfocus=setday(this) readOnly value="<?//=(empty($_GET["ed"])?date("Y-m-d"):$_GET["ed"]);?>" />
								</li>
							</ul>
						</div>
					</li>
					<li class="b32" style="MARGIN-BOTTOM: 1px;"><input type="image" src="images/an_cx_03.gif" /></li>
					</form>
					-->
					<li class="b180c">Date and Time</li>
					<li class="b150c">Action</li>
					<li class="b42c">Amount </li>
					<li class="b42c"><!--影响银行 --></li>
						<?php
						$intpage = 14;
						if (isset($_GET['page'])) {
							$rsnum = (intval($_GET['page']) -1)*$intpage;
						}
						else {
							$rsnum = 0;
						}
						$sql="Select * from {$web_dbtop}backlog where usersid=".intval($_COOKIE["usersid"])."";
						if($_GET["act"]=="search"){
							$sql.=" and (STR_TO_DATE(time,'%Y-%m-%d') between '".str_check($_GET["sd"])."' and '".str_check($_GET["ed"])."')";
						}
						if(isset($_GET["m"])){
							if($_GET["m"]==0){
								$sql.=" and log='withdraw'";
							}else if($_GET["m"]==1){
								$sql.=" and log='deposit'";
							}
						}
						$sql.=" Order by id desc";
						$query=$db->query($sql);
						if($db->fetch_array($query)) 
							$intnum=$db->num_rows($query);
						$query=$db->query($sql." limit $rsnum,$intpage");
						while($rs=$db->fetch_array($query)){
							echo"<li class=\"b180\">".date("M d, Y",strtotime($rs["time"]))."</li>";
							echo"<li class=\"b150\">".$rs["log"]."</li>";
							echo"<li class=\"b42\">".number_format($rs["points"])."<img src=\"".$web_moneypic."\" align=\"absmiddle\" /></li>";
							//echo"<li class=\"b42\">".number_format($rs["back"])."<img src=\"".$web_moneypic."\" align=\"absmiddle\" /></li>";
							echo"<li class=\"b42\"></li>";
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