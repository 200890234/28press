<?php
include_once("inc/conn.php");
include_once("inc/function.php");
login_check();

$intpage = 30;
if (isset($_GET['page'])) {
	$rsnum = (intval($_GET['page']) -1)*$intpage;
}
else {
	$rsnum = 0;
}
if($_GET["minNO"] && $_GET["maxNO"]){
	$sql="Select {$web_dbtop}game16.id,{$web_dbtop}game16.kgtime,{$web_dbtop}game16.kgjg,{$web_dbtop}game16.zjpl,{$web_dbtop}game16.kj,{$web_dbtop}game16_users_tz.hdpoints,{$web_dbtop}game16_users_tz.points from {$web_dbtop}game16,{$web_dbtop}game16_users_tz where {$web_dbtop}game16.id={$web_dbtop}game16_users_tz.NO and {$web_dbtop}game16_users_tz.uid=".intval($_COOKIE["usersid"])." and {$web_dbtop}game16.id>=".intval($_GET["minNO"])." and {$web_dbtop}game16.id<=".intval($_GET["maxNO"])." and kj=1 Order by {$web_dbtop}game16.id desc";
}else{
	$sql="Select {$web_dbtop}game16.id,{$web_dbtop}game16.kgtime,{$web_dbtop}game16.kgjg,{$web_dbtop}game16.zjpl,{$web_dbtop}game16.kj,{$web_dbtop}game16_users_tz.hdpoints,{$web_dbtop}game16_users_tz.points from {$web_dbtop}game16,{$web_dbtop}game16_users_tz where {$web_dbtop}game16.id={$web_dbtop}game16_users_tz.NO and {$web_dbtop}game16_users_tz.uid=".intval($_COOKIE["usersid"])." and kj=1 Order by {$web_dbtop}game16.id desc";
}
$query=$db->query($sql);
if($rs=$db->fetch_array($query)){
	$maxid=$rs["id"];
	$intnum=$db->num_rows($query);
}

if($_GET["minNO"] && $_GET["maxNO"]){
	$query=$db->query("Select min({$web_dbtop}game16.id) as id,sum({$web_dbtop}game16_users_tz.hdpoints) as hdpoints,sum({$web_dbtop}game16_users_tz.points) as tzpoints from {$web_dbtop}game16,{$web_dbtop}game16_users_tz where {$web_dbtop}game16.id={$web_dbtop}game16_users_tz.NO and uid=".intval($_COOKIE["usersid"])." and {$web_dbtop}game16.id>=".intval($_GET["minNO"])." and {$web_dbtop}game16.id<=".intval($_GET["maxNO"]));
}else{
	$query=$db->query("Select min({$web_dbtop}game16.id) as id,sum({$web_dbtop}game16_users_tz.hdpoints) as hdpoints,sum({$web_dbtop}game16_users_tz.points) as tzpoints from {$web_dbtop}game16,{$web_dbtop}game16_users_tz where {$web_dbtop}game16.id={$web_dbtop}game16_users_tz.NO and uid=".intval($_COOKIE["usersid"]));
}
if($rs=$db->fetch_array($query)){
	$minid=$rs["id"];
	$tzpoints=$rs["tzpoints"];
	$sumpoints=$rs["hdpoints"];
}

if($_GET["minNO"] && $_GET["maxNO"]){
	$minid=$_GET["minNO"];
	$maxid=$_GET["maxNO"];
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
<style type="text/css">
table a{color:#285D0B;}
table a:hover{color:black;font-weight:bold;}
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
                  <td background="images/game2_04.jpg" class="font14">My press history:</td>
                  <td width="13"><img src="images/game2_06.jpg" width="13" height="27" /></td>
                </tr>
              </table>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="5"></td>
                </tr>
              </table>
			  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <form action="?" method="get">
                  <tr>
                    <td colspan="9">
						<div style="color:white;"> Draw £º from
							<input name="minNO" type="text" size="20" maxlength="10" value="<?=$minid?>"/>
								To 
							<input name="maxNO" type="text" size="20" maxlength="10" value="<?=$maxid?>" />
							<input type="submit" name="btnSearch" value=" view " />
						</div>
                    </td>
                  </tr>
                </form>
                <tr>
                  <td colspan="9" height="30" style="color:white">
					From Draw #<?=$minid?> to Draw #<?=$maxid?>
				  you pressed <?=$tzpoints?> <?=$web_moneyname?>, gained <?=$sumpoints;?><?=$web_moneyname?>, 
				  you earned/lossed <?=$sumpoints-$tzpoints?><?=$web_moneyname?> 
				  <!--Ó¯¿÷±ÈÎª<?//=($sumpoints?number_format($sumpoints/$tzpoints*100,2):"00.00")?> %. -->
				  </td>
                </tr>
  <td bgcolor="#9F4F18"><table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="80" height="28" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">Draw</td>
          <td width="120" height="28" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">pressed time</td>
          <td align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white" width="120">winning number</td>
          <td width="100" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">pressed<?//=$web_moneyname?></td>
          <td width="100" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">gained<?//=$web_moneyname?></td>
          <td width="80" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">odds</td>
          <td width="80" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">gained/pressed</td>
          <td width="60" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">detail</td>
          <td width="120" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">save as press pattern</td>
        </tr>
        <?php
					$query=$db->query($sql." limit $rsnum,$intpage");
					while($rs=$db->fetch_array($query)){
						$kgh=explode("|",$rs["kgjg"]);
						$zjpl=explode("|",$rs["zjpl"]);
					?>
        <tr>
          <td height="32" align="center" bgcolor="#FCF5E1" class="font12game"><?=$rs["id"]?></td>
          <td align="center" bgcolor="#FFFFFF" class="font12game"><?=date("M d H:i:s",strtotime($rs["kgtime"]))?></td>
          <td align="center" bgcolor="#FFFFFF" class="font12game"><?="<img src=\"images/happy/number_".$kgh[3].".gif\" />"?></td>
          <td align="center" bgcolor="#FFFFFF" class="font12game"><?=number_format($rs["points"])?>
              <img src="<?=$web_moneypic?>" /></td>
          <td align="center" bgcolor="#FFFFFF" class="font12game"><?=number_format($rs["hdpoints"])."<img src=\"".$web_moneypic."\" />"?></td>
          <td align="center" bgcolor="#FFFFFF" class="font12game"><?=$zjpl[$kgh[3]-3]?></td>
          <td align="center" bgcolor="#FFFFFF" class="font12game"><?=number_format(($rs["hdpoints"]/$rs["points"]*100),2)."%"?></td>
          <td align="center" bgcolor="#FFFFFF"><a href="happymydetail.php?happyno=<?=$rs["id"]?>">view</a></td>
          <td align="center" bgcolor="#FFFFFF"><a href="happymodelsave.php?happyno=<?=$rs["id"]?>">save</a></td>
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