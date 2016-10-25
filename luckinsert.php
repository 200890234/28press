<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();

$query=$db->query("Select id,kj,kgtime,tzpoints from {$web_dbtop}game28 where id=".intval($_GET["luckno"]));
if($rs=$db->fetch_array($query)){
	$kgqh=$rs["id"];
	$kj=$rs["kj"];
	$kgtime=DateDiff($rs["kgtime"],date("Y-m-d H:i:s"),"s")+25;
	$tzsumpoints=$rs["tzpoints"];
}

if($_GET["act"]=="invest"){
	$query=$db->query("Select * from {$web_dbtop}game_system where id=1");
	if($rs=$db->fetch_array($query)){
		$game28_go_time=$rs["game28_go_time"];
		$game28_tz_experience=$rs["game28_tz_experience"];
		$game28_jl_experience=$rs["game28_jl_experience"];
		$game28_jl_maxexperience=$rs["game28_jl_maxexperience"];
		$game28_jl_experience_vip=$rs["game28_jl_experience_vip"];
		$game28_jl_maxexperience_vip=$rs["game28_jl_maxexperience_vip"];
	}
	$query=$db->query("Select id from {$web_dbtop}game28_auto where uid=".intval($_COOKIE["usersid"])." Order by id desc");
	if($rs=$db->fetch_array($query)){
		//echo "<script language=javascript>alert('对不起，请先取消自动投注后在投注！');location.href='luckautodetail.php';</script>";
		//exit;
	}
	if($kj){
		echo "<script language=javascript>alert('sorry,the draw# you are pressing is completed.');location.href='luck.php';</script>";
		exit;
	}
 	if($kgtime<=$game28_go_time){
		echo "<script language=javascript>alert('sorry,this draw is not available, please press next draw');location.href='luck.php';</script>";
		exit;
	}
	if($_POST["tbTotalG2"]==0){
		//echo "<script language=javascript>alert('对不起，您已经投注这期所有号码，请不要在重复投注！');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		//exit;
	}
	$sumpoints=0;
	for($i = 0; $i < 28; $i ++){
		if($_POST["tbChk"][$i]){
			$sumpoints=$sumpoints+zint(intval($_POST["tbNum"][$i]));
		}
	}
	$experience=0;
	$query=$db->query("Select points,vip,dailygame28experience from {$web_dbtop}users where id=".intval($_COOKIE["usersid"]));
	if($rs=$db->fetch_array($query)){
		$userspoints=$rs["points"];
		$vip=$rs["vip"];
		$dailygame28experience=$rs["dailygame28experience"];
		if($vip==1){
			$game28_maxexperience=$game28_jl_maxexperience_vip;
		}else{
			$game28_maxexperience=$game28_jl_maxexperience;
		}
	}
	if($userspoints<$sumpoints){
		echo "<script language=javascript>alert('sorry,you don't have enough ".$web_moneyname." ".$userspoints."');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
		exit;
	}
	if($sumpoints>=$game28_tz_experience){
		if($dailygame28experience<=$game28_maxexperience){
			if($vip==1){
				$experience=$game28_jl_experience_vip;
			}else{
				$experience=$game28_jl_experience;
			}
		}
	}
	$db->query("update {$web_dbtop}users set points=points-$sumpoints,experience=experience+$experience,maxexperience=maxexperience+$experience,dailygame28experience=dailygame28experience+$experience where id =".intval($_COOKIE["usersid"]));
	$db->query("update {$web_dbtop}game_log set game28_hd=game28_hd-$sumpoints where uid=".intval($_COOKIE["usersid"]));
	$x=0;
	for($i = 0; $i < 28; $i ++){
		if($_POST["tbChk"][$i]){
			$query=$db->query("Select id from {$web_dbtop}game28_kg_users_tz where NO=".intval($_GET["luckno"])." and tznum=".$i." and uid=".intval($_COOKIE["usersid"])." Order by id desc");
			//if(!$rs=$db->fetch_array($query))
			//{
				$x++;
				$db->query("INSERT INTO {$web_dbtop}game28_kg_users_tz (uid,NO,tznum,tzpoints,time) VALUES (".intval($_COOKIE["usersid"]).",".$kgqh.",".$i.",".zint(intval($_POST["tbNum"][$i])).",'".date("Y-m-d H:i:s")."')");
			//}else{
				//echo "<script language=javascript>alert('".$i."号码您已经投注过,请不要重复投注！');location.href='happy.php';</script>";
				//exit;
			//}
		}
	}
	
	$db->query("update {$web_dbtop}game28 set tznum=tznum+$x,tzpoints=tzpoints+$sumpoints,sdtz=sdtz+1 where id =".intval($_GET["luckno"]));
	echo "<script language=javascript>alert('press success，".$sumpoints.$web_moneyname." deducted');location.href='luck.php';</script>";
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>luck8-game area-<?=$web_name;?></title>
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
                  <td width="50%" background="images/game2_04.jpg" class="font14">Current Draw# <span class="STYLE1">
                    <?=$kgqh;?>
                    </span>　　<?=$web_moneyname?> total:<font color="red">
                    <?=number_format($tzsumpoints);?>
                  </font></td>
                  <td width="50%" align="right" background="images/game2_04.jpg" class="font14"><span  class="rf" id="fLuck"></span></td>
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
                  <td bgcolor="#248301"><form action="?luckno=<?=$kgqh?>&act=invest" name="form" method="post">
                      <table width="100%" border="0" cellpadding="0" cellspacing="1">
                        <tr>
                          <td height="28" colspan="5" bgcolor="#FFFFFF">&nbsp;&nbsp;<strong>Press patterns：</strong>
						  <?
					$i=0;
					$game28tz_array = array();
					$query=$db->query("Select * from {$web_dbtop}game28_auto_tz where uid=".intval($_COOKIE["usersid"])."  Order by tzid asc");
					while($rs=$db->fetch_array($query)){
						echo "&nbsp;&nbsp;<span class=\"pointer\" onclick=\"chgModel('".$i."')\">".$rs["tzname"]."</span>";
						
						$tzunm=explode("|",$rs["tzunm"]);
						$game28tz_array[]="{\"ID\":\"".$rs["id"]."\",\"modelID\":\"".$rs["tzid"]."\",\"modelName\":\"".$rs["tzname"]."\",\"N0\":\"".$tzunm[0]."\",\"N1\":\"".$tzunm[1]."\",\"N2\":\"".$tzunm[2]."\",\"N3\":\"".$tzunm[3]."\",\"N4\":\"".$tzunm[4]."\",\"N5\":\"".$tzunm[5]."\",\"N6\":\"".$tzunm[6]."\",\"N7\":\"".$tzunm[7]."\",\"N8\":\"".$tzunm[8]."\",\"N9\":\"".$tzunm[9]."\",\"N10\":\"".$tzunm[10]."\",\"N11\":\"".$tzunm[11]."\",\"N12\":\"".$tzunm[12]."\",\"N13\":\"".$tzunm[13]."\",\"N14\":\"".$tzunm[14]."\",\"N15\":\"".$tzunm[15]."\",\"N16\":\"".$tzunm[16]."\",\"N17\":\"".$tzunm[17]."\",\"N18\":\"".$tzunm[18]."\",\"N19\":\"".$tzunm[19]."\",\"N20\":\"".$tzunm[20]."\",\"N21\":\"".$tzunm[21]."\",\"N22\":\"".$tzunm[22]."\",\"N23\":\"".$tzunm[23]."\",\"N24\":\"".$tzunm[24]."\",\"N25\":\"".$tzunm[25]."\",\"N26\":\"".$tzunm[26]."\",\"N27\":\"".$tzunm[27]."\"}";
						
						$i++;
					}
					$tzjs=implode(",",$game28tz_array);
					//print_r($tzjs);
					?></td>
                        </tr>
                        <tr>
                          <td height="28" colspan="5" bgcolor="#FFFFFF">&nbsp;&nbsp;<strong>quick press：</strong>
                              <input type="hidden" id="hidTimes" value="1" />
                              <input value=" * 0.5 " onclick="chgAllTimes(0.5)" type="button" />
                              <input value=" * 0.8 " onclick="chgAllTimes(0.8)" type="button" />
                              <input value=" * 1.2 " onclick="chgAllTimes(1.2)" type="button" />
                              <input value=" * 1.5 " onclick="chgAllTimes(1.5)" type="button" />
                              <input value=" * 2 " onclick="chgAllTimes(2)" type="button" />
                              <input value=" * 5 " onclick="chgAllTimes(5)" type="button" />
                              <input value=" * 10 " onclick="chgAllTimes(10)" type="button" />
							  <input value=" * 50 " onclick="chgAllTimes(50)" type="button" />
							  <input value=" * 100 " onclick="chgAllTimes(100)" type="button" />
                              <input id="tbTotalG1" type="text" value="0" size="8" readonly="true" />
                              <input value=" Press " id="pointerSubmit1" type="submit" onclick="javascript:this.disabled = true;document.form.submit();" />
&nbsp;&nbsp;
              <input name="pointer" type="button" value=" refresh current odds " onclick="location.reload();" class="rf" /></td>
                        </tr>
                        <tr>
                          <td height="28" colspan="5" bgcolor="#FFFFFF" class="rf">&nbsp;&nbsp;<strong>standard pattern：</strong><span class="pointer" onclick="init()">reset</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(1)">all</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(2)">odd</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(3)">even</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(4)">big</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(5)">small</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(6)">middle</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(7)">edge</span>&nbsp;&nbsp;<!--<span class="pointer" onclick="useModel(8)">smaller</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(9)">middle</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(10)">bigger</span>--></td>
                        </tr>
                        <tr>
                          <td width="20%" height="28" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">number list</td>
                          <td width="15%" height="28" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">standard odds</td>
                          <td width="15%" height="28" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">current odds</td>
                          <td width="20%" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf" style="cursor:pointer;"  title="all/reverse"><font onclick="useModel(1)">select all</font> / <font color="#FF0000" onclick="subSelect();">reverse</font></td>
                          <td width="30%" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">press</td>
                        </tr>
                        <?
						for($i = 0; $i < 28; $i ++){
							$query=$db->query("Select sum(tzpoints) as sumnumtzpoints from {$web_dbtop}game28_kg_users_tz where NO=".intval($_GET["luckno"])." and tznum=$i Order by id desc");
							if($rs=$db->fetch_array($query)){
								$sumnumtzpoints=$rs["sumnumtzpoints"];
							}
							$tzpoints=0;
							$query=$db->query("Select tzpoints from {$web_dbtop}game28_kg_users_tz where NO=".intval($_GET["luckno"])." and tznum=$i and uid=".intval($_COOKIE["usersid"])." Order by id desc");
							if($rs=$db->fetch_array($query)){
								$tzpoints=$rs["tzpoints"];
							}
					?>
                        <tr>
                          <td height="32" align="center" bgcolor="#E6F7E0" class="font12game"><img src="images/luck/number_<?=$i;?>.gif" /></td>
                          <td align="center" bgcolor="#FFFFFF" class="font12game"><?=game28pl($i);?></td>
                          <td align="center" bgcolor="#FFFFFF" class="font12game"><?=($sumnumtzpoints?round(($tzsumpoints/$sumnumtzpoints),2):game28pl($i));?></td>
                          <td align="center" bgcolor="#FFFFFF"><input name="tbChk[<?=$i;?>]" id="tbChk<?=$i;?>" type="checkbox" onclick="insert(this,'tbNum<?=$i;?>')" <? if($tzpoints) /*echo"CHECKED disabled";*/ echo "checked=checked";?>/></td>
                          <td align="center" bgcolor="#FFFFFF"><input type="text" size="8" name="tbNum[]" id="tbNum<?=$i;?>" value="<?=$tzpoints;?>" onblur="input(this,'tbChk<?=$i;?>')" <? //if($tzpoints) echo"readonly=\"true\""?> />
                              <input type="button" value=" + " onclick="addNum('tbNum<?=$i;?>','tbChk<?=$i;?>')" />
                              <input type="button" value=" - " onclick="subtractNum('tbNum<?=$i;?>','tbChk<?=$i;?>')" />
                              <input type="button" value=" x2 " onclick="chgTimes('tbNum<?=$i;?>',2)" />
                              <input type="button" value=" x0 " onclick="clearNum('tbNum<?=$i;?>','tbChk<?=$i;?>')" /></td>
                        </tr>
                        <?
					}
					?>
                        <tr>
                          <td height="32" colspan="5" align="center" bgcolor="#FFFFFF">total :
                              <input id="tbTotalG2" name="tbTotalG2" type="text" value="0" size="10" readonly="true" /></td>
                        </tr>
                        <tr>
                          <td height="32" colspan="5" align="center" bgcolor="#FFFFFF"><label>
                            <!--<input value="确认投注" type="submit" id="pointerSubmit" onclick="javascript:this.disabled = true;this.document.form.submit();" />-->                        
                            <input value=" Press " type="submit" id="pointerSubmit" onclick="javascript:this.disabled = true;document.form.submit();" />                           
                          </label></td>
                        </tr>
                      </table>
                  </form></td>
                </tr>
              </table>
			  <script type="text/javascript">
<!--
var arrModel1 = new Array();
var arrModel2 = new Array();
var arrModel3 = new Array();
var arrModel4 = new Array();
var arrModel5 = new Array();
var arrModel6 = new Array();
var arrModel7 = new Array();
var arrModel8 = new Array();
var arrModel9 = new Array();
var arrModel10 = new Array();
//全包
arrModel1[0] = 1;
arrModel1[1] = 3;
arrModel1[2] = 6;
arrModel1[3] = 10;
arrModel1[4] = 15;
arrModel1[5] = 21;
arrModel1[6] = 28;
arrModel1[7] = 36;
arrModel1[8] = 45;
arrModel1[9] = 55;
arrModel1[10] = 63;
arrModel1[11] = 69;
arrModel1[12] = 73;
arrModel1[13] = 75;
arrModel1[14] = 75;
arrModel1[15] = 73;
arrModel1[16] = 69;
arrModel1[17] = 63;
arrModel1[18] = 55;
arrModel1[19] = 45;
arrModel1[20] = 36;
arrModel1[21] = 28;
arrModel1[22] = 21;
arrModel1[23] = 15;
arrModel1[24] = 10;
arrModel1[25] = 6;
arrModel1[26] = 3;
arrModel1[27] = 1;
//单
arrModel2[0] = 0;
arrModel2[1] = 3;
arrModel2[2] = 0;
arrModel2[3] = 10;
arrModel2[4] = 0;
arrModel2[5] = 21;
arrModel2[6] = 0;
arrModel2[7] = 36;
arrModel2[8] = 0;
arrModel2[9] = 55;
arrModel2[10] = 0;
arrModel2[11] = 69;
arrModel2[12] = 0;
arrModel2[13] = 75;
arrModel2[14] = 0;
arrModel2[15] = 73;
arrModel2[16] = 0;
arrModel2[17] = 63;
arrModel2[18] = 0;
arrModel2[19] = 45;
arrModel2[20] = 0;
arrModel2[21] = 28;
arrModel2[22] = 0;
arrModel2[23] = 15;
arrModel2[24] = 0;
arrModel2[25] = 6;
arrModel2[26] = 0;
arrModel2[27] = 1;
//双
arrModel3[0] = 1;
arrModel3[1] = 0;
arrModel3[2] = 6;
arrModel3[3] = 0;
arrModel3[4] = 15;
arrModel3[5] = 0;
arrModel3[6] = 28;
arrModel3[7] = 0;
arrModel3[8] = 45;
arrModel3[9] = 0;
arrModel3[10] = 63;
arrModel3[11] = 0;
arrModel3[12] = 73;
arrModel3[13] = 0;
arrModel3[14] = 75;
arrModel3[15] = 0;
arrModel3[16] = 69;
arrModel3[17] = 0;
arrModel3[18] = 55;
arrModel3[19] = 0;
arrModel3[20] = 36;
arrModel3[21] = 0;
arrModel3[22] = 21;
arrModel3[23] = 0;
arrModel3[24] = 10;
arrModel3[25] = 0;
arrModel3[26] = 3;
arrModel3[27] = 0;
//大
arrModel4[0] = 0;
arrModel4[1] = 0;
arrModel4[2] = 0;
arrModel4[3] = 0;
arrModel4[4] = 0;
arrModel4[5] = 0;
arrModel4[6] = 0;
arrModel4[7] = 0;
arrModel4[8] = 0;
arrModel4[9] = 0;
arrModel4[10] = 0;
arrModel4[11] = 0;
arrModel4[12] = 0;
arrModel4[13] = 0;
arrModel4[14] = 75;
arrModel4[15] = 73;
arrModel4[16] = 69;
arrModel4[17] = 63;
arrModel4[18] = 55;
arrModel4[19] = 45;
arrModel4[20] = 36;
arrModel4[21] = 28;
arrModel4[22] = 21;
arrModel4[23] = 15;
arrModel4[24] = 10;
arrModel4[25] = 6;
arrModel4[26] = 3;
arrModel4[27] = 1;
//小
arrModel5[0] = 1;
arrModel5[1] = 3;
arrModel5[2] = 6;
arrModel5[3] = 10;
arrModel5[4] = 15;
arrModel5[5] = 21;
arrModel5[6] = 28;
arrModel5[7] = 36;
arrModel5[8] = 45;
arrModel5[9] = 55;
arrModel5[10] = 63;
arrModel5[11] = 69;
arrModel5[12] = 73;
arrModel5[13] = 75;
arrModel5[14] = 0;
arrModel5[15] = 0;
arrModel5[16] = 0;
arrModel5[17] = 0;
arrModel5[18] = 0;
arrModel5[19] = 0;
arrModel5[20] = 0;
arrModel5[21] = 0;
arrModel5[22] = 0;
arrModel5[23] = 0;
arrModel5[24] = 0;
arrModel5[25] = 0;
arrModel5[26] = 0;
arrModel5[27] = 0;
//中
arrModel6[0] = 0;
arrModel6[1] = 0;
arrModel6[2] = 0;
arrModel6[3] = 0;
arrModel6[4] = 0;
arrModel6[5] = 0;
arrModel6[6] = 0;
arrModel6[7] = 0;
arrModel6[8] = 0;
arrModel6[9] = 0;
arrModel6[10] = 63;
arrModel6[11] = 69;
arrModel6[12] = 73;
arrModel6[13] = 75;
arrModel6[14] = 75;
arrModel6[15] = 73;
arrModel6[16] = 69;
arrModel6[17] = 63;
arrModel6[18] = 0;
arrModel6[19] = 0;
arrModel6[20] = 0;
arrModel6[21] = 0;
arrModel6[22] = 0;
arrModel6[23] = 0;
arrModel6[24] = 0;
arrModel6[25] = 0;
arrModel6[26] = 0;
arrModel6[27] = 0;
//边
arrModel7[0] = 1;
arrModel7[1] = 3;
arrModel7[2] = 6;
arrModel7[3] = 10;
arrModel7[4] = 15;
arrModel7[5] = 21;
arrModel7[6] = 28;
arrModel7[7] = 36;
arrModel7[8] = 45;
arrModel7[9] = 55;
arrModel7[10] = 0;
arrModel7[11] = 0;
arrModel7[12] = 0;
arrModel7[13] = 0;
arrModel7[14] = 0;
arrModel7[15] = 0;
arrModel7[16] = 0;
arrModel7[17] = 0;
arrModel7[18] = 55;
arrModel7[19] = 45;
arrModel7[20] = 36;
arrModel7[21] = 28;
arrModel7[22] = 21;
arrModel7[23] = 15;
arrModel7[24] = 10;
arrModel7[25] = 6;
arrModel7[26] = 3;
arrModel7[27] = 1;
//区间小
arrModel8[0] = 1;
arrModel8[1] = 3;
arrModel8[2] = 6;
arrModel8[3] = 10;
arrModel8[4] = 15;
arrModel8[5] = 21;
arrModel8[6] = 28;
arrModel8[7] = 36;
arrModel8[8] = 45;
arrModel8[9] = 55;
arrModel8[10] = 0;
arrModel8[11] = 0;
arrModel8[12] = 0;
arrModel8[13] = 0;
arrModel8[14] = 0;
arrModel8[15] = 0;
arrModel8[16] = 0;
arrModel8[17] = 0;
arrModel8[18] = 0;
arrModel8[19] = 0;
arrModel8[20] = 0;
arrModel8[21] = 0;
arrModel8[22] = 0;
arrModel8[23] = 0;
arrModel8[24] = 0;
arrModel8[25] = 0;
arrModel8[26] = 0;
arrModel8[27] = 0;
//区间中
arrModel9[0] = 0;
arrModel9[1] = 0;
arrModel9[2] = 0;
arrModel9[3] = 0;
arrModel9[4] = 0;
arrModel9[5] = 0;
arrModel9[6] = 0;
arrModel9[7] = 0;
arrModel9[8] = 0;
arrModel9[9] = 0;
arrModel9[10] = 63;
arrModel9[11] = 69;
arrModel9[12] = 73;
arrModel9[13] = 75;
arrModel9[14] = 75;
arrModel9[15] = 73;
arrModel9[16] = 69;
arrModel9[17] = 63;
arrModel9[18] = 55;
arrModel9[19] = 0;
arrModel9[20] = 0;
arrModel9[21] = 0;
arrModel9[22] = 0;
arrModel9[23] = 0;
arrModel9[24] = 0;
arrModel9[25] = 0;
arrModel9[26] = 0;
arrModel9[27] = 0;
//区间大
arrModel10[0] = 0;
arrModel10[1] = 0;
arrModel10[2] = 0;
arrModel10[3] = 0;
arrModel10[4] = 0;
arrModel10[5] = 0;
arrModel10[6] = 0;
arrModel10[7] = 0;
arrModel10[8] = 0;
arrModel10[9] = 0;
arrModel10[10] = 0;
arrModel10[11] = 0;
arrModel10[12] = 0;
arrModel10[13] = 0;
arrModel10[14] = 0;
arrModel10[15] = 0;
arrModel10[16] = 0;
arrModel10[17] = 0;
arrModel10[18] = 0;
arrModel10[19] = 45;
arrModel10[20] = 36;
arrModel10[21] = 28;
arrModel10[22] = 21;
arrModel10[23] = 15;
arrModel10[24] = 10;
arrModel10[25] = 6;
arrModel10[26] = 3;
arrModel10[27] = 1;

var insertG = 10;
function init(){
	for(i=0;i<28;i++){
		if(document.getElementById("tbNum"+i).readOnly == false){
			document.getElementById("tbChk"+i).checked = false;
			document.getElementById("tbNum"+i).value = 0;
		}
	}
	document.getElementById("hidTimes").value = 1;
	document.getElementById("tbTotalG1").value = 0;
	document.getElementById("tbTotalG2").value = 0;
}
function addNum(numID,chkID){
	if(document.getElementById(numID).readOnly == false){
		document.getElementById(numID).value=document.getElementById(numID).value==''?0:document.getElementById(numID).value;
		document.getElementById("tbTotalG1").value = document.getElementById("tbTotalG2").value = parseInt(document.getElementById("tbTotalG1").value) + insertG;
		document.getElementById(numID).value = parseInt(document.getElementById(numID).value) + insertG;
		document.getElementById(chkID).checked = true;
	}
}
function subtractNum(numID,chkID){
	if(document.getElementById(numID).readOnly == false){
		if(document.getElementById(numID).value!=''){
			var subValue = parseInt(document.getElementById(numID).value) > insertG ? insertG : parseInt(document.getElementById(numID).value)
			document.getElementById("tbTotalG1").value = document.getElementById("tbTotalG2").value = parseInt(document.getElementById("tbTotalG1").value) - subValue;
			document.getElementById(numID).value = parseInt(document.getElementById(numID).value) - subValue;
			if(document.getElementById(numID).value=='0'){
				document.getElementById(chkID).checked = false;
			}
		}
	}
}
function chgTimes(numID,times){
	if(document.getElementById(numID).readOnly == false){
		if(parseInt(document.getElementById(numID).value * times) > 0){
			document.getElementById("tbTotalG1").value = parseInt(document.getElementById("tbTotalG1").value) + parseInt(document.getElementById(numID).value) * times - parseInt(document.getElementById(numID).value);
			document.getElementById("tbTotalG2").value = document.getElementById("tbTotalG1").value;
			document.getElementById(numID).value = parseInt(document.getElementById(numID).value) * times;
		}
	}
}
function clearNum(numID,chkID){
	if(document.getElementById(numID).readOnly == false){
		document.getElementById("tbTotalG1").value = document.getElementById("tbTotalG2").value = parseInt(document.getElementById("tbTotalG1").value) - parseInt(document.getElementById(numID).value);
		document.getElementById(numID).value = 0;
		document.getElementById(chkID).checked = false;
	}
}
function insert(obj,numID){
	if(obj.checked){
		document.getElementById(numID).value = insertG;
		if(document.getElementById("tbTotalG1").value == ""){
			document.getElementById("tbTotalG1").value = 0;
		}
		document.getElementById("tbTotalG1").value = parseInt(document.getElementById("tbTotalG1").value) + insertG;
	}
	else{
		if(document.getElementById("tbTotalG1").value == ""){
			document.getElementById("tbTotalG1").value = 0;
		}
		document.getElementById("tbTotalG1").value = parseInt(document.getElementById("tbTotalG1").value) - parseInt(document.getElementById(numID).value);
		document.getElementById(numID).value = 0;
	}
	document.getElementById("tbTotalG2").value = document.getElementById("tbTotalG1").value;
}
function input(obj,chkID){
	if(obj.value<=0){
		obj.value=0;
	}
	if(obj.readOnly == false){
		var tmpMoney=0;
		if(obj.value != ""){
			if(chkInt(obj.value)==false){
				obj.value = 0;
			}
			if(obj.value != 0){
				document.getElementById(chkID).checked = true;
			}
			else{
				document.getElementById(chkID).checked = false;
			}
		}
		else{
			document.getElementById(chkID).checked = false;
		}
		var id = document.getElementsByName("tbNum[]");
		for(i=0;i<id.length;i++){
			if(id[i].readOnly == false){
				if(id[i].value != ""){
					tmpMoney += parseInt(id[i].value);
				}
			}
		}
		document.getElementById("tbTotalG1").value = document.getElementById("tbTotalG2").value = tmpMoney;
	}
}
function useModel(index){
	init();
	var arrModel = eval("arrModel"+index);
	for(i=0;i<arrModel.length;i++){
		if(document.getElementById("tbNum"+i).readOnly == false){
			document.getElementById("tbChk"+i).checked = false;
			if(arrModel[i] > 0){
				document.getElementById("tbNum"+i).value = arrModel[i];
				document.getElementById("tbChk"+i).checked = true;
				document.getElementById("tbTotalG1").value = parseInt(document.getElementById("tbTotalG1").value) + arrModel[i];
				document.getElementById("tbTotalG2").value = parseInt(document.getElementById("tbTotalG2").value) + arrModel[i];
			}
		}
	}
}
function subSelect(){
	var arrModel = eval("arrModel1");
	for(i=0;i<arrModel.length;i++){
		if(document.getElementById("tbNum"+i).readOnly == false){
			if(arrModel[i] > 0){
				if(document.getElementById("tbChk"+i).checked==false){
					document.getElementById("tbNum"+i).value = Math.floor(arrModel[i] * document.getElementById("hidTimes").value);
					document.getElementById("tbChk"+i).checked = true;
					document.getElementById("tbTotalG1").value = Math.floor(parseInt(document.getElementById("tbTotalG1").value) + arrModel[i] * document.getElementById("hidTimes").value);
					document.getElementById("tbTotalG2").value = Math.floor(parseInt(document.getElementById("tbTotalG2").value) + arrModel[i] * document.getElementById("hidTimes").value);
				}
				else{
					document.getElementById("tbChk"+i).checked = false;
					document.getElementById("tbTotalG1").value = parseInt(document.getElementById("tbTotalG1").value) - document.getElementById("tbNum"+i).value;
					document.getElementById("tbTotalG2").value = parseInt(document.getElementById("tbTotalG2").value) - document.getElementById("tbNum"+i).value;
					document.getElementById("tbNum"+i).value = 0;
				}
			}
		}
	}
}

function chgModel(index){
	init();
	var result = {"arrJsonModel":[<?=$tzjs?>]};
	if(result.arrJsonModel != null){
		for(j=0;j<28;j++){
			if(eval("result.arrJsonModel[index].N"+j) > 0){
				if(document.getElementById("tbNum"+j).readOnly == false){
					document.getElementById("tbChk"+j).checked = true;
					document.getElementById("tbNum"+j).value = eval("result.arrJsonModel[index].N"+j);
					document.getElementById("tbTotalG1").value = parseInt(document.getElementById("tbTotalG1").value) + parseInt(eval("result.arrJsonModel[index].N"+j));
				}
			}
		}
		document.getElementById("tbTotalG2").value = document.getElementById("tbTotalG1").value;
	}
}

function chgAllTimes(times){
	document.getElementById("hidTimes").value=document.getElementById("hidTimes").value * times;
	for(i=0;i<28;i++){
		if(document.getElementById("tbNum"+i).readOnly == false){
			if(parseInt(document.getElementById("tbNum"+i).value) * times > 1){
				if(document.getElementById("tbNum"+i).value > 0){
					document.getElementById("tbTotalG1").value = parseInt(document.getElementById("tbTotalG1").value) + Math.floor(parseInt(document.getElementById("tbNum"+i).value) * times) - parseInt(document.getElementById("tbNum"+i).value);
					document.getElementById("tbTotalG2").value = document.getElementById("tbTotalG1").value;
					document.getElementById("tbNum"+i).value = Math.floor(parseInt(document.getElementById("tbNum"+i).value) * times);
					document.getElementById("tbChk"+i).checked = true;
				}
			}
			else{
				if(document.getElementById("tbNum"+i).value > 0){
					document.getElementById("tbTotalG1").value = parseInt(document.getElementById("tbTotalG1").value) - parseInt(document.getElementById("tbNum"+i).value);
					document.getElementById("tbTotalG2").value = document.getElementById("tbTotalG1").value;
					document.getElementById("tbNum"+i).value = 0;
					document.getElementById("tbChk"+i).checked = false;
				}
			}
		}
	}
}

function chkInt(int,minLength,maxLength,pattern){
	pattern = typeof(pattern) == 'undefined' ? '^-?[1-9]+[0-9]*$' : pattern;
	pattern = new RegExp(pattern);
	if(pattern.test(int)==false){
		return false;
	}
	return chkStrLen(int,minLength,maxLength);
}

function chkStrLen(str,minLength,maxLength){
	if(str.length < minLength) {
		return false;
	}
	if(maxLength != null && str.length > maxLength) {
		return false;
	}
	return true;
}

function ShowSecond(cDate){
	if(cDate > 1){
		document.getElementById("fLuck").innerHTML = (--cDate)+" seconds left for Draw #<?=$kgqh;?>";
		setTimeout("ShowSecond("+cDate+")",1000);
	}
	else{
		document.getElementById("fLuck").innerHTML = "Please refresh to view the luck number of Draw #<?=$kgqh;?> ";
	}
}
ShowSecond(parseInt("<?=$kgtime?>"));
-->
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