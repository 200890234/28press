<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();

if($_GET["act"] =="modelsave"){
	$tzmodel_array=array();
	$query=$db->query("Select tznum,tzpoints,points from {$web_dbtop}game16_users_tz where NO=".intval($_GET["happyno"])." and uid=".intval($_COOKIE["usersid"])." Order by id desc");
		if($rs=$db->fetch_array($query)){
			$tznum=explode("|",$rs["tznum"]);
			$tzpoints_array=explode("|",$rs["tzpoints"]);
			$tzpoints=$rs["points"];
		}
	for($i = 0; $i <16 ; $i ++){
		$tzmodel_array[$i]=0;
		for($y = 0; $y < count($tznum); $y++){
			if($tznum[$y]==($i+3)){
				$tzmodel_array[$i]=$tzpoints_array[$y];
			}
		}
	}
	$tznum=implode("|",$tzmodel_array);
	if($_POST["tbID"]){
		$db->query("update {$web_dbtop}game16_auto_tz set tzname='".str_check($_POST["tbModelName"])."',tzunm='".$tznum."',tzpoints=$tzpoints where id =".intval($_POST["tbID"]));
	}else{
		$db->query("INSERT INTO {$web_dbtop}game16_auto_tz (uid,tzname,tzunm,tzpoints,tzid) VALUES (".intval($_COOKIE["usersid"]).",'".str_check($_POST["tbModelName"])."','".$tznum."',$tzpoints,".intval($_POST["tbModelID"]).")");
	}
	echo "<script language=javascript>alert('投注模式保存成功！');location.href='happymodelsave.php?happyno=".$_GET["happyno"]."';</script>";
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
			<LI class="current"><A href="happymodel.php">Edit press pattern</A></LI>
			<LI><A href="happyautoset.php">Autopress</A></LI>
			<LI><A href="happydirection.php">Trend chart</A></LI>
		  </UL>
		</DIV>
		<DIV class="webgame-info">
			<DIV class="webgame-info-tabs">		  
			  <table width="100%" height="27" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="12"><img src="images/game2_03.jpg" width="12" height="27" /></td>
                  <td background="images/game2_04.jpg" class="font14">Autopress Setting:</td>
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
                  <td bgcolor="#9F4F18"><form action="?act=modelsave&happyno=<?=$_GET["happyno"]?>" method="post">
                      <input name="tbID" id="hidID" type="hidden" value="" />
                      <table width="100%" border="0" cellspacing="1" cellpadding="4">
                        <tr>
                          <td width="40%" height="28" align="right" bgcolor="#FFFFFF">Select pattern：</td>
                          <td width="60%" bgcolor="#FFFFFF"><select name="tbModelID" id="tbModelID" onchange="chgModel(this.selectedIndex)">
                              <?
															$tzname=array("pattern 1","pattern 2","pattern 3","pattern 4","pattern 5","pattern 6","pattern 7","pattern 8","pattern 9","pattern 10",
															"pattern 11","pattern 12","pattern 13","pattern 14","pattern 15","pattern 16","pattern 17","pattern 18","pattern19","pattern20",
															"pattern 21","pattern 22","pattern 23","pattern24","pattern 25","pattern 26","pattern 27","m8de 27","pattern 29","pattern30",
															"pattern 31","pattern 32","pattern 33","pattern 34","pattern 35","pattern 36","pattern 37","pattern 38","pattern 39","pattern 40");
															$i=1;
															foreach($tzname as $tzarray){
																$query=$db->query("Select tzname,tzid from {$web_dbtop}game16_auto_tz where uid=".intval($_COOKIE["usersid"])." and tzid=$i Order by tzid asc");
																if($rs=$db->fetch_array($query)){
																	echo"<option label=\"".$rs["tzname"]."\" value=\"".$i."\">".$rs["tzname"]."</option>";
																}else{
																	echo"<option label=\"".$tzarray."\" value=\"".$i."\">".$tzarray."</option>";
																}
															$i++;
															}
														?>
                          </select></td>
                        </tr>
                        <tr>
                          <td height="28" align="right" bgcolor="#FFFFFF">Rename：</td>
                          <td bgcolor="#FFFFFF"><input type="text" name="tbModelName" id="tbModelName" value=""/></td>
                        </tr>
                        <tr>
                          <td height="28" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><input value=" save " type="submit" id="btnSubmit" /></td>
                        </tr>
                      </table>
                  </form></td>
                </tr>
              </table>
			  <?
				$game16tz_array = array();
				$query=$db->query("Select * from {$web_dbtop}game16_auto_tz where uid=".intval($_COOKIE["usersid"])."  Order by tzid asc");
				while($rs=$db->fetch_array($query)){
					$game16tz_array[]="{\"ID\":\"".$rs["id"]."\",\"modelID\":\"".$rs["tzid"]."\",\"modelName\":\"".$rs["tzname"]."\"}";
				}
				$tzjs=implode(",",$game16tz_array);
				?>
				<script type="text/javascript">
				<!--
				function chgModel(index){
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
							document.getElementById("hidID").value = result.arrJsonModel[index].ID;
						}
					}
				}
				chgModel(0);
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