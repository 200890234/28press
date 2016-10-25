<?php
include_once("inc/conn.php");
include_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>luck28-game area-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(2);
document.getElementById("qh_con2").getElementsByTagName('li')[0].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
		<DIV class="webgame-info-title">
		  <UL>
			<LI class="current"><A href="luck.php">Luck28 home</A></LI>
			<LI><A href="luckhelp.php">Luck28 guide</A></LI>
			<LI><A href="luckmylist.php">My press history</A></LI>
			<LI><A href="luckmodel.php">Edit press pattern</A></LI>
			<LI><A href="luckautoset.php">Autopress</A></LI>
			<LI><A href="luckdirection.php">Trend chart</A></LI>
		  </UL>
		</DIV>
		<DIV class="webgame-info">
			<DIV class="webgame-info-tabs">
			  <table width="100%" height="27" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="12"><img src="images/game2_03.jpg" width="12" height="27" /></td>
                  <td background="images/game2_04.jpg" class="font14">Winners of Draw# <?=$_GET["luckno"]?> :</td>
                  <td width="13"><img src="images/game2_06.jpg" width="13" height="27" /></td>
                </tr>
              </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5"></td>
                </tr>
              </table>
			  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td bgcolor="#248301"><table width="100%" border="0" cellpadding="0" cellspacing="1">
                      <tr>
                        <td height="28" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">user</td>
                        <td align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">pressed (<?=$web_moneyname?>)</td>
                        <td align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">gained(<?=$web_moneyname?>)</td>
                      </tr>
                      <?php
				$intpage = 30;
				if (isset($_GET['page'])) {
					$rsnum = (intval($_GET['page']) -1)*$intpage;
				}
				else {
					$rsnum = 0;
				}
				$sql="Select points,hdpoints,uid from {$web_dbtop}game28_users_tz where NO=".intval($_GET["luckno"])." and hdpoints>0 Order by hdpoints desc";
				$query=$db->query($sql);
				if($db->fetch_array($query)) 
					$intnum=$db->num_rows($query);
				$query=$db->query($sql." limit $rsnum,$intpage");
				while($rs=$db->fetch_array($query)){
					$query_f=$db->query("Select vip,maxexperience from {$web_dbtop}users where id=".$rs["uid"]);
					if($rs_f=$db->fetch_array($query_f)){
						$vip=$rs_f["vip"];
						$maxexperience=$rs_f["maxexperience"];
					}
				?>
                      <tr>
                        <td height="32" align="center" bgcolor="#E6F7E0" class="font12game"><a href="user.php?id=<?=$rs["uid"]?>" style="color:green;"><?=$rs["uid"]?></a><?// if($vip){?><!--<img src="images/vip.gif" />--><? //}?>&nbsp;<? showstars(userslive($maxexperience));?></td>
                        <td align="center" bgcolor="#FFFFFF" class="font12game"><?=number_format($rs["points"])?>
                            <img src="<?=$web_moneypic?>" /></td>
                        <td align="center" bgcolor="#FFFFFF" class="font-red font12game"><?=number_format($rs["hdpoints"])?>
                            <img src="<?=$web_moneypic?>" /></td>
                      </tr>
                      <?
				} 
				?>
                  </table></td>
                </tr>
              </table>
			  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="4">
                <tr>
                  <td align="center"><?php
		  include_once("inc/page_class.php");
		  $page=new page(array('total'=>$intnum,'perpage'=>$intpage));
		  echo $page->show(5,"","");?></td>
                </tr>
              </table>
			</DIV>
			<DIV class=cl></DIV>
		</DIV>
		<DIV class="area960-b h5px"></DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>