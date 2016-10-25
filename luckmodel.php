<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();

if($_GET["act"] =="save"){
	$ztsum=0;
	for($i = 0; $i < count($_POST["tbNum"]); $i ++){
		if($_POST["tbChk"][$i]){
			$ztsum=$ztsum+$_POST["tbNum"][$i];
		}
	}
	if($ztsum>200000000){
		echo "<script language=javascript>alert('sorry,the max amount of every press is 200000000');history.go(-1);</script>";
		exit;
	}
	$tznum=implode("|",$_POST["tbNum"]);
	if($_POST["tbID"]){
		$db->query("update {$web_dbtop}game28_auto_tz set tzname='".str_check($_POST["tbModelName"])."',tzunm='".str_check($tznum)."',tzpoints=".intval($ztsum)." where id =".intval($_POST["tbID"]));
		echo "<script language=javascript>alert('update success');location.href='".($_POST["pointerSubmitGo"]?"luckautoset.php":"luckmodel.php")."';</script>";
		exit;
	}else{
		$db->query("INSERT INTO {$web_dbtop}game28_auto_tz (uid,tzname,tzunm,tzpoints,tzid) VALUES (".intval($_COOKIE["usersid"]).",'".str_check($_POST["tbModelName"])."','".str_check($tznum)."',".intval($ztsum).",".intval($_POST["tbModelID"]).")");
		//$sql="INSERT INTO {$web_dbtop}game28_auto_tz (uid,tzname,tzunm,tzpoints,tzid) VALUES (".intval($_COOKIE["usersid"]).",'".str_check($_POST["tbModelName"])."','".str_check($tznum)."',".intval($ztsum).",".intval($_POST["tbModelID"]).")";
		//echo $sql;
		echo "<script language=javascript>alert('add success');location.href='".($_POST["pointerSubmitGo"]?"luckautoset.php":"luckmodel.php")."';</script>";
		exit;
	}
}
if($_GET["act"] =="del"){
	if($_GET["id"]){
		$db->query("delete from {$web_dbtop}game28_auto_tz where id=".intval($_GET["id"]));
		echo "<script language=javascript>alert('delete success');location.href='luckmodel.php';</script>";
		exit;
	}else{
		echo "<script language=javascript>alert('unable to find this pattern');history.go(-1);</script>";
		exit;
	}
}

$game28tz_array = array();
$query=$db->query("Select * from {$web_dbtop}game28_auto_tz where uid=".intval($_COOKIE["usersid"])."  Order by tzid asc");
while($rs=$db->fetch_array($query)){
	$tzunm=explode("|",$rs["tzunm"]);
	$game28tz_array[]="{\"ID\":\"".$rs["id"]."\",\"modelID\":\"".$rs["tzid"]."\",\"modelName\":\"".$rs["tzname"]."\",\"N0\":\"".$tzunm[0]."\",\"N1\":\"".$tzunm[1]."\",\"N2\":\"".$tzunm[2]."\",\"N3\":\"".$tzunm[3]."\",\"N4\":\"".$tzunm[4]."\",\"N5\":\"".$tzunm[5]."\",\"N6\":\"".$tzunm[6]."\",\"N7\":\"".$tzunm[7]."\",\"N8\":\"".$tzunm[8]."\",\"N9\":\"".$tzunm[9]."\",\"N10\":\"".$tzunm[10]."\",\"N11\":\"".$tzunm[11]."\",\"N12\":\"".$tzunm[12]."\",\"N13\":\"".$tzunm[13]."\",\"N14\":\"".$tzunm[14]."\",\"N15\":\"".$tzunm[15]."\",\"N16\":\"".$tzunm[16]."\",\"N17\":\"".$tzunm[17]."\",\"N18\":\"".$tzunm[18]."\",\"N19\":\"".$tzunm[19]."\",\"N20\":\"".$tzunm[20]."\",\"N21\":\"".$tzunm[21]."\",\"N22\":\"".$tzunm[22]."\",\"N23\":\"".$tzunm[23]."\",\"N24\":\"".$tzunm[24]."\",\"N25\":\"".$tzunm[25]."\",\"N26\":\"".$tzunm[26]."\",\"N27\":\"".$tzunm[27]."\"}";
}
$tzjs=implode(",",$game28tz_array);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Luck28-game center-<?=$web_name;?></title>
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
			<LI class="current"><A href="luckmodel.php">Edit press pattern</A></LI>
			<LI><A href="luckautoset.php">Autopress</A></LI>
			<LI><A href="luckdirection.php">Trend chart</A></LI>
		  </UL>
		</DIV>
		<DIV class="webgame-info">
			<DIV class="webgame-info-tabs">
			  <table width="100%" height="27" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="12"><img src="images/game2_03.jpg" width="12" height="27" /></td>
                  <td background="images/game2_04.jpg" class="font14">Edit press pattern:</td>
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
                  <td bgcolor="#248301"><form action="?act=save" method="post">
                      <table width="100%" border="0" cellpadding="0" cellspacing="1">
                        <tr>
                          <td height="28" colspan="4" bgcolor="#FFFFFF">&nbsp;&nbsp;<strong>select pattern：
                                <input name="tbID" id="hidID" type="hidden" value="" />
                                <select name="tbModelID" id="tbModelID" onchange="chgModel(this.selectedIndex)">
                                  <?
															$tzname=array("pattern 1","pattern 2","pattern 3","pattern 4","pattern 5","pattern 6","pattern 7","pattern 8","pattern 9","pattern 10",
															"pattern 11","pattern 12","pattern 13","pattern 14","pattern 15","pattern 16","pattern 17","pattern 18","pattern19","pattern20",
															"pattern 21","pattern 22","pattern 23","pattern24","pattern 25","pattern 26","pattern 27","pattern 28","pattern 29","pattern30",
															"pattern 31","pattern 32","pattern 33","pattern 34","pattern 35","pattern 36","pattern 37","pattern 38","pattern 39","pattern 40");
															$i=1;
															foreach($tzname as $tzarray){
																$query=$db->query("Select tzname,tzid from {$web_dbtop}game28_auto_tz where uid=".intval($_COOKIE["usersid"])." and tzid=$i Order by tzid asc");
																if($rs=$db->fetch_array($query)){
																	echo"<option label=\"".$rs["tzname"]."\" value=\"".$i."\">".$rs["tzname"]."</option>";
																}else{
																	echo"<option label=\"".$tzarray."\" value=\"".$i."\">".$tzarray."</option>";
																}
															$i++;
															}
														?>
                                </select>
