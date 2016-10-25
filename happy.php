<?php
include_once("inc/conn.php");
include_once("inc/function.php");

$query=$db->query("Select id,kgtime from {$web_dbtop}game16 where kj=0 Order by id asc");
if($rs=$db->fetch_array($query)){
	$kgqh=$rs["id"];
	$kgtime=DateDiff($rs["kgtime"],date("Y-m-d H:i:s"),"s");
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
			<LI class="current"><A href="happy.php">Luck16 home</A></LI>
			<LI><A href="happyhelp.php">Luck16 guide</A></LI>
			<LI><A href="happymylist.php">My press history</A></LI>
			<LI><A href="happymodel.php">Edit press pattern</A></LI>
			<LI><A href="happyautoset.php">Autopress</A></LI>
			<LI><A href="happydirection.php">Trend chart</A></LI>
		  </UL>
		</DIV>
		<DIV class="webgame-info">
			<DIV class="webgame-info-tabs">
			  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                  <td width="100" align="center">&nbsp;</td>
                  <td align="center" height="28"><span id="fSound"></span><font id="fHappy" style="font-weight:bold; color:#FF6633; font-size:14px;"></font></td>
                  <td width="100" align="center"><!--<a href="bbs/forum.php?forumsid=4" target="_blank"><img src="images/bbs_jl.gif" border="0" /></a>--></td>
                </tr>
              </table>
			  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td bgcolor="#9F4F18"><table width="100%" border="0" cellpadding="0" cellspacing="1">
                      <tr>
                        <td width="68" height="28" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">Draw</td>
                        <td width="100" height="28" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">Time</td>
                        <td width="134" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">Winning number</td>
                        <td width="72" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">Pressed</td>
                        <td width="127" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white"><?//=$web_moneyname?>Total</td>
                        <td width="85" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">Winners</td>
                        <td width="118" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">Pressed/Gained</td>
                        <td width="70" align="center" background="images/happy16_40.jpg" bgcolor="#FFFFFF" class="font-white">Operation</td>
                      </tr>
                      <?php
				$i=0;
				$intpage = 30;
				if (isset($_GET['page'])) {
					$rsnum = (intval($_GET['page']) -1)*$intpage;
				}
				else {
					$rsnum = 0;
				}
				$sql="Select * from {$web_dbtop}game16 Order by id desc";
				$query=$query=$db->query($sql);
				if($db->fetch_array($query))
					$intnum=$db->num_rows($query);
				$query=$query=$db->query($sql." limit $rsnum,$intpage");
				while($rs=$db->fetch_array($query)){
					$kgh=explode("|",$rs["kgjg"]);
					$hdpoints=0;
					$sumnumtzpoints=0;
					if($rs["kj"]!=1){
						$query_f=$db->query("Select sum(tzpoints) as points,sum(hdpoints) as hdpoints from {$web_dbtop}game16_kg_users_tz where NO=".$rs["id"]." and uid=".intval($_COOKIE["usersid"])." Order by id desc");
					}else{
						$query_f=$db->query("Select points,hdpoints from {$web_dbtop}game16_users_tz where NO=".$rs["id"]." and uid=".intval($_COOKIE["usersid"])." Order by id desc");
					}
					if($rs_f=$db->fetch_array($query_f)){
						$sumnumtzpoints=$rs_f["points"];
						$hdpoints=$rs_f["hdpoints"];
					}
				$bgcolor=($i%2==0?"#FFFFFF":"#F8F8F8");
				?>
                      <tr>
                        <td height="32" align="center" bgcolor="#FCF5E1" class="font12game"><?=$rs["id"];?></td>
                        <td align="center" bgcolor="<?=$bgcolor;?>" class="font12game"><?=date("M d H:i",strtotime($rs["kgtime"]));?></td>
                        <td align="center" bgcolor="<?=$bgcolor;?>" class="font12game"><?
					if($rs["kgjg"]){
					?>
                            <img align="absmiddle" src="images/happy/<?=$kgh[0];?>.gif"> + <img align="absmiddle" src="images/happy/<?=$kgh[1];?>.gif"> + <img align="absmiddle" src="images/happy/<?=$kgh[2];?>.gif">＝<img align="absmiddle" src="images/happy/number_<?=$kgh[3];?>.gif" />
                            <?
					 }else{
					 	echo"-";
					 }
					 ?>
                        </td>
                        <td align="center" bgcolor="<?=$bgcolor;?>" class="font12game"><?=$rs["tznum"];?></td>
                        <td align="center" bgcolor="<?=$bgcolor;?>" class="font12game"><?=number_format($rs["tzpoints"]);?>
                            <img src="<?=$web_moneypic?>" align="absmiddle" /></td>
                        <td align="center" bgcolor="<?=$bgcolor;?>" class="font12game"><? if($rs["kj"]==1){ echo"<a href=\"happywinlist.php?happyno=".$rs["id"]."\" class=\"b\">".$rs["zjrnum"]."</a>";}else{echo"-";}?></td>
                        <td align="center" bgcolor="<?=$bgcolor;?>" class="font12game"><? 
					if($rs["kj"]==1){
						if($sumnumtzpoints) {
							echo "<a href=\"happymydetail.php?happyno=".$rs["id"]."\"><font color=\"".($sumnumtzpoints>$hdpoints?"#FF0000":"#006600")."\">".number_format($sumnumtzpoints)." / ".number_format($hdpoints)."</font></a>";
						}else{
							echo "0 / 0";
						}
					}else{
						if($sumnumtzpoints){
							echo"<a href=\"happymydetail.php?happyno=".$rs["id"]."\"><font color=\"#FF0000\">".number_format($sumnumtzpoints)." / 0</font>";
						}else{
							echo "0 / 0";
						}
					}
					?></td>
                        <td align="center" bgcolor="<?=$bgcolor;?>">
						<? if($rs["kj"]==0 && $rs["iscancel"]!="yes"){ 
							echo"<a href=\"happyinsert.php?happyno=".$rs["id"]."\" class=\"b\">PRESS</a>";
						}else if($rs["kj"]==0 && $rs["iscancel"]=="yes"){
							echo "<span style='color:gray;'>canceled</span>";
					    }else if($rs["kj"]==1 && $rs["iscancel"]=="yes"){
							echo "<span style='color:gray;'>canceled</span>";
					    }else{
							echo"<a href=\"happymyinsert.php?happyno=".$rs["id"]."\"><span style='color:green;'>completed</span></a>";
						}?>
						</td>
                      </tr>
                      <?
				$i++;
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
			  <script type="text/javascript">
				<!--
				var happyno = "<?=$kgqh;?>";
				if(readCookie('cSoundHappy')=='1'){
					imgSound = '<img src="images/sound1.gif" onclick="setSound(this,0)" align="absmiddle" style="cursor:pointer" title="turn off alarm">';
				}
				else{
					imgSound = '<img src="images/sound0.gif" onclick="setSound(this,1)" align="absmiddle" style="cursor:pointer" title="turn on alarm">';
				}
				document.getElementById("fSound").innerHTML = imgSound;
				function ShowSecond(cDate){
					if(happyno != ""){
						if(cDate > 1){
							document.getElementById("fHappy").innerHTML = (--cDate)+" seconds left for draw #"+happyno;
							setTimeout("ShowSecond("+cDate+")",1000);
						}
						else{
							wavSound = '';
							if(readCookie('cSoundHappy')=='1'){
								wavSound = '<embed src="images/sound/security.wav" autostart=true hidden=true loop=false>';
							}
							document.getElementById("fHappy").innerHTML = "please refresh to view the winning number of draw# "+happyno+wavSound;
						}
					}
				}
				ShowSecond(parseInt("<?=$kgtime;?>"));
				function setSound(obj,v){
					if(v=='1'){
						obj.src='images/sound1.gif';
						obj.title='turn off alarm';
						obj.onclick=function (){setSound(this,0);}
					}
					else{
						obj.src='images/sound0.gif';
						obj.title='turn on alarm';
						obj.onclick=function (){setSound(this,1);}
					}
					setCookie('cSoundHappy',v);
				}
				function setCookie(cookieName,cookieValue){
					var date = new Date();
					date.setTime(date.getTime() + 24*60*60*1000000);
					document.cookie = cookieName + "=" + cookieValue + ";expires=" + date.toGMTString() + ";path=/";
				}
				function readCookie(cookieName){
					var aCookie = document.cookie.split("; ");
					for (var i=0; i < aCookie.length; i++){
					var aCrumb = aCookie[i].split("=");
					if(cookieName == aCrumb[0])
						return unescape(aCrumb[1]);
					}
					return null;
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