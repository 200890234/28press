<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();

$query=$db->query("Select * from {$web_dbtop}game16_auto where uid=".intval($_COOKIE["usersid"])." Order by id desc");
if($rs=$db->fetch_array($query)){
	$id=$rs["id"];
	$startNO=$rs["startNO"];
	$endNO=$rs["endNO"];
	$minG=$rs["minG"];
	$maxG=$rs["maxG"];
	$autoid=$rs["autoid"];
}else{
	echo "<script language=javascript>alert('对不起，您是不是进错地方了！');location.href='happy.php';</script>";
	exit;
}
$query=$db->query("Select * from {$web_dbtop}game16_auto_tz where id=".$autoid." Order by id asc");
if($rs=$db->fetch_array($query)){
	$tzname=$rs["tzname"];
	$tzunm=explode("|",$rs["tzunm"]);
	$tzpoints=$rs["tzpoints"];
}

if($_GET["act"] =="endStart"){
	$db->query("delete from {$web_dbtop}game16_auto where id=".$id);
	echo "<script language=javascript>alert('Autopress cancelled');location.href='happyautoset.php';</script>";
	exit;
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
			<LI><A href="happymylist.php">My press history</A></LI>
			<LI><A href="happymodel.php">Edit press pattern</A></LI>
			<LI class="current"><A href="happyautoset.php">Autopress</A></LI>
			<LI><A href="happydirection.php">Trend chart</A></LI>
		  </UL>
		</DIV>
		<DIV class="webgame-info">
			<DIV class="webgame-info-tabs">
			  <table width="100%" height="27" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="12"><img src="images/game2_03.jpg" width="12" height="27" /></td>
                  <td background="images/game2_04.jpg">Autopress options：</td>
                  <td width="13"><img src="images/game2_06.jpg" width="13" height="27" /></td>
                </tr>
              </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5"></td>
                </tr>
              </table>
			  <form action="?act=endStart" method="post">
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td bgcolor="#9F4F18"><table width="100%" border="0" cellpadding="0" cellspacing="1">
                        <tr>
                          <td colspan="4" bgcolor="#FFFFFF" class="font12">&nbsp;&nbsp;From Draw#<font class="rbf">
                            <?=$startNO?>
                            </font> to <font class="rbf">Draw#
                            <?=$endNO?>
                            </font><br />
&nbsp;&nbsp;Auto terminate when <?=$web_moneyname?> < <font class="rbf">
              <?=$minG?>
              </font> or <?=$web_moneyname?> > <font class="rbf">
              <?=$maxG?>
              </font><br />
&nbsp;&nbsp;Current pattern:<font class="rbf"><?=$tzname?></font>，<font class="rbf"><?=$tzpoints?></font> <?=$web_moneyname?> per draw</td>
                        </tr>
                        <tr>
                          <td width="50%" height="28" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">Number list</td>
                          <td align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">Amount</td>
                        </tr>
                        <?
					for($i = 0; $i < count($tzunm); $i ++){
					?>
                        <tr>
                          <td height="32" align="center" bgcolor="#FCF5E1"><img src="images/happy/number_<?=$i+3?>.gif" /></td>
                          <td align="center" bgcolor="#FFFFFF"><?=$tzunm[$i]?>
                              <img src="<?=$web_moneypic?>" /></td>
                        </tr>
                        <?
					 }
					 ?>
                        <tr>
                          <td height="40" colspan="4" align="center" bgcolor="#FFFFFF"><input type="submit" id="btnSubmit" name="btnCancel" class="btnCancelInvest pointer" value=" " /></td>
                        </tr>
                    </table></td>
                  </tr>
                </table>
		      </form>
		  </DIV>
			<DIV class=cl></DIV>
		</DIV>
		<DIV class="area960-b h5px"></DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>