&nbsp;&nbsp;rename:
              <input type="text" maxlength="10" name="tbModelName" id="tbModelName" value="" />
                            </strong>
                              <input type="button" value=" reset " onclick="chgModel($('tbModelID').selectedIndex)" />
                              <!--<input type="button" value=" delete " onclick="window.location.href='luckmodel.php?act=del&id='+$('tbID').value" />-->
                             <input type="button" value=" delete " onclick="window.location.href='luckmodel.php?act=del&id='+document.getElementById('hidID').value" />
                          </td>
                        </tr>
                        <tr>
                          <td height="28" colspan="4" bgcolor="#FFFFFF"><strong>&nbsp; <strong>
                            <label></label>
                            </strong>
                                <label> </label>
              pattern detail
              <label>：</label>
                          </strong></td>
                        </tr>
                        <tr>
                          <td height="28" colspan="4" bgcolor="#FFFFFF">
						      <input type="hidden" id="hidTimes" value="1" />
                              <input value=" *0.5 " onclick="chgAllTimes(0.5)" type="button" />
                              <input value=" *0.8 " onclick="chgAllTimes(0.8)" type="button" />
                              <input value=" *1.2 " onclick="chgAllTimes(1.2)" type="button" />
                              <input value=" *1.5 " onclick="chgAllTimes(1.5)" type="button" />
                              <input value=" *2 " onclick="chgAllTimes(2)" type="button" />
                              <input value=" *10 " onclick="chgAllTimes(10)" type="button" />
							  <input value=" *50 " onclick="chgAllTimes(50)" type="button" />
							  <input value=" *100 " onclick="chgAllTimes(100)" type="button" />
                              <input name="tbTotalG1" id="tbTotalG1" readonly="readOnly" value="" />
                              <input name="pointerSubmit2" value=" save " type="submit" />
                              <input value=" save and start autopress " type="submit" name="pointerSubmitGo" />
						   </td>
                        </tr>
                        <tr>
                          <td height="28" colspan="4" bgcolor="#FFFFFF" class="rf">&nbsp;&nbsp;<strong>standard pattern：</strong><span class="pointer" onclick="init()">reset</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(1)">all</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(2)">odd</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(3)">even</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(4)">big</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(5)">small</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(6)">middle</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(7)">edge</span>&nbsp;&nbsp;<!--<span class="pointer" onclick="useModel(8)">smaller</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(9)">middle</span>&nbsp;&nbsp;<span class="pointer" onclick="useModel(10)">bigger</span>--></td>
                        </tr>
                        <tr>
                          <td width="30%" height="28" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF"  class="wf">number list</td>
                          <td align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf" style="cursor:pointer;"><font onclick="useModel(1)">select all</font> / <font color="#FF0000" onclick="subSelect();">reverse</font></td>
                          <td width="30%" align="center" background="images/310-bj.jpg" bgcolor="#FFFFFF" class="wf">press option</td>
                        </tr>
                        <?
						for($i = 0; $i < 28; $i ++){
					?>
                        <tr>
                          <td height="32" align="center" bgcolor="#E6F7E0" class="font12game"><img src="images/luck/number_<?=$i?>.gif" /></td>
                          <td align="center" bgcolor="#FFFFFF"><input name="tbChk[<?=$i?>]" id="tbChk<?=$i?>" type="checkbox" onclick="insert(this,'tbNum<?=$i?>')"  /></td>
                          <td align="center" bgcolor="#FFFFFF"><input type="text" size="8" name="tbNum[]" id="tbNum<?=$i?>" value="" onblur="input(this,'tbChk<?=$i?>')"  />
                              <input type="button" value=" + " onclick="addNum('tbNum<?=$i?>','tbChk<?=$i?>')" />
                              <input type="button" value=" - " onclick="subtractNum('tbNum<?=$i?>','tbChk<?=$i?>')" />
                              <input type="button" value=" x2 " onclick="chgTimes('tbNum<?=$i?>',2)" />
                              <input type="button" value=" x0 " onclick="clearNum('tbNum<?=$i?>','tbChk<?=$i?>')" /></td>
                        </tr>
                        <?
					}
					?>
                        <tr>
                          <td height="32" colspan="4" align="center" bgcolor="#FFFFFF">total:
                              <input id="tbTotalG2" readonly="readOnly" value="" /></td>
                        </tr>
                        <tr>
                          <td height="32" colspan="4" align="center" bgcolor="#FFFFFF"><label>
                            <input name="pointerSubmit" value=" save " type="submit" />
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
					document.getElementById(numID).value=document.getElementById(numID).value==''?0:document.getElementById(numID).value;
					document.getElementById("tbTotalG1").value = document.getElementById("tbTotalG2").value = parseInt(document.getElementById("tbTotalG1").value) + insertG;
					document.getElementById(numID).value = parseInt(document.getElementById(numID).value) + insertG;
					document.getElementById(chkID).checked = true;
				}
				function subtractNum(numID,chkID){
					if(document.getElementById(numID).value!=''){
						var subValue = parseInt(document.getElementById(numID).value) > insertG ? insertG : parseInt(document.getElementById(numID).value)
						document.getElementById("tbTotalG1").value = document.getElementById("tbTotalG2").value = parseInt(document.getElementById("tbTotalG1").value) - subValue;
						document.getElementById(numID).value = parseInt(document.getElementById(numID).value) - subValue;
						if(document.getElementById(numID).value=='0'){
							document.getElementById(chkID).checked = false;
						}
					}
				}
				function chgTimes(numID,times){
					if(parseInt(document.getElementById(numID).value * times) > 0){
						document.getElementById("tbTotalG1").value = parseInt(document.getElementById("tbTotalG1").value) + parseInt(document.getElementById(numID).value) * times - parseInt(document.getElementById(numID).value);
						document.getElementById("tbTotalG2").value = document.getElementById("tbTotalG1").value;
						document.getElementById(numID).value = parseInt(document.getElementById(numID).value) * times;
					}
				}
				function clearNum(numID,chkID){
					document.getElementById("tbTotalG1").value = document.getElementById("tbTotalG2").value = parseInt(document.getElementById("tbTotalG1").value) - parseInt(document.getElementById(numID).value);
					document.getElementById(numID).value = 0;
					document.getElementById(chkID).checked = false;
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
					var modelID = document.getElementById("tbModelID").options[index].value;
					document.getElementById("hidID").value = '';
					var flag = false;
					var result = {"arrJsonModel":[<?=$tzjs?>]};
					if(result.arrJsonModel != null){
						document.getElementById("tbModelName").value = document.getElementById("tbModelID").options[index].text;	
						for(i=0;i<result.arrJsonModel.length;i++){
							if(result.arrJsonModel[i].modelID==modelID){
								flag = true;
								index = i;
							}
						}
						if(flag){
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
							document.getElementById("hidID").value = result.arrJsonModel[index].ID;
						}
					}
				}
				chgModel(0);
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
				
				function $(obj){
					return typeof(obj) == "string" ? document.getElementById(obj) : obj;
				}
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