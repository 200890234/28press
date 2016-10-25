<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();

$query=$db->query("Select id,kj,tzpoints,zjrnum from {$web_dbtop}game28 where id=".intval($_GET["luckno"]));
if($rs=$db->fetch_array($query)){
	$kgqh=$rs["id"];
	$kj=$rs["kj"];
	$tzpoints=$rs["tzpoints"];
	$zjrnum=$rs["zjrnum"];
}
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
			<LI><A href="luck.php">Luck28 home</A></LI>
			<LI><A href="luckhelp.php">Luck28 guide</A></LI>
			<LI class="current"><A href="luckmylist.php">My press history</A></LI>
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
                  <td background="images/game2_04.jpg" class="font14">
				  Draw# <span class="STYLE1">
                    <?=$kgqh?>
                    </span> &nbsp;&nbsp;&nbsp;  total <?=$web_moneyname?><font color="red"> : 
                    <?=number_format($tzpoints);?>
                    </font>　 total winners: <font color="red">
                    <?=$zjrnum?>
                  </font><font color="red"></font></td>
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
                        <td width="160" height="28" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF"  class="wf">Draw#</td>
                        <td width="130" height="28" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF"  class="wf">Pressed time</td>
                        <td width="140" height="28" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF"  class="wf">Number list</td>
                        <td width="140" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF"  class="wf">your pressed amount</td>
                        <td align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">Status</td>
                        <td align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">Gained <?=$web_moneyname?></td>
                      </tr>
					<?
					if($kj==1){
						$query=$db->query("Select * from {$web_dbtop}game28_users_tz where NO=".$kgqh." and uid=".intval($_COOKIE["usersid"])." Order by tznum asc");
						if($rs=$db->fetch_array($query)){
						
							//print_r($rs["tznum"]);
						
							$tznum_array=explode("|",$rs["tznum"]);
							$tzpoints_array=explode("|",$rs["tzpoints"]);
							$zjpoints_array=explode("|",$rs["zjpoints"]);
							for($i = 0; $i < count($tznum_array); $i++){
					?>
						<tr>
							<td height="32" align="center" bgcolor="#FCF5E1" class="font12game"><?=$rs["NO"]?></td>
							<td align="center" bgcolor="#FFFFFF" class="font12game"><?=date("M d H:i:s",strtotime($rs["time"]))?></td>
							<td align="center" bgcolor="#FFFFFF" class="font12game"><img src="images/luck/number_<?=$tznum_array[$i]?>.gif" /></td>
							<td align="center" bgcolor="#FFFFFF" class="font-red font12game"><?=number_format($tzpoints_array[$i])?><img src="<?=$web_moneypic?>" /></td>
							<td align="center" bgcolor="#FFFFFF">completed</td>
							<td align="center" bgcolor="#FFFFFF" class="font12game"><? if($zjpoints_array[$i]>0){echo"<font class=\"rf\">".number_format($zjpoints_array[$i])."</font><img src=\"".$web_moneypic."\" />";}else{echo"0";}?></td>
						  </tr>
					<?
							}
						}
					}else{
						$query=$db->query("Select * from {$web_dbtop}game28_kg_users_tz where NO=".$kgqh." and uid=".intval($_COOKIE["usersid"])." Order by tznum asc");
						while($rs=$db->fetch_array($query)){
					?>
						  <tr>
							<td height="32" align="center" bgcolor="#FCF5E1" class="font12game"><?=$rs["NO"]?></td>
							<td align="center" bgcolor="#FFFFFF" class="font12game"><?=$rs["time"]?></td>
							<td align="center" bgcolor="#FFFFFF" class="font12game"><img src="images/luck/number_<?=$rs["tznum"]?>.gif" /></td>
							<td align="center" bgcolor="#FFFFFF" class="font-red font12game"><?=number_format($rs["tzpoints"])?><img src="<?=$web_moneypic?>" /></td>
							<td align="center" bgcolor="#FFFFFF">under way</td>
							<td align="center" bgcolor="#FFFFFF" class="font12game"><? if($rs["hdpoints"]>0){echo"<font class=\"rf\">".number_format($rs["hdpoints"])."</font><img src=\"".$web_moneypic."\" />";}else{echo"0";}?></td>
						  </tr>
                    <?
					  	}
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