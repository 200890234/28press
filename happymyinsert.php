<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();

$query=$db->query("Select id,kgtime,tzpoints,tznum,zjpl from {$web_dbtop}game16 where id=".intval($_GET["happyno"]));
if($rs=$db->fetch_array($query)){
	$kgqh=$rs["id"];
	$kgtime=$rs["kgtime"];
	$tzpoints=$rs["tzpoints"];
	$tznum=$rs["tznum"];
	$zjpl=$rs["zjpl"];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Luck16-Games Center-<?=$web_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="keywords" content="<?=$web_keywords;?>" />
<meta name="description" content="<?=$web_description;?>" />
<META http-equiv=X-UA-Compatible content=IE=EmulateIE7>
<link href="style/default.css" rel="stylesheet" type="text/css" />
</head>
<?php include_once("top.php");?>
<script language="javascript">
qiehuan(2);
document.getElementById("qh_con2").getElementsByTagName('li')[2].className="current";
</script>
<DIV class="wrapper">
	<DIV class="page_content">
		<DIV class="webgame-info-title">
		  <UL>
			<LI><A href="happy.php">Luck16 home</A></LI>
			<LI><A href="happyhelp.php">Luck16 guide</A></LI>
			<LI class="current"><A href="happymylist.php">My press history</A></LI>
			<LI><A href="happymodel.php">Edit press pattern</A></LI>
			<LI><A href="happyautoset.php">Autopress</A></LI>
			<LI><A href="happydirection.php">Trend chart</A></LI>
		  </UL>
		</DIV>
		<DIV class="webgame-info">
			<DIV class="webgame-info-tabs">		  
			  <table width="100%" height="27" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="12"><img src="images/game2_03.jpg" width="12" height="27" /></td>
                  <td background="images/game2_04.jpg" class="font14">Draw#
                      <?=$kgqh?>
                         total <?=$web_moneyname?>:<font color="red">
                      <?=number_format($tzpoints)?>
                      </font>　
					  <!--总投注数:<font color="red">
                      <?=$tznum?>
                      注</font>-->
					  </td>
                  <td width="269" align="right" background="images/game2_04.jpg" class="font14">Time:
                      <?=$kgtime?></td>
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
                  <td bgcolor="#9F4F18"><table width="100%" border="0" cellpadding="0" cellspacing="1">
                      <tr>
                        <td width="250" height="28" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF"  class="font-white">pressed number</td>
                        <td width="250" height="28" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF"  class="font-white">odds</td>
                        <td align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF"  class="font-white">pressed amount</td>
                      </tr>
                      <?
						$zjplsz=explode("|",$zjpl);
						$query=$db->query("Select tznum,tzpoints from {$web_dbtop}game16_users_tz where NO=".intval($_GET["happyno"])." and uid=".intval($_COOKIE["usersid"])." Order by id desc");
						if($rs=$db->fetch_array($query)){
							$tznum=explode("|",$rs["tznum"]);
							$tzpoints_array=explode("|",$rs["tzpoints"]);
						}
						for($i = 0; $i < 16; $i ++){
							$tzpoints=0;
							for($y = 0; $y < count($tznum); $y++){
								if($tznum[$y]==($i+3)){
									$tzpoints=$tzpoints_array[$y];
								}
							}
					?>
                      <tr>
                        <td height="32" align="center" bgcolor="#FCF5E1" class="font-red font12game"><img src="images/happy/number_<?=$i+3?>.gif" /></td>
                        <td align="center" bgcolor="#FFFFFF" class="font12game"><?=$zjplsz[$i]?></td>
                        <td align="center" bgcolor="#FFFFFF" class="font12game"><?=number_format($tzpoints);?>
                            <img src="<?=$web_moneypic?>" /></td>
                      </tr>
                      <?
				  }
				  ?>
                  </table></td>
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