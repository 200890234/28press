<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();

$query=$db->query("Select id from {$web_dbtop}game28 where kj=0 Order by id asc");
if($rs=$db->fetch_array($query)){
	$kgqh=$rs["id"];
}

$query=$db->query("Select id from {$web_dbtop}game28_auto where uid=".intval($_COOKIE["usersid"])." Order by id desc");
if($rs=$db->fetch_array($query)){
	echo "<script language=javascript>location.href='luckautodetail.php';</script>";
	exit;
}

if($_GET["act"] =="autostart"){
//echo "<script language=javascript>alert(".$_POST['tbID'].");location.href='luckautoset.php';</script>";
	if(!$_POST["tbStartNO"] || !$_POST["tbEndNO"]){
		echo "<script language=javascript>alert('all fields are required');location.href='luckautoset.php';</script>";
		exit;
	}
	if(!is_numeric($_POST["tbStartNO"]) || !is_numeric($_POST["tbEndNO"]) || !is_numeric($_POST["tbMinG"]) || !is_numeric($_POST["tbMaxG"])){
		echo "<script language=javascript>alert('invalid string format');location.href='luckautoset.php';</script>";
		exit;
	}
	if(!$_POST["tbID"]){
		echo "<script language=javascript>alert(\"sorry, you haven't create any pattern yet.\");location.href='luckautoset.php';</script>";
		exit;
	}
	if($_POST["tbStartNO"]<($kgqh+1)){
		echo "<script language=javascript>alert(\"sorry,the start draw must be greater than the current one\");location.href='luckautoset.php';</script>";
		exit;
	}
	if($_POST["tbStartNO"]>$_POST["tbEndNO"]){
		echo "<script language=javascript>alert(\"make sure the end draw is greater than the start draw\");location.href='luckautoset.php';</script>";
		exit;
	}
	if(($_POST["tbEndNO"]-$_POST["tbStartNO"])>99999){
		echo "<script language=javascript>alert(\"sorry, the total draws is no more than 99999.\");location.href='luckautoset.php';</script>";
		exit;
	}
	if($_POST["tbMinG"]<0){
		echo "<script language=javascript>alert('sorry,please check your minimum balance');location.href='luckautoset.php';</script>";
		exit;
	}
	if($_POST["tbMaxG"]<0){
		echo "<script language=javascript>alert(\"sorry,please check your maximum balance\");location.href='luckautoset.php';</script>";
		exit;
	}
	if($_POST["tbMaxG"]-$_POST["tbMinG"]<0){
		echo "<script language=javascript>alert(\"maximum balance should be greater that minimum balance\");location.href='luckautoset.php';</script>";
		exit;
	}
	
	$db->query("INSERT INTO {$web_dbtop}game28_auto (startNO,endNO,minG,maxG,autoid,uid) VALUES (".intval($_POST["tbStartNO"]).",".intval($_POST["tbEndNO"]).",".intval($_POST["tbMinG"]).",".intval($_POST["tbMaxG"]).",".intval($_POST["tbID"]).",".intval($_COOKIE["usersid"]).")");
	for($i = 0; $i < count($_POST["sID"]); $i ++){
		$db->query("update {$web_dbtop}game28_auto_tz set winid=".intval($_POST["sWinModel"][$i]).",lossid=".intval($_POST["sLossModel"][$i])." where id =".intval($_POST["sID"][$i]));
	}
	echo "<script language=javascript>alert('autopress setting success');location.href='luckautodetail.php';</script>";
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>luck28-game center-<?=$web_name;?></title>
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
			<LI><A href="luckmylist.php">My press history</A></LI>
			<LI><A href="luckmodel.php">Edit press pattern</A></LI>
			<LI class="current"><A href="luckautoset.php">Autopress</A></LI>
			<LI><A href="luckdirection.php">Trend chart</A></LI>
		  </UL>
		</DIV>
		<DIV class="webgame-info">
			<DIV class="webgame-info-tabs">
			  <table width="100%" height="27" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="12"><img src="images/game2_03.jpg" width="12" height="27" /></td>
              <td background="images/game2_04.jpg" class="font14">Autopress settings:</td>
              <td width="13"><img src="images/game2_06.jpg" width="13" height="27" /></td>
            </tr>
          </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5"></td>
              </tr>
            </table>
			<form action="?act=autostart" method="post" onsubmit="return ChkSetAuto()">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td bgcolor="#248301"><table width="100%" border="0" align="center" cellpadding="4" cellspacing="1">
                  <tr>
                    <td width="25%" height="28" align="right" bgcolor="#FFFFFF">Select pattern：</td>
                    <td bgcolor="#FFFFFF">
                    <select name="tbID">
					<?
					$query=$db->query("Select * from {$web_dbtop}game28_auto_tz where uid=".intval($_COOKIE["usersid"])." Order by tzid asc");
					while($rs=$db->fetch_array($query)){
					?>
					  	<option label="<?=$rs["tzname"]?>" value="<?=$rs["id"]?>"><?=$rs["tzname"]?></option>
					<?
					}
					?>
					</select>
					 <a href="luckmodel.php" style="color:green;"> create new pattern</a>
					</td>
                  </tr>
                  <tr>
                    <td height="28" align="right" bgcolor="#FFFFFF">Draw from：</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="tbStartNO" id="tbStartNO" value="<?=$kgqh+1?>" /> must be greater than <?=$kgqh+1?> </td>
                  </tr>
                  <tr>
                    <td height="28" align="right" bgcolor="#FFFFFF">Draw to：</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="tbEndNO" id="tbEndNO" value="<?=$kgqh+99999?>" /> must be less than <?=$kgqh+99999?> </td>
                  </tr>
                  <tr>
                    <td height="28" align="right" bgcolor="#FFFFFF">Minimum balance <?=$web_moneyname?>：</td>
                    <td bgcolor="#FFFFFF">
                      <input type="text" name="tbMinG" id="tbMinG" value="0" /> terminate autopress when your balance <?=$web_moneyname?> is less than it</td>
                  </tr>
                  <tr>
                    <td height="28" align="right" bgcolor="#FFFFFF">Maximum balance <?=$web_moneyname?>：</td>
                    <td bgcolor="#FFFFFF"><input name="tbMaxG" type="text" id="tbMaxG" value="0" /> terminate autopress when your balance <?=$web_moneyname?> is greater than it</td>
                  </tr>
				  
                  <tr>
                    <td height="180" colspan="2" align="center" bgcolor="#FFFFFF" class="rf">
					 <table width="100%" border="0" cellpadding="0" cellspacing="3">
                        <tr>
                          <td width="23%" align="center" class="rf">pattern list</td>
                          <td width="24%" align="center" class="rf">Press amount<?//=$web_moneyname?></td>
                          <td width="28%" align="center" class="rf">Choose the pattern after win</td>
                          <td width="25%" align="center" class="rf">Choose the pattern after lose</td>
                        </tr>
						<?
						$i=0;
						$query_f=$db->query("Select * from {$web_dbtop}game28_auto_tz where uid=".intval($_COOKIE["usersid"])." Order by tzid asc");
						while($rs_f=$db->fetch_array($query_f)){
						?>
                        <tr>
						  <td align="center"><input type="hidden" name="sID[]" id="sID<?=$i;?>" value="<?=$rs_f["id"]?>" /><?=$rs_f["tzname"]?></td>
						  <td align="center"><?=$rs_f["tzpoints"]?></td>
						  <td align="center"><select name="sWinModel[]" id="sWinModel<?=$i;?>">
							<?
							$query=$db->query("Select * from {$web_dbtop}game28_auto_tz where uid=".intval($_COOKIE["usersid"])." Order by tzid asc");
							while($rs=$db->fetch_array($query)){
							?>
								<option label="<?=$rs["tzname"]?>" value="<?=$rs["id"]?>"><?=$rs["tzname"]?></option>
							<?
							}
							?>
							</select>
						  </td>
                          	<td align="center"><select name="sLossModel[]" id="sLossModel<?=$i;?>">
							<?
							$query=$db->query("Select * from {$web_dbtop}game28_auto_tz where uid=".intval($_COOKIE["usersid"])." Order by tzid asc");
							while($rs=$db->fetch_array($query)){
							?>
								<option label="<?=$rs["tzname"]?>" value="<?=$rs["id"]?>"><?=$rs["tzname"]?></option>
							<?
							}
							?>
							</select>
							</td>
                        </tr>
						<?
							$i++;
						}
						?>
                     </table>
                      <br />
                      <input name="image" type="image" id="btnSubmit" src="images/28-submit.gif" width="115" height="29" border="0" />&nbsp;<!--g src="images/28-back28.gif" width="115" height="29" border="0" class="pointer" onclick="javascript:history.back()" />-->
					  <div class="clear" style="height:30px;"></div><!--只用来分隔-->
					  </td>
                  </tr>
				 <!-- 
                  <tr>
                    <td height="28" colspan="2" align="left" valign="top" bgcolor="#FFFFFF"><p  style="margin-left:15px;">Users guide：<br />
                      1．Select press pattern<br />
                      2．Set the start draw and end draw<br />
                      3．Set minimun and maximum balance <?=$web_moneyname?><br />
                      4．After submit，it will start and auto terminate autopress according to your settings，it doesn't matter whether you are online or offline;<br />
                      5．The <?=$web_moneyname?> in your bank is not available for autopress.
					  <div style="height:10px;"><div>
					  </p>
					</td>
                  </tr>
                  -->
                </table></td>
              </tr>
            </table>
			</form>
			
			<script type="text/javascript">
			/*function ChkSetAuto(){
				var s = parseInt("");
				var starLuckNO = parseInt(document.getElementById("tbStartNO").value);
				var endLuckNO = parseInt(document.getElementById("tbEndNO").value);
				var minMoney = parseInt(document.getElementById("tbMinG").value);
				var maxMoney = parseInt(document.getElementById("tbMaxG").value);
				
				if(ChkInt(starLuckNO,1,10)==false || starLuckNO < s){
					alert("开始投注期数格式错误！");
					return false;
				}
				alert("dd");
				
			}*/
			function ResetModel(t){
				for(i=0;i<t;i++){
					document.getElementById("sWinModel"+i).selectedIndex = GetSIndex("sWinModel"+i,document.getElementById("sID"+i).value);
					document.getElementById("sLossModel"+i).selectedIndex = GetSIndex("sLossModel"+i,document.getElementById("sID"+i).value);
				}
			}
			function GetSIndex(obj,v){
				var l = document.getElementById(obj).options.length;
				for(o=0;o<l;o++){
					if(document.getElementById(obj).options[o].value == v){
						return o;
					}
				}
				return 0;
			}
			ResetModel('<?=$i?>');
			
			</script>
			</DIV>
			<DIV class=cl></DIV>
		</DIV>
		<DIV class="area960-b h5px"></DIV>
	<!--Flink End-->
	<div class="blank10"></div>
	<!--Footer Start-->
<?php include_once("footer.php");?>
</DIV>