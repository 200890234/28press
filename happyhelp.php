<?php
include_once("inc/conn.php");
include_once("inc/function.php");
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
<style type="text/css">
table{color:#C8F139;}
.font14{color:#666666;}
.webgame-info-tabs p{color:#C8F139;margin:10px;font-size:16px;}
</style>
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
			<LI class="current"><A href="happyhelp.php">Luck16 guide</A></LI>
			<LI><A href="happymylist.php">My press history</A></LI>
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
                  <td background="images/game2_04.jpg" class="font14">Rules of Luck16：</td>
                  <td width="13"><img src="images/game2_06.jpg" width="13" height="27" /></td>
                </tr>
              </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5"></td>
                </tr>
              </table>
			  <TABLE cellSpacing=5 cellPadding=5 width="100%" align=center border=0>
                <TBODY>
                  <TR>
                    <TD class=font12>
					<p>Luck16 is another exciting lottery game that is very similiar to Luck28. The winning number is sum of 3 digits, each of which is randomly generated between 1 and 6. Numbers may be repeated. The winning number ranges from 3 to 18. A total of 16 possible sums. The digits of the number 111 sum up to 3, and those of 666 sum up to 18, the rest lie in between. For each draw, 98% of the total pressed PRs is allocated as prize money. For more information, Please refer to <a href="luckhelp.php" style="color:#FF6308;">Luck28 Guide</a>
					</p>
					<p>The following table is a list of all the 16 possible sums and the corresponding standard odds.</p>
					<p align="center"><img src="images/helppic/l6table.jpg"></p>
					</TD>
                  </TR>
                </TBODY>
              </TABLE>
			</DIV>
			<DIV class=cl></DIV>
		</DIV>
		<DIV class="area960-b h5px"></DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